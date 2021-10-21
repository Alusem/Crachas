<?php
    session_start();
	require 'conexao.php';
	global $pdo;

    $nomeEmpresa = addslashes($_POST['nomeEmpresa']);
 
if (strlen($_POST['nomeEmpresa']) ==  0){
	$erros[] = utf8_encode('Preencha o campo nome empresa.');
} 


if (isset($erros) && count($erros) > 0) {
    
    $_SESSION['camposForm'] = $_POST;
    $_SESSION['errosReportados'] = $erros;
    header("Location: ../VIEW/editar.php");

}else {
     try {
        
         $id = addslashes($_POST['idEmpresas']);

	     $stmt = $pdo->prepare('UPDATE empresas SET empresa = :empresa WHERE idEmpresas=:id');
	 
         $stmt->bindParam(':id', $id);
         $stmt->bindParam(':empresa', $nomeEmpresa);

         $retorno  = $stmt->execute();

             if (! $retorno){
                ?> <script>alert("Erro, tente novamente!");</script> <?php
                ?> <script>window.location.href = "../VIEW/editarE.php";</script> <?php
             }else {
                ?> <script>alert("Empresa editado com sucesso!");</script> <?php
                ?> <script>window.location.href = "../VIEW/empresas.php";</script> <?php
             }  

     } catch(PDOException $e) {
          echo 'Error: ' . $e->getMessage();
     }

     }