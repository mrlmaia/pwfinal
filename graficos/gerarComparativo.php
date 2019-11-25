<?php
    function __autoload($class_name){
        require_once 'class/' . $class_name .'.class.php';
    }
    
    $produtoDAO = new ProdutoDAO();
    $produtos = $produtoDAO->listarComPC();

    // label
    $nomes[];
    foreach ($produtos as $produto) {
        $nomes[] = $produto->getNome();
    }

	$todosValores = array();
	
	foreach($produtos as $produto){
		$valores = array();
        $precos = array($produto->getPrecoCusto(), $produto->getPrecoVenda());
        foreach($precos as $preco){			
            array_push($valores , $preco[0], $preco[1]);
        }	
		array_push($todosValores , $valores);
	}

	$dados = array('nomes' => $nomes, 'valores' => $todosValores);		  
	echo json_encode($dados);	
	
?>