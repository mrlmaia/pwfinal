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
				$ingredientes[] = $ingrediente;
			}	
		}
		return $ingredientes;
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
			echo "true";
		}
		return $situacao;
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

	public function listarEsseProduto($idReceita){
		$sql = "SELECT * from TbProduto where idReceita = :idReceita";
		$registro = parent::__listarEspecifico($sql,$idReceita);
		$produtoDAO = new ProdutoDAO();
		$produto = null;
		if (isset($registro)) {
			$produto = $produtoDAO->buscarPorId($registro['id']);
		}
		return $produto;
	}

	public function getUltimoId(){
		$LAST_ID = parent::getUltimoId();
		return $LAST_ID;
	}
}
?> 