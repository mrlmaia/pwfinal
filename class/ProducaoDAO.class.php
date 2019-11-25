<?php
require_once 'Producao.class.php';
require_once 'CrudDAO.class.php';
require_once 'IngredienteDAO.class.php';

class ProducaoDAO extends CrudDAO{

	private $table = 'TbProducao';
	public function inserir($producao){
		$criterios = array(
			"mes" => $producao->getMes(),
			"ano" => $producao->getAno(),
			"dia" => $producao->getDia(),
			"gastoTotal" => $producao->getGastoTotal()
		);
		$sql = "INSERT INTO $this->table(dia, mes, ano, gastoTotal) VALUES(:dia, :mes, :ano, :gastoTotal)";
		$situacao = parent::__inserir($sql, $criterios, $producao);
		return $situacao;
	}

	public function atualizar($producao){
		$criterios = array(
			"dia" => $producao->getDia(),
			"mes" => $producao->getmes(),
			"ano" => $producao->getano(),
			"id" => $producao->getId(),
			"gastoTotal" => $producao->getGastoTotal()
		);
		$sql = "UPDATE $this->table SET dia = :dia, mes =:mes, ano =:ano, gastoTotal = :gastoTotal WHERE id = :id";
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
		$sql = "SELECT * FROM $this->table ORDER BY dia";
		$registros = parent::__listar($sql);
		foreach ($registros as $registro){
			$producao = new Producao(null,null,null,null);
			$producao->setId($registro['id']);
			$producao->setdia($registro['dia']);
			$producao->setmes($registro['mes']);
			$producao->setano($registro['ano']);
			$producao->setGastoTotal($registro['gastoTotal']);
			$producoes[] = $producao;
		}
		return $producoes;
	}

	public function listarPorMes(){
		$Producaos = null;
		$sql = "SELECT * FROM $this->table group BY mes";
		$registros = parent::__listar($sql);
		foreach ($registros as $registro){
			$producao = new Producao(null,null,null,null);
			$producao->setId($registro['id']);
			$producao->setdia($registro['dia']);
			$producao->setmes($registro['mes']);
			$producao->setano($registro['ano']);
			$producao->setGastoTotal($registro['gastoTotal']);
			$producoes[] = $producao;
		}
		return $producoes;
	}
	
	public function buscarPorId($id){
		$producao = null;
		$sql = "SELECT * FROM $this->table WHERE id = :id";
		$registro = parent::__buscarPorId($sql, $id);
		$producao = new producao(null,null,null,null);
		$producao->setId($registro['id']);
		$producao->setdia($registro['dia']);
		$producao->setmes($registro['mes']);
		$producao->setano($registro['ano']);
		$producao->setGastoTotal($registro['gastoTotal']);
		return $producao;
	}

}
?> 