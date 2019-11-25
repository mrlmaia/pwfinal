<?php
  # metodo magico: require_once automatico
  function __autoload($class_name){
    require_once 'class/' . $class_name .'.class.php';
    require_once 'class/ProdutoDAO.class.php';
    require_once 'class/Produto.class.php';
  }
  
	$id = 0;
	$mes = "";
	$dia = 0;
	$ano = 0;
	$gastoTotal = 0;

	if (isset($_GET["id"])) {
    $producaoDAO = new ProducaoDAO();
		$producao = $producaoDAO->buscarPorId($_GET["id"]);
		$id = $producao->getId();
		$dia = $producao->getDia();
    $mes = $producao->getMes();
    $ano = $producao->getAno();
		$gastoTotal = $producao->getGastoTotal();
  }

  $produtoDAO = new ProdutoDAO();
  $produtos = $produtoDAO->listar();
?>

<!doctype html>
<html>
  <head>
    <title>Cadastro de Producao</title>
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
      <form id="formulario" action="producaoSalvar.php" method="post" enctype="multipart/form-data">
        <fieldset>
          <div class="row form-group">
            <div class="col-md-4">
              <input class="form-control" id="id" name="id" value="<?php echo $id?>" type="hidden">
              <label for="mes">Dia</label>  
               <select name="dia" id="dia" value="1" class="form-control">
                    <?php
                      while($i < 31){
                        echo '<option value="$i">' . $i . '</option>';
                        $i++;
                      }
                    ?>
               </select>
              </div>							
              <div class="col-md-4">
                <label for="mes">Mes</label>  
                 <select name="mes" id="mes" class="form-control">
                      <option value="jul">Julho</option>
                      <option value="ago">Agosto</option>
                      <option value="set">Setembro</option>
                      <option value="out">Outubro</option>
                      <option value="nov">Novembro</option>
                      <option value="dez">Dezembro</option>
                 </select>
              </div>
              <div class="col-md-4">
                <label for="ano">Ano</label>
                <input type="text" class="form-control" name="ano" value="" id="ano" aria-describedby="helpId" placeholder="Informe o ano">
              </div>				
              <div class="col-md-4">
                <label for="gastoTotal">Gasto Total</label>
                <input type="text" class="form-control" name="gastoTotal" value="" id="gastoTotal" aria-describedby="helpId" placeholder="Informe o gasto total">
              </div>
              <div class="col-md-4">
                <label for="produto">Produto</label>  
                 <select name="produto" id="produto" class="form-control">
                      <?php
                          foreach($produtos as $key => $produto){
                              echo '<option value=' . $produto->getId() . '>' . $produto->getNome() . '</option>';
                          }
                      ?>
                 </select>
              </div>
              <div class="col-md-4">
                <label for="quantidade">Quantidade</label>
                <input type="text" class="form-control" name="quantidade" value="" id="quantidade" aria-describedby="helpId" placeholder="Informe a quantidade">
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