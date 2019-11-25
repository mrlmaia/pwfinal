<?php
    
	class Producao
	{
        private  $id;
        private  $dia;
        private  $mes;
        private  $ano;
        private  $gastoTotal;
        
        function __construct($dia, $mes, $ano, $gastoTotal) {
            $this->setId(0);
            $this->setDia($dia);
            $this->setMes($mes);
            $this->setAno($ano);
            $this->setGastoTotal($gastoTotal); 
        }

        function getId(){
            return $this->id;
        }

        function setId($id){
            $this->id = intval($id);
        }

        function getDia(){
            return $this->dia;
        }

        function setDia($dia){
            $this->dia = $dia;
        }   

        function getMes(){
            return $this->mes;
        }
        function setMes($mes){
            $this->mes = $mes;
        }  
		
        function getAno(){
            return $this->ano;
        }

        function setAno($ano){
            $this->ano = $ano;
        }

        public function getGastoTotal(){
            return $this->gastoTotal;
        }

        public function setGastoTotal($gastoTotal){
            $this->gastoTotal = floatval($gastoTotal);
        } 
	}
?>
