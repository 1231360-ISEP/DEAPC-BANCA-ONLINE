<?php session_start(); ?>
<?php
	require 'seguranca.php';

	assegura_login_administrador();
?>
<!DOCTYPE html>
<html lang="pt">
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=divice, initial-scale=1"/>
		<title>Banca Online - Gestão de contas</title>
		<link rel="stylesheet" href="styles/main.css"/>
		<link rel="stylesheet" href="styles/header.css"/>
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
				<div id="pesquisa">
					<label for="pesquisa-nome">Nome:</label>
					<input id="pesquisa-nome" type="text"/>
					<button>Pesquisa</button>
				</div>
			</div>
			<table class="main-table">
				<thead>
					<tr>
						<th>Nº da conta</th>
						<th>Nome do Cliente</th>
						<th>Saldo</th>
						<th>Estado</th>
						<th>Ação</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>123435</td>
						<td>Alferedo Costa</td>
						<td>654,67€</td>
						<td>Ativa</td>
						<td>
							<img alt="Desativar utilizador" src="images/material-symbols/block.svg"/>
							<img alt="Remover utilizador" src="images/material-symbols/delete.svg"/>
						</td>
					</tr>
					<tr>
						<td>128765</td>
						<td>Barbara Marques</td>
						<td>12389,65€</td>
						<td>Ativa</td>
						<td>
							<img alt="Desativar utilizador" src="images/material-symbols/block.svg"/>
							<img alt="Remover utilizador" src="images/material-symbols/delete.svg"/>
						</td>
					</tr>
					<tr>
						<td>138653</td>
						<td>Henrique Santos</td>
						<td>-13,56€</td>
						<td>Desativa</td>
						<td>
							<img alt="Desativar utilizador" src="images/material-symbols/block.svg"/>
							<img alt="Remover utilizador" src="images/material-symbols/delete.svg"/>
						</td>
					</tr>
					<tr>
						<td>235643</td>
						<td>Joana Nascimento</td>
						<td>234,76€</td>
						<td>Ativa</td>
						<td>
							<img alt="Desativar utilizador" src="images/material-symbols/block.svg"/>
							<img alt="Remover utilizador" src="images/material-symbols/delete.svg"/>
						</td>
					</tr>
					<tr>
						<td>126543</td>
						<td>Mario Neves</td>
						<td>3657,43€</td>
						<td>Ativa</td>
						<td>
							<img alt="Desativar utilizador" src="images/material-symbols/block.svg"/>
							<img alt="Remover utilizador" src="images/material-symbols/delete.svg"/>
						</td>
					</tr>
					<tr>
						<td>245643</td>
						<td>Óscar Silva</td>
						<td>-2,54€</td>
						<td>Desativa</td>
						<td>
							<img alt="Desativar utilizador" src="images/material-symbols/block.svg"/>
							<img alt="Remover utilizador" src="images/material-symbols/delete.svg"/>
						</td>
					</tr>
					<tr>
						<td>128533</td>
						<td>Vitor Vieira</td>
						<td>456,87</td>
						<td>Ativa</td>
						<td>
							<img alt="Desativar utilizador" src="images/material-symbols/block.svg"/>
							<img alt="Remover utilizador" src="images/material-symbols/delete.svg"/>
						</td>
					</tr>
				</tbody>
			</table>
		</main>
		<?php include 'footer.php'; ?>
	</body>
</html>
