<?php session_start(); ?>

<?php 
require 'base-dados.php';
require 'seguranca.php';

assegura_login_cliente();

function validar_input(&$iban, &$montante, &$data){
	if(!isset($_POST['iban']))
		return false;

	if(!isset($_POST['montante']))
		return false;

	if(!isset($_POST['data']))
		return false;

	$iban = $_POST['iban'];
	$montante = floatval($_POST['montante']);
	$data = strtotime($_POST['data']);

	error_log($data);

	return true;
}

function criar_transacao($base_dados, $iban, $montante, $data){
	$id_utilizador = obter_id_utilizador($base_dados, $_SESSION['username']);

	if(!$id_utilizador)
		return;

	try{

		$query = $base_dados->prepare(
			'INSERT INTO Transacoes (montante, data, IBAN_transacao, id_utilizador) VALUES(:montante, :data, :iban, :id_utilizador)'

		);

		$query->bindParam(':montante', $montante, SQLITE3_FLOAT);
		$query->bindParam(':data', $data, SQLITE3_INTEGER);
		$query->bindParam(':iban', $iban, SQLITE3_TEXT);
		$query->bindParam(':id_utilizador', $id_utilizador, SQLITE3_INTEGER);

		$query->execute();

	}catch(Exception $e) {
		error_log($e->getMessage());
	}

}

obter_base_dados($base_dados);

if(validar_input($montante, $data, $iban)){
	criar_transacao($base_dados, $iban, $montante, $data);

	header('Location: cliente.php');
}

$base_dados->close();

?>
<!DOCTYPE html>
<html lang="pt">
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=divice, initial-scale=1"/>
		<title>Banca Online - Adicionar transação</title>
		<link rel="stylesheet" href="styles/main.css"/>
		<link rel="stylesheet" href="styles/header.css"/>
		<link rel="stylesheet" href="styles/adicionar-transacoes.css"/>
	</head>
	<body>
		<header>
			<p>[Cliente] Saldo:</p>
			<a href="login.html"><button id="sair">Sair</button></a>
		</header>
		<main>
			<h1>Adicionar Transação</h1>
			<p class="erro"></p>
			<form method="post">
				<table>
					<tr>
						<td>
							<label for="iban">IBAN:</label>
						</td>
						<td>
							<input name="iban" id="iban" type="text">
						</td>
					</tr>
					<tr>
						<td>
							<label for="montante">Montante:</label>
						</td>
						<td>
							<input name="montante" id="montante" type="text">
						</td>
					</tr>
					<tr>
						<td>
							<label for="data">Data:</label>
						</td>
						<td>
							<input name="data" id="data" type="date">
						</td>
					</tr>
				</table>
				<a href="cliente.html"><button>Cancelar</button></a>
				<button type="submit">Efetuar Transação</button>
			</form>
		</main>
		<script src="scripts/adicionar-transacoes.js"></script>
	</body>
</html>
