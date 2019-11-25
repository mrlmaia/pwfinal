<?php
 
	class Produto
	{
        private  $id;
        private  $descricao;
        private  $valor;
        private  $quantidade;
         	 
        function __construct() {
            $this->setId(0);
            $this->setDescricao("");
            $this->setValor(0);
            $this->setQuantidade(0);
        }

		function __toString(){
			return $this->getDescricao();
		}

        function getId(){
            return $this->id;
        }

        function setId($id){
            $this->id = intval($id);
        }

        function getDescricao(){
            return $this->descricao;
        }

        function setDescricao($descricao){
            $this->descricao = $descricao;
        }   

        function getValor(){
            return $this->valor;
        }
        function setValor($valor){
            $this->valor = floatval($valor);
        }  
		
        function getQuantidade(){
            return $this->quantidade;
        }

        function setQuantidade($quantidade){
            $this->quantidade = intval($quantidade);
        }

	}
?>
