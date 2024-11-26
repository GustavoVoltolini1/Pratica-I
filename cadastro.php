<?php

$host = "localhost";
$user = "root";
$password = "root";
$dbname = "GerenciamentoChamados";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome_cliente'];
    $email = $_POST['email_cliente'];
    $telefone = $_POST['telefone_cliente'];

   
    $sql = "INSERT INTO Cliente (nome_cliente, email_cliente, telefone_cliente) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nome, $email, $telefone);

    if ($stmt->execute()) {
        echo "Cliente cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar cliente: " . $conn->error;
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>
</head>
<body>
    <h1>Cadastro de Cliente</h1>
    <form method="POST" action="">
        <label for="nome_cliente">Nome:</label><br>
        <input type="text" id="nome_cliente" name="nome_cliente" required><br><br>

        <label for="email_cliente">E-mail:</label><br>
        <input type="email" id="email_cliente" name="email_cliente" required><br><br>

        <label for="telefone_cliente">Telefone:</label><br>
        <input type="text" id="telefone_cliente" name="telefone_cliente" required><br><br>

        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
