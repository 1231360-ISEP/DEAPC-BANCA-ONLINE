<?php session_start(); ?>
<?php
	require 'seguranca.php';

	assegura_login();
	$base_dados = new SQLite3('banca-online.db', SQLITE3_OPEN_READONLY);
	$base_dados->enableExceptions(true);
	
	// Obter todos os clientes
	$query = $base_dados->query("SELECT * FROM Utilizadores WHERE tipo = 1");
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
			<form action="administrador.html">
				<table>
					<tr>
						<td>
							<label for="nome-cliente">Nome do Cliente:</label>
						</td>
						<td>
							<input id="nome-cliente" type="text"/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="sexo">Sexo:</label>
						</td>
						<td>
							<select id="sexo">
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
							<input id="email" type="text"/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="telemovel">Telemóvel:</label>
						</td>
						<td>
							<input id="telemovel" type="number"/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="username">Username:</label>
						</td>
						<td>
							<input id="username" type="text"/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="password">Passaword:</label>
						</td>
						<td>
							<input id="password" type="password"/>
						</td>
					</tr>
					<tr>
						<td>
							<label for="iban-cliente">IBAN do cliente:</label>
						</td>
						<td>
							<input id="iban-cliente" type="text"/>
						</td>
					</tr>
				</table>
				<a href="administrador.html"><button id="cancelar">Cancelar</button></a>
				<button type="submit">Criar</button>
			</form>
		</main>
		<script src="scripts/adicionar-conta.js"></script>
	</body>
</html>
