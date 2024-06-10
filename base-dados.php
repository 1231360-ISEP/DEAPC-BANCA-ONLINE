<?php
function obter_base_dados(&$base_dados) {
	$base_dados = new SQLite3('banca-online.db', SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);
	$base_dados->enableExceptions(true);
}
?>
