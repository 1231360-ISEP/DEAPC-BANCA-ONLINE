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

function obter_saldo_cliente($base_dados, $id_cliente) {
	$saldo = 0;

	try {
		$query = $base_dados->prepare('SELECT montante FROM Transacoes WHERE id = :id_cliente');
		$query->bindParam(':id_cliente', $id_cliente, SQLITE3_INTEGER);
		$result = $query->execute();

		while($linha = $result->fetchArray(SQLITE3_NUM))
			$saldo += $linha[0];
	}catch(Exception $exception) {
		error_log($exception->getMessage());
	}

	return $saldo;
}

?>
