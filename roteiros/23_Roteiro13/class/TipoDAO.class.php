<?php	
	require_once 'Tipo.class.php';
	require_once 'CrudDAO.class.php';

	class TipoDAO extends CrudDAO{

		public function inserir($tipo){
			$criterios = array(
				"nome" => $tipo->getNome()
			);
			$sql = "INSERT INTO tbTipo(nome) VALUES(:nome)";
			$situacao = parent::__inserir($sql, $criterios, $tipo);
			return $situacao;
		}

		public function atualizar($tipo){
			$criterios = array(
				"nome" => $tipo->getNome(),
				"id" => $tipo->getId()
			);
			$sql = "UPDATE tbTipo SET nome = :nome WHERE id = :id";
			$situacao = parent::__atualizar($sql, $criterios);
			return $situacao;
		}						

		public function excluir($tipo){
			$sql = "DELETE FROM tbTipo WHERE id = :id";
			$situacao = parent::__excluir($sql,$tipo);
			return $situacao;
		}

		public function listar(){
			$tipos = null;
			$sql = "SELECT * FROM tbTipo order by nome";
			$registros = parent::__listar($sql);
			foreach ($registros as $registro){
				$tipo = new Tipo(null);
				$tipo->setId($registro['id']);
				$tipo->setNome($registro['nome']);
				$tipos[] = $tipo;
			}			
			return $tipos;
		}

		public function buscarPorId($id){
			$tipo = null;
			$sql = "SELECT * FROM tbTipo WHERE id = :id";
			$registro = parent::__buscarPorId($sql, $id);
			$tipo = new Tipo(null);
			$tipo->setId($registro['id']);
			$tipo->setNome($registro['nome']);
			return $tipo;
		}
	}
?> 