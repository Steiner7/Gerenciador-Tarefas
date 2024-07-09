<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Tarefa</title>
    <link rel="stylesheet" href="../css/addTarefa.css">
</head>

<body>
    <div class="addTarefa">
        <h2>Adicionar Nova Tarefa</h2>
        <form action="addTarefa.php" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required><br>
            <label for="data">Data:</label>
            <input type="date" id="data" name="data" required><br>
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" required></textarea><br>
            <input type="submit" name="submit" value="Adicionar">
        </form>
        <a href="dashboard.php" class="voltar">Voltar ao Dashboard</a>
    </div>
</body>

</html>


<?php
include '../includes/conexao.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['submit'])) {
    $user_id = $_SESSION['user_id'];
    $nome = $_POST['nome'];
    $data = $_POST['data'];
    $descricao = $_POST['descricao'];

    $sql = "INSERT INTO tarefas (usuario_id, nome, data, descricao) VALUES ($user_id, '$nome', '$data', '$descricao')";
    if ($conn->query($sql) === TRUE) {
        echo "TAREFA ADICIONADA";
        header("Location: dashboard.php");
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>