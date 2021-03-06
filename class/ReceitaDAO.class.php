<?php
require_once 'CrudDAO.class.php';

class ReceitaDAO extends CrudDAO{

	private $table = 'TbReceita';
	public function inserir($receita){
		$criterios = array(
			"nome" => $receita->getNome(),
			"rendimento" => $receita->getRendimento()
		);
		$sql = "INSERT INTO $this->table(nome, rendimento) VALUES(:nome, :rendimento)";
		$situacao = parent::__inserir($sql, $criterios, $receita);
		return $situacao;
	}

	public function atualizar($receita){
		$criterios = array(
			"nome" => $receita->getNome(),
			"rendimento" => $receita->getRendimento(),
			"id" => $receita->getId()
		);
		$sql = "UPDATE $this->table SET nome = :nome, rendimento = :rendimento WHERE id = :id";
		$situacao = parent::__atualizar($sql, $criterios);
		return $situacao;
	}

	public function excluir($id){
		$situacao = false;
		try {
			$sql = "DELETE FROM $this->table WHERE id = :id";
			$situacao = parent::__excluir($sql, $id);
			
		} catch (PDOException $erro) {
			parent::gerarLog($erro);
		}
		return $situacao;
	}

	public function listar(){
		$receitas = null;
		$sql = "SELECT * FROM $this->table";
		$registros = parent::__listar($sql);
		foreach ($registros as $registro){
			$receita = new Receita(null, null);
			$receita->setId($registro['id']);
			$receita->setNome($registro['nome']);
			$receita->setRendimento($registro['rendimento']);
			$receitas[] = $receita;
		}
		return $receitas;
	}
	public function listarEssesIngredientes(Receita $receita){
		$ingredientes = null;
		$id = $receita->getId();
		$sql = "SELECT r.id, r.nome, i.id, i.nome, qtdIngrediente as qtd from TbReceita r, TbReceitaIngrediente ri, TbIngrediente i where r.id = ri.idReceita and i.id = ri.idIngrediente and r.id = :id";
		$registros = parent::__listarEspecifico($sql, $id);
		$ingredienteDAO = new IngredienteDAO();
		if (isset($registros)) {
			foreach ($registros as $registro){
				$ingrediente = $ingredienteDAO->buscarPorId($registro['id']);
				$ingrediente->setQuantidade($this->getQuantidade($id, $ingrediente->getId()));
				$ingredientes[] = $ingrediente;
			}	
		}
		return $ingredientes;
	}

	private function getQuantidade(int $idReceita, int $idIngrediente){
		$sql = "SELECT qtdIngrediente as 'qtd' from TbReceitaIngrediente where idReceita = :id1 and idIngrediente = :id2";
		$registro = parent::__verificarExistenciaNN($sql, $idReceita, $idIngrediente);
		return $registro["qtd"];
	}

	public function buscarPorId($id){
		$receita = null;
		$sql = "SELECT * FROM $this->table WHERE id = :id";
		$registro = parent::__buscarPorId($sql, $id);
		$receita = new Receita(null, null);
		$receita->setId($registro['id']);
		$receita->setNome($registro['nome']);
		$receita->setRendimento($registro['rendimento']);
		return $receita;
	}
	public function adicionarIngrediente($idReceita, $idIngrediente, $qtdIngrediente){
		// verficar se existe esse ingrediente na receita
		//		se sim adiciono a qtd
		//		se nao adiciono
		$situacao = false;
		try {
			if($this->verificaIngrediente(intval($idIngrediente)) && !$this->verificaIngredienteReceita($idIngrediente, $idReceita)){
				$criterios = array(
					"id1" => $idReceita,
					"id2" => $idIngrediente,
					"qtdIngrediente" => $qtdIngrediente
				);
				$sql = "INSERT INTO TbReceitaIngrediente values(:id1,:id2,:qtdIngrediente)";
				$situacao = parent::__adicionaNN($sql, $criterios);
			}
		} catch (PDOException $erro) {
			parent::gerarLog($erro);
		}
		if ($situacao) {
			$this->atualizarPrecoCusto($idReceita);
		}
		return $situacao;
	}

	private function atualizarPrecoCusto(int $idReceita){
		// preco de custo = soma(quant do ingrediente * quant na receita)
		$receita = new Receita(null, null);
		$receita->setId($idReceita);
		$receita = $this->buscarPorId($idReceita);
		$precoCusto = 0;
		echo $precoCusto;
		$ingredientes = $this->listarEssesIngredientes($receita);
		$produto = $this->listarEsseProduto($idReceita);
		
		if ($ingredientes != null) {
			foreach ($ingredientes as $ingrediente) {
				$precoCusto += $ingrediente->getQuantidade() * $ingrediente->getPreco();
			}
			$precoCusto = $precoCusto / $receita->getRendimento();
		}
		$produtoDAO = new ProdutoDAO();
		$produtoDAO->atualizarPrecoCusto($produto->getId(), $precoCusto);
	}

	private function verificaIngrediente($id){
		$ingredienteDAO = new IngredienteDAO();
		if($ingredienteDAO->buscarPorId($id) == null){
			return false;
		} else {
			return true;
		}
	}

	private function verificaIngredienteReceita($idIngrediente, $idReceita){
		//buscar o id do ingrediente junto com o id da receita
		// select count(idIngrediente) from TbReceitaIngrediente where idIngrediente = 1 and idReceita = 1;
		$sql = "SELECT count(idIngrediente) as 'qtd' from TbReceitaIngrediente where idIngrediente = :id1 and idReceita = :id2";
		$registro = parent::__verificarExistenciaNN($sql, $idIngrediente, $idReceita);
		if ($registro["qtd"] == 1) {
			return true;
		}
		return false;
	}

	public function listarEsseProduto(int $idReceita){
		$sql = "SELECT * from TbProduto where idReceita = :id";
		$registros = parent::__listarEspecifico($sql, $idReceita);
		$produtoDAO = new ProdutoDAO();
		$produto = null;
		if (isset($registros)) {
			foreach ($registros as $registro) {
				$produto = $produtoDAO->buscarPorId($registro['id']);
			}
			
		}
		return $produto;
	}

	public function getUltimoId(){
		$LAST_ID = parent::getUltimoId();
		return $LAST_ID;
	}

}
?> 