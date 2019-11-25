
	<?php

	class BancoDados
	{
		private static $conexao = null;
		
		private function __construct(){
		}
		
		public static function conectar(){
			if(self::$conexao == null){
				try{
					self::$conexao = new PDO('mysql:host=localhost; dbname=trabalhoFinalPW', 'root', '');
					self::$conexao->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				}
				catch(PDOException $erro){
					die($erro->getMessage());
				}
			}
			return self::$conexao;
		}
	}
	?>

