<?php
  # metodo magico: require_once automatico
  function __autoload($class_name){
    require_once 'class/' . $class_name .'.class.php';
  }
  
	$id = 0;
	$nome = "";
	$rendimento = 0;

	if (isset($_GET["id"])) {
		$receitaDAO = new ReceitaDAO();
		$receita = $receitaDAO->buscarPorId($_GET["id"]);
		$id = $receita->getId();
		$nome = $receita->getnome();
		$rendimento = $receita->getRendimento();
		$esseProduto = $receitaDAO->listarEsseProduto($id);
  }
  $produtoDAO = new ProdutoDAO();
  $produtosDisponiveis = $produtoDAO->listarProdutosDisponiveis();
?>

<!doctype html>
<html>
  <head>
    <title>Registro de receita</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
    <link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
	<link type="text/css" rel="stylesheet" href="css/estilo.css"/>
  </head>
  <body>
    <?php require_once 'menu.php' ?>
  <div class='container'>
    <h5>Registro de receita</h5>
    <form id="formulario" action="receitaAcao.php" method="post" enctype="multipart/form-data">
      <fieldset>
        <div class="row form-group">
          <div class="col-md-4">
            <input type="hidden" id="action" name="action" />
            <input class="form-control" id="id" name="id" value="<?php echo $id?>" type="hidden">
            <label for="nome">Nome</label>  
            <input class="form-control" id="nome" name="nome" value="<?php if ($id!=0) {echo $nome;}?>" type="text" 
              placeholder="Informe o nome">
          </div>										
          <div class="col-md-4">
            <label for="rendimento">Rendimento</label>
            <input type="text" class="form-control" name="rendimento" id="rendimento" value="<?php if ($id!=0) {echo $rendimento;}?>" aria-describedby="helpId" placeholder="Informe o preco do ingrediente">
          </div>							
          <div class="col-md-4">
            <label for="produto">Produto</label>
              <select class="form-control" id="produto" name="produto">
                <?php if (isset($produtosDisponiveis)):	
                    foreach($produtosDisponiveis as $key => $registro): //input que passa o id do produto referente a receita?> 
                      <option value="<?php echo $registro->getId()?>"> 
                        <?php echo $registro->getNome()?>
                      </option>
                    <?php endforeach;
                  endif;
                ?>
              </select>
          </div>				
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <button type="reset"  class="btn btn-danger float-right">Cancelar</button>	
            <button type="submit" name="salvar" class="btn btn-success float-right mx-1" onclick="doPost('formulario', 'salvar')">Salvar</button>	
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
		<script type="text/javascript" src="js/receitaFormulario.js"></script>			
</body>
</html>