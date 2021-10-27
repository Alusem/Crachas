<?php
    require '../PHP/conexao.php';
	global $pdo;
	//include("configuracoes.php");
	//session_start();
?>
	 <?php

			/*if(is_array($_SESSION) && isset($_SESSION['empresa'])){
				$empresa = $_SESSION['empresa'];
				if ($empresa == "ROQUE"){
					$id = 1;
				}
				if ($empresa == "QUERY"){
					$id = 2;
				}
			}
			session_unset();
			*/
			$empresa = 1;

			if(isset($_POST['idEmpresa'])){				
				$empresa = $_POST['idEmpresa'];
			}

            $stringQuery = ("SELECT * FROM empresas WHERE idEmpresas = '".$empresa."';");
			
            $sql = $pdo->query($stringQuery);
			$dados = [];
            if($sql->rowCount() > 0){
                $dados = $sql->fetch();
		    }	

			//$conteudo = $dados['background'];
		
			/*$tipo = 'image/png';
            
			ob_clean();
            header("Content-Type: $tipo");
            echo $conteudo;*/

			$dados = ['data'=>$dados];
			echo json_encode($dados);		
		?>
