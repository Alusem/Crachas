<?php
	require '../PHP/conexao.php';
	global $pdo;
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <title>Lista de Funcionarios</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="/CSS/listas.css">
</head>
<body>

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
                    session_unset();
                ?>

    <h1> Funcion&aacute;rios </h1>
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

        $consultaF = $pdo->query("SELECT * FROM crachas WHERE nomeCompleto LIKE '%". $pesquisaF ."%'");

        while ($linhaF = $consultaF->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td>
                            <?php echo $linhaF['nomeCompleto']; ?>
                        </td>
                        <td>
                            <?php echo $linhaF['empresa']; ?>
                        </td>
                        <td>
                            <?php echo $linhaF['filial']; ?>
                        </td>
                        <td>
                            <form action="../VIEW/impressao.php">
                                <input type="hidden" name="idFuncionario" value="<?php echo $linhaF['idCrachas'];?>">
                                <div class="btn-deletar-funcionarios">
                                    <button class="input-botão">Imprimir Crach&aacute;</button>
                                </div>
                            </form>
                        </td>
                        <td>
                            <form action="../VIEW/editar.php">
                                <input type="hidden" name="idFuncionario" value="<?php echo $linhaF['idCrachas'];?>">
                                <div class="btn-editar-funcionarios">  
                                    <button class="input-botão">Editar</button>
                                </div>
                            </form>
                        </td>
                        <td>
                            <form action="../VIEW/deletar.php">
                                <input type="hidden" name="idFuncionario" value="<?php echo $linhaF['idCrachas'];?>">
                                <div class="btn-deletar-funcionarios">
                                    <button class="input-botão">Deletar</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                <?php
                }
                ?>
        </tbody>
    </table>

    <br>

    <form action="cadastrar.php">
        <div class="btn-cadastrar-funcionario">
            <button class="input-botão">Cadastrar Funcionario</button>
        </div>
    </form>

</body>
</html>