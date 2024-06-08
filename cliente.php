<?php session_start(); ?>
<?php 
	require 'segurança.php';

	assegura_login();
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
				<a href="adicionar-transacao.html"><button id="adicionar-transacao">+ Adicionar transação</button></a>
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
					<tr>
						<td>56789</td>
						<td>64,93€</td>
						<td>16/05/2024</td>
					</tr>
					<tr>
						<td>23145</td>
						<td>204,00€</td>
						<td>14/05/2024</td>
					</tr>
					<tr>
						<td>57903</td>
						<td>60,90€</td>
						<td>10/05/2024</td>
					</tr>
					<tr>
						<td>45890</td>
						<td>10,00€</td>
						<td>9/05/2024</td>
					</tr>
					<tr>
						<td>78347</td>
						<td>4,99€</td>
						<td>4/05/2024</td>
					</tr>
					<tr>
						<td>90341</td>
						<td>730,00€</td>
						<td>3/05/2024</td>
					</tr>
				</tbody>
			</table>
		</main>
		<?php include 'footer.php'; ?>
	</body>
</html>
