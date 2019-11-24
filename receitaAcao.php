<?php 

//nome da funcao (Veio do campo 'action'[hidden])
$funcao = $_REQUEST["action"];
/*
 * REQUEST recebe dados via GET, POST, e COOKIE
 * Deixa livre para _GET e _POST
 */

if (function_exists($funcao)) {
    call_user_func($funcao);
}

function __autoload($class_name){
    require_once 'class/' . $class_name .'.class.php';
}

function salvar()
{
    $id = $_POST["id"];
	
	if (isset($_POST['salvar'])) {
		$nome = $_POST['nome'];
		$rendimento = $_POST['rendimento'];
		
		$receita = new Receita($nome,$rendimento);
		$receita->setId($id);
		$receitaDAO = new ReceitaDAO();
		$idProduto = $_POST["produto"];
		if($id == 0){
			// inserir a receita
			// alterar o chupchup add a receita
			$situacao = $receitaDAO->inserir($receita); 
			if($situacao){
				$produtoDAO = new ProdutoDAO();
				$situacao =  $produtoDAO->adicionarReceita($idProduto,$receitaDAO->getUltimoId());
			}
		}else{
			$situacao = $receitaDAO->atualizar($receita);
		}
	
		if($situacao){
			echo "<script>alert('Registro salvo com sucesso!'); location.href='receitaTabela.php';</script>"; 
		}else{
			echo "<script>alert('Erro ao salvar o registro'); location.href='receitaTabela.php';</script>"; 	
		}	
	}
}

?>