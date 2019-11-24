<?php
function __autoload($class_name){
    require_once 'class/' . $class_name .'.class.php';
}

class Item 
{
    private $ingrediente;
    private $quantidadeIngrediente;

    public function getQuantidadeIngrediente()
    {
        return $this->quantidadeIngrediente;
    }
    public function setQuantidadeIngrediente(float $qtd = 0)
    {
        $this->quantidadeIngrediente = $qtd;
    }
    
}


?>