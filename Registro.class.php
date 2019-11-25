<?php
    
	class Registro
	{
        private  $nome;
        private  $qtd;
        private  $gastoTotal;
        
        function __construct($nome,$qtd, $gastoTotal) {
            $this->setNome($nome);
            $this->setQtd($qtd);
            $this->setGastoTotal($gastoTotal); 
        }

        function getNome(){
            return $this->nome;
        }

        function setNome($nome){
            $this->nome = $nome;
        }  

        function getQtd(){
            return $this->qtd;
        }

        function setQtd($qtd){
            $this->qtd = $qtd;
        }   

        public function getGastoTotal(){
            return $this->gastoTotal;
        }

        public function setGastoTotal($gastoTotal){
            $this->gastoTotal = floatval($gastoTotal);
        } 
	}
?>
