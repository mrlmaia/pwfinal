<?php
require_once 'Republica.class.php';
require_once 'CrudDAO.class.php';

class RepublicaDAO extends CrudDAO{

	public function inserir($republica){
		$criterios = array(
			"nome" => $republica->getNome()
		);
		$sql = "INSERT INTO tbRepublica(nome) VALUES(:nome)";
		$situacao = parent::__inserir($sql, $criterios, $republica);
		return $situacao;
	}

	public function atualizar($republica){
		$criterios = array(
			"nome" => $republica->getNome(),
			"id" => $republica->getId()
		);
		$sql = "UPDATE tbRepublica SET nome = :nome WHERE id = :id";
		$situacao = parent::__atualizar($sql, $criterios);
		return $situacao;
	}

	public function excluir($republica){
		$sql = "DELETE FROM tbRepublica WHERE id = :id";
		$situacao = parent::__excluir($sql, $republica);
		return $situacao;
	}

	public function listar(){
		$republicas = null;
		$sql = "SELECT * FROM tbRepublica";
		$registros = parent::__listar($sql);
		foreach ($registros as $registro){
			$republica = new Republica(null);
			$republica->setId($registro['id']);
			$republica->setNome($registro['nome']);
			$republicas[] = $republica;
		}
		return $republicas;
	}

	public function buscarPorId($id){
		$republica = null;
		$sql = "SELECT * FROM tbRepublica WHERE id = :id";
		$registro = parent::__buscarPorId($sql, $id);
		$republica = new Republica(null);
		$republica->setId($registro['id']);
		$republica->setNome($registro['nome']);
		return $republica;
	}
}
?> 