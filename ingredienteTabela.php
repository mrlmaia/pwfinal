<?php	
    # metodo magico: require_once automatico
    function __autoload($class_name){
        require_once 'class/' . $class_name .'.class.php';
    }
    $ingredienteDAO = new IngredienteDAO();
    $ingredientes = $ingredienteDAO->listar();	
?>
	

<html>
	<head>
		<meta charset="utf-8"/>
		<title> Ingredientes </title>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
		<link type="text/css" rel="stylesheet" href="css/estilo.css"/>	
	</head>
	<body>
		<?php			
			require_once('menu.php'); 
		?>
		<div class="container">

			<h5 id="titulo"> Ingredientes </h5>

			<a class="btn btn-primary float-right" href="ingredienteFormulario.php">Novo</a>

			<table class="table">
				<thead>
					<tr>
						<th scope="col">Nome</th>
						<th scope="col">Preco</th>
						<th scope="col">Quantidade</th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
					<?php	
						foreach($ingredientes as $key => $registro){
							echo"<tr> 
									<td>
										{$registro->getNome()}
									</td>
									<td>
										{$registro->getPreco()}
									</td>
									<td>
										{$registro->getQuantidade()}
									</td>
									<td>
										<td>
											<a class='btn btn-success float-right' href='ingredienteFormulario.php?id={$registro->getId()}'>Editar</a> 
											<a class='btn btn-danger float-right mx-1' href='ingredienteExcluir.php?id={$registro->getId()}'>Excluir</a> 
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



