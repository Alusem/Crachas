<?php
    require_once("../PHP/login.class.php");
    $login = new Login();
    $login->verificar("login.php");

    require '../PHP/conexao.php';
	global $pdo;
	
	$consulta = $pdo->query("SELECT isAdmin FROM usuarios WHERE '$LoginUsuario' = loginUsuarios");
	$campo = $consulta->fetch(PDO::FETCH_ASSOC);
	if($consulta->rowCount() != 0){
?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <title>Funcionários</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="../CSS/listas.css">
        <script src="https://kit.fontawesome.com/4642f198d2.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script>
            $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
    </head>
    <body>

        <header>
            <ul>
                <li>
                    <div>
                        <h1>Sam Crach&aacute;s</h1></li>
                    </div>
                <li>
                    <a href="home.php">Home</a>
                </li>

                <li>
                    <a href="lista.php">Funcion&aacute;rios</a>
                </li>

                <li>
                    <a href="empresas.php">Empresas</a>
                </li>

                <li>
                    <a href="configuracoes.php">Background</a>
                </li>

                <li>
                    <div class="Usuario">
                        <a> <?php echo $LoginUsuario;?> </a></li>
                    </div>
                </li>

                <?php
                    $consulta = $pdo->query("SELECT isAdmin FROM usuarios WHERE '$LoginUsuario' = loginUsuarios");
	                $campo = $consulta->fetch(PDO::FETCH_ASSOC);
	                if($consulta->rowCount() != 0){
                ?>

                <li>
                    <div class="Usuario">
                        <a class="active" href="Admin.php"> <?php echo "ADM";?> </a></li>
                    </div>
                </li>
                
                <?php
                    }
                ?>
                
                <li>
                    <div class="Usuario">
                         <a href="login.php">Sair</a></li>
                    </div>
                </li>
            </ul>
		</header>

        <?php
           /*         
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
                //   session_unset();
            */
        ?>

        <h2> Usu&aacute;rios </h2>

        <div class="tabela-botao">

	        <table id="tabelaF">
                <thead>
                   <form method="post" action="../VIEW/Admin.php" >
                        <tr>
                            <th><input class="form-control" name="nomeF" id="nomeF" placeholder="Nome" na  me="nomeF"></th>
                            <th><button type="submit" class="btn btn-primary">Buscar</button></th>
                        </tr>
                        <tr>
                            <th>Usu&aacute;rios</th>
                        </tr>   
                   </form>

                </thead>
                <tbody>
                <?php

                    if (isset(($_POST['nomeF']))){
                        $pesquisaF = addslashes($_POST['nomeF']);
                        $_POST['nomeF'] = "";
                    }else{
                        $pesquisaF = "";
                    }

                    $consultaF = $pdo->query("SELECT * FROM usuarios WHERE loginUsuarios LIKE '%". $pesquisaF ."%'");
                
                    while ($linhaF = $consultaF->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td>
                            <?php echo $linhaF['loginUsuarios']; ?>
                        </td>

                        <td class=botoes-tabela>
                            <div class="container_acoes">

                                <br>

                                <form action="../VIEW/AdminE.php" class="acao">
                                    <input type="hidden" name="idUsuarios" value="<?php echo $linhaF['idUsuarios'];?>">
                                    <div class="btn-editar-usuarios">  
                                        <button class="input-bot�o">Editar</button>
                                    </div>
                                </form>

                                <br>

                                <form action="../PHP/deletarAdmin.php" class="acao">
                                    <input type="hidden" name="idUsuarios" value="<?php echo $linhaF['idUsuarios'];?>">
                                    <div class="btn-deletar-funcionarios">
                                        <button class="input-bot�o" onclick="return confirm('Tem certeza que deseja deletar este usuario?');">Deletar</button>
                                    </div>
                                </form>  

                            </div>
                        </td>
                    </tr>
                    
                    <?php
                    }
                    ?>
                </tbody>
            </table>

            <br>

                <form action="../VIEW/AdminC.php">
                    <div class="btn-cadastrar-funcionario">
                        <button class="input-bot�o">Cadastrar Funcionario</button>
                    </div>
                </form>
         </div>
    </body>
    </html>
<?php 
}