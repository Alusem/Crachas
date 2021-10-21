<?php
    require '../PHP/conexao.php';
	global $pdo;
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
   <head>
       <meta charset="utf-8"/>
       <title>Editar Cadastro</title>
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
       <link rel="stylesheet" href="/CSS/forms.css">
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

        <div class=form-criar-crachas>
            <div><h2>Editar Empresa</h2></div>
                <div>
                    <?php
                    
                        $id = $_GET['idEmpresas'];       

                        $sql = "SELECT * FROM empresas WHERE idEmpresas = :idEmpresas";
		                $sql = $pdo->prepare($sql);
		                $sql->bindValue("idEmpresas", $id);
                        $sql->execute();
                        $dados = $sql->fetch(PDO::FETCH_ASSOC);

                        $sql2 = $pdo->query("SELECT * FROM empresas");
                        $empresas = $sql2->fetchAll(PDO::FETCH_ASSOC);
                        //echo "<pre>";print_r($empresas);echo "</pre>"; die;

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
            <div class=centro-cadastro>
                <form id="form_editar" enctype="multipart/form-data"  method="POST" action="../PHP/editarE.php">  
                
                    <div>
                        <input type="hidden" name="idEmpresas" value="<?php echo $id?>">
                    </div>

                    <div>
                        <label>Nome Empresa</label><br>
                        <input class="input" minlength="2" type="text" name="nomeEmpresa" id="inputNome" placeholder="Nome da Empresa" value="<?php echo $dados['empresa']; ?>" required><br>
                    </div>

                    <div class="btn1">
                        <button class="input-botao" type="submit">Editar</button>
                    </div>
                </form>   
            <div>
    </body>
</html>