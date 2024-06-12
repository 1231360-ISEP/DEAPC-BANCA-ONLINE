<?php
define('ROLE_ADMINISTRADOR', 0);
define('ROLE_CLIENTE', 1);

function assegura_login() {
	if(!isset($_SESSION['username'])) {
		header('Location: login.php');
		exit();
	}

	if(!isset($_SESSION['role'])) {
		header('Location: login.php');
		exit();
	}

	if(!isset($_SESSION['id'])) {
		header('Location: login.php');
		exit();
	}
}

function assegura_sem_login() {
	if(!isset($_SESSION['username']))
		return;

	if(!isset($_SESSION['role'])) {
		session_destroy();

		header('Location: login.php');
		exit();
	}

	if(!isset($_SESSION['id'])) {
		session_destroy();

		header('Location: login.php');
		exit();
	}

	if($_SESSION['role'] == ROLE_ADMINISTRADOR) {
		header('Location: administrador.php');
		exit();
	}elseif($_SESSION['role'] == ROLE_CLIENTE) {
		header('Location: cliente.php');
		exit();
	}else {
		session_destroy();

		header('Location: login.php');
		exit();
	}
}

function assegura_login_administrador() {
	assegura_login();

	if($_SESSION['role'] != ROLE_ADMINISTRADOR) {
		session_destroy();

		header('Location: login.php');

		return;
	}
}

function assegura_login_cliente() {
	assegura_login();

	if($_SESSION['role'] != ROLE_CLIENTE) {
		session_destroy();

		header('Location: login.php');

		return;
	}
}
?>
