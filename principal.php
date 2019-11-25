<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Gráficos Produto</title>
	<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
	<link type="text/css" rel="stylesheet" href="css/estilos.css" />
</head>

<body>
	<?php require_once 'menu.php' ?>
	<br>
	<div class="container">	
		<h1 id="titulo">Comparativo de preco de custo<h1>
		<div class="areaGrafico">
			<canvas id="grafico"></canvas>	 
		</div>	
	</div>
	
	<!--importar o jQuery.js antes do bootstrap.js-->
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
</body>

</html>