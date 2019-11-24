<?php
  # metodo magico: require_once automatico
  function __autoload($class_name){
    require_once 'class/' . $class_name .'.class.php';
  }
  
	$id = 0;
	$nome = "";
	$precoCusto = 0;
	$precoVenda = 0;
	$quantidade = 0;

	if (isset($_GET["id"])) {
    $produtoDAO = new ProdutoDAO();
		$produto = $produtoDAO->buscarPorId($_GET["id"]);
		$id = $produto->getId();
		$nome = $produto->getNome();
		$precoVenda = $produto->getPrecoVenda();
    $quantidade = $produto->getQuantidade();
  }
?>

<!doctype html>
<html>
  <head>
    <title>Cadastro de Produtos</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
	  <link type="text/css" rel="stylesheet" href="css/estilo.css"/>
  </head>
  <body>
    <?php 
      require_once "menu.php"
    ?>
    <div class="container">
      <form id="formulario" action="produtoSalvar.php" method="post" enctype="multipart/form-data">
        <fieldset>
          <div class="row form-group">
            <div class="col-md-6">
              <input class="form-control" id="id" name="id" value="<?php echo $id?>" type="hidden">
              <label for="nome">Nome</label>  
              <input class="form-control" id="nome" name="nome" value="<?php if ($id!=0) {echo $nome;}?>" type="text" 
                placeholder="Informe o nome">
              </div>							
              <div class="col-md-6">
                <label for="precoCusto">Preco de custo</label>
                <input type="text" class="form-control" name="precoCusto" value="<?php echo $precoCusto?>" id="precoCusto" aria-describedby="helpId" readonly placeholder="Informe o preco de custo">
              </div>				
              <div class="col-md-6">
                <label for="precoVenda">Preco de venda</label>
                <input type="text" class="form-control" name="precoVenda" value="<?php if ($id!=0) {echo $precoVenda;}?>" id="precoVenda" aria-describedby="helpId" placeholder="Informe o preco de venda">
              </div>				
              <div class="col-md-6">
                <label for="quantidade">Quantidade</label>
                <input type="text" class="form-control" name="quantidade" id="quantidade" value="<?php if ($id!=0) {echo $quantidade;}?>" aria-describedby="helpId" placeholder="Informe a quantidade de produtos no estoque">
              </div>				
            </div>	
          </tbody>
          
          <div class="form-group">
            <div class="col-md-12">
              <button type="submit" name="salvar" class="btn btn-primary float-right mx-1">Salvar</button>	
              <button type="reset"  class="btn btn-danger float-right">Cancelar</button>	
            </div>											
          </div>					
        </fieldset>
      </form>	
    </div>
    
    <!-- JavaScript -->
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/jquery.mask.js"></script>
    <script type="text/javascript" src="js/jquery.validate.js"></script>					
		<script type="text/javascript" src="js/produtoFormulario.js"></script>			
  </body>
</html>