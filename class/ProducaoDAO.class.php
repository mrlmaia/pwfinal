<?php
require_once 'Producao.class.php';
require_once 'CrudDAO.class.php';
require_once 'IngredienteDAO.class.php';

class ProducaoDAO extends CrudDAO{

	private $table = 'TbProducao';
	public function inserir($producao){
		$criterios = array(
			"data" => $producao->getData(),
			"gastoTotal" => $producao->getGastoTotal()
		);
		$sql = "INSERT INTO $this->table(dtProducao, gastoTotal) VALUES(:data, :gastoTotal)";
		$situacao = parent::__inserir($sql, $criterios, $producao);
		return $situacao;
	}

	public function atualizar($producao){
		$criterios = array(
			"data" => $producao->getData(),
			"id" => $producao->getId(),
			"gastoTotal" => $producao->getGastoTotal()
		);
		$sql = "UPDATE $this->table SET dtProducao = :data, gastoTotal = :gastoTotal WHERE id = :id";
		$situacao = parent::__atualizar($sql, $criterios);
		return $situacao;
	}

	public function excluir($id){
		$sql = "DELETE FROM $this->table WHERE id = :id";
		$situacao = parent::__excluir($sql, $id);
		return $situacao;
	}

	public function listar(){
		$Producaos = null;
		$sql = "SELECT * FROM $this->table ORDER BY dtProducao";
		$registros = parent::__listar($sql);
		foreach ($registros as $registro){
			$producao = new Producao(null,null);
			$producao->setId($registro['id']);
			$producao->setdata($registro['data']);
			$producao->setGastoTotal($registro['gastoTotal']);
			$producoes[] = $producao;
		}
		return $producoes;
	}

	public function listarPorMes(int $mes){
		$Producaos = null;
		$sql = "SELECT * from $this->table where month(dtProducao) = :mes";
		$registros = parent::__listarEspecifico($sql, $mes);
		foreach ($registros as $registro){
			$producao = new Producao(null,null);
			$producao->setId($registro['id']);
			$producao->setdata($registro['data']);
			$producao->setGastoTotal($registro['gastoTotal']);
			$producoes[] = $producao;
		}
		return $producoes;
	}
	
	public function buscarPorId($id){
		$producao = null;
		$sql = "SELECT * FROM $this->table WHERE id = :id";
		$registro = parent::__buscarPorId($sql, $id);
		$producao = new producao(null,null);
		$producao->setId($registro['id']);
		$producao->setdata($registro['data']);
		$producao->setGastoTotal($registro['gastoTotal']);
		return $producao;
	}

}
?> 