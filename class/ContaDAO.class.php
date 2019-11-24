<?php	
	require_once 'Conta.class.php';
	require_once 'TipoDAO.class.php';
	require_once 'RepublicaDAO.class.php';
	require_once 'CrudDAO.class.php';

	class ContaDAO extends CrudDAO{

		public function inserir($conta){
			$criterios = array(
				"mes" =>  $conta->getMes(),
				"valor" =>  $conta->getValor(),
				"idTipo" =>  $conta->getTipo()->getId(),
				"idRepublica" =>  $conta->getRepublica()->getId()
			);
			$sql = "INSERT INTO tbConta(mes, valor, idTipo, idRepublica) VALUES(:mes, :valor, :idTipo, :idRepublica)";
			$situacao = parent::__inserir($sql, $criterios, $conta);
			return $situacao;
		}

		public function atualizar($conta){
			$criterios = array(
				"mes" =>  $conta->getMes(),
				"valor" =>  $conta->getValor(),
				"idTipo" =>  $conta->getTipo()->getId(),
				"idRepublica" =>  $conta->getRepublica()->getId(),
				"id" => $conta->getId()
			);
			$sql = "UPDATE tbConta SET mes = :mes, valor = :valor, idTipo = :idTipo, idRepublica = :idRepublica WHERE id = :id";
			$situacao = parent::__atualizar($sql, $criterios);
			return $situacao;
		}			
		
		public function excluir($conta){
			$sql = "DELETE FROM tbConta WHERE id = :id";
			$situacao = parent::__excluir($sql, $conta);
			return $situacao;
		}		

		public function listar(){
			$contas = null;
			$sql = "SELECT * FROM tbConta";
			$registros = parent::__listar($sql);
			$tipoDAO = new TipoDAO();
			$republicaDAO = new RepublicaDAO();
			foreach ($registros as $registro){
				$conta = new Conta(null, null, null, null);
				$conta->setId($registro['id']);
				$conta->setMes($registro['mes']);
				$conta->setValor($registro['valor']);
				$tipo = $tipoDAO->buscarPorId($registro['idTipo']);
				$conta->setTipo($tipo);
				$republica = $republicaDAO->buscarPorId($registro['idRepublica']);
				$conta->setRepublica($republica);
				$contas[] = $conta;
			}			
			return $contas;
		}

		public function buscarPorId($id){
			$conta = null;
			$sql = "SELECT * FROM tbConta WHERE id = :id";
			$registro = parent::__buscarPorId($sql, $id);
			$tipoDAO = new TipoDAO();
			$republicaDAO = new RepublicaDAO();
			$conta = new Conta(null, null, null, null);
			$conta->setId($registro['id']);
			$conta->setMes($registro['mes']);
			$conta->setValor($registro['valor']);
			$tipo = $tipoDAO->buscarPorId($registro['idTipo']);
			$conta->setTipo($tipo);
			$republica = $republicaDAO->buscarPorId($registro['idRepublica']);
			$conta->setRepublica($republica);
			return $conta;
		}

		public function listarPorMes($mes){
			$contas = null;
			$sql = "SELECT * FROM tbConta WHERE mes ='{$mes}'";
			$registros = parent::__listar($sql);
			$tipoDAO = new TipoDAO();
			$republicaDAO = new RepublicaDAO();
			foreach ($registros as $registro){
				$conta = new Conta(null, null, null, null);
				$conta->setId($registro['id']);
				$conta->setMes($registro['mes']);
				$conta->setValor($registro['valor']);
				$tipo = $tipoDAO->buscarPorId($registro['idTipo']);
				$conta->setTipo($tipo);
				$republica = $republicaDAO->buscarPorId($registro['idRepublica']);
				$conta->setRepublica($republica);
				$contas[] = $conta;
			}
			return $contas;
		}

		public function listarPorTipo($tipo){
			$contas = null;
			$sql = "SELECT * FROM tbConta WHERE idTipo = {$tipo->getId()}";
			$registros = parent::__listar($sql);
			$tipoDAO = new TipoDAO();
			$republicaDAO = new RepublicaDAO();
			foreach ($registros as $registro){
				$conta = new Conta(null, null, null, null);
				$conta->setId($registro['id']);
				$conta->setMes($registro['mes']);
				$conta->setValor($registro['valor']);
				$tipo = $tipoDAO->buscarPorId($registro['idTipo']);
				$conta->setTipo($tipo);
				$republica = $republicaDAO->buscarPorId($registro['idRepublica']);
				$conta->setRepublica($republica);
				$contas[] = $conta;
			}
			return $contas;
		}
		
		public function listarPorTipoValor($tipo,  $valorMinimo, $valorMaximo){

			$idTipo = $tipo->getId() == 0 ? "NULL" : $tipo->getId();
			$valorMinimo =  empty($valorMinimo) ? "NULL" : $valorMinimo;
			$valorMaximo =  empty($valorMaximo) ? "NULL" : $valorMaximo;
			
			$contas = null;
			$sql = "SELECT * FROM tbConta WHERE idTipo = {$tipo->getId()} AND valor >= IFNULL({$valorMinimo}, valor)
					 AND valor <= IFNULL({$valorMaximo}, valor)";
					 
			$registros = parent::__listar($sql);
			$tipoDAO = new TipoDAO();
			$republicaDAO = new RepublicaDAO();
			foreach ($registros as $registro){
				$conta = new Conta(null, null, null, null);
				$conta->setId($registro['id']);
				$conta->setMes($registro['mes']);
				$conta->setValor($registro['valor']);
				$tipo = $tipoDAO->buscarPorId($registro['idTipo']);
				$conta->setTipo($tipo);
				$republica = $republicaDAO->buscarPorId($registro['idRepublica']);
				$conta->setRepublica($republica);
				$contas[] = $conta;
			}
			return $contas;
		}	

		public function listarPorTipoMes($tipo, $mes){
			$contas = null;
			$sql = "SELECT * FROM tbConta WHERE idTipo = {$tipo->getId()} AND mes = '{$mes}'";
			$registros = parent::__listar($sql);
			$tipoDAO = new TipoDAO();
			$republicaDAO = new RepublicaDAO();
			foreach ($registros as $registro){
				$conta = new Conta(null, null, null, null);
				$conta->setId($registro['id']);
				$conta->setMes($registro['mes']);
				$conta->setValor($registro['valor']);
				$tipo = $tipoDAO->buscarPorId($registro['idTipo']);
				$conta->setTipo($tipo);
				$republica = $republicaDAO->buscarPorId($registro['idRepublica']);
				$conta->setRepublica($republica);
				$contas[] = $conta;
			}
			return $contas;
		}
		
		
		
		
	}
?> 