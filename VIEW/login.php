<?php

	require_once("../PHP/login.class.php");
    $login = new Login();
    $login->verificar();
	
	if (isset($LoginUsuario)) {
		require_once("../PHP/login.class.php");
		$login = new Login();
		$login->logout();
	}
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="../CSS/login.css">
		<title>Usuario Login</title>
	</head>
	<body>

		 <h1> SamCrach&aacute;s </h1>

		<div>
			<?php

			

			if(is_array($_SESSION) && isset($_SESSION['errosReportados'])){
				$erros = $_SESSION['errosReportados'];
                    foreach ($erros as $erro) {
						echo $erro;
						echo "<br>";
                    }
					session_unset();
                }
			?>
        </div>

		<br> 

		<div>
			<form method="POST" action="../PHP/logar.php">
				<div>
					<input class="input" type="text" name="login" id="inputLogin" placeholder="Login"><br>
					<label for="inputLogin"></label>
				</div>

				<div>
					<input class="input" type="password" name="senha" id="inputSenha" placeholder="Senha"><br>
					<label for="inputSenha"></label>
				</div>

				<div class="btn">
					<button class="input-botao" type="submit"><br>Acessar</button>
				</div>
			</form>
		</div>

	</body>
</html>