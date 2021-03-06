<?php
require_once 'Produto.class.php';
require_once 'CrudDAO.class.php';
require_once 'IngredienteDAO.class.php';

class ProdutoDAO extends CrudDAO{

	private $table = 'TbProduto';
	public function inserir($produto){
		$criterios = array(
			"nome" => $produto->getNome(),
			"precoVenda" => $produto->getPrecoVenda(),
			"quantidade" => $produto->getQuantidade()
		);
		$sql = "INSERT INTO $this->table(nome, precoVenda, quantidade) VALUES(:nome, :precoVenda, :quantidade)";
		$situacao = parent::__inserir($sql, $criterios, $produto);
		return $situacao;
	}

	public function atualizar(Produto $produto, int $idReceita = 0){
		$criterios = array(
			"nome" => $produto->getNome(),
			"precoVenda" => $produto->getPrecoVenda(),
			"quantidade" => $produto->getQuantidade(),
			"id" => $produto->getId()
		);
		$sql = "UPDATE $this->table SET nome = :nome, precoVenda =:precoVenda, quantidade =:quantidade WHERE id = :id";
		$situacao = parent::__atualizar($sql, $criterios);
		if ($idReceita != null && $situacao) {
			$this->adicionarReceita($produto->getId(), $idReceita);
		}
		return $situacao;
	}

	public function excluir($id){
		$sql = "DELETE FROM $this->table WHERE id = :id";
		$situacao = parent::__excluir($sql, $id);
		return $situacao;
	}

	public function listar(){
		$produtos = null;
		$sql = "SELECT * FROM $this->table ORDER BY nome";
		$registros = parent::__listar($sql);
		foreach ($registros as $registro){
			$produto = new Produto(null,null,null);
			$produto->setId($registro['id']);
			$produto->setnome($registro['nome']);
			$produto->setprecoVenda($registro['precoVenda']);
			$produto->setQuantidade($registro['quantidade']);
			$produto->setReceita($registro['idReceita']);
			if ($registro['precoCusto'] != null) {
				$produto->setPrecoCusto($registro['precoCusto']);
			}
			$produtos[] = $produto;
		}
		return $produtos;
	}
	public function listarPorSabor(){
        $Producaos = null;
        $sql = "SELECT nome, sum(qtdProduto)as qtd, sum(gastoTotal) as gastoTotal FROM tbProducao p, tbproducaoproduto pp, tbProduto pdt
        where p.id = pp.idProducao
        and pdt.id = pp.idProduto
        group by nome";
        $registros = parent::__listar($sql);
        foreach ($registros as $registro){
            $producao = new Registro(null,null,null);
            $producao->setNome($registro['nome']);
            $producao->setQtd($registro['qtd']);
            $producao->setGastoTotal($registro['gastoTotal']);
            $producoes[] = $producao;
        }
        return $producoes;
    }
	public function listarComPC(){
		$produtos = null;
		$sql = "SELECT p.id, p.nome, precoCusto, precoVenda from TbProduto p inner join TbReceita r on p.IdReceita = r.id ORDER BY p.nome";
		$registros = parent::__listar($sql);
		foreach ($registros as $registro){
			$produto = new Produto(null,null,null);
			$produto->setId($registro['id']);
			$produto->setnome($registro['nome']);
			$produto->setprecoVenda($registro['precoVenda']);
			if (!empty($registro['quantidade'])) {
				$produto->setQuantidade($registro['quantidade']);
			}
			if (!empty($registro['idReceita'])) {
				$produto->setReceita($registro['idReceita']);
			}
			if ($registro['precoCusto'] != null) {
				$produto->setPrecoCusto($registro['precoCusto']);
			}
			$produtos[] = $produto;
		}
		return $produtos;
	}

	public function listarProducoes(){
		$produtos = null;
		$sql = "SELECT sum(qtdProduto) as 'soma', idProduto  from TbProducaoProduto group by idProduto";
		$registros = parent::__listar($sql);
		foreach ($registros as $registro){
			$produto = $this->buscarPorId($registro["idProduto"]);
			$quantidadeProduto = $registro["soma"];
			$produtos[] = $produto;
		}
		return $produtos;
	}

	public function listarEssesIngredientes(Produto $produto){
		try {	
		$ingredientes = null;
		$id = $produto->getId();
		$sql = "SELECT i.id, qtdIngrediente from TbProduto p, TbProdutoIngrediente pi, TbIngrediente i where p.id = pi.idProduto and i.id = pi.idIngrediente and p.id = :id";
		$registros = parent::__listarEspecifico($sql, $id);
		$ingredienteDAO = new IngredienteDAO();
		
		if (isset($registros)) {
			foreach ($registros as $registro){
				$ingrediente = $ingredienteDAO->buscarPorId($registro['id']);
				$ingredientes[] = $ingrediente;
			}	
		}
		} catch (PDOException $erro) {
			parent::gerarLog($erro);
			$ingredientes = null;
		}
		return $ingredientes;
	}
	public function listarIngredientesQuantidades(Produto $produto){
		
		$ingredientesQtd = array();
		$ingredienteQtd = array(
			"ingrediente" => null,
			"qtdIngrediente" => 0
		);
		try {	
			$id = $produto->getId();
			$sql = "SELECT i.id, qtdIngrediente from TbReceita r, TbReceitaIngrediente ri, TbIngrediente i where r.id = ri.idReceita and i.id = ri.idIngrediente and r.id = :id";
			$registros = parent::__listarEspecifico($sql, $id);
			$ingredienteDAO = new IngredienteDAO();

			if (isset($registros)) {
				foreach ($registros as $registro){
					$ingredienteQtd["ingrediente"] = $ingredienteDAO->buscarPorId($registro['id']);
					$ingredienteQtd["qtdIngrendiente"] = $registro['qtdIngrediente'];
					$ingredientesQtd[] = $ingredienteQtd;
				}	
			}
		} catch (PDOException $erro) {
			parent::gerarLog($erro);
			$ingredientesQtd = null;
		}
		return $ingredientesQtd;
	}

	public function buscarPorId($id){
		$produto = null;
		$sql = "SELECT * FROM $this->table WHERE id = :id";
		$registro = parent::__buscarPorId($sql, $id);
		$produto = new Produto(null,null, null);
		$produto->setId($registro['id']);
		$produto->setnome($registro['nome']);
		$produto->setPrecoVenda($registro['precoVenda']);
		$produto->setQuantidade($registro['quantidade']);
		return $produto;
	}
	public function listarProdutosDisponiveis(){
		$produtos = null;
		$sql = "SELECT * from $this->table where id not in(select p.id from TbProduto p inner join TbReceita r on p.IdReceita = r.id)";
		$registros = parent::__listar($sql);
		foreach ($registros as $registro){
			$produto = new Produto(null,null,null);
			$produto->setId($registro['id']);
			$produto->setnome($registro['nome']);
			$produto->setprecoVenda($registro['precoVenda']);
			$produto->setQuantidade($registro['quantidade']);
			$produto->setReceita($registro['idReceita']);
			$produtos[] = $produto;
		}
		return $produtos;
	}
	public function adicionarReceita($idProduto, $idReceita)
	{
		$criterios = array(
			"idReceita" => $idReceita,
			"id" => $idProduto
		);
		$sql = "UPDATE $this->table SET idReceita = :idReceita WHERE id = :id";
		$situacao = parent::__atualizar($sql, $criterios);
		return $situacao;
	}
	public function atualizarPrecoCusto($idProduto, $precoCusto){
		$sql = "UPDATE $this->table SET precoCusto = :precoCusto where id = :id";
		$criterios = array(
			"precoCusto" => $precoCusto,
			"id" => $idProduto
		);
		$situacao = parent::__atualizar($sql, $criterios);
		return $situacao;
	}
}
?> 