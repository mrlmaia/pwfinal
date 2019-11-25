<?php
    
	class ProducaoProduto
	{
        private  $idProducao;
        private  $idProduto;
        private  $qtdProduto;
        
        function __construct($idProduto, $idProducao, $qtdProduto) {
            $this->setIdProducao($idProducao);
            $this->setIdProduto($idProduto);
            $this->setqtdProduto($qtdProduto);
        }

        function getIdProducao(){
            return $this->idProducao;
        }

        function setIdProducao($idProducao){
            $this->idProducao = $idProducao;
        }   

        function setId($idProducao){
            $this->idProducao = $idProducao;
        }

        function getIdProduto(){
            return $this->idProduto;
        }
        function setIdProduto($idProduto){
            $this->idProduto = $idProduto;
        }  
		
        function getqtdProduto(){
            return $this->qtdProduto;
        }

        function setqtdProduto($qtdProduto){
            $this->qtdProduto = $qtdProduto;
        } 
	}
?>
