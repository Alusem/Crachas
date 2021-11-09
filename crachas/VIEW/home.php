
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
            <ul>
                <li>
                    <div>
                        <h1>Sam Crach&aacute;s</h1></li>
                    </div>
                <li>
                    <a class="active" href="home.php">Home</a>
                </li>

                <li>
                    <a href="lista.php">Funcion&aacute;rios</a>
                </li>

                <li>
                    <a href="empresas.php">Empresas</a>
                </li>

                <li>
                    <a href="configuracoes.php">Background</a>
                </li>

                <li>
                    <div class="Usuario">
                        <a> <?php echo $LoginUsuario;?> </a></li>
                    </div>
                <li>
                    <div class="Usuario">
                         <a href="login.php">Sair</a></li>
                    </div>
            </ul>
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
                               <!--<p><?php echo $contador;?> <?php if ($contador > 1) {echo "funcionarios cadastrados.";}else{echo "funcionario cadastrado.";} ?> </p> -->
                        </div>
                     </div>

                     <div class="container">
                        <div id="contador2">
                            <?php echo $contador2; ?>
                        </div>
                        <div class="box">
                            <h4><b>Empresas</b></h4>
                            <!--<p><?php echo $contador2;?> <?php if ($contador2 > 1) {echo "Empresas cadastradas.";}else{echo "empresa cadastrada.";} ?> </p> -->
                        </div>
                    </div>

                    <div class="container">
                        <div id="contador3">
                            <?php echo $contador3; ?>
                        </div>
                        <div class="box">
                            <h4><b>Funcionarios sem foto</b></h4>
                            <!--<p><?php echo $contador3;?> <?php if ($contador3 > 1) {echo "funcionarios sem foto";}else{echo "funcionario sem foto.";} ?> </p> -->
                        </div>
                    </div>

                    <div class="container">
                        <div id="contador4">
                            <?php echo $contador4; ?>
                        </div>
                        <div class="box">
                            <h4><b>Empresas sem background</b></h4>
                            <!--<p><?php echo $contador4;?> <?php if ($contador4 > 1) {echo "empresas sem background";}else{echo "empresas sem background.";} ?> </p> -->
                        </div>
                    </div>

               </div>
                
            </div>
    </body>
</html>