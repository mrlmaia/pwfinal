<?php
    require_once 'Tipo.class.php';
    require_once 'Republica.class.php';

	class Conta
	{
		private  $id;
		private  $mes;
        private  $valor;
        private  $tipo;
        private  $republica;
                
        function __construct($mes, $valor, $tipo, $republica){
            $this->setId(0);
            $this->setMes($mes);
            $this->setValor($valor);
            $this->setTipo($tipo);
            $this->setRepublica($republica);
        }

		function __toString(){
            return $this->getMes();
		}

        public function getId()
        {
            return $this->id;
        }

        public function setId($id)
        {
            $this->id = $id;
        }

        public function getMes()
        {
            return $this->mes;
        }

        public function setMes($mes)
        {
            $this->mes = $mes;
        }

        public function getValor()
        {
            return $this->valor;
        }

        public function setValor($valor)
        {
            $this->valor = floatval($valor);
        }

        public function getTipo()
        {
            return $this->tipo;
        }

        public function setTipo($tipo)
        {
            $this->tipo = $tipo;
        }

        public function getRepublica()
        {
            return $this->republica;
        }

        public function setRepublica($republica)
        {
            $this->republica = $republica;
        }


	}
?>
