
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
       <title>Home</title>
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
       <link rel="stylesheet" href="../CSS/listas.css">
       <link rel="stylesheet" href="../CSS/home.css">
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
                            <a class="nav-link" href="configuracoes.php">Configura&ccedil;oes</a>
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

       <?php
           $consultaF = $pdo->query("SELECT idCrachas FROM crachas");
            
           $dados = $consultaF->fetch(PDO::FETCH_ASSOC);
           $count = $consultaF->rowCount();
           
           if ($count > 0){
               $contador = 0;
               while ($count != $contador){
                   
                    $contador ++;
                    
               }
            }
           $consultaF = $pdo->query("SELECT empresa FROM empresas");
            
           $dados2 = $consultaF->fetch(PDO::FETCH_ASSOC);
           $count2 = $consultaF->rowCount();
           
           if ($count2 > 0){
               $contador2 = 0;
               while ($count2 != $contador2){
                        $contador2 ++;
               }
            }
           $consultaF = $pdo->query("SELECT foto FROM crachas WHERE foto is null ");
            
           $dados3 = $consultaF->fetch(PDO::FETCH_ASSOC);
           $count3 = $consultaF->rowCount();

           $contador3 = 0;
           if ($count3 > 0){
              
               while ($count3 != $contador3){
                   
                    $contador3 ++;
                    
               }
            
            }
            $consultaF = $pdo->query("SELECT background FROM empresas WHERE background is null ");
            
            $dados4 = $consultaF->fetch(PDO::FETCH_ASSOC);
            $count4 = $consultaF->rowCount();
 
            $contador4 = 0;
            if ($count4 > 0){
               
                while ($count4 != $contador4){
                    
                     $contador4 ++;
                     
                }
             
             }
       ?>
            <div style="width:50%; margin:auto;">
                <h2>Dashboards</h2>
               <div class="bloco">
                    <div class="container">
                        <div id="contador">
                            <?php echo $contador; ?>
                        </div>
                        <div class="box">
                               <h4><b>Funcionarios</b></h4>
                        </div>
                     </div>

                     <div class="container">
                        <div id="contador2">
                            <?php echo $contador2; ?>
                        </div>
                        <div class="box">
                            <h4><b>Empresas</b></h4>
                        </div>
                    </div>

                    <div class="container">
                        <div id="contador3">
                            <?php echo $contador3; ?>
                        </div>
                        <div class="box">
                            <h4><b>Funcionarios sem foto</b></h4>
                        </div>
                    </div>

                    <div class="container">
                        <div id="contador4">
                            <?php echo $contador4; ?>
                        </div>
                        <div class="box">
                            <h4><b>Empresas sem background</b></h4>
                        </div>
                    </div>

               </div>
                
            </div>
    </body>
</html>