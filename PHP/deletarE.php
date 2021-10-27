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
        header("Location: ../VIEW/deletar.php");

    }else {
        try {
            
            $id = addslashes($_POST['idEmpresa']);

            $stmt = $pdo->prepare('DELETE FROM empresas WHERE idEmpresas = :id');
    
            $stmt->bindParam(':id', $id);
            
            if ($id > 0 ){
            $retorno  = $stmt->execute();
            }
    
            if (! $retorno){
                $erros[] = utf8_encode('Erro, tente novamente!');
            }else {
                ?> <script>alert("Empresa deletado com sucesso!");</script> <?php
                ?> <script>window.location.href = "../VIEW/empresas.php";</script> <?php
            }

        }catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        }

        }