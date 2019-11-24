<?php			
        # metodo magico: require_once automatico
        function __autoload($class_name){
            require_once 'class/' . $class_name .'.class.php';
        }
        
        $id = $_GET["id"];
		$produtoDAO = new ProdutoDAO();
		$situacao = $produtoDAO->excluir(intval($id));
			
		if($situacao){
			echo "<script>alert('Registro excluído com sucesso.');</script>";
		}else{
			echo "<script>alert('Erro ao excluir o registro.');</script>";
		}

		echo "<script>location.href='produtoTabela.php';</script>"; 
?>	
	