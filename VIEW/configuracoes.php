<?php
    require_once("../PHP/login.class.php");
    $login = new Login();
    $login->verificar("login.php");

	require '../PHP/conexao.php';
	global $pdo;

    $sql2 = $pdo->query("SELECT * FROM empresas");
    $empresas = $sql2->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">
   <head>
       <meta charset="utf-8"/>
       <title>Background</title>
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
       <link rel="stylesheet" href="../CSS/listas.css">
       <link rel="stylesheet" href="../CSS/configuracoes.css">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

       <h2>Configura&ccedil;&otilde;es</h2></div>

        <form enctype="multipart/form-data"  method="POST" action="configuracoes.php">
            <div class='select-empresa'>
                <label>Empresa</label><br>
                <select class="input" name="empresa" id="inputEmpresa" required>
                    <option value="" disabled="disabled" selected="selected">Selecione a empresa</option>
                    <?php
                        foreach ($empresas as $empresa) {
                    ?>
                            <option value="<?php echo $empresa['idEmpresas']; ?>"> <?php echo $empresa['empresa']; ?></option>
                            <?php
                    }
                    ?>
                    
                </select>
            </div>
        </form>

           <br>
        
       <?php
            $empresa = "0";

            if (isset($_POST['nomeEmpresa'])) {  
                $empresa = addslashes($_POST['nomeEmpresa']);
            }
            
            $diretorioFileImg = "";
            $diretorioFileImg2 = "";
    
            if (isset($_FILES["arquivo"])){
       
               $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
               $novo_nome = md5(time()) . $extensao;
               $diretorio = "../IMG/".$empresa;
               
               if (!file_exists($diretorio)) {
                    mkdir($diretorio, 0777, true);
                }
       
               $retorno = move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorioFileImg = $diretorio."/Frente".$novo_nome);

               if ($retorno == TRUE){

                    $stmt = $pdo->prepare('UPDATE empresas SET background = :background WHERE empresa = :empresa');
        
                    $stmt->bindParam(':background', $diretorioFileImg);
                    $stmt->bindParam(':empresa', $empresa);
                    
                    $retorno  = $stmt->execute();
                    
               }
       
            }
    
            if (isset($_FILES["arquivo2"])){
       
                $extensao = strtolower(substr($_FILES['arquivo2']['name'], -4));
                $novo_nome = md5(time()) . $extensao;
                $diretorio = "../IMG/".$empresa;
                
                if (!file_exists($diretorio)) {
                        mkdir($diretorio, 0777, true);
                    }
                
                $retorno2 = move_uploaded_file($_FILES['arquivo2']['tmp_name'], $diretorioFileImg2 = $diretorio."/Verso".$novo_nome);
                
                if ($retorno == TRUE){
                    $stmt = $pdo->prepare('UPDATE empresas SET background2 = :background2 WHERE empresa = :empresa');
        
                    $stmt->bindParam(':background2', $diretorioFileImg2);
                    $stmt->bindParam(':empresa', $empresa);
                    
                    $retorno  = $stmt->execute();
                
                }
            }

           $consultaF = $pdo->query("SELECT * FROM empresas ");

           $consultaF->fetch(PDO::FETCH_ASSOC);

           if($consultaF->rowCount() > 0){

		echo
        "
            <div id='backgroundFV' class='conteiner1'>
                    <div>
                        <figure id='fig'>
                            <img name='empresa' value='ROQUE' id='frenteBG' width='250px'/>
                            <figcaption><h2 id='frente'>Frente</h2></figcaption>
                        </figure>
                    </div>

                    <div>
                        <figure>
                            <img  id='versoBG' width='250px'/>
                            <figcaption><h2 id='verso'>Verso</h2></figcaption>
                        </figure>
                    </div>
            </div>
            
            <div id='arquivos' class='conteiner2'>
                    <form enctype='multipart/form-data'  method='POST' action='configuracoes.php'>
                
                        <input type='hidden' name='idEmpresas' id='idEmpresas' value='' required>
                        <input type='hidden' name='nomeEmpresa' id='nomeEmpresa' value='' required>
                        
                        <div class='background_campo_input'>
                            <input id='escolher_arquivo_frente' type='file' name='arquivo' class='form-control' required>
                        </div>

                        <div class='background_campo_input'>
                            <input id='escolher_arquivo_verso' type='file' name='arquivo2' class='form-control' required>
                        </div>
                        
                        <br>

                        <div class='btn1'>
                            <button class='input-botao' type='submit'>Enviar</button>
                        </div>

                    </form>
            </div>
        ";

           }
           ?>
    </body>
</html>
<script>
   $(document).ready(function(){

        $('#inputEmpresa').on("change", function (e) {

            
            var img = document.getElementById('frenteBG');
            var img2 = document.getElementById('versoBG');
            var idEmpresa = document.getElementById('inputEmpresa').value;
            var formData = new FormData();

            formData.append('idEmpresa', idEmpresa);

            $.ajax({
                url : "abrir_arquivo_configuracoes.php",
                type : 'post',
                data: formData,
                processData: false,
                contentType: false,
                dataType : "json",
                success : function(response){

                    var img = document.getElementById('frenteBG');
                    var img2 = document.getElementById('versoBG');

                    img.src = response.data.background;
                    img2.src = response.data.background2;

                    console.log(response);
                    
                    if(response){
                        if(response.data){

                            console.log(response.data.idEmpresas);
                            document.getElementById('nomeEmpresa').value = response.data.empresa;
                            document.getElementById('idEmpresas').value = response.data.idEmpresas;
                        }
                    }
                }
            });  
        })
    });    

    function response(frente='', verso='') {
        document.getElementById('frenteBG').src =frente;
        document.getElementById('versoBG').src =verso;
    }

</script>