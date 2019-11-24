<?php
function __autoload($class_name){
    require_once 'class/' . $class_name .'.class.php';
}

$nome = "leite";
$preco = 2;
$quantidade = 10;
$ingrediente = new Ingrediente($nome,$preco, $quantidade);
$iDAO = new IngredienteDAO();
$iDAO->inserir($ingrediente);
$ingrediente2 = new Ingrediente("creme de leite", 2.48, 5);
$iDAO->inserir($ingrediente2);


?>