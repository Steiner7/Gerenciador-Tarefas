<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet"  href="../css/index.css">
</head>

<body>
    <div class="cadastro">
        <h2>Cadastro de Usuário</h2>
        <form action="index.php" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required><br>
            <label for="idade">Idade:</label>
            <input type="number" id="idade" name="idade" required><br>
            <input type="submit" name="submit" value="Cadastrar">
        </form>
    </div>
</body>

</html>
<?php
include '../includes/conexao.php';

if (isset($_POST['submit'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);
    $idade = $_POST['idade'];

    $sql = "INSERT INTO usuarios (nome, email, senha, idade) VALUES ('$nome', '$email', '$senha', $idade)";
    if ($conn->query($sql) === TRUE) {
        echo "CADASTRO COM SUCESSO HORIZONTAL";
    } else {
        echo "ERRO: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>