<?php

	require_once "mpdf/mpdf.php";
	require_once "class/TipoDAO.class.php";
	require_once "class/ContaDAO.class.php";

	$idTipo = $_GET['idTipo'];
	$valorMinimo = $_GET['valorMinimo'];
	$valorMaximo = $_GET['valorMaximo'];

	$valorMinimo = str_replace(".","",$valorMinimo );
	$valorMinimo = str_replace(",",".",$valorMinimo );

	$valorMaximo = str_replace(".","",$valorMaximo );
	$valorMaximo = str_replace(",",".",$valorMaximo );	

	$tipoDAO = new TipoDAO();
	$tipo = $tipoDAO->buscarPorId($idTipo);

	$contaDAO = new ContaDAO();	
	$contas = $contaDAO->listarPorTipoValor($tipo, $valorMinimo, $valorMaximo);

	$nomeTipo = $tipo->getId() == 0 ? "Todos" : $tipo;

	$mpdf = new mPDF();
	$mpdf->SetDisplayMode("fullpage");
	
	$html = "<div id='area01'>
				<img class='figura' src='logo.jpg'>
			</div>	
			<div id='area02'>	
				<h1 class='titulo'>Contas - Tipo: {$nomeTipo}</h1>
			</div>";

	$html = $html . "<div id='area03'>
					<hr>				
					<table class='tabela'>
						<thead>
							<tr>
								<th width='50%'>Republica</th>
								<th width='30%'>Mes</th>
								<th width='20%'>Valor</th>
							</tr>
						</thead>
						<tbody>";		

	foreach($contas as $conta){
		$html = $html . "<tr>";								
		$html = $html .	"<td>{$conta->getRepublica()}</td>";
		$html = $html . "<td>{$conta->getMes()}</td>";		
		$html = $html .	"<td>R$ ".number_format($conta->getValor(), 2, ',', '.')."</td>";
		$html = $html . "</tr>";						
	}	
					
	$html = $html . "</tbody> </table> </div>";	
	$dataEmissao = date("d/m/Y H:i:s");	
	$css = file_get_contents('exemplo05.css');	
	$mpdf->WriteHTML($css, 1);		
	$mpdf->SetHeader("Programação para Web |  | Emissão: {$dataEmissao}");
	$mpdf->setFooter("{PAGENO} de {nb}"); 
	$mpdf->WriteHTML($html, 2);	
	$mpdf->Output('exemplo05.pdf',I);

	exit();
	
?>
