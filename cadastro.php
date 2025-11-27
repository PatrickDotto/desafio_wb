<?php
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':senha' => $senha_hash
        ]);
        echo "Usuário cadastrado com sucesso.";
    } catch (PDOException $e) {
        echo "Erro ao cadastrar ou email em uso: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
</head>
<body>

    <h1>Criar Nova Conta</h1>

    <form method="POST">

      <label>Nome:</label>
        <input type="text" name="nome" required>
        <br><br>

        <label>Email:</label>
        <input type="email" name="email" required>
        <br><br>

        <label>Senha:</labeel>
        <input type="password" name="senha" required>
        <br><br>

        <button type="submit">Cadastrar</button>

    </form>

</body>
</html>