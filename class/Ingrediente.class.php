<?php
        class Ingrediente
        {
                private $id = 0;
                private $nome;
                private $preco;
                private $quantidadeEmEstoque;

                function __construct($nome, $preco, $quantidade){
                        $this->setId(0);
                        $this->setNome($nome);
                        $this->setPreco($preco);
                        $this->setQuantidade($quantidade);
                }
                public function getId()
                {
                        return intval($this->id);
                }
                public function getNome()
                {
                        return $this->nome;
                }
                public function setNome(String $nome)
                {      
                        if ($nome != null) {
                                $this->nome = $nome;                
                        }
                }
                public function getPreco()
                {
                        return $this->preco;
                }
                public function setPreco($preco)
                {
                        $this->preco = $preco;
                }

                public function getQuantidade()
                {
                        return $this->quantidadeEmEstoque;
                }               
                public function setQuantidade($quantidade)
                {
                        $this->quantidadeEmEstoque = $quantidade;
                }
                public function setId($id)
                {
                        $this->id = $id;
                }
        }
?>
