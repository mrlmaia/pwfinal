
	<?php
		ob_start();
		require_once "mpdf/mpdf.php";
		require_once "class/ProducaoDAO.class.php";
		$nome = $_GET["nome"];
		$mpdf = new mPDF();
		$mpdf->SetDisplayMode("fullpage");	
		$html = "<div id='area01'>
					<img class='figura' src='logo.jpg'>
				</div>	
				<div id='area02'>	
					<h1 class='titulo'>Relatório de Produção</h1>
				</div>";	
		$html = $html . "<div id='area03'>
						<hr>
						<table class='tabela'>
							<thead>
								<tr>
									<th width='30%'>Produto</th>
									<th width='30%'>Gasto total</th>
									<th width='30%'>Quantidade</th>
								</tr>
							</thead>
							<tbody>
								";							
		$ProducaoDAO = new ProducaoDAO();
		$produto = $ProducaoDAO->buscarPorSabor($nome);
		$total = 0;
			$html = $html . "<tr>";								
			$html = $html .	"<td>{$produto->getNome()}</td>";
			$html = $html .	"<td>R$ ".number_format($produto->getGastoTotal(), 2, ',', '.')."</td>";
			$html = $html . "<td>{$produto->getQtd()}</td>";
			$html = $html . "</tr>";		
						
		$html = $html . "</tbody> </table> 
		</div>";	
		$dataEmissao = date("d/m/Y H:i:s");	
		$css = file_get_contents('exercicio01.css');	
		$mpdf->WriteHTML($css, 1);		
		$mpdf->SetHeader("Programação para Web |  | Emissão: {$dataEmissao}");
		$mpdf->setFooter("{PAGENO} de {nb}"); 
		$mpdf->WriteHTML($html, 2);	
		$mpdf->Output('relatorio.pdf',I);
		exit();
	?>
