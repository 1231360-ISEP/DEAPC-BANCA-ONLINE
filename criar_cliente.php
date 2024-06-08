<?php
$base_dados = new SQLite3('banca-online.db', SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);
$base_dados->enableExceptions(true);

try {
    $nome_cliente = $_POST['nome_cliente'];
    $IBAN_cliente = $_POST['IBAN_cliente'];
    $sexo_cliente = $_POST['sexo_cliente'];
    $email_cliente = $_POST['email_cliente'];
    $telemovel_cliente = $_POST['telemovel_cliente'];
    
    $query = $base_dados->prepare(
        "INSERT INTO Utilizadores (username, password, tipo, nome_cliente, IBAN_cliente, sexo_cliente, email_cliente, telemovel_cliente) 
        VALUES (:username, :password, :tipo, :nome_cliente, :IBAN_cliente, :sexo_cliente, :email_cliente, :telemovel_cliente)"
    );

    $username = $nome_cliente; 
    $password = password_hash('senha_temporaria', PASSWORD_DEFAULT); // Criar uma senha temporária ou outra lógica de senha
    $tipo = 1; 

    $query->bindParam(':username', $username, SQLITE3_TEXT);
    $query->bindParam(':password', $password, SQLITE3_TEXT);
    $query->bindParam(':tipo', $tipo, SQLITE3_INTEGER);
    $query->bindParam(':nome_cliente', $nome_cliente, SQLITE3_TEXT);
    $query->bindParam(':IBAN_cliente', $IBAN_cliente, SQLITE3_TEXT);
    $query->bindParam(':sexo_cliente', $sexo_cliente, SQLITE3_INTEGER);
    $query->bindParam(':email_cliente', $email_cliente, SQLITE3_TEXT);
    $query->bindParam(':telemovel_cliente', $telemovel_cliente, SQLITE3_TEXT);

    $query->execute();
	$_SESSION['mensagem'] = "Cliente adicionado com sucesso!";
	
    header('Location: criar_cliente.php');
} catch (Exception $e) {
    echo "Erro ao adicionar cliente: " . $e->getMessage();
}
$base_dados->close();
?>