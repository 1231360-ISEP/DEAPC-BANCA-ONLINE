<?php session_start(); ?>
<?php
require 'seguranca.php';
require 'base-dados.php';

assegura_login_cliente();

function escrever_transacao($linha_transacao){
	$data = date('d/m/Y', $linha_transacao[2]);
?>
	<tr>
		<td><?= $linha_transacao[0] ?></td>
		<td><?= $linha_transacao[1] ?></td>
		<td><?= $data ?></td>
	</tr>
<?php
}

function listar_transacoes($base_dados){
	try {
		$id_utilizador = $_SESSION['id'];
	
		$query = $base_dados->prepare("SELECT IBAN_transacao, montante, data FROM Transacoes WHERE id_utilizador = :id_utilizador");
		$query->bindParam(':id_utilizador', $id_utilizador, SQLITE3_INTEGER);
		$result = $query->execute();

		while($linha = $result->fetchArray(SQLITE3_NUM)){
			escrever_transacao($linha);
		}
	} catch (Exception $exception) {
		error_log($exception->getMessage());
	}

	
}

obter_base_dados($base_dados);
?>
<!DOCTYPE html>
<html lang="pt">
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device, initial-scale=1"/>
		<title>Banca online - Histórico de transações</title>
		<link rel="stylesheet" href="styles/main.css"/>
		<link rel="stylesheet" href="styles/header.css"/>
		<link rel="stylesheet" href="styles/painel.css">
		<link rel="stylesheet" href="styles/cliente.css">

	</head>
	<body>
		<header>
			<p><?= $_SESSION['username'] ?></p>
			<a href="sair.php"><button id="sair">Sair</button></a>
		</header>
		<main>
			<h1>Histórico de transações</h1>
			<div id="funcionalidades">
				<a href="adicionar-transacao.php"><button id="adicionar-transacao">+ Adicionar transação</button></a>
				<div id="pesquisa">
					<table>
						<tr>
							<td><label for="pesquisa-entidade">IBAN:</label></td>
							<td><input id="pesquisa-entidade" type="number"/></td>
							<td><button>Pesquisa</button></td>
						</tr>
						<tr>
							<td><label for="pesquisa-data-inicio">Data:</label></td>
							<td>
								<input id="pesquisa-data-inicio" type="date">
								-
								<input id="pesquisa-data-fim" type="date">
							</td>
							<td></td>
						</tr>
					</table>
				</div>
			</div>
			<table class="main-table">
				<thead>
					<tr>
						<th>IBAN</th>
						<th>Montante</th>
						<th>Data</th>
					</tr>
				</thead>
				<tbody>
					<?php listar_transacoes($base_dados); ?>
				</tbody>
			</table>
		</main>
		<?php include 'footer.php'; ?>
	</body>
</html>
<?php $base_dados->close(); ?>