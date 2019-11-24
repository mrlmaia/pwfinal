<?php
  # metodo magico: require_once automatico
  function __autoload($class_name){
    require_once 'class/' . $class_name .'.class.php';
  }
  
	$id = 0;
	$nome = "";
	$preco = 0;
	$quantidade = 0;

	if (isset($_GET["id"])) {
    $ingredienteDAO = new IngredienteDAO();
		$ingrediente = $ingredienteDAO->buscarPorId($_GET["id"]);
		$id = $ingrediente->getId();
		$nome = $ingrediente->getNome();
		$preco = $ingrediente->getPreco();
		$quantidade = $ingrediente->getQuantidade();
		
	}
?>

<!doctype html>
<html>
  <head>
    <title>Cadastro Ingrediente</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
	<link type="text/css" rel="stylesheet" href="css/estilo.css"/>
  </head>
  <body>
  <?php require_once 'menu.php'?>
  <h5>Cadastro de Ingredientes</h5>
  <form id="formulario" action="ingredienteSalvar.php" method="post" enctype="multipart/form-data">
    <fieldset>
      <div class="row form-group">
        <div class="col-md-5">
          <input class="form-control" id="id" name="id" value="<?php echo $id?>" type="hidden">
          <label for="nome">Nome</label>  
          <input class="form-control" id="nome" name="nome" value="<?php if ($id!=0) {echo $nome;}?>" type="text" 
            placeholder="Informe o nome">
        </div>							
        <div class="col-md-3">
          <label for="preco">Preco</label>
          <input type="text" class="form-control" name="preco" value="<?php if ($id!=0) {echo $preco;}?>" id="preco" aria-describedby="helpId" placeholder="Informe o preco do ingrediente">
        </div>				
        <div class="col-md-3">
          <label for="quantidade">Quantidade</label>
          <input type="text" class="form-control" name="quantidade" id="quantidade" value="<?php if ($id!=0) {echo $quantidade;}?>" aria-describedby="helpId" placeholder="Informe o preco do ingrediente">
        </div>				
      </div>
      <div class="form-group">
        <div class="col-md-12">
          <button type="reset"  class="btn btn-danger float-right">Cancelar</button>	
          <button type="submit" name="salvar" class="btn btn-success float-right mx-1">Salvar</button>	
        </div>											
      </div>					
    </fieldset>
	</form>

    <!-- JavaScript -->
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/jquery.mask.js"></script>
    <script type="text/javascript" src="js/jquery.validate.js"></script>					
		<script type="text/javascript" src="js/ingredienteFormulario.js"></script>			
</body>
</html>