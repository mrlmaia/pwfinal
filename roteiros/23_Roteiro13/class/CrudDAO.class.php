<?php	
	require_once 'BancoDados.class.php';

	abstract class CrudDAO{
		
		protected function conectar(){
			return BancoDados::conectar();;
		}		
		
		protected function gerarLog($erro){
			$arquivo = fopen('logErro.txt','a+');
			$dataHora = date("d/m/Y H:i:s");
			$mensagem = "{$dataHora} - Arquivo: {$erro->getFile()} - Linha: {$erro->getLine()} - Erro: {$erro->getMessage()}\n";
			fwrite($arquivo, $mensagem);
			fclose($arquivo);
		}		

		protected function __inserir($sql, $criterios, $objeto){
			$situacao = FALSE;
			try{				
				$conexao = $this->conectar();				
				$resultado = $conexao->prepare($sql);
				foreach($criterios as $chave => $valor) {
					$resultado->bindValue($chave, $valor); 
				}
	  			$resultado->execute(); 
				$objeto->setId($conexao->lastInsertId());
				$conexao = null;
				$situacao = TRUE;
			}catch(PDOException $erro){
				$this->gerarLog($erro);
			}		
			return $situacao;	
		}

		protected function __atualizar($sql, $criterios){
			$situacao = FALSE;
			try{				
				$conexao = $this->conectar();
				$resultado = $conexao->prepare($sql);
				foreach($criterios as $chave => $valor) {
					$resultado->bindValue($chave, $valor); 
				}
				$resultado = $conexao->prepare($sql);			
				$resultado->execute();
				$conexao = null;
				$situacao = TRUE;
			}catch(PDOException $erro){
				$this->gerarLog($erro);
			}		
			return $situacao;
		}

		protected function __excluir($sql, $objeto){
			$situacao = FALSE;
			try{				
				$conexao = $this->conectar();		
				$resultado = $conexao->prepare($sql);
	  			$resultado->bindValue(':id', $objeto->getId());			
				$resultado->execute();
				$conexao = null;
				$situacao = TRUE;
			}catch(PDOException $erro){
				$this->gerarLog($erro);
			}		
			return $situacao;			
		}

		protected function __listar($sql){
			$registros = null;	
			try{				
				$conexao = $this->conectar();						
				$resultado = $conexao->prepare($sql);			
				$resultado->execute(); 
				$registros = $resultado->fetchAll();
				$conexao = null;
			}catch(PDOException $erro){
				$this->gerarLog($erro);
			}		
			return $registros;
		}

		protected function __buscarPorId($sql, $id){
			$registro = null;
			try{
				$conexao = $this->conectar();	
				$resultado = $conexao->prepare($sql);
				$resultado->bindValue(':id', $id);
				$resultado->execute();
				$registro = $resultado->fetch();
				$conexao = null;
			}catch(PDOException $erro){
				$this->gerarLog($erro);
			}
			return $registro;			
		}

	}
?> 