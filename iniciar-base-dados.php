<?php
require 'base-dados.php';
require 'seguranca.php';

function inicializar_base_dados($base_dados) {
	$base_dados->query(
	'CREATE TABLE IF NOT EXISTS Utilizadores(' .
	'id INTEGER PRIMARY KEY AUTOINCREMENT,' .
	'username VACHAR(32) NOT NULL UNIQUE,' .
	'password VARCHAR(256) NOT NULL,' .
	'tipo INT NOT NULL,' .
	'estado INT NOT NULL DEFAULT 0,' .
	'ultimo_login INT NOT NULL DEFAULT 0,' .
	'nome_cliente VARCHAR(128),' .
	'IBAN_cliente VARCHAR(34),' .
	'sexo_cliente INT,' .
	'email_cliente VARCHAR(256),' .
	'telemovel_cliente INT)'
	);

	$base_dados->query(
	'CREATE TABLE IF NOT EXISTS Transacoes(' .
	'id INTEGER PRIMARY KEY AUTOINCREMENT,' .
	'montante FLOAT NOT NULL,' .
	'data INT NOT NULL,' .
	'IBAN_transacao VARCHAR(34) NOT NULL,' .
	'id_utilizador INTEGER NOT NULL REFERENCES Utilizadores(id))'
	);
}

function adicionar_administrador($base_dados, $username, $password) {
	$query = $base_dados->prepare('INSERT OR IGNORE INTO Utilizadores(username, password, tipo) VALUES (:username, :password, :tipo)');
	$query->bindParam(':username', $username, SQLITE3_TEXT);
	$password = password_hash($password, PASSWORD_DEFAULT);
	$query->bindParam(':password', $password, SQLITE3_TEXT);
	$tipo = ROLE_ADMINISTRADOR;
	$query->bindParam(':tipo', $tipo, SQLITE3_INTEGER);
	$query->execute();
}

function adicionar_cliente($base_dados, $username, $password, $nome_cliente, $iban_cliente) {
	$query = $base_dados->prepare('INSERT OR IGNORE INTO Utilizadores(username, password, tipo, nome_cliente, IBAN_cliente) VALUES (:username, :password, :tipo, :nome_cliente, :iban_cliente)');
	$query->bindParam(':username', $username, SQLITE3_TEXT);
	$password = password_hash($password, PASSWORD_DEFAULT);
	$query->bindParam(':password', $password, SQLITE3_TEXT);
	$tipo = ROLE_CLIENTE;
	$query->bindParam(':tipo', $tipo, SQLITE3_INTEGER);
	$query->bindParam(':nome_cliente', $nome_cliente, SQLITE3_TEXT);
	$query->bindParam(':iban_cliente', $iban_cliente, SQLITE3_TEXT);
	$query->execute();
}

obter_base_dados($base_dados);

inicializar_base_dados($base_dados);

adicionar_administrador($base_dados, 'leonardo_silva', '12345678');
adicionar_administrador($base_dados, 'rodrigo_delgado', '12345678');
adicionar_administrador($base_dados, 'rodrigo_rocha', '12345678');

adicionar_cliente($base_dados, 'leonardo', '12345678', 'Leonardo o Cliente', 'PT10003506515478542369382');

$base_dados->close();

header('Location: index.php');
?>
