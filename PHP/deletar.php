<?php
    session_start();
	require 'conexao.php';
	global $pdo;

    $nome = addslashes($_POST['nome']);
    $apelido = addslashes($_POST['apelido']);
    $cargo = addslashes($_POST['cargo']);
    $orgaoExpeditor = addslashes($_POST['orgaoExpeditor']);
    $data = addslashes($_POST['data']);
    $empresa = addslashes($_POST['empresa']);
    $filial = addslashes($_POST['filial']);
    

    if (strlen($_POST['nome']) ==  0){
        $erros[] = utf8_encode('Preencha o campo nome.');
    }

    if (strlen($_POST['apelido']) ==  0){
        $erros[] = utf8_encode('Preencha o campo apelido.');
    }

    if (strlen($_POST['cargo']) ==  0){
        $erros[] = utf8_encode('Preencha o campo cargo.');
    }

    if (strlen($_POST['orgaoExpeditor']) ==  0){
        $erros[] = utf8_encode('Preencha o campo orgaoExpeditor.');
    }

    if (strlen($_POST['data']) ==  0){
        $erros[] = utf8_encode('Preencha o campo data.');
    }

    if (strlen($_POST['foto']) ==  0){
        //$erros[] = utf8_encode('Insira uma foto');
    }

    if (strlen($_POST['codigoMatricula']) ==  0){
        $erros[] = utf8_encode('Preencha o campo matricula.');

    }else {

        $codigoMatricula = addslashes($_POST['codigoMatricula']);

        $sql = "SELECT * FROM crachas WHERE codigoMatricula = :codigoMatricula";
        $sql = $pdo->prepare($sql);
        $sql->bindValue("codigoMatricula", $codigoMatricula);
        $sql->execute();

            if($sql->rowCount() < 0){
                $erros[] = utf8_encode('Matricula incorreta!');
            }
    }

    if (strlen($_POST['rg']) ==  0){
        $erros[] = utf8_encode('Preencha o campo rg.');

    }else {

        $rg = addslashes($_POST['rg']);

        $sql = "SELECT * FROM crachas WHERE numeroRG = :numeroRG";

        $sql = $pdo->prepare($sql);
        $sql->bindValue("numeroRG", $rg);
        $sql->execute();

            if($sql->rowCount() < 0){
                $erros[] = utf8_encode('RG incorreto!');
            }
        }

    if (strlen($_POST['cpf']) == 0){
        $erros[] = utf8_encode('Preencha o campo CPF.');

    }else {

        $cpf = addslashes($_POST['cpf']);

        if (validaCPF($cpf) == true){
            
            $sql = "SELECT * FROM crachas WHERE numeroCPF = :numeroCPF";
            $sql = $pdo->prepare($sql);
            $sql->bindValue("numeroCPF", $cpf);
            $sql->execute();

            if($sql->rowCount() < 0){
                $erros[] = utf8_encode('CPF incorreto!');
            }

        }else {
            $erros[] = utf8_encode('CPF invalido.');
        }
    }

    if (isset($erros) && count($erros) > 0) {
        
        $_SESSION['camposForm'] = $_POST;
        $_SESSION['errosReportados'] = $erros;
        header("Location: ../VIEW/deletar.php");

    }else {
        
        try {
            
            $id = addslashes($_POST['idFuncionario']);

            $stmt = $pdo->prepare('DELETE FROM crachas WHERE idCrachas = :id');
    
            $stmt->bindParam(':id', $id);
            
            if ($id > 0 ){
                $retorno  = $stmt->execute();
            }
    
            if (! $retorno){
                $erros[] = utf8_encode('Erro, tente novamente!');
            }else {
                ?> <script>alert("Funcionario deletado com sucesso!");</script> <?php
                ?> <script>window.location.href = "../VIEW/lista.php";</script> <?php
            }

        }catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        }

    }


    function validaCPF($cpf) {
    
        // Extrai somente os n�meros
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
        
        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se foi informada uma sequ�ncia de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;

    }