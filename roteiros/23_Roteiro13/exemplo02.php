<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Exemplos - Gráficos </title>
	<link type="text/css" rel="stylesheet" href="css/bootstrap.css" />
	<link type="text/css" rel="stylesheet" href="css/estilos.css" />
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="principal.php">Gráficos</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
			aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Alterna navegação">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav">
				<a class="nav-item nav-link" href="exemplo01.php">Exemplo01</a>
			</div>
			<div class="navbar-nav">
				<a class="nav-item nav-link active" href="exemplo02.php">Exemplo02</a>
			</div>			
			<div class="navbar-nav">
				<a class="nav-item nav-link" href="exemplo03.php">Exemplo03</a>
			</div>
			<div class="navbar-nav">
				<a class="nav-item nav-link" href="exemplo04.php">Exemplo04</a>
			</div>									
		</div>
	</nav>
	<br>
	<div class="container">	
		<h1 id="titulo">Exemplo 02 - Gastos por mês agrupados por tipo<h1>
		<div class="areaGrafico">
			<canvas id="grafico"></canvas>	 
		</div>	
	</div>
	<!--importar o jQuery.js antes do bootstrap.js-->
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/Chart-2.9.1.js"></script>
	<script type="text/javascript" src="js/exemplo02.js"></script>	
</body>

</html>