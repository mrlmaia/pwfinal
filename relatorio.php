
	<?php
		ob_start();
		require_once "mpdf/mpdf.php";
		require_once "class/ProdutoDAO.class.php";
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
									<th width='50%'>Produto</th>
									<th width='20%'>Valor</th>
									<th width='10%'>Quantidade</th>
									<th width='10%'>Subtotal</th>
								</tr>
							</thead>
							<tbody>
								";							
		$produtoDAO = new ProdutoDAO();
		$lista = $produtoDAO->listar();
		$total = 0;
		foreach($lista as $produto){
			$html = $html . "<tr>";								
			$html = $html .	"<td>{$produto->getDescricao()}</td>";
			$html = $html .	"<td>R$ ".number_format($produto->getValor(), 2, ',', '.')."</td>";
			$html = $html . "<td>{$produto->getQuantidade()}</td>";
			$quant = $produto->getQuantidade();
			$valor = $produto->getValor();
			$subtotal = $quant * $valor;
			$html = $html .	"<td>R$ ".number_format($subtotal, 2, ',', '.')."</td>";
			$html = $html . "</tr>";
			$total = $total + $subtotal;			
		}		
						
		$html = $html . "</tbody> </table> 
		<th width='10%'>Total a pagar</th>
		<td>R$ ".number_format($total, 2, ',', '.')."</td>
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
