<?php
    
	class Produto
	{
        private  $id;
        private  $nome;
        private  $precoVenda;
        private  $precoCusto;
        private  $quantidade;
        private  $receita;
        
        function __construct($nome, $precoVenda, $quantidade) {
            $this->setId(0);
            $this->setnome($nome);
            $this->setPrecoVenda($precoVenda);
            $this->setQuantidade($quantidade);
            $this->setReceita(null); 
        }

		function __toString(){
			return $this->getnome();
		}

        function getId(){
            return $this->id;
        }

        function setId($id){
            $this->id = intval($id);
        }

        function getnome(){
            return $this->nome;
        }

        function setnome($nome){
            $this->nome = $nome;
        }   

        function getPrecoVenda(){
            return $this->precoVenda;
        }
        function setPrecoVenda($precoVenda){
            $this->precoVenda = floatval($precoVenda);
        }  
		
        function getQuantidade(){
            return $this->quantidade;
        }

        function setQuantidade($quantidade){
            $this->quantidade = intval($quantidade);
        }

        public function getPrecoCusto()
        {
            return $this->precoCusto;
        }

        public function setPrecoCusto($precoCusto)
        {
            $this->precoCusto = floatval($precoCusto);
        } 

        public function getReceita()
        {
                return $this->receita;
        }

        public function setReceita($receita)
        {
                $this->receita = $receita;
        }
	}
?>
