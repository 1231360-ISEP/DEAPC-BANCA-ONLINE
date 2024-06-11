<?php session_start(); ?>
<?php
require 'seguranca.php';
require 'base-dados.php';

function obter_saldo_cliente($base_dados, $id_cliente) {
	$saldo = 0;

	try {
		$query = $base_dados->prepare('SELECT montante FROM Transacoes WHERE id_utilizador = :id_cliente');
		$query->bindParam(':id_cliente', $id_cliente, SQLITE3_INTEGER);
		$result = $query->execute();

		while($linha = $result->fetchArray(SQLITE3_NUM))
			$saldo += $linha[0];
	}catch(Exception $exception) {
		error_log($exception->getMessage());
	}

	return $saldo;
}

function escrever_cliente($linha_cliente, $saldo) {
	$estado_conta = "";

	switch($linha_cliente[2]) {
		case ESTADO_CONTA_ATIVADA:
			$estado_conta = "Ativada";
			break;
		case ESTADO_CONTA_DESATIVADA:
			$estado_conta = "Desativada";
			break;
		case ESTADO_CONTA_ELIMINADA:
			$estado_conta = "Eliminada";
			break;
	}
?>
	<tr>
		<td><?= $linha_cliente[0] ?></td>
		<td><?= $linha_cliente[1] ?></td>
		<td><?= $saldo ?>€</td>
		<td><?= $estado_conta ?></td>
		<td>
			<form method="post">
				<input name="id" value="<?= $linha_cliente[3] ?>" type="hidden"/>
				<button name="acao" value="desativar" type="submit" class="acao"><img alt="Desativar utilizador" src="images/material-symbols/block.svg"/></button>
				<button name="acao" value="eliminar" type="submit" class="acao"><img alt="Remover utilizador" src="images/material-symbols/delete.svg"/></button>
			</form>
		</td>
	</tr>
<?php
}

function listar_clientes($base_dados) {
	$nome = '';

	if(isset($_GET['pesquisa_nome'])) {
		$nome = $_GET['pesquisa_nome'];
	}

	$nome = '%' . $nome . '%';

	try {
		$role = ROLE_CLIENTE;

		$query = $base_dados->prepare("SELECT IBAN_cliente, nome_cliente, estado, id FROM Utilizadores WHERE tipo = :role AND nome_cliente LIKE :nome");
		$query->bindParam(':role', $role, SQLITE3_INTEGER);
		$query->bindParam(':nome', $nome, SQLITE3_TEXT);
		$result = $query->execute();

		while($linha = $result->fetchArray(SQLITE3_NUM)) {
			$saldo = obter_saldo_cliente($base_dados, $linha[3]);

			escrever_cliente($linha, $saldo);
		}
	}catch(Exception $exception) {
		error_log($exception->getMessage());
	}
}

function validar_input(&$acao, &$id) {
	if(!isset($_POST['acao']))
		return false;

	if(!isset($_POST['id']))
		return false;

	$acao = $_POST['acao'];
	$id = $_POST['id'];

	return true;
}

function alterar_estado_utilizador($base_dados, $id, $estado) {
	try {
		$query = $base_dados->prepare('UPDATE Utilizadores SET estado = :estado WHERE id = :id');
		$query->bindParam(':estado', $estado, SQLITE3_INTEGER);
		$query->bindParam(':id', $id, SQLITE3_INTEGER);
		$query->execute();
	}catch(Exception $exception) {
		error_log($exception->getMessage);
	}
}

assegura_login_administrador();
obter_base_dados($base_dados);

error_log('Baka!');

if(validar_input($acao, $id)) {
	error_log($acao);

	if($acao == 'desativar')
		alterar_estado_utilizador($base_dados, $id, ESTADO_CONTA_DESATIVADA);
	else if($acao == 'eliminar')
		alterar_estado_utilizador($base_dados, $id, ESTADO_CONTA_ELIMINADA);
}
?>
<!DOCTYPE html>
<html lang="pt">
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=divice, initial-scale=1"/>
		<title>Banca Online - Gestão de contas</title>
		<link rel="stylesheet" href="styles/main.css"/>
		<link rel="stylesheet" href="styles/header.css"/>
		<link rel="stylesheet" href="styles/footer.css"/>
		<link rel="stylesheet" href="styles/painel.css"/>
		<link rel="stylesheet" href="styles/administrador.css"/>
	</head>
	<body>
		<header>
			<p><?= $_SESSION['username'] ?></p>
			<a href="sair.php"><button id="sair">Sair</button></a>
		</header>
		<main>
			<h1>Gestão de contas</h1>
			<div id="funcionalidades">
				<a href="adicionar-conta.php"><button id="adicionar-conta">+ Adicionar Cliente</button></a>
				<form id="pesquisa">
					<label for="pesquisa-nome">Nome:</label>
					<input name="pesquisa_nome" id="pesquisa-nome" type="text" value="<?= isset($_GET['pesquisa_nome']) ? $_GET['pesquisa_nome'] : '' ?>"/>
					<button>Pesquisa</button>
				</form>
			</div>
			<table class="main-table">
				<thead>
					<tr>
						<th>IBAN do Cliente</th>
						<th>Nome do Cliente</th>
						<th>Saldo</th>
						<th>Estado</th>
						<th>Ação</th>
					</tr>
				</thead>
				<tbody>
					<?php listar_clientes($base_dados); ?>
				</tbody>
			</table>
		</main>
		<?php include 'footer.php'; ?>
	</body>
</html>
<?php $base_dados->close(); ?>
