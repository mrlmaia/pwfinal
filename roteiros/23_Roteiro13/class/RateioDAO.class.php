<?php	
	require_once 'MoradorDAO.class.php';
	require_once 'ContaDAO.class.php';
	require_once 'Rateio.class.php';
	require_once 'CrudDAO.class.php';

	class RateioDAO extends CrudDAO{

		public function inserir($rateio){
			$criterios = array(
				"valor" => $rateio->getValor(),
				"situacao" => $rateio->getSituacao(),
				"idMorador" => $rateio->getMorador()->getId(),
				"idConta" => $rateio->getConta()->getId()
			);
			$sql = "INSERT INTO tbRateio(valor, situacao, idMorador, idConta) VALUES(:valor, :situacao, :idMorador, :idConta)";
			$situacao = parent::__inserir($sql, $criterios, $rateio);
			return $situacao;
		}	
		
		public function atualizar($rateio){
			$criterios = array(
				"valor" => $rateio->getValor(),
				"situacao" => $rateio->getQuantidade(),
				"idMorador" => $rateio->getMorador()->getId(),
				"idConta" => $rateio->getConta()->getId(),
				"id" => $rateio->getId()
			);
			$sql = "UPDATE tbRateio SET valor = :valor, situacao = :situacao, idMorador = :idMorador, idConta = :idConta WHERE id = :id";
			$situacao = parent::__atualizar($sql, $criterios);
			return $situacao;
		}		

		public function excluir($rateio){
			$sql = "DELETE FROM tbRateio WHERE id = :id";
			$situacao = parent::__excluir($sql, $rateio);
			return $situacao;
		}
		
		public function listar(){
			$rateios = null;
			$sql = "SELECT * FROM tbRateio";
			$registros = parent::__listar($sql);
			$moradorDAO = new MoradorDAO();
			$contaDAO = new ContaDAO();
			foreach ($registros as $registro){
				$rateio = new Rateio(null, null,null, null);
				$rateio->setId($registro['id']);
				$rateio->setValor($registro['valor']);
				$rateio->setSituacao($registro['situacao']);
				$morador = $moradorDAO->buscarPorId($registro['idMorador']);
				$conta = $contaDAO->buscarPorId($registro['idConta']);
				$rateio->setMorador($morador);
				$rateio->setConta($conta);
				$rateios[] = $rateio;
			}			
			return $rateios;
		}

	

		public function buscarPorId($id){
			$rateio = null;
			$sql = "SELECT * FROM tbRateio WHERE id = :id";
			$registro = parent::__buscarPorId($sql, $id);
			$moradorDAO = new MoradorDAO();
			$contaDAO = new ContaDAO();
			$rateio = new Rateio(null, null,null, null);
			$rateio->setId($registro['id']);
			$rateio->setValor($registro['valor']);
			$rateio->setSituacao($registro['situacao']);
			$morador = $moradorDAO->buscarPorId($registro['idMorador']);
			$conta = $contaDAO->buscarPorId($registro['idConta']);
			$rateio->setMorador($morador);
			$rateio->setConta($conta);
			return $rateio;
		}

		public function listarPorConta($conta){
			$rateios = null;
			$sql = "SELECT * FROM tbRateio WHERE idConta = {$conta->getId()}";
			$registros = parent::__listar($sql);
			$moradorDAO = new MoradorDAO();
			$contaDAO = new ContaDAO();
			foreach ($registros as $registro){
				$rateio = new Rateio(null, null,null, null);
				$rateio->setId($registro['id']);
				$rateio->setValor($registro['valor']);
				$rateio->setSituacao($registro['situacao']);
				$morador = $moradorDAO->buscarPorId($registro['idMorador']);
				$conta = $contaDAO->buscarPorId($registro['idConta']);
				$rateio->setMorador($morador);
				$rateio->setConta($conta);
				$rateios[] = $rateio;
			}
			return $rateios;
		}

		public function listarPorMorador($morador){
			$rateios = null;
			$sql = "SELECT * FROM tbRateio WHERE idMorador = {$morador->getId()}";
			$registros = parent::__listar($sql);
			$moradorDAO = new MoradorDAO();
			$contaDAO = new ContaDAO();
			foreach ($registros as $registro){
				$rateio = new Rateio(null, null,null, null);
				$rateio->setId($registro['id']);
				$rateio->setValor($registro['valor']);
				$rateio->setSituacao($registro['situacao']);
				$morador = $moradorDAO->buscarPorId($registro['idMorador']);
				$conta = $contaDAO->buscarPorId($registro['idConta']);
				$rateio->setMorador($morador);
				$rateio->setConta($conta);
				$rateios[] = $rateio;
			}
			return $rateios;
		}

	}
?> 