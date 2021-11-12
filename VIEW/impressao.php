<?php
	require_once("../PHP/login.class.php");
    $login = new Login();
    $login->verificar("login.php");

    require '../PHP/conexao.php';
	global $pdo;
			
	$id = $_GET['idFuncionario'];    

    $stringQuery = "SELECT * FROM crachas WHERE idCrachas = '".$id."';";
			
    $sql = $pdo->query($stringQuery);

    if($sql->rowCount() > 0){
        $dados = $sql->fetch();
	}
	
	$empresa = $dados['idEmpresa'];

    $consultaF = $pdo->query("SELECT * FROM empresas WHERE idEmpresas = ". $empresa);
            
    $dados2 = $consultaF->fetch();

	

?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8" />
		<title>Preview Crachás</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="../CSS/preview.css">
		<link rel="stylesheet" href="../CSS/dados_<?php echo $dados2['empresa']; ?>.css">
	</head>
	<body>

		<header>
            <ul>
                <li>
                    <div>
                        <h1>Sam Crach&aacute;s</h1></li>
                    </div>
                <li>
                    <a href="home.php">Home</a>
                </li>

                <li>
                    <a class="active" href="lista.php">Funcion&aacute;rios</a>
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
                </li>

                <?php
                    $consulta = $pdo->query("SELECT isAdmin FROM usuarios WHERE '$LoginUsuario' = loginUsuarios");
	                $campo = $consulta->fetch(PDO::FETCH_ASSOC);
	                if($consulta->rowCount() != 0){
                ?>

                <li>
                    <div class="Usuario">
                        <a href="Admin.php"> <?php echo "ADM";?> </a></li>
                    </div>
                </li>
                
                <?php
                    }
                ?>
                
                <li>
                    <div class="Usuario">
                         <a href="login.php">Sair</a></li>
                    </div>
                </li>
            </ul>
		</header>

	<?php if (isset($dados2['background'])){ ?>
		<div class="container">
			<div class="form-crachas-frente">
				<figure>
					<img src= '<?php echo $dados2['background']; ?>' width='400px' height = '606px'/>
					<figcaption>
						<h2 id="frente">Frente</h2>
						<div id="foto">
							<img src= '<?php echo $dados['foto']; ?>?idFuncionario= <?php echo $id;?>' width='<?php echo $dados2['emp_preview_foto_largura'];?>px' height='<?php echo $dados2['emp_preview_foto_altura'];?>px'/>
						</div>
						<form action="../VIEW/impressao_frente.php" class="acao">
							<input type="hidden" name="idFuncionario" value="<?php echo $id;?>">
								<div>
									<button id="btn-impressao-funcionariosF">Imprimir Frente</button>
								</div>
						</form>
					</figcaption>
				</figure>
			
				<div class="dados">

					<div id="nome">
						<?php echo $dados['apelido']; ?>
					</div>	

					<div id="cargo">
						<?php echo $dados['cargo']; ?>
					</div>

				</div>
			</div>

			<div class="form-crachas-verso">
				
				<div>
			        <figure>
						<img src='<?php echo $dados2['background2']; ?>' width='400px'height = '606px';/>
                        <figcaption>
							<h2 id="verso">Verso</h2>
							<form action="../VIEW/impressao_verso.php" class="acao">
								<input type="hidden" name="idFuncionario" value="<?php echo $id;?>">
									<div>
										<button id="btn-impressao-funcionariosV">Imprimir Verso</button>
									</div>
							</form>
						</figcaption>
					</figure>
			    </div>
				
				<div>
					<input class="input" type="text" id="nomeCompleto" value="<?php echo $dados['nomeCompleto'];?>" readonly><br>
				</div>

				<div>
					<input class="input" type="text" value="<?php echo $dados['numeroRG']; echo ' '; echo $dados['orgaoExpeditor'];?>" readonly><br>
				</div>

				<div>
					<input class="input" type="text" value="<?php echo $dados['numeroCPF'];?>" readonly><br>
				</div>

				<div>
					<input class="input" type="text" value="<?php $date = new DateTime($dados['dataAdimssao']); echo $date->format('d/m/Y'); ?>" readonly>
				</div>

				<div>
					<input class="input" type="text" value="<?php echo $dados['codigoMatricula'];?>" readonly><br>
				</div>
			
			</div>
		</div>
	</body>
 	<?php }else{ ?>
		 <h2 id="erro">Não foi encontrado o background desta empresa, acesse "Impressão" para adicionar um novo background.</h2>
	<?php } ?>
	</html>