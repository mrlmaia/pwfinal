<?php
	# metodo magico: require_once automatico
	function __autoload($class_name){
		require_once 'class/' . $class_name .'.class.php';
	}
	$id = $_POST["id"];

	if (isset($_POST['salvar'])) {
		$nome = $_POST['nome'];
		$preco = $_POST['preco'];
		$quantidade = $_POST['quantidade'];
		
		$ingrediente = new Ingrediente($nome,$preco, $quantidade);
		$ingrediente->setId($id);
		$ingredienteDAO = new IngredienteDAO();
		
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
	
			
?>