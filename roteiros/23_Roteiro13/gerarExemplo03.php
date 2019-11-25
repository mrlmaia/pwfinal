<?php

	require_once 'class/ContaDAO.class.php';
	
	$contaDAO = new ContaDAO();
	$contas = $contaDAO->listar();
	$meses = ["janeiro", "fevereiro", "marco"];	
	$valores = array();
	
	foreach($meses as $mes){
		$valor = 0;
		foreach($contas as $conta){
			if($conta->getMes() == $mes){
				$valor = $valor + $conta->getValor();
			}
		}
		array_push($valores , $valor);
	}

	$dados = array('meses' => $meses, 'valores' => $valores);		  
	echo json_encode($dados);	
	
?>