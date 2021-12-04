<?php
    require '../PHP/conexao.php';
	global $pdo;
?>
	 <?php

			$id = 1;
            $stringQuery = ("SELECT * FROM configuracoes WHERE idconfiguracoes = '".$id."';");
			
            $sql = $pdo->query($stringQuery);
			
            if($sql->rowCount() > 0){
                $dados = $sql->fetch();
		    }	

			$conteudo = $dados['background2'];
		
			$tipo = 'image/png';
            
			ob_clean();
            header("Content-Type: $tipo");
            echo $conteudo;

		?>
