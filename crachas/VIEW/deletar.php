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
       <title>Deletar Cadastro</title>
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

       <div class=form-criar-crachas>
            <div><h2>Deletar Funcion&aacute;rio</h2></div>
                <div>
                    <?php
                    
                        $id = $_GET['idFuncionario'];       

                        $sql = "SELECT * FROM crachas c JOIN empresas e ON c.idEmpresa = e.idEmpresas  WHERE idCrachas = :idCrachas";
		                $sql = $pdo->prepare($sql);
		                $sql->bindValue("idCrachas", $id);
                        $sql->execute();
                        $dados = $sql->fetch(PDO::FETCH_ASSOC);


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
                        //session_unset();
                    ?>
            <div class=centro-cadastro>
                <form id="form_deletar" enctype="multipart/form-data"  method="POST" action="../PHP/deletar.php">  
                
                    <div>
                        <input type="hidden" name="idFuncionario" value="<?php echo $id?>">
                    </div>

                    <div>
                        <label>Empresa</label><br>
                        <input class="input" minlength="1" type="text" name="empresa" id="inputEmpresa" placeholder="Empresa" value="<?php echo $dados['empresa']; ?>" readonly><br>
                    </div>

                    <div>
                        <label>Filial</label><br>
                        <input class="input" minlength="1" type="text" name="filial" id="inputFilial" placeholder="Filial" value="<?php echo $dados['filial']; ?>" readonly><br>
                    </div>

                    <div>
                        <label>Nome Completo</label><br>
                        <input class="input" minlength="15" type="text" name="nome" id="inputNome" placeholder="Nome Completo" value="<?php echo $dados['nomeCompleto']; ?>" readonly><br>
                    </div>

                    <div>
                        <label>Apelido</label><br>
                        <input class="input" minlength="1" maxlength="15" type="text" name="apelido" id="inputApelido" placeholder="Apelido" value="<?php echo $dados['apelido']; ?>" readonly><br>
                    </div>

                    <div>
                        <label>Cargo</label><br>
                        <input class="input" minlength="1" maxlength="20" type="text" name="cargo" id="inputCargo" placeholder="Cargo" value="<?php echo $dados['cargo']; ?>" readonly><br>
                    </div>

                    <div>
                         <label>RG</label><br>
                         <input class="input" type="text" name="rg" id="inputRG" placeholder="RG" required value="<?php echo $dados['numeroRG']; ?>" readonly><br/>
                    </div>

                    <div>
                        <label>Org&atilde;o Expeditor</label>
                        <br>
                        <input class="input" minlength="2" type="text" name="orgaoExpeditor" id="inputOE" placeholder="Org&atilde;o Expeditor" value="<?php echo $dados['orgaoExpeditor']; ?>" readonly><br>
                    </div>

                    <div>
                        <label>CPF</label>
                        <br>
                        <input class="input" minlength="11" maxlength="11" type="text" name="cpf" id="inputNome" placeholder="CPF" value="<?php echo $dados['numeroCPF']; ?>" readonly><br>
                    </div>

                    <div>
                        <label>Data de Admiss&atilde;o</label>
                        <br>
                        <input class="input" minlength="10" type="date" name="data" id="inputData" placeholder="Data" value="<?php echo $dados['dataAdimssao']; ?>" readonly><br>
                    </div>

                    <div>
                        <label>C&oacute;digo da Matricula</label>
                        <br>
                        <input class="input" minlength="4" type="text" name="codigoMatricula" id="inputCodigo" placeholder="C&oacute;digo Matricula" value="<?php echo $dados['codigoMatricula']; ?>" readonly><br>
                    </div>
                    
                    <label>Foto</label>
                    <div>
                        <img src= <?php echo $dados['foto']; ?> ?idFuncionario= <?php echo $id;?> width='162px' height = '218px'/>
                    </div>
                    <br>
                 
                    <div class="btn1">
                        <button class="input-bot�o" onclick="return confirm('Tem certeza que deseja deletar este funcionario');">Deletar</button>
                    </div>
                </form>   
            <div>
    </body>
</html>