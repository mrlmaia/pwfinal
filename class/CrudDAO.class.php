<?php	
	require_once 'BancoDados.class.php';

	abstract class CrudDAO{
		
		protected function conectar(){
			return BancoDados::conectar();;
		}		
		
		protected function gerarLog($erro){
			#$arquivo = fopen('logErro.txt','a+');
			$dataHora = date("d/m/Y H:i:s");
			$mensagem = "{$dataHora} - Arquivo: {$erro->getFile()} - Linha: {$erro->getLine()} - Erro: {$erro->getMessage()}\n";
			#fwrite($arquivo, $mensagem);
			#fclose($arquivo);
			echo "Mensagem:" . $mensagem;
			echo "Erro:" . $erro;
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
				$resultado->bindValue(':id', $criterios['id']);
				$resultado->execute();
				$conexao = null;
				$situacao = TRUE;
			}catch(PDOException $erro){
				$this->gerarLog($erro);
			}		
			return $situacao;
		}

		protected function __excluir($sql, $id){
				try {
					$conexao = $this->conectar();		
					$resultado = $conexao->prepare($sql);
					$resultado->bindValue(':id', $id, PDO::PARAM_INT);			
					$conexao = null;	
					return $resultado->execute();
				} catch (PDOException $erro) { // retorna erro
					return false;
				}
							
		}

		protected function __listar($sql){
			$registros = null;	
			try{				
				$conexao = $this->conectar();						
				$resultado = $conexao->prepare($sql);
				#$resultado->bindValue(':id', $id, PDO::PARAM_INT);							
				$resultado->execute(); 
				$registros = $resultado->fetchAll();
				$conexao = null;
			}catch(PDOException $erro){
				$this->gerarLog($erro);
			}		
			return $registros;
		}
		
		protected function __listarEspecifico(String $sql, int $id)
		{
			$registros = null;	
			try{				
				$conexao = $this->conectar();						
				$resultado = $conexao->prepare($sql);
				$resultado->bindValue(':id', $id, PDO::PARAM_INT);							
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

		protected function __verificarExistenciaNN($sql, $id1, $id2){
			$registro = null;
			try {
				$conexao = $this->conectar();	
				$resultado = $conexao->prepare($sql);
				$resultado->bindValue(':id1', $id1);
				$resultado->bindValue(':id2', $id2);
				$resultado->execute();
				$registro = $resultado->fetch();
				$conexao = null;
			}catch(PDOException $erro){
				$this->gerarLog($erro);
			}
			return $registro;
		}

		protected function __adicionaNN($sql,$criterios){
			$situacao = FALSE;
			try{				
				$conexao = $this->conectar();				
				$resultado = $conexao->prepare($sql);
				foreach($criterios as $chave => $valor) {
					$resultado->bindValue($chave, $valor); 
				}
	  			$resultado->execute(); 
				$conexao = null;
				$situacao = TRUE;
			}catch(PDOException $erro){
				$this->gerarLog($erro);
			}	
			return $situacao;	
		}
		public function getUltimoId(){
			$conexao = $this->conectar();				
			$LAST_ID = $conexao->lastInsertId();
			return $LAST_ID;
		}

	}
?> 