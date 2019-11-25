<?php
	
	function __autoload($class_name){
        require_once 'class/' . $class_name .'.class.php';
	}

	// get id  receita 
	// adiciona o ingrediente na receita
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

	function atualizarPrecoCusto($idReceita, $idIngrediente, $qtdIngrediente){
		// listar todos os inredientes com sua respectivas qtd do respectivo produto
		// preco de custo = ingredientes.precoun * qtd
		$produtoDAO = new ProdutoDAO();
		$receitaDAO = new ReceitaDAO();
		$produto = $receitaDAO->listarEsseProduto($idReceita);
		$essesIngredientesQtd = $produtoDAO->listarIngredientesQuantidades($produto);
		foreach ($essesIngredientesQtd as $ingredienteQtd) {
			echo "Ingrediente: " . $ingredienteQtd["ingrediente"]->getNome();
			echo "Quantidade: " . $ingredienteQtd["qtdIngrediente"];
		}
	}
?>