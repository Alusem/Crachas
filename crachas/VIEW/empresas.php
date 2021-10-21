<?php
	require '../PHP/conexao.php';
	global $pdo;
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <title>Empresas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="/CSS/listas.css">
</head>
<body>

<header>
            <ul>
                <li><div><h1>Sam Crach&aacute;s</h1></li>
                <li><a href="home.php">Home</a></li>
                <li><a href="lista.php">Funcion&aacute;rios</a></li>
                <li><a class="active" href="empresas.php">Empresas</a></li>
                <li><a href="configuracoes.php">Impress&atilde;o</a></li>
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
                    session_unset();
                ?>

    <h2> Empresas </h2>

    <div class="tabela-botao">

	    <table id="tabelaF">
            <thead>
               <form method="post" action="empresas.php" >
                    <tr>
                        <th><input class="form-control" name="nomeF" id="nomeF" placeholder="Nome" na  me="nomeF"></th>
                        <th><button type="submit" class="btn btn-primary">Buscar</button></th>
                    </tr>
                    <tr>
                        <th>Empresas</th>
                        
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

            $consultaF = $pdo->query("SELECT * FROM empresas WHERE empresa LIKE '%". $pesquisaF ."%' ");

            while ($linhaF = $consultaF->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <tr>
                            <td>
                                <?php echo $linhaF['empresa']; ?>
                            </td>
                           
                            <td class=botoes-tabela>
                                <div class="container_acoes" >                                

                                    <form action="../VIEW/editarE.php" class="acao">
                                        <input type="hidden" name="idEmpresas" value="<?php echo $linhaF['idEmpresas'];?>">
                                        <div class="btn-editar-empresas">  
                                            <button class="input-bot�o">Editar</button>
                                        </div>
                                    </form>

                                    <br>

                                    <form action="../VIEW/deletarE.php" class="acao">
                                        <input type="hidden" name="idEmpresas" value="<?php echo $linhaF['idEmpresas'];?>">
                                        <div class="btn-deletar-empresas">
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

            <form action="cadastrarE.php">
                <div class="btn-cadastrar-empresa">
                    <button class="input-bot�o">Cadastrar Empresa</button>
                </div>
            </form>
     </div>
</body>
</html>