<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$banco = "gerenciador_tarefas"; 

$conn = new mysqli($servername, $username, $password, $banco);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
