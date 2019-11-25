<?php
	
	function __autoload($class_name){
        require_once 'class/' . $class_name .'.class.php';
	}

	# Request recebe via get e post
	$funcao = $_REQUEST["action"];

	if (function_exists($funcao)) {
		call_user_func($funcao);
	}


	// post id  receita 
	// adiciona o ingrediente na receita
	function adicionar()
	{
	$idReceita = $_POST["id"];
	$idIngrediente = $_POST["ingrediente"];
	$qtdIngrediente = $_POST["quantidadeIngrediente"];
	$receitaDAO = new ReceitaDAO();
	$situacao = $receitaDAO->adicionarIngrediente(intval($idReceita),intval($idIngrediente), floatval($qtdIngrediente));
	if ($situacao) {
		#atualizarPrecoCusto(intval($idReceita), intval($idIngrediente), floatval($qtdIngrediente)); 
		echo "<script>alert('Ingrediente adicionado com sucesso!'); location.href='ingredienteReceitaFormulario.php?id={$idReceita}';</script>";
	} else {
		echo "<script>alert('Falha ao adicionar ingrediente!'); location.href='ingredienteReceitaFormulario.php?id={$idReceita}';</script>"; 
	
	}
	}
	
?>