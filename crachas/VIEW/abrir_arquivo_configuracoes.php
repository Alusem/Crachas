<?php
    require '../PHP/conexao.php';
	global $pdo;

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

	$dados = ['data'=>$dados];
	echo json_encode($dados);
	
?>
