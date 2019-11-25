<?php
class Morador
{
    private  $id;
    private  $nome;
    private  $cpf;

    function __construct($nome, $cpf){
        $this->setId(0);
        $this->setNome($nome);
        $this->setCPF($cpf);
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

    function getCPF(){
        return $this->cpf;
    }

    function setId($id){
        $this->id = intval($id);
    }

    function setNome($nome){
        $this->nome = $nome;
    }

    function setCPF($cpf){
        $this->cpf = $cpf;
    }

}
?>
