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
       <link rel="stylesheet" href="../CSS/forms.css">
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

        <div class=form-criar-crachas>
            <div><h2>Editar Crach&aacute;s</h2></div>
                <div>
                    <?php
                    
                        $id = $_GET['idFuncionario'];       

                        $sql = "SELECT * FROM crachas c JOIN empresas e ON c.idEmpresa = e.idEmpresas WHERE idCrachas = :idCrachas";
		                $sql = $pdo->prepare($sql);
		                $sql->bindValue("idCrachas", $id);
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
                <form id="form_editar" enctype="multipart/form-data"  method="POST" action="../PHP/editar.php">  
                
                    <div>
                        <input type="hidden" name="idFuncionario" value="<?php echo $id?>">
                    </div>
                    <!--
                    <div>
                        <label>Empresa</label><br>
                        <input class="input" minlength="1" type="text" name="empresa" id="inputEmpresa" placeholder="Empresa" value="<?php echo $dados['empresa']; ?>" required><br>
                    </div>
                    -->
                    <div>
                        <label>Empresa</label><br>
                        <select class="input" name="idEmpresa" id="inputEmpresa" required>

                            <option value="" disabled="disabled">Selecione a empresa</option>

                            <?php
                            foreach ($empresas as $empresa) {
                                ?>
                                 <option value="<?php echo $empresa['idEmpresas']; ?>" <?php if ($dados['idEmpresa'] == $empresa['idEmpresas']) { echo "selected"; }; ?>><?php echo $empresa['empresa']; ?></option>
                                 <?php
                            }
                            ?>
                            <!--<option value="ROQUE" <?php if ($dados['empresa']=='ROQUE') { echo "selected"; }; ?>>ROQUE</option>
                            <option value="QUERY" <?php if ($dados['empresa']=='QUERY') { echo "selected"; }; ?>>QUERY</option>-->
                        </select>
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
                        <input class="input" minlength="14" maxlength="14" type="text" name="cpf" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" id="inputNome" placeholder="Digite um CPF no formato: xxx.xxx.xxx-xx" value="<?php echo $dados['numeroCPF']; ?>" required><br>
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
                         <input type="file" name="arquivo" class="form-control" value="">
                    </div>

                    <label>Foto Atual</label>
                    <div>
					     <img src= <?php echo $dados['foto']; ?> ?idFuncionario= <?php echo $id;?> width='162px' height = '218px'/>
                    </div>
                    
                    <br>
                    <div class="btn1">
                        <button class="input-botao" type="submit">Editar</button>
                    </div>
                </form>   
            <div>
    </body>
</html>