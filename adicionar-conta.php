<?php session_start(); ?>
<?php
require 'seguranca.php';
require 'base-dados.php';

assegura_login_administrador();

function validar_input(&$username, &$password, &$nome_cliente, &$IBAN_cliente, &$sexo_cliente, &$email_cliente, &$telemovel_cliente) {
	if(!isset($_POST['username']))
		return false;

	if(!isset($_POST['password']))
		return false;

	if(!isset($_POST['nome_cliente']))
		return false;

	if(!isset($_POST['IBAN_cliente']))
		return false;

	if(!isset($_POST['sexo_cliente']))
		return false;

	if(!isset($_POST['email_cliente']))
		return false;

	if(!isset($_POST['telemovel_cliente']))
		return false;

	$username = $_POST['username'];
	$password = $_POST['password'];
	$nome_cliente = $_POST['nome_cliente'];
	$IBAN_cliente = $_POST['IBAN_cliente'];
	$sexo_cliente = $_POST['sexo_cliente'];
	$email_cliente = $_POST['email_cliente'];
	$telemovel_cliente = $_POST['telemovel_cliente'];

	return true;
}

function criar_cliente($base_dados, $username, $password, $tipo, $nome_cliente, $IBAN_cliente, $sexo_cliente, $email_cliente, $telemovel_cliente) {
	try {
		$query = $base_dados->prepare(
			"INSERT INTO Utilizadores (username, password, tipo, nome_cliente, IBAN_cliente, sexo_cliente, email_cliente, telemovel_cliente) VALUES (:username, :password, :tipo, :nome_cliente, :IBAN_cliente, :sexo_cliente, :email_cliente, :telemovel_cliente)"
		);

		$username = $nome_cliente;
		$password = password_hash('senha_temporaria', PASSWORD_DEFAULT); // Criar uma senha temporária ou outra lógica de senha
		$tipo = 1;

		$query->bindParam(':username', $username, SQLITE3_TEXT);
		$query->bindParam(':password', $password, SQLITE3_TEXT);
		$query->bindParam(':tipo', $tipo, SQLITE3_INTEGER);
		$query->bindParam(':nome_cliente', $nome_cliente, SQLITE3_TEXT);
		$query->bindParam(':IBAN_cliente', $IBAN_cliente, SQLITE3_TEXT);
		$query->bindParam(':sexo_cliente', $sexo_cliente, SQLITE3_INTEGER);
		$query->bindParam(':email_cliente', $email_cliente, SQLITE3_TEXT);
		$query->bindParam(':telemovel_cliente', $telemovel_cliente, SQLITE3_TEXT);

		$query->execute();
		$_GET['mensagem'] = "Cliente adicionado com sucesso!";

		header('Location: administrador.php');
	} catch (Exception $e) {
		error_log($e->getMessage);
	}
}

obter_base_dados($base_dados);

if(validar_input($password, $nome_cliente, $IBAN_cliente, $sexo_cliente, $email_cliente, $telemovel_cliente)) {
	criar_cliente($base_dados, $username, $password, $nome_cliente, $IBAN_cliente, $sexo_cliente, $email_cliente, $telemovel_cliente);
}

$base_dados->close();

?>
<!DOCTYPE html>
<html lang="pt">
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<title>Banca Online - Adicionar um cliente</title>
		<link rel="stylesheet" href="styles/main.css"/>
		<link rel="stylesheet" href="styles/header.css"/>
		<link rel="stylesheet" href="styles/adicionar-conta.css"/>
	</head>
	<body>
		<header>
			<p><?= $_SESSION['username'] ?></p>
			<a href="sair.php"><button id="sair">Sair</button></a>
		</header>
		<main>
			<h1>Adicionar um cliente</h1>
			<p class="erro"></p>
			<form method="post">
				<table>
					<tr>
						<td>
							<label for="nome-cliente">Nome do Cliente:</label>
						</td>
						<td>
							<input name="nome_cliente" id="nome-cliente" type="text"/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="sexo">Sexo:</label>
						</td>
						<td>
							<select name="sexo_cliente" id="sexo">
								<option value="masculino">Masculino</option>
								<option value="feminino">Feminino</option>
								<option value="nao_especifico" selected>Não especifico</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<label for="email">Email:</label>
						</td>
						<td>
							<input nome="email_cliente" id="email" type="text"/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="telemovel">Telemóvel:</label>
						</td>
						<td>
							<input name="telemovel_cliente" id="telemovel" type="number"/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="username">Username:</label>
						</td>
						<td>
							<input name="username" id="username" type="text"/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="password">Passaword:</label>
						</td>
						<td>
							<input name="password" id="password" type="password"/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="iban-cliente">IBAN do cliente:</label>
						</td>
						<td>
							<input name="IBAN_cliente" id="iban-cliente" type="text"/>
						</td>
					</tr>
				</table>
				<a href="administrador.php"><button id="cancelar">Cancelar</button></a>
				<button type="submit">Criar</button>
			</form>
		</main>
		<script src="scripts/adicionar-conta.js"></script>
	</body>
</html>
