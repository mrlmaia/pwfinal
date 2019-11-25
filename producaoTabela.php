<?php	
    # metodo magico: require_once automatico
    function __autoload($class_name){
        require_once 'class/' . $class_name .'.class.php';
    }
    $producaoDAO = new ProducaoDAO();
    $producoes = $producaoDAO->listarPorSabor();	
?>
	

<html>
	<head>
		<meta charset="utf-8"/>
		<title> Producao </title>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
		<link type="text/css" rel="stylesheet" href="css/estilo.css"/>	
	</head>
	<body>
		<?php			
			require_once('menu.php'); 
		?>
		<div class="container">

			<h5 id="titulo"> Producao </h5>

			<a class="btn btn-primary float-right" href="producaoFormulario.php">Novo</a>

			<table class="table">
				<thead>
					<tr>
						<th scope="col">Sabor</th>
						<th scope="col">Quantidade</th>
						<th scope="col">Gasto Total</th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
					<?php	
						foreach($producoes as $key => $registro){
							echo"<tr> 
									<td>
										{$registro->getNome()}
									</td>
									<td>
										{$registro->getQtd()}
									</td>
									<td>
										{$registro->getGastoTotal()}
									</td>
									<td>
										<td>
											<a class='btn btn-danger float-right mx-1' href='relatorio.php?id={$registro->getNome()}'>Relatorio</a> 
										</td>
									</td>
								</tr>";
						}	
					?>							
				</tbody>
			</table>		

		</div> 	
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>			
	</body>
</html>



