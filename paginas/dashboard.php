<?php
include '../includes/conexao.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM tarefas WHERE usuario_id=$user_id";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>

<body>
    <div class="dashboard">
        <h1>Bem-vindo ao Dashboard</h1>
        <a href="logout.php" class="logout">Logout</a>
        <h2>Suas Tarefas</h2>
        <a href="addTarefa.php" class="novaTarefa">Criar Nova Tarefa</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Data</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['nome']}</td>
                                <td>{$row['data']}</td>
                                <td>{$row['descricao']}</td>
                                <td>
                                    <a href='editar.php?id={$row['id']}' class='editar'>Editar</a>
                                    <a href='deletar.php?id={$row['id']}' class='deletar'>Excluir</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>NÃO ACHEI NADA</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php
$conn->close();
?>