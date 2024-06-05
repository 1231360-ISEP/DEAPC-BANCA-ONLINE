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
?>
