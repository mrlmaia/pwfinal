<?php
	class Tipo
	{
		private  $id;
		private  $nome;
                
        function __construct($nome){
            $this->setId(0);
            $this->setNome($nome);
        }

		function __toString(){
			return $this->getNome();
		}
        		
        function getId(){
            return $this->id;
        }

        function getNome(){
            return $this->nome;
        }
		
        function setId($id){
            $this->id = intval($id);
        }

        function setNome($nome){
            $this->nome = $nome;
        }

	}
?>
