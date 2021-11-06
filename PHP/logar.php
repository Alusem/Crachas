<?php
	session_start();
	require '../PHP/conexao.php';
	global $pdo;

if (strlen($_POST['senha']) ==  0){
	$erros[] = utf8_encode('Preencha o campo senha.');
}

if (strlen($_POST['login']) == 0){
	$erros[] = utf8_encode('Preencha o campo login.');

	}

if (isset($erros) && count($erros) > 0) {
    $_SESSION['errosReportados'] = $erros;
    header("Location: ../View/login.php");

	}else {
		
		$login = addslashes($_POST['login']);
		$senha = addslashes($_POST['senha']);

		$sql = "SELECT * FROM usuarios WHERE loginUsuarios = :loginUsuarios AND senhaUsuarios = :senhaUsuarios";
		$sql = $pdo->prepare($sql);
		$sql->bindValue("loginUsuarios", $login);
		$sql->bindValue("senhaUsuarios", $senha);
		$sql->execute();

		if($sql->rowCount() > 0){
			$dado = $sql->fetch();
			$_SESSION['idUser'] = $dado['idUsuarios'];
			header("Location: ../View/home.php");
		}else{
			$erros[] = utf8_encode('Usuario ou senha inválidos.');
			if (isset($erros) && count($erros) > 0) {
			$_SESSION['errosReportados'] = $erros;
			header("Location: ../View/login.php");
			}
		}
	}