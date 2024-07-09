<?php
include '../includes/conexao.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$task_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

if (isset($_POST['submit'])) {
    $nome = $_POST['nome'];
    $data = $_POST['data'];
    $descricao = $_POST['descricao'];

    $sql = "UPDATE tarefas SET nome='$nome', data='$data', descricao='$descricao' WHERE id=$task_id AND usuario_id=$user_id";
    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
    } else {
        $error = "ERRO DE ATUALIZAÇÃO:  " . $conn->error;
    }
} else {
    $sql = "SELECT * FROM tarefas WHERE id=$task_id AND usuario_id=$user_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $task = $result->fetch_assoc();
    } else {
        $error = "NÃO FOI ACHADO NADA";
        exit();
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarefa</title>
    <link rel="stylesheet" href="../css/editar.css">
</head>

<body>
    <div class="editar">
        <h2>Editar Tarefa</h2>
        <form action="editar.php?id=<?php echo $task_id; ?>" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo $task['nome']; ?>" required><br>
            <label for="data">Data:</label>
            <input type="date" id="data" name="data" value="<?php echo $task['data']; ?>" required><br>
            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" required><?php echo $task['descricao']; ?></textarea><br>
            <input type="submit" name="submit" value="Atualizar">
        </form>
        <a href="dashboard.php" class="voltar">Voltar ao Dashboard</a>
    </div>
</body>

</html>