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

	public function atualizar($produto){
		$criterios = array(
			"nome" => $produto->getNome(),
			"precoVenda" => $produto->getPrecoVenda(),
			"quantidade" => $produto->getQuantidade(),
			"id" => $produto->getId()
		);
		$sql = "UPDATE $this->table SET nome = :nome, precoVenda =:precoVenda, quantidade =:quantidade WHERE id = :id";
		$situacao = parent::__atualizar($sql, $criterios);
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
}
?> 