<?php
require_once 'Produto.class.php';
require_once 'CrudDAO.class.php';

class ProdutoDAO extends CrudDAO{

	public function inserir($produto){
		$criterios = array(
			"descricao" => $produto->getDescricao(),
			"valor" => $produto->getValor(),
			"quantidade" => $produto->getQuantidade()
		);
		$sql = "INSERT INTO tbProduto(descricao, valor, quantidade) VALUES(:descricao, :valor, :quantidade)";
		$situacao = parent::__inserir($sql, $criterios, $produto);
		return $situacao;
	}

	public function atualizar($produto){
		$criterios = array(
			"descricao" => $produto->getDescricao(),
			"valor" => $produto->getValor(),
			"quantidade" => $produto->getQuantidade(),
			"id" => $produto->getId()
		);
		$sql = "UPDATE tbProduto SET descricao = :descricao, valor =:valor, quantidade =:quantidade WHERE id = :id";
		$situacao = parent::__atualizar($sql, $criterios);
		return $situacao;
	}

	public function excluir($produto){
		$sql = "DELETE FROM tbProduto WHERE id = :id";
		$situacao = parent::__excluir($sql,$morador);
		return $situacao;
	}

	public function listar(){
		$produtos = null;
		$sql = "SELECT * FROM tbProduto ORDER BY descricao";
		$registros = parent::__listar($sql);
		foreach ($registros as $registro){
			$produto = new Produto(null,null);
			$produto->setId($registro['id']);
			$produto->setDescricao($registro['descricao']);
			$produto->setValor($registro['valor']);
			$produto->setQuantidade($registro['quantidade']);
			$produtos[] = $produto;
		}
		return $produtos;
	}

	public function buscarPorId($id){
		$produto = null;
		$sql = "SELECT * FROM tbProduto WHERE id = :id";
		$registro = parent::__buscarPorId($sql, $id);
		$produto = new Produto(null,null);
		$produto->setId($registro['id']);
		$produto->setDescricao($registro['descricao']);
		$produto->setValor($registro['valor']);
		$produto->setQuantidade($registro['quantidade']);
		return $produto;
	}
}
?> 