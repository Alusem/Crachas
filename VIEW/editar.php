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
   <div class=form-criar-crachas>
        <div><h1>Editar Crach&aacute;s</h1></div>
            <div>
                <?php
                    
                    $id = $_GET['idFuncionario'];       

                    $sql = "SELECT * FROM crachas WHERE idCrachas = :idCrachas";
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
                    session_unset();
                ?>
        <div class=centro-cadastro>
            <form enctype="multipart/form-data"  method="POST" action="../PHP/editar.php">  
                
                <div>
                    <input type="hidden" name="idFuncionario" value="<?php echo $id?>">
                </div>

                <div>
                    <label>Empresa</label><br>
                    <input class="input" minlength="1" type="text" name="empresa" id="inputEmpresa" placeholder="Empresa" value="<?php echo $dados['empresa']; ?>" required><br>
                </div>

                <div>
                    <label>Filial</label><br>
                    <input class="input" minlength="1" type="text" name="filial" id="inputFilial" placeholder="Filial" value="<?php echo $dados['filial']; ?>" required><br>
                </div>

                <div>
                    <label>Nome Completo</label><br>
                    <input class="input" minlength="9" type="text" name="nome" id="inputNome" placeholder="Nome Completo" value="<?php echo $dados['nomeCompleto']; ?>" required><br>
                </div>

                <div>
                    <label>Apelido</label><br>
                    <input class="input" minlength="1" maxlength="15" type="text" name="apelido" id="inputApelido" placeholder="Apelido" value="<?php echo $dados['apelido']; ?>" required /><br>
                </div>

                <div>
                    <label>Cargo</label><br>
                    <input class="input" minlength="1" maxlength="20" type="text" name="cargo" id="inputCargo" placeholder="Cargo" value="<?php echo $dados['cargo']; ?>" required><br>
                </div>

                <div>
                     <label>RG</label><br>
                     <input class="input" type="text" name="rg" id="inputRG" placeholder="RG" required value="<?php echo $dados['numeroRG']; ?>" required><br/>
                </div>

                <div>
                    <label>Org&atilde;o Expeditor</label>
                    <br>
                    <input class="input" minlength="2" type="text" name="orgaoExpeditor" id="inputOE" placeholder="Org&atilde;o Expeditor" value="<?php echo $dados['orgaoExpeditor']; ?>" required><br>
                </div>

                <div>
                    <label>CPF</label>
                    <br>
                    <input class="input" minlength="11" maxlength="11" type="text" name="cpf" id="inputNome" placeholder="CPF" value="<?php echo $dados['numeroCPF']; ?>" required><br>
                </div>

                <div>
                    <label>Data de Admiss&atilde;o</label>
                    <br>
                    <input class="input" minlength="10" type="date" name="data" id="inputData" placeholder="Data" value="<?php echo $dados['dataAdimssao']; ?>" required><br>
                </div>

                <div>
                    <label>C&oacute;digo da Matricula</label>
                    <br>
                    <input class="input" minlength="4" type="text" name="codigoMatricula" id="inputCodigo" placeholder="C&oacute;digo Matricula" value="<?php echo $dados['codigoMatricula']; ?>" required><br>
                </div>

                <div>
                     <label>Foto</label>
                     <input type="file" name="arquivo" class="form-control" required>
                </div>
                <br>
                <div class="btn1">
                    <button class="input-botao" type="submit">Cadastrar</button>
                </div>
            </form>   
        <div>
    </body>
</html>