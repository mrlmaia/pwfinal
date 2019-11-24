<?php	
	require_once 'Ingrediente.class.php';
	require_once 'CrudDAO.class.php';

	class IngredienteDAO extends CrudDAO{
		private $table = 'TbIngrediente';

		public function inserir($ingrediente){
			$criterios = array(
				"nome" =>  $ingrediente->getNome(),
				"preco" =>  $ingrediente->getPreco(),
				"quantidade" =>  $ingrediente->getQuantidade()
			); 
			$sql = "INSERT INTO $this->table (nome, preco, quantidade) VALUES(:nome, :preco, :quantidade)";
			$situacao = parent::__inserir($sql, $criterios, $ingrediente);
			return $situacao;
		}

		public function atualizar($ingrediente){

			$criterios = array(
				"nome" =>  $ingrediente->getNome(),
				"preco" =>  $ingrediente->getPreco(),
				"quantidade" =>  $ingrediente->getQuantidade(),
			    "id" => $ingrediente->getId()
			);
			$sql = "UPDATE $this->table SET nome = :nome, preco = :preco, quantidade = :quantidade WHERE id = :id";
			$situacao = parent::__atualizar($sql, $criterios);
			return $situacao;
		}		
		
		public function excluir($id){
			$sql = "DELETE FROM $this->table WHERE id = :id";
			$situacao = parent::__excluir($sql, $id);
			return $situacao;
		}		

		public function listar(){
			$ingredientes = null;
			$sql = "SELECT * FROM $this->table";
			$registros = parent::__listar($sql);
			
			foreach ($registros as $registro){
				$ingrediente = new Ingrediente("", null, null);
				$ingrediente->setId($registro['id']);
				$ingrediente->setNome($registro['nome']);
				$ingrediente->setPreco($registro['preco']);
				$ingrediente->setQuantidade($registro['quantidade']);
				$ingredientes[] = $ingrediente;
			}
			return $ingredientes;
		}

		public function buscarPorId($id){
			$ingrediente = null;
			$sql = "SELECT * FROM $this->table WHERE id = :id";
			$registro = parent::__buscarPorId($sql, $id);
			$ingrediente = new Ingrediente($registro['nome'], $registro['preco'], $registro['quantidade']);
            $ingrediente->setId($registro['id']);
            return $ingrediente;
		}

		public function listarThisIngredientes($id){
			$ingrediente = null;
			$sql = "";
			return null;
		}
		
	}
?> 