<?php
    
	class Receita
	{
        private  $id;
        private  $nome;
        private  $rendimento;
<<<<<<< HEAD
        private $ingredientes;
=======
>>>>>>> 6e583d6e513433204583c84db984debc2788725c
        
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
<<<<<<< HEAD
            $this->id = $id;
=======
            $this->id = intval($id);
>>>>>>> 6e583d6e513433204583c84db984debc2788725c
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

<<<<<<< HEAD

        public function getIngredientes()
        {
                return $this->ingredientes;
        }

        public function setIngredientes($ingredientes)
        {
                $this->ingredientes = $ingredientes;
=======
        public function setAllIngredientes($ingredientes)
        {
            # code...
>>>>>>> 6e583d6e513433204583c84db984debc2788725c
        }
	}
?>
