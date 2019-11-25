<?php
require_once 'Morador.class.php';
require_once 'CrudDAO.class.php';

class MoradorDAO extends CrudDAO{

	public function inserir($morador){
		$criterios = array(
			"nome" => $morador->getNome(),
			"cpf" => $morador->getCPF()
		);
		$sql = "INSERT INTO tbMorador(nome, cpf) VALUES(:nome, :cpf)";
		$situacao = parent::__inserir($sql, $criterios, $morador);
		return $situacao;
	}

	public function atualizar($morador){
		$criterios = array(
			"nome" => $morador->getNome(),
			"cpf" => $morador->getCPF(),
			"id" => $morador->getId()
		);
		$sql = "UPDATE tbMorador SET nome = :nome, cpf =:cpf WHERE id = :id";
		$situacao = parent::__atualizar($sql, $criterios);
		return $situacao;
	}

	public function excluir($morador){
		$sql = "DELETE FROM tbMorador WHERE id = :id";
		$situacao = parent::__excluir($sql,$morador);
		return $situacao;
	}

	public function listar(){
		$moradores = null;
		$sql = "SELECT * FROM tbMorador";
		$registros = parent::__listar($sql);
		foreach ($registros as $registro){
			$morador = new Morador(null,null);
			$morador->setId($registro['id']);
			$morador->setNome($registro['nome']);
			$morador->setCPF($registro['cpf']);
			$moradores[] = $morador;
		}
		return $moradores;
	}

	public function buscarPorId($id){
		$morador = null;
		$sql = "SELECT * FROM tbMorador WHERE id = :id";
		$registro = parent::__buscarPorId($sql, $id);
		$morador = new Morador(null,null);
		$morador->setId($registro['id']);
		$morador->setNome($registro['nome']);
		$morador->setCPF($registro['cpf']);
		return $morador;
	}
}
?> 