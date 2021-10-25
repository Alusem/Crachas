<?php
    require '../PHP/conexao.php';
    session_start();
    global $pdo;

    $sql2 = $pdo->query("SELECT * FROM empresas");
    $empresas = $sql2->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
   <head>
       <meta charset="utf-8"/>
       <title>Cadastrar Funcionário</title>
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
       <link rel="stylesheet" href="/CSS/forms.css">
   </head>
   <body>

        <header>
             <ul>
				<li><div><h1>Sam Crach&aacute;s</h1></li>
				<li><a href="home.php">Home</a></li>
				<li><a class="active" href="lista.php">Funcion&aacute;rios</a></li>
				<li><a href="empresas.php">Empresas</a></li>
				<li><a href="configuracoes.php">Background</a></li>
             </ul>
		</header>

            <div><h2>Cadastrar Crach&aacute;s</h2></div>
                <div>
                    <?php

                        $sql2 = $pdo->query("SELECT * FROM empresas");
                        $empresas = $sql2->fetchAll(PDO::FETCH_ASSOC);

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
                <form  id="form_cadastro" enctype="multipart/form-data"  method="POST" action="../PHP/criar.php">  

                     <div>
                        <label>Empresa</label><br>
                        <select class="input" name="empresa" id="inputEmpresa" required>

                            <option value="" >Selecione a empresa</option>
 
                            <?php
                            foreach ($empresas as $empresa) {
                                ?>
                                 <option value="<?php echo $empresa['idEmpresas']; ?>"> <?php echo $empresa['empresa']; ?></option>
                                 <?php
                            }
                            ?>
                            <!--<option value="ROQUE" <?php if ($dados['empresa']=='ROQUE') { echo "selected"; }; ?>>ROQUE</option>
                            <option value="QUERY" <?php if ($dados['empresa']=='QUERY') { echo "selected"; }; ?>>QUERY</option>-->
                        </select>
                    </div>

                    <div>
                        <label>Filial</label><br>
                        <input class="input" minlength="1" type="text" name="filial" id="inputFilial" placeholder="Filial" value="<?php if (isset($campos)){ echo $campos['filial'];}?>" required><br>
                    </div>

                    <div>
                        <label>Nome Completo</label><br>
                        <input class="input" minlength="9" type="text" name="nome" id="inputNome" placeholder="Nome Completo" value="<?php if (isset($campos)){ echo $campos['nome'];}?>" required><br>
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
                         <input class="input" minlength="6" type="text" name="rg" id="inputRG" placeholder="RG" required value="<?php if (isset($campos)){ echo $campos['rg'];}?>" required><br/>
                    </div>

                    <div>
                        <label>Org&atilde;o Expeditor</label>
                        <br>
                        <input class="input" minlength="2" type="text" name="orgaoExpeditor" id="inputOE" placeholder="Org&atilde;o Expeditor" value="<?php if (isset($campos)){ echo $campos['orgaoExpeditor'];}?>" required><br>
                    </div>

                    <div>
                        <label>CPF</label>
                        <br>
                        <input class="input" minlength="14" maxlength="14" type="text" name="cpf" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" id="inputNome" placeholder="Digite um CPF no formato: xxx.xxx.xxx-xx" value="<?php if (isset($campos)){ echo $campos['cpf'];}?>" required><br>
                    </div>

                    <div>
                        <label>Data de Admiss&atilde;o</label>
                        <br>
                        <input class="input" minlength="10" maxlength="10" type="date" name="data" id="inputData" placeholder="Data" value="<?php if (isset($campos)){ echo $campos['data'];}?>" required><br>
                    </div>

                    <div>
                        <label>C&oacute;digo da Matricula</label>
                        <br>
                        <input class="input" minlength="4" type="text" name="codigoMatricula" id="inputCodigo" placeholder="C&oacute;digo Matricula" value="<?php if (isset($campos)){ echo $campos['codigoMatricula'];}?>" required><br>
                    </div>

                    <div class="foto_campo_input">
                         <label>Foto</label>
                         <input type="file" name="arquivo" class="form-control">
                    </div>
                    <br>
                    <div class="btn1">
                        <button class="input-botao" type="submit">Cadastrar</button>
                    </div>

                </form>   
            <div>
    </body>
</html>