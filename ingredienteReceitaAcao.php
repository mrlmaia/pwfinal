<?php
	
	function __autoload($class_name){
        require_once 'class/' . $class_name .'.class.php';
	}
	echo "entrou";
	// get id  receita 
	// adiciona o ingrediente na receita
	$idReceita = $_POST["id"];
	$idIngrediente = $_POST["ingrediente"];
	echo $idReceita . $idIngrediente . $_POST["quantidadeIngrediente"];
	$receitaDAO = new ReceitaDAO();
	$situacao = $receitaDAO->adicionarIngrediente(intval($idReceita),intval($idIngrediente), $_POST["quantidadeIngrediente"]);
	if ($situacao) {
		echo "<script>alert('Ingrediente adicionado com sucesso!');<script>"; 
	} else {
		echo "<script>alert('Falaha ao adicionar ingrediente!');<script>";
	}
	echo "location.href='ingredienteReceitaFormulario.php?id=$idReceita';</script>";
?>