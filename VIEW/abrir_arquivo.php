<?php
    require '../PHP/conexao.php';
	global $pdo;
?>
	 <?php
		
			$id = $_GET['idFuncionario'];

            $stringQuery = "SELECT * FROM crachas WHERE idCrachas = '".$id."';";

            $sql = $pdo->query($stringQuery);

            if($sql->rowCount() > 0){
                $dados = $sql->fetch();
		    }	
            
			$conteudo = $dados['foto'];
		
			$tipo = 'image/png';
            
			ob_clean();
            header("Content-Type: $tipo");
            echo $conteudo;
			
		?>
