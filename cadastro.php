<?php
require 'conexao.php';

$sucesso= null;
$erro = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $sql_check = "SELECT id FROM usuarios WHERE email = :email";
    $stmt_check = $pdo->prepare($sql_check);
    $stmt_check->execute([':email' => $email]);

    if ($stmt_check->rowCount() > 0) {
        $erro = "Este email já está em uso!";
    }
    else {
        $sql = "INSERT into usuarios (nome , email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':senha' => $senha_hash
        ]);
        $sucesso = "Usuário cadastrado com sucesso.";
    } catch (PDOException $e) {
        echo "Erro ao cadastrar." . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .card_cadastro {
            width: 100%;
            max-width: 450px;
        }
    </style>
</head>
<body>

    <div class="card card_cadastro shadow-sm">
        <div class="card-body p-4">
            <h3 class="text-center mb-4">Criar Nova Conta</h3>
        
            

            <?php if ($erro): ?>
                <div class="alert alert-danger text-center">
                    <?php echo $erro; ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">Nome completo:</label>
                    <input type="text" name="nome" class="form-control" placeholder="Seu nome" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" placeholder="email@gmail.com" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Senha:</label>
                    <input type="password" name="senha" class="form-control" placeholder="Digite uma senha" required>
                </div>
                
                <button type="submit" class="btn btn-success w-100">Cadastrar</button>
            </form>

            <?php if ($sucesso): ?>
                <div class="alert alert-success text-center mt-3">
                    <?php echo $sucesso; ?>
                </div>
            <?php endif; ?>

            <div class="text-center mt-3">
                <p>Já tem uma conta? <a href="login.php">Entrar</a></p>
            </div>
        </div>
    </div>

</body>
</html>