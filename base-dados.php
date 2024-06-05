<?php
function inicializar_base_dados() {
	$base_dados = new SQLite3('banca-online.db', SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);

	$base_dados->query(
	'CREATE TABLE IF NOT EXISTS Utilizadores(' .
	'id INTEGER PRIMARY KEY AUTOINCREMENT,' .
	'username VACHAR(32) NOT NULL UNIQUE,' .
	'password VARCHAR(256) NOT NULL,' .
	'tipo INT NOT NULL,' .
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

	$base_dados->close();
}

function adicionar_administrador($username, $password) {
	$base_dados = new SQLite3('banca-online.db', SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);

	$query = $base_dados->prepare("INSERT INTO Utilizadores(username, password, tipo) VALUES (:username, :password, 0)");
	$query->bindParam(':username', $username, SQLITE3_TEXT);
	$query->bindParam(':password', $password, SQLITE3_TEXT);
	$query->execute();

	$base_dados->close();
}

inicializar_base_dados();
adicionar_administrador('leonardo_silva', '12345678');
adicionar_administrador('rodrigo_delgado', '12345678');
adicionar_administrador('rodrigo_rocha', '12345678');
?>
