<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/cadastroU.css">
        <title>Cadastro</title>
    </head>
        <body>
        <div>
            <form method="POST" action="../PHP/cadastro.php">
                
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

                    if (is_array($_SESSION) && isset($_SESSION['cadastroRealizado'])){
                        $sucesso = $_SESSION['cadastroRealizado'];
                        echo $sucesso;
                        session_unset();
                    }
                ?>
            </div>
                <div>
                    <input class="input" type="text" name="login" id="inputLogin" placeholder="Login"><br>
                    <label for="inputLogin"></label>
                </div>

                <div>
                    <input class="input" type="password" name="senha" id="inputSenha" placeholder="Senha"><br>
                    <label for="inputSenha"></label>
                </div>

                <div>
                    <input class="input" type="password" name="confirmarSenha" id="inputSenha" placeholder="Confirmar Senha"><br>
                    <label for="inputConfirmarSenha"></label>
                </div>

                <div>
                    <input class="input" type="email" name="email" id="inputEmail" placeholder="Email"><br>
                    <label for="inputEmail"></label>
                </div>

                <div class="btn1">
                    <button class="input-botao" type="submit"><br>Cadastrar </button>
                </div>
            </form>

            <form action="../View/login.php">
				<div class="btn2">
					<button class="input-botao"><br>Login</button>
				</div>
			</form>

        </div>
    </body>
</html>
