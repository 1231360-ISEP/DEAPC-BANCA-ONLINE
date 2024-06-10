<?php session_start(); ?>
<?php
require 'seguranca.php';
require 'base-dados.php';

function escrever_cliente($linha_cliente) {
?>
	<tr>
		<td><?= $linha_cliente[0] ?></td>
		<td><?= $linha_cliente[1] ?></td>
		<td>654,67€</td>
		<td>Ativa</td>
		<td>
			<img alt="Desativar utilizador" src="images/material-symbols/block.svg"/>
			<img alt="Remover utilizador" src="images/material-symbols/delete.svg"/>
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

		$query = $base_dados->prepare("SELECT IBAN_cliente, nome_cliente FROM Utilizadores WHERE nome_cliente LIKE :nome");
		// $query->bindParam(':role', $role, SQLITE3_INTEGER);
		$query->bindParam(':nome', $nome, SQLITE3_TEXT);
		$result = $query->execute();

		while($linha = $result->fetchArray(SQLITE3_NUM))
			escrever_cliente($linha);
	}catch(Exception $exception) {
		error_log($exception->getMessage());
	}
}

assegura_login_administrador();
obter_base_dados($base_dados);
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
