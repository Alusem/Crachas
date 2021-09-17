<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
   <head>
       <meta charset="utf-8"/>
       <title>Cadastro</title>
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
       <link rel="stylesheet" href="/CSS/cadastrar-fluxo.css">
   </head>
   <div class=form-criar-crachas>
        <div><h1>Crach&aacute;s</h1></div>
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
                    session_unset();
                ?>
        <div class=centro-cadastro>
            <form method="POST" action="../PHP/Criar.php">
                <div>
                    <label>Nome Completo</label><br>
                    <input class="input" minlength="15" type="text" name="nome" id="inputNome" placeholder="Nome Completo" value="<?php if (isset($campos)){ echo $campos['nome'];}?>" required><br>
                </div>

                <div>
                    <label>Apelido</label><br>
                    <input class="input" minlength="1" maxlength="15" type="text" name="apelido" id="inputApelido" placeholder="Apelido" value="<?php if (isset($campos)){ echo $campos['apelido'];}?>" required /><br>
                </div>

                <div>
                    <label>Cargo</label><br>
                    <input class="input" minlength="1" maxlength="20" type="text" name="cargo" id="inputCargo" placeholder="Cargo" value="<?php if (isset($campos)){ echo $campos['cargo'];}?>" required><br>
                </div>

                <div>
                     <label>RG</label><br>
                     <input class="input" minlength="14" maxlength="14" type="text" name="rg" id="inputRG" placeholder="RG" required value="<?php if (isset($campos)){ echo $campos['rg'];}?>" required><br/>
                </div>

                <div>
                    <label>Org&atilde;o Expeditor</label>
                    <input class="input" minlength="2" type="text" name="orgaoExpeditor" id="inputOE" placeholder="Org&atilde;o Expeditor" value="<?php if (isset($campos)){ echo $campos['orgaoExpeditor'];}?>" required><br>
                </div>

                <div>
                    <label>UR do RG</label>
                    <input class="input" minlength="2" type="text" name="urRG" id="inputURRG" placeholder="UR do RG" value="<?php if (isset($campos)){ echo $campos['urRG'];}?>" required><br>
                </div>

                <div>
                    <label>N&uacute;mero do CPF</label>
                    <input class="input" minlength="17" maxlength="17" type="text" name="cpf" id="inputNome" placeholder="CPF" value="<?php if (isset($campos)){ echo $campos['cpf'];}?>" required><br>
                </div>

                <div>
                    <label>Data de Admiss&atilde;o</label>
                    <input class="input" type="date" name="data" id="inputData" placeholder="Data" value="<?php if (isset($campos)){ echo $campos['data'];}?>" required><br>
                </div>

                <div>
                    <label>C&oacute;digo da Matricula</label>
                    <input class="input" minlength="4" type="text" name="codigoMatricula" id="inputCodigo" placeholder="C&oacute;digo Matricula" value="<?php if (isset($campos)){ echo $campos['codigoMatricula'];}?>" required><br>
                </div>

                <div>
                    <label>Foto</label>
                    <input class="input" type="file" name="nome" id="inputNome" placeholder="Nome Completo" value="<?php if (isset($campos)){ echo $campos['nome'];}?>" required><br>
                </div>

                <div class="btn1">
                    <button class="input-botao" type="submit">Cadastrar</button>
                </div>
            </form>   
        <div>
    </body>
</html>