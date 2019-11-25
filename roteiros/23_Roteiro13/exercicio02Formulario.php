	<?php	
		require_once 'class/MoradorDAO.class.php';
		$moradorDAO = new MoradorDAO();
		$moradores = $moradorDAO->listar();
	?>
	<html>
		<head>
			<meta charset="utf-8"/>
			<title> Extrato por Morador</title>
			<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
			<link type="text/css" rel="stylesheet" href="css/estilo.css"/>
		</head>
		<body>
		<div class="container">
			<h5 id="titulo">Extrato por Morador</h5>
			<form id="formMorador" action="exercicio02.php" method="get">
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
							<label for="idMorador">Morador</label>
							<select class="form-control" id="idMorador" name="idMorador">
							<option value="" disable seleted>Selecione um morador</option>
							<?php
								foreach($moradores as $morador){
									echo "<option value='{$morador->getId()}'>{$morador}</option>";
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
			<script type="text/javascript" src="js/exercicio02Formulario.js"></script>				
		</body>
	</html>