<?php
require_once 'ProducaoProduto.class.php';
require_once 'CrudDAO.class.php';

class ProducaoProdutoDAO extends CrudDAO{

	private $table = 'TbProducaoProduto';
	public function inserir($ProducaoProduto){
		$criterios = array(
			"idProduto" => $ProducaoProduto->getIdProduto(),
			"qtdProduto" => $ProducaoProduto->getqtdProduto(),
			"idProducao" => $ProducaoProduto->getIdProducao()
		);
		$sql = "INSERT INTO $this->table(idProduto, idProducao, qtdProduto) VALUES(:idProduto, :idProducao, :qtdProduto)";
		$situacao = parent::__inserir($sql, $criterios, $ProducaoProduto);
		return $situacao;
	}

	public function atualizar($ProducaoProduto){
		$criterios = array(
			"idProducao" => $ProducaoProduto->getidProducao(),
			"idProduto" => $ProducaoProduto->getidProduto(),
			"qtdProduto" => $ProducaoProduto->getqtdProduto()
		);
		$sql = "UPDATE $this->table SET idProducao = :idProducao, idProduto =:idProduto, qtdProduto =:qtdProduto WHERE id = :id";
		$situacao = parent::__atualizar($sql, $criterios);
		return $situacao;
	}

	public function excluir($id){
		$sql = "DELETE FROM $this->table WHERE id = :id";
		$situacao = parent::__excluir($sql, $id);
		return $situacao;
	}

	public function listar(){
		$ProducaoProdutos = null;
		$sql = "SELECT * FROM $this->table ORDER BY idProducao";
		$registros = parent::__listar($sql);
		foreach ($registros as $registro){
			$ProducaoProduto = new ProducaoProduto(null,null,null);
			$ProducaoProduto->setId($registro['id']);
			$ProducaoProduto->setidProducao($registro['idProducao']);
			$ProducaoProduto->setidProduto($registro['idProduto']);
			$ProducaoProduto->setqtdProduto($registro['qtdProduto']);
			$producoes[] = $ProducaoProduto;
		}
		return $producoes;
	}
	
	public function buscarPorId($id){
		$ProducaoProduto = null;
		$sql = "SELECT * FROM $this->table WHERE id = :id";
		$registro = parent::__buscarPorId($sql, $id);
		$ProducaoProduto = new ProducaoProduto(null,null,null);
		$ProducaoProduto->setId($registro['id']);
		$ProducaoProduto->setidProducao($registro['idProducao']);
		$ProducaoProduto->setidProduto($registro['idProduto']);
		$ProducaoProduto->setqtdProduto($registro['qtdProduto']);
		return $ProducaoProduto;
	}

}
?> 