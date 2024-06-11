<?php
define('ESTADO_CONTA_ATIVADA', 0);
define('ESTADO_CONTA_DESATIVADA', 1);
define('ESTADO_CONTA_ELIMINADA', 2);

function obter_base_dados(&$base_dados) {
	try {
		$base_dados = new SQLite3('banca-online.db', SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);
		$base_dados->enableExceptions(true);
	}catch(Exception $exception) {
		exit('Não foi possível abrir a base de dados');
	}
}
?>
