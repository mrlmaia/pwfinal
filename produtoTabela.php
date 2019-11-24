<?php	
    # metodo magico: require_once automatico
    function __autoload($class_name){
        require_once 'class/' . $class_name .'.class.php';
    }
    $produtoDAO = new ProdutoDAO();
    $produtos = $produtoDAO->listar();	
?>
	

<html>
	<head>
		<meta charset="utf-8"/>
		<title> Produtos </title>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
		<link type="text/css" rel="stylesheet" href="css/estilo.css"/>	
	</head>
	<body>
		<?php			
			require_once('menu.php'); 
		?>
		<div class="container">

			<h5 id="titulo"> Produtos </h5>

			<a class="btn btn-primary float-right" href="produtoFormulario.php">Novo</a>

			<table class="table">
				<thead>
					<tr>
						<th scope="col">Nome</th>
						<th scope="col">Preco de venda</th>
						<th scope="col">Preco de custo</th>
						<th scope="col">Quantidade em estoque</th>
						<th scope="col"></th>
					</tr>
				</thead>
				<tbody>
					<?php	
						if (!empty($produtos)):
						foreach($produtos as $key => $registro): ?>
                            <tr> 
                                <td>
                                    <?php echo $registro->getNome()?>
                                </td>
                                <td>
                                    <?php echo $registro->getPrecoVenda()?>
                                </td>
                                <td>
                                    <?php echo $registro->getPrecoCusto()?>
                                </td>
                                <td>
                                    <?php echo $registro->getQuantidade()?>
                                </td>
                                <td>
                                    <td>
                                        <a class='btn btn-secundary float-right' href='ingredienteReceitaFormulario.php?id=<?php echo $registro->getReceita()?>'>Ver receita</a> 
                                        <a class='btn btn-success float-right' href='produtoFormulario.php?id=<?php echo $registro->getId()?>'>Editar</a> 
                                        <a class='btn btn-danger float-right mx-1' href='produtoExcluir.php?id=<?php echo $registro->getId()?>'>Excluir</a> 
                                    </td>
                                </td>
                            </tr>
						<?php endforeach;
						endif;	
					?>							
				</tbody>
			</table>		

		</div> 	
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>			
	</body>
</html>



