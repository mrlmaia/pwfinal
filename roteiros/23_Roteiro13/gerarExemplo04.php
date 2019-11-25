<?php

	require_once 'class/ContaDAO.class.php';
	require_once 'class/TipoDAO.class.php';

	$tipoDAO = new TipoDAO();
	$tipos = $tipoDAO->listar();
	
	$contaDAO = new ContaDAO();
	$meses = ["janeiro", "fevereiro", "marco"];	

	$todosValores = array();
	
	foreach($tipos as $tipo){
		$valores = array();
		foreach($meses as $mes){
			$contas = $contaDAO->listarPorTipoMes($tipo, $mes);
			foreach($contas as $conta){			
				array_push($valores , $conta->getValor());
			}		
		}
		array_push($todosValores , $valores);
	}

	$dados = array('meses' => $meses, 'valores' => $todosValores);		  
	echo json_encode($dados);	
	
?>