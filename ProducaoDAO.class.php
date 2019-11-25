<?php
require_once 'Producao.class.php';
require_once 'CrudDAO.class.php';
require_once 'IngredienteDAO.class.php';

class ProducaoDAO extends CrudDAO{

	private $table = 'TbProducao';
	public function inserir($producao){
		$criterios = array(
			"dtProducao" => $producao->getdtProducao(),
			"gastoTotal" => $producao->getGastoTotal()
		);
		$sql = "INSERT INTO $this->table(dtProducao, gastoTotal) VALUES(:dtProducao, :gastoTotal)";
		$situacao = parent::__inserir($sql, $criterios, $producao);
		return $situacao;
	}

	public function atualizar($producao){
		$criterios = array(
			"dtProducao" => $producao->getdtProducao(),
			"id" => $producao->getId(),
			"gastoTotal" => $producao->getGastoTotal()
		);
		$sql = "UPDATE $this->table SET dtProducao = :dtProducao, gastoTotal = :gastoTotal WHERE id = :id";
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
			$producao->setdtProducao($registro['dtProducao']);
			$producao->setGastoTotal($registro['gastoTotal']);
			$producoes[] = $producao;
		}
		return $producoes;
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
	
	public function buscarPorId($id){
		$producao = null;
		$sql = "SELECT * FROM $this->table WHERE id = :id";
		$registro = parent::__buscarPorId($sql, $id);
		$producao = new producao(null,null);
		$producao->setId($registro['id']);
		$producao->setdtProducao($registro['dtProducao']);
		$producao->setGastoTotal($registro['gastoTotal']);
		return $producao;
	}

}
?> 