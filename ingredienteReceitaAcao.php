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

function salvar(){

	$id = $_POST["id"];

	if (isset($_POST['salvar'])) {
		$nome = $_POST['nome'];
		$precoCusto = $_POST['precoCusto'];
		$precoVenda = $_POST['precoVenda'];
		$quantidade = $_POST['quantidade'];
		
		$produto = new Produto($nome,$precoVenda, $quantidade);
        $ingrediente->setId($id);
        $ingrediente->setPrecoCusto($precoCusto);
        
		$produtoDAO = new ProdutoDAO();
		
		if($id == 0){
			$situacao = $ingredienteDAO->inserir($ingrediente);
		}else{
			$situacao = $ingredienteDAO->atualizar($ingrediente);
		}
	
		if($situacao){
			echo "<script>alert('Registro salvo com sucesso!'); location.href='ingredienteTabela.php';</script>"; 
		}else{
			echo "<script>alert('Erro ao salvar o registro'); location.href='ingredienteTabela.php';</script>"; 	
		}	
	}
}

function editar()
{
$campo  = $_POST["campo"];
$campo2  = $_POST["campo2"];
echo "<script>alert('Editando [$campo] e [$campo2]');</script>";
echo "<script>location.href = 'index.html';</script>";
}

function excluir(){	
	echo "<script>location.href = 'index.html';</script>";
}

function adicionar(){
	// Pega o id da receita 
	// adiciona o ingrediente na receita
	$idIngrediente = $_POST["ingrediente"];
	$ingredienteDAO = new IngredienteDAO();
	$id = $_POST["id"];
	if (isset($id)) {
		$ingrediente = $ingredienteDAO->buscarPorId($idIngrediente);
		$receitaDAO = new ReceitaDAO();
		$receita = $receitaDAO->buscarPorId($_POST["id"]);
		$situacao = $receitaDAO->adicionarIngrediente(intval($receita->getId()),intval($idIngrediente), $_POST["quantidadeIngrediente"]);
		if ($situacao) {
			echo "<script>alert('Ingrediente adicionado com sucesso!');<script>"; 
		} else {
			echo "<script>alert('Falaha ao adicionar ingrediente!');<script>";
		}
		echo "location.href='ingredienteReceitaFormulario.php?id=$id';</script>";
	}
}