<?php
    
	class Receita
	{
        private  $id;
        private  $nome;
        private  $rendimento;
        private $ingredientes;
        
        function __construct($nome, $rendimento) {
            $this->setId(0);
            $this->setNome($nome);
            $this->setRendimento($rendimento);
        }
        function __tooString(){
            return $this->nome;
        }
        function getId(){
            return intval($this->id);
        }

        function setId(int $id){
            $this->id = intval($id);
        }

        function getnome(){
            return $this->nome;
        }

        function setNome($nome){
            $this->nome = $nome;
        }     
		
        function getRendimento(){
            return $this->rendimento;
        }

        function setRendimento($rendimento){
            $this->rendimento = intval($rendimento);
        }


        public function getIngredientes()
        {
                return $this->ingredientes;
        }

        public function setIngredientes($ingredientes)
        {
                $this->ingredientes = $ingredientes;
        }
	}
?>
