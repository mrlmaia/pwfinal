<?php
	# metodo magico: require_once automatico
	function __autoload($class_name){
		require_once 'class/' . $class_name .'.class.php';
	}
	$idProducao = $_POST["id"];
	$dia = $_POST['dia'];
	$mes = $_POST['mes'];
	$ano = $_POST['ano'];
	$gastoTotal = $_POST['gastoTotal'];
	$idProduto = $_POST['produto'];
	$quantidade = $_POST['quantidade'];
	$producao = new Producao($dia,$mes,$ano,$gastoTotal);
	$producao->setId($idProducao);
	$producaoDAO = new ProducaoDAO();
	
	if($idProducao == 0){
		$situacao = $producaoDAO->inserir($producao);
		$id = $producao->getId();
		$producaoProduto = new ProducaoProduto($idProduto,$id,$quantidade);
		$producaoProdutoDAO = new ProducaoProdutoDAO();
		$resultado = $producaoProdutoDAO->inserir($producaoProduto);
	}else{
		$situacao = $producaoDAO->atualizar($producao);
		$resultado = $producaoProdutoDAO->atualizar($producaoProduto);
	}

	if($situacao && $resultado){
		echo "<script>alert('Producao cadastrado'); location.href='producaoTabela.php';</script>"; 
	}else{
		echo "<script>alert('Erro ao salvar o producao'); location.href='producaoTabela.php';</script>"; 	
	}	
	
			
?>