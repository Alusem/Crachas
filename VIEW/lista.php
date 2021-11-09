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
                    <a class="active" href="lista.php">Funcion&aacute;rios</a>
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
                <li>
                    <div class="Usuario">
                         <a href="login.php">Sair</a></li>
                    </div>
            </ul>
		</header>

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
            //   session_unset();
    ?>

    <h2> Funcion&aacute;rios </h2>

    <div class="tabela-botao">

	    <table id="tabelaF">
            <thead>
               <form method="post" action="lista.php" >
                    <tr>
                        <th><input class="form-control" name="nomeF" id="nomeF" placeholder="Nome" na  me="nomeF"></th>
                        <th><button type="submit" class="btn btn-primary">Buscar</button></th>
                    </tr>
                    <tr>
                        <th>Nome</th>
                        <th>Empresa</th>
                        <th>Filial</th>
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

                $consultaF = $pdo->query("SELECT * FROM crachas c JOIN empresas e ON c.idEmpresa = e.idEmpresas WHERE nomeCompleto LIKE '%". $pesquisaF ."%' OR empresa LIKE '%". $pesquisaF ."%' OR filial LIKE '%". $pesquisaF ."%' ");
                
                while ($linhaF = $consultaF->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <tr>
                    <td>
                        <?php echo $linhaF['nomeCompleto'];
                        if ($linhaF['foto'] == null) { 
                            ?>
                                <i data-placement="right" class="fas fa-exclamation-triangle" data-toggle="tooltip" title="Funcionario sem foto!"></i>
                                <!--<i class="fas fa-exclamation-triangle"></i>-->
                        <?php 
                        } 
                        ?>
                    </td>
                    <td>
                        <?php echo $linhaF['empresa']; ?>
                    </td>
                    <td>
                        <?php echo $linhaF['filial']; ?>
                    </td>
                    <td class=botoes-tabela>
                        <div class="container_acoes" >                                
                        
                            <form action="../VIEW/impressao.php" class="acao">
                                <input type="hidden" name="idFuncionario" value="<?php echo $linhaF['idCrachas'];?>">
                                <div class="btn-impressao-funcionarios">
                                    <button class="input-bot�o">Imprimir Crach&aacute;</button>
                                </div>
                            </form>

                            <br>

                            <form action="../VIEW/editar.php" class="acao">
                                <input type="hidden" name="idFuncionario" value="<?php echo $linhaF['idCrachas'];?>">
                                <div class="btn-editar-funcionarios">  
                                    <button class="input-bot�o">Editar</button>
                                </div>
                            </form>

                            <br>

                            <form action="../VIEW/deletar.php" class="acao">
                                <input type="hidden" name="idFuncionario" value="<?php echo $linhaF['idCrachas'];?>">
                                <div class="btn-deletar-funcionarios">
                                    <button class="input-bot�o">Deletar</button>
                                </div>
                            </form>  

                        </div>
                </tr>
                    
                <?php
                }
                ?>
            </tbody>
        </table>

        <br>

            <form action="cadastrar.php">
                <div class="btn-cadastrar-funcionario">
                    <button class="input-bot�o">Cadastrar Funcionario</button>
                </div>
            </form>
     </div>
</body>
</html>