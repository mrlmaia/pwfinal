<?php
	# metodo magico: require_once automatico
	function __autoload($class_name){
		require_once 'class/' . $class_name .'.class.php';
	}
	$id = $_POST["id"];
	$nome = $_POST['nome'];
	$precoVenda = $_POST['precoVenda'];
	$quantidade = $_POST['quantidade'];
	
	$produto = new Produto($nome,$precoVenda, $quantidade);
	$produto->setId($id);
	$produtoDAO = new ProdutoDAO();
	
	if($id == 0){
		$situacao = $produtoDAO->inserir($produto);
	}else{
		$situacao = $produtoDAO->atualizar($produto);
	}

	if($situacao){
		echo "<script>alert('Produto cadastrado'); location.href='produtoTabela.php';</script>"; 
	}else{
		echo "<script>alert('Erro ao salvar o produto'); location.href='produtoTabela.php';</script>"; 	
	}	
	
			
?>