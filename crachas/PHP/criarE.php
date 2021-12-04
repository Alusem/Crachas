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
        header("Location: ../VIEW/cadastrarE.php");


    }else {

        $sql = "SELECT * FROM empresas WHERE empresa = :empresa";
        $sql = $pdo->prepare($sql);
        $sql->bindValue("empresa", $nomeEmpresa);
        $sql->execute();

        if($sql->rowCount() > 0){

        ?> <script>alert("Erro, empresa já cadastrada!");</script> <?php
        ?> <script>window.location.href = "../VIEW/cadastrarE.php";</script> <?php

    }else{

        $stmt2 = $pdo->prepare("INSERT INTO empresas (empresa) VALUES(:empresa)");
        $stmt2->execute(array(':empresa' => $nomeEmpresa));
     
        ?> <script>alert("Dados cadastrados!");</script> <?php
        ?> <script>window.location.href = "../VIEW/empresas.php";</script> <?php
        
    }
}   