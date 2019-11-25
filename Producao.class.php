<?php
    
	class Producao
	{
        private  $id;
        private  $data;
        private  $gastoTotal;
        
        function __construct($data, $gastoTotal) {
            $this->setId(0);
            $this->setData($data);
            $this->setGastoTotal($gastoTotal); 
        }

        function getId(){
            return $this->id;
        }

        function setId($id){
            $this->id = intval($id);
        }

        function getData(){
            return $this->data;
        }

        function setData($data){
            $this->data = $data;
        }   

        public function getGastoTotal(){
            return $this->gastoTotal;
        }

        public function setGastoTotal($gastoTotal){
            $this->gastoTotal = floatval($gastoTotal);
        } 
	}
?>
