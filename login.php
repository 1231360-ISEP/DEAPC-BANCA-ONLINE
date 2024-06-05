<?php session_start();?>
<?php
require 'seguranca.php';

assegura_sem_login();

function validar_input(&$username, &$password) {
	if(!isset($_POST['username']))
		return false;

	if(!isset($_POST['password']))
		return false;

	$username = $_POST['username'];
	$password = $_POST['password'];

	return true;
}

if(validar_input($username, $password)) {
	$_SESSION['username'] = $username;

	header('Location: administrador.php');
}
?>

<!DOCTYPE html>
<html lang="pt">
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<title>Banca Online - Entrar</title>
		<link rel="stylesheet" href="styles/main.css"/>
		<link rel="stylesheet" href="styles/footer.css"/>
		<link rel="stylesheet" href="styles/login.css"/>
	</head>
	<body>
		<header>
			<p><a href="index.php">Página inicial</a></p>
		</header>
		<main>
			<form method="post">
				<h1>Login</h1>
				<p class="erro"></p>
				<div>
					<label for="username">Nome de utilizador:</label>
					<input name="username" id="username" type="text"/>
					<label for="password">Password:</label>
					<input name="password" id="password" type="password"/>
					<button type="submit">Entrar</button>
				</div>
			</form>
		</main>
		<?php include 'footer.php'; ?>
		<script src="scripts/login.js"></script>
	</body>
</html>
