<?php
    require '../PHP/conexao.php';
	global $pdo;
	session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

	<head>
		<meta charset="utf-8"/>
		<title>Impress&atilde;o</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="/CSS/print.css">
	</head>

	 <?php
			
			$id = $_GET['idFuncionario'];    

            $stringQuery = "SELECT * FROM crachas WHERE idCrachas = '".$id."';";
			
            $sql = $pdo->query($stringQuery);

            if($sql->rowCount() > 0){
                $dados = $sql->fetch();
		    }	
        ?>
	<body>
		<div class=form-crachas-frente>
			<div>
				<img src='abrir_arquivo.php?idFuncionario=<?php echo $id; ?>' width='120px'/>
			</div>
			
			<div>
				<?php echo $dados[4]; ?>
			</div>
			<div>
				<?php echo $dados[5]; ?>
			</div>

		</div>
		
		<div class=form-crachas-verso>
			<div>
				<label>NOME</label><br>
				<input class="input" type="text" value="<?php echo $dados[3];?>" readonly><br>
            </div>

			<div>
				<label>RG</label><br>
				<input class="input" type="text" value="<?php echo $dados[6]; echo ' '; echo $dados[7];?>" readonly><br>
            </div>

			<div>
				<label>CPF</label><br>
				<input class="input" type="text" value="<?php echo $dados[8];?>" readonly><br>
            </div>

			<div>
				<label>ADMISS&Atilde;O</label><br>
				<input class="input" type="text" value="<?php echo $dados[9];?>" readonly><br>
            </div>

			<div>
				<label>MATR&Iacute;CULA</label><br>
				<input class="input" type="text" value="<?php echo $dados[10];?>" readonly><br>
            </div>
			
			<div class=lista-regras>
				<ul>
					<li>Uso estritamente pessoal</li>
					<li>Mant&ecirc;-lo na altura do t&oacute;rax</li>
					<li>Devolv&ecirc;-lo ao setor pessoal em caso de desligamento</li>
				</ul>
			</div>
		</div>
		
	</body>

</html>