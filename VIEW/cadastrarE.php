<?php
    require_once("../PHP/login.class.php");
    $login = new Login();
    $login->verificar("login.php");

    require '../PHP/conexao.php';
	global $pdo;
?>

<!DOCTYPE html>
<html lang="pt-br">
   <head>
       <meta charset="utf-8"/>
       <title>Cadastrar Empresa</title>
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
       <link rel="stylesheet" href="../CSS/forms.css">
   </head>
   <body>

        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <h1>Sam Crach&aacute;s</h1>
                
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                            <a class="nav-link" href="lista.php">Funcion&aacute;rios</a>
                            <a class="nav-link" href="empresas.php">Empresas</a>
                            <a class="nav-link" href="configuracoes.php">Configura&ccedil;oes</a>
                        </div>
                    </div>

                    <div class="Usuario">
                        <a> <?php echo $LoginUsuario; ?> </a></li>
                    </div>

                    <?php
                        $consulta = $pdo->query("SELECT isAdmin FROM usuarios WHERE '$LoginUsuario' = loginUsuarios");
	                    $campo = $consulta->fetch(PDO::FETCH_ASSOC);
	                    if ($campo['isAdmin'] != 0){
                    ?>

                    <div class="Usuario">
                        <a href="Admin.php"> <?php echo "ADM";?> </a>
                    </div>

                    <?php
                        }
                    ?>

                    <div class="Usuario">
                        <a href="login.php">Sair</a>
                    </div>

                </div>
            </nav>
		</header>

        <div><h2>Cadastrar Empresa</h2></div>
            <div>
                <?php

                    if(is_array($_SESSION) && isset($_SESSION['errosReportados'])){
                        $erros = $_SESSION['errosReportados'];
                        foreach ($erros as $erro) {
                            echo $erro;
                            echo "<br>";
                        }
                    }

                    if (is_array($_SESSION) && isset($_SESSION['cadastroRealizado'])){
                        $sucesso = $_SESSION['cadastroRealizado'];
                        echo $sucesso;
                    }

                    if (is_array($_SESSION) && isset($_SESSION['camposForm'])){
                        $campos = $_SESSION['camposForm'];
                    }
                //    session_unset();
                ?>
        <div class=centro-cadastro>
            <form  id="form_cadastro" enctype="multipart/form-data"  method="POST" action="../PHP/criarE.php">  

                <div>
                    <label>Empresa</label><br>
                    <input class="input" minlength="2" type="text" name="nomeEmpresa" id="inputNome" placeholder="Nome da Empresa" value="<?php if (isset($campos)){ echo $campos['nome'];}?>" required><br>
                </div>

                <div class="btn1">
                    <button class="input-botao" type="submit">Cadastrar</button>
                </div>

            </form>
        <div>
    </body>
</html>