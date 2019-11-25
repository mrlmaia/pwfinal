<?php
    require_once 'Morador.class.php';
    require_once 'Conta.class.php';

	class Rateio
	{
		private  $id;
		private  $valor;
		private  $situacao;
        private  $morador;
        private  $conta;
                
        function __construct($valor, $situacao, $morador, $conta){
            $this->setId(0);
            $this->setValor($valor);
            $this->setSituacao($situacao);
            $this->setMorador($morador);
			$this->setConta($conta);
        }

		function __toString(){
			return $this->getMorador();
		}

        public function getId()
        {
            return $this->id;
        }

        public function setId($id)
        {
            $this->id = $id;
        }

        public function getValor()
        {
            return $this->valor;
        }

        public function setValor($valor)
        {
            $this->valor = floatval($valor);
        }

        public function getSituacao()
        {
            return $this->situacao;
        }

        public function setSituacao($situacao)
        {
            $this->situacao = $situacao;
        }

        public function getMorador()
        {
            return $this->morador;
        }

        public function setMorador($morador)
        {
            $this->morador = $morador;
        }

        public function getConta()
        {
            return $this->conta;
        }

        public function setConta($conta)
        {
            $this->conta = $conta;
        }


	}
?>
