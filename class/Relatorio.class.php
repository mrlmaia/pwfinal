<?php	
	require_once 'ContaDAO.class.php';
	require_once 'RateioDAO.class.php';
	require_once 'MoradorDAO.class.php';


	class Relatorio{
		
		public function imprimirConta($conta){
			$rateioDAO = new RateioDAO();

			echo "Republica: {$conta->getRepublica()} <br>";
			echo "Mês: {$conta->getMes()} <br>";
			echo "Conta: {$conta->getTipo()} - Valor: {$conta->getValor()}<br>";
			echo "Rateio: <br>";
			$rateios = $rateioDAO->listarPorConta($conta);
			foreach ($rateios as $rateio) {
				if($rateio->getSituacao() == 0){
					$situacao = "Em aberto";
				}else{
					$situacao = "Pago";
				}
				echo "Morador: {$rateio->getMorador()} - Valor: {$rateio->getValor()} - Situação: {$situacao} <br>";
			}
		}

		public function imprimirExtratoPorMorador($morador){
			$rateioDAO = new RateioDAO();
			echo "Morador: {$morador->getNome()} <br>";
			echo "CPF: {$morador->getCPF()} <br>";
			$rateios = $rateioDAO->listarPorMorador($morador);
			foreach ($rateios as $rateio) {
				if($rateio->getSituacao() == 0){
					$situacao = "Em aberto";
				}else{
					$situacao = "Pago";
				}
				echo "Mês: {$rateio->getConta()->getMes()} - Tipo: {$rateio->getConta()->getTipo()} - Valor: {$rateio->getValor()} - Situação: {$situacao} <br> ";
			}
		}


	}
?> 