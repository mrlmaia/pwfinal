<?php
	function __autoload($class_name){
        require_once 'class/' . $class_name .'.class.php';
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Gráficos Produto</title>
	<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
	<link type="text/css" rel="stylesheet" href="css/estilos.css" />
</head>

<body>
	<?php 
		require_once 'menu.php';
		$produtoDAO = new ProdutoDAO();
		$produtos = $produtoDAO->listarComPC();
	?>
	<canvas id="grafico-comparativo" height="110%" weidth="80%"></canvas>	 
	
	<script typ="text/javascript" src="js/Chart-2.7.1.js"></script>
	<script>
		var ctx = document.getElementById("grafico-comparativo")
		<?php
			// label
			$nomes = array();
			$precosCusto = array();
			$precosVenda = array();
			
			foreach ($produtos as $produto) {
				$nomes[] = $produto->getNome();
				$precosVenda[] = $produto->getPrecoVenda();
				$precosCusto[] = $produto->getPrecoCusto();
			}

			
			
		?>
		// type (bar), data, options
		var chartGraph = new Chart(ctx,{
			type: 'bar',
			data:{
				labels: [
					<?php 
						foreach ($nomes as $nome) {
							echo "\"{$nome}\",";
						}
					?>
				],
				datasets: [
					{
						label:"Preco de custo",
						data: [
							<?php
								foreach ($precosCusto as $precoCusto) {
									echo $precoCusto . ",";
								}
							?>
						],
						borderWidth: 3,
						borderColor: 'rgba(0,191,255,0.8)',
						backgroundColor: 'rgba(0,191,255,0.5)'
					},
					{
						label:"Preco de venda",
						data: [
							<?php
								foreach ($precosVenda as $precoVenda) {
									echo $precoVenda . ",";
								}
							?>
						],
						borderWidth: 3,
						borderColor: 'rgba(0,128,0,0.8)',
						backgroundColor: 'rgba(0,128,0,0.5)'
					}
				],
			},
			options: {
				title:{
					display:true,
					fontSize: 20,
					text: "Comparativo de preco de custo/venda"
				},
				layout: {
					padding: {
						left: 50,
						right: 0,
						top: 0,
						bottom: 0
					}
				},
				scales: {
					xAxes: [{
						gridLines: {
							offsetGridLines: true
						},
					}],
					yAxes: [{
						gridLines: {
							offsetGridLines: true,
						},
						ticks: {
							min: 0,
							stepSize: 1
						}						
					}]
				}
			}
		});

	</script>

	<!--importar o jQuery.js antes do bootstrap.js-->
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
</body>

</html>