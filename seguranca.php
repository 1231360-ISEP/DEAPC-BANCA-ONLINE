<?php
define('ROLE_ADMINISTRADOR', 0);
define('ROLE_CLIENTE', 1);

function assegura_login() {
	if(!isset($_SESSION['username'])) {
		header('Location: login.php');
	}
}

function assegura_sem_login() {
	if(isset($_SESSION['username'])) {
		header('Location: administrador.php');
	}
}

function assegura_login_administrador() {
	if(!isset($_SESSION['username'])) {
		header('Location: login.php');

		return;
	}

	if(!isset($_SESSION['role'])) {
		session_destroy();

		header('Location: login.php');

		return;
	}

	if($_SESSION['role'] != ROLE_ADMINISTRADOR) {
		session_destroy();

		header('Location: login.php');

		return;
	}
}

function assegura_login_cliente() {
	if(!isset($_SESSION['username'])) {
		header('Location: login.php');

		return;
	}

	if(!isset($_SESSION['role'])) {
		session_destroy();

		header('Location: login.php');

		return;
	}

	if($_SESSION['role'] != ROLE_CLIENTE) {
		session_destroy();

		header('Location: login.php');

		return;
	}
}
?>
