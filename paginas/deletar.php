<?php
include '../includes/conexao.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$task_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$sql = "DELETE FROM tarefas WHERE id=$task_id AND usuario_id=$user_id";
if ($conn->query($sql) === TRUE) {
    header("Location: dashboard.php");
} else {
    echo "NAO EXCLUIU AINDA " . $conn->error;
}

$conn->close();
