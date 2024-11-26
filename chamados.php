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
    $cliente_id = $_POST['id_cliente'];
    $descricao = $_POST['descricao_chamado'];
    $criticidade = $_POST['criticidade'];

    $sql = "INSERT INTO Chamado (id_cliente, descricao_chamado, criticidade, data_abertura) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $cliente_id, $descricao, $criticidade);

    if ($stmt->execute()) {
        echo "Chamado cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar chamado: " . $conn->error;
    }

    $stmt->close();
}

$result = $conn->query("SELECT id_cliente, nome_cliente FROM Cliente");
$clientes = $result->fetch_all(MYSQLI_ASSOC);
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Chamado</title>
</head>
<body>
    <h1>Cadastro de Chamado</h1>
    <form method="POST" action="">
        <label for="id_cliente">Cliente:</label><br>
        <select id="id_cliente" name="id_cliente" required>
            <option value="">Selecione um cliente</option>
            <?php foreach ($clientes as $cliente): ?>
                <option value="<?= $cliente['id_cliente'] ?>"><?= $cliente['nome_cliente'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="descricao_chamado">Descrição do Problema:</label><br>
        <textarea id="descricao_chamado" name="descricao_chamado" required></textarea><br><br>

        <label for="criticidade">Criticidade:</label><br>
        <select id="criticidade" name="criticidade" required>
            <option value="baixa">Baixa</option>
            <option value="média">Média</option>
            <option value="alta">Alta</option>
        </select><br><br>

        <button type="submit">Cadastrar Chamado</button>
    </form>
</body>
</html>
