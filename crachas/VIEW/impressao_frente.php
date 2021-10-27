<?php
    require '../PHP/conexao.php';
	global $pdo;
	session_start();
			
	$id = $_GET['idFuncionario'];    

    $stringQuery = "SELECT * FROM crachas WHERE idCrachas = '".$id."';";
			
    $sql = $pdo->query($stringQuery);

    if($sql->rowCount() > 0){
        $dados = $sql->fetch();
	}
	
	$empresa = $dados['idEmpresa'];

    $consultaF = $pdo->query("SELECT * FROM empresas WHERE idEmpresas = ". $empresa);
            
    $dados2 = $consultaF->fetch();

	
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <title>Impressão Crachá Frente</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="../CSS/print_frente_<?php echo $dados2['empresa']; ?>.php">
	<link rel="stylesheet" href="../CSS/dados_<?php echo $dados2['empresa']; ?>.css">

</head>
	
	<body>
		
		<div class="container2">
		
				<div id="foto">
					<img src= '<?php echo $dados['foto']; ?>?idFuncionario= <?php echo $id;?>' width='<?php echo $dados2['emp_impressao_foto_largura'];?>px' height='<?php echo $dados2['emp_impressao_foto_altura'];?>px'/>
				</div>

			<div class="dados">

				<div id="nome">
					<?php echo $dados['apelido']; ?>
				</div>	

				<div id="cargo">
					<?php echo $dados['cargo']; ?>
				</div>

			</div>


	</body>

</html>