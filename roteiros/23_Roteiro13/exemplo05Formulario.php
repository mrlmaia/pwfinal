	<?php	
		require_once 'class/TipoDAO.class.php';
		$tipoDAO = new TipoDAO();
		$tipos = $tipoDAO->listar();
	?>
	<html>
		<head>
			<meta charset="utf-8"/>
			<title> Relatório de contas por Tipo e valores</title>
			<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
			<link type="text/css" rel="stylesheet" href="css/estilo.css"/>
		</head>
		<body>
		<div class="container">
			<h5 id="titulo">Contas - Relatório por Tipo e Valores</h5>
			<form id="formTipo" action="exemplo05.php" method="get">
					<div class="row form-group">
						<div class="col-md-3">
							<label for="valorMinimo">Valor mínimo</label>
							<input type="text" class="form-control valores" id="valorMinimo" name="valorMinimo">
						</div>
						<div class="col-md-3">
							<label for="valorMaximo">Valor máximo</label>
							<input type="text" class="form-control valores" id="valorMaximo" name="valorMaximo">
						</div>											
						<div class="col-md-6">
							<label for="idTipo">Tipo</label>
							<select class="form-control" id="idTipo" name="idTipo">
							<option value="" disable seleted>Todos</option>
							<?php
								foreach($tipos as $tipo){
									echo "<option value='{$tipo->getId()}'>{$tipo}</option>";
								}
							?>
							</select>
						</div>			
					</div>
					<div class="row form-group">
							<div class="col-md-12"> 
								<button type="submit" class="btn btn-success float-right mx-1">Imprimir</button>	
							</div>											
					</div>	
				</form >
			</div>
			<script type="text/javascript" src="js/jquery.js"></script>
			<script type="text/javascript" src="js/bootstrap.js"></script>	
			<script type="text/javascript" src="js/jquery.validate.js"></script>		
			<script type="text/javascript" src="js/jquery.mask.js"></script>		
			<script type="text/javascript" src="js/exemplo05Formulario.js"></script>				
		</body>
	</html>