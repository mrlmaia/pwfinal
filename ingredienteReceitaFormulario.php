<?php
    # metodo magico: require_once automatico
    function __autoload($class_name){
        require_once 'class/' . $class_name .'.class.php';
    }
    session_start();
	$id = 0;
	$nomeReceita = "";
	$precoCusto = 0;
	$precoVenda = 0;
	$rendimento = 0;
    $receita = null;
    $receitaDAO = new ReceitaDAO();	
	if (isset($_GET["id"]) && !empty($_GET["id"])) {
        $receita = $receitaDAO->buscarPorId($_GET["id"]);
		$id = $receita->getId();
		$nomeReceita = $receita->getNome();
        $rendimento = $receita->getRendimento();
        $_SESSION['ingredientes'] = $receitaDAO->listarEssesIngredientes($receita);
    } else {
        echo "<script>alert(\"Esse produto não contem receita\");location.href='produtoTabela.php';</script>";
    }

    $ingredienteDAO = new IngredienteDAO();
    $todosIngredientes = $ingredienteDAO->listar();

?>

<!doctype html>
<html>
    <head>
    <title>Cadastro de receitaas</title>
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
        <form id="formulario" action="ingredientereceitaAcao.php" method="post" enctype="multipart/form-data">
            <fieldset>
                <div class="row form-group">
                    <div class="col-md-6">
                        <input type="hidden" id="action" name="action" />
                        <input class="form-control" id="id" name="id" value="<?php echo $id?>" type="hidden">
                        <label for="nome">Nome</label>  
                        <input class="form-control" id="nome" name="nome" value="<?php echo $nomeReceita?>" type="text" readonly>
                    </div>							
                    			
                    <div class="col-md-6">
                        <label for="rendimento">Rendimento</label>
                        <input type="text" class="form-control"  name="rendimento" id="rendimento" value="<?php echo $rendimento?>" aria-describedby="helpId" readonly placeholder="Informe o preco do receitaa">
                    </div>	
                </div>			
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-body">
                                <div class="form-group">
                                <label for="ingredientes">Ingredientes</label>
                                    <select class="form-control" id="ingrediente" name="ingrediente">
                                        <?php 
                                            if (isset($todosIngredientes)):	
                                                foreach($todosIngredientes as $key => $registro): //input que passa o id do ingrediente?> 
                                                    <option value="<?php echo $registro->getId()?>"> 
                                                        <?php echo $registro->getNome()?>
                                                    </option>
                                                <?php endforeach;
                                            endif; 
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                <label for="quantidadeIngrediente">Quantidade</label>
                                <input class="form-control" type="text" name="quantidadeIngrediente" id="quantidadeIngrediente">
                            </div>
                        </div>
                    </div><!--// .panel -->
                </div><!--// .col-md -->
                <button id="btAdicionar" class="btn btn-primary" onclick="doPost('formulario', 'adicionar')">
                    Adicionar Ingrediente
                </button>        
            </fieldset>
        </form>	
        
        
        <div class="col-md-12">
            
            
            <?php
                $ingredientesReceita = $_SESSION['ingredientes'];
            ?>
            
            <div class="col-md-12">
                    <h5>Ingredientes</h5>
                </div>		
            <table id="ingredienteTable" class="table table-bordered table-condensed table-striped">
                <thead>
                <tr>
                    <th>Ingrediente</th>
                    <th>Preco Un</th>
                    <th>Quantidade</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        if (!empty($_SESSION['ingredientes'])):	
                            foreach($_SESSION['ingredientes'] as $key => $registro): ?>
                                <tr> 
                                    <td>
                                        <?php echo $registro->getNome()?>
                                    </td>
                                    <td>
                                        <?php echo $registro->getPreco()?>
                                    </td>
                                    <td>
                                        <?php echo $registro->getQuantidade()?>
                                    </td>
                                    <td>
                                        <?php echo ($registro->getPreco()*$registro->getQuantidade())?>
                                    </td>
                                    <td>
                                        <a class='btn btn-outline-danger float-right mx-1' onclick="doPost('formulario', 'excluir')">Excluir</a> 
                                    </td>
                                </tr>
                            <?php endforeach;
                        endif;
                    ?>

                </tbody>
            </table>
            
            <div class="col-md-12">
                <button type="reset" name="cancelar" class="btn btn-secundary float-right">Voltar</button>
            </div>
        </div><!--// .col-md-6 -->

        
    </div>
    
                    
                    
    <!-- JavaScript -->
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/jquery.mask.js"></script>
    <script type="text/javascript" src="js/jquery.validate.js"></script>					
	<script type="text/javascript" src="js/ingredienteReceitaFormulario.js"></script>			
  </body>
</html>