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

	$dados['dataAdimssao'] = date("n/j/Y");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <title>Impressão Crachá Verso</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="/CSS/print_verso_<?php echo $dados2['empresa']; ?>.php">
	<link rel="stylesheet" href="/CSS/dados_<?php echo $dados2['empresa']; ?>.css">
</head>

	<body>
		
		<div class="container2">
			<div class="dados">
				<div>
					<input class="input" id="nomeCompleto" type="text" value="<?php echo $dados['nomeCompleto'];?>" readonly><br>
				</div>

				<div>
					<input class="input" type="text" value="<?php echo $dados['numeroRG']; echo ' '; echo $dados['orgaoExpeditor'];?>" readonly><br>
				</div>

				<div>
					<input class="input" type="text" value="<?php echo $dados['numeroCPF'];?>" readonly><br>
				</div>

				<div>
					<input class="input" type="text" value="<?php echo date('d/m/Y', strtotime($dados['dataAdimssao']));?>" readonly><br>
				</div>

				<div>
					<input class="input" type="text" value="<?php echo $dados['codigoMatricula'];?>" readonly><br>
				</div>
			</div>
		</div>
			
		
	</body>

</html>