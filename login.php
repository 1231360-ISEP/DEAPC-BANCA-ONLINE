<?php session_start();?>
<?php
require 'seguranca.php';
require 'base-dados.php';

function validar_input(&$username, &$password) {
	if(!isset($_POST['username']))
		return false;

	if(!isset($_POST['password']))
		return false;

	$username = $_POST['username'];
	$password = $_POST['password'];

	return true;
}

function login($base_dados, &$username, $password, &$role) {
	$password_hash = password_hash($password, PASSWORD_DEFAULT);

	try {
		$query = $base_dados->prepare('SELECT tipo, password FROM utilizadores WHERE username = :username');
		$query->bindParam(':username', $username, SQLITE3_TEXT);
		$result = $query->execute();

		$row = $result->fetchArray(SQLITE3_NUM);

		if(!$row) {
			session_destroy();

			return;
		}

		$password_hash = $row[1];

		if(!password_verify($password, $password_hash)) {
			session_destroy();

			return false;
		}

		$role = $row[0];
		$current_time = time();

		$query = $base_dados->prepare('UPDATE Utilizadores SET ultimo_login=:ultimo_login WHERE username=:username');
		$query->bindParam(':ultimo_login', $current_time, SQLITE3_INTEGER);
		$query->bindParam(':username', $username, SQLITE3_TEXT);
		$query->execute();
	}catch(Exception $exception) {
		error_log($exception->getMessage());

		return false;
	}

	return true;
}

assegura_sem_login();
obter_base_dados($base_dados);

if(validar_input($username, $password)) {
	if(login($base_dados, $username, $password, $role)) {
		$_SESSION['username'] = $username;
		$_SESSION['role'] = $role;

		if($role == ROLE_ADMINISTRADOR) {
			header('Location: administrador.php');
		}elseif($role == ROLE_CLIENTE) {
			header('Location: cliente.php');
		}else {
			session_destroy();

			header('Location: index.php');
		}
	}
}

$base_dados->close();
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
