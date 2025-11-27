<?php
require 'conexao.php';
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nova_tarefa'])) {

    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $data_limite = $_POST['data_limite'];

    $usuario_id = $_SESSION['usuario_id'];

    $sql = "INSERT INTO tarefas (usuario_id, titulo, descricao, data_limite, status)
            VALUES (:usuario_id, :titulo, :descricao, :data_limite, 'pendente')";

    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([
            ':usuario_id' => $usuario_id,
            ':titulo' => $titulo,
            ':descricao' => $descricao,
            ':data_limite' => $data_limite
        ]);

        header("Location: dashboard.php");
        exit;
    } catch (PDOException $e) {
        echo "Erro ao salvar: " . $e->getMessage();
    }
}

$sql_busca = "SELECT * FROM tarefas WHERE usuario_id = :usuario_id ORDER BY data_criacao DESC";
$stmt_busca = $pdo->prepare($sql_busca);
$stmt_busca->execute([':usuario_id' => $_SESSION['usuario_id']]);
$tarefas = $stmt_busca->fetchall(PDO::FETCH_ASSOC)
;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Tarefas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Olá, <?php echo $_SESSION['usuario_nome']; ?>!</h1>
        <a href="login.php" class="btn-danger">Sair</a>
</div>

<div class="card shadow-sm mb-5">
    <div class="card-body">
        <h5 class="card-tittle">Nova Tarefa</h5>

        <form method="POST">
            <input type="hidden" name="nova_tarefa" value="1">

            <div class="row">
                <div class="col-md-5">
                <input type="text" name="titulo" class="form-control" placeholder="Título da tarefa" required>
            </div>
            <div class="col-md-4">
                <input type="date" name="data_limite" class="form-control" required>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">Adicionar</button>
            </div>
        </div>
        <div class="mt-2">
            <textarea name="descricao" class="form-control" placeholder="Descricao (opcional)"></textarea>
        </div>
    </form>
</div>
</div>
<h3>Sua lista</h3>
<hr>

    <div class="list-group">
        <?php foreach($tarefas as $tarefa): ?>

            <div class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <h5><?php echo htmlspecialchars($tarefa['titulo']); ?></h5>

                    <p class="mb-1"><?php echo htmlspecialchars($tarefa['descricao']); ?></p>

                    <small> Prazo: 
                        <?= ($tarefa['data_limite'] && $tarefa['data_limite'] != '0000-00-00') 
                            ? date('d/m/Y', strtotime($tarefa['data_limite'])) 
                            : 'Sem data' 
                        ?>
                    </small>
                </div>

                <div>
                    <?php if ($tarefa['status'] == 'pendente'): ?>

                        <a href="concluir.php?id=<?php echo $tarefa['id']; ?>" class="btn btn-sm btn-success" title="Concluir">Concluir
                        </a>
                    <?php else: ?>

                        <span class="badge bg-success">Feito!</span>

                    <?php endif; ?>

                    <a href="excluir.php?id=<?php echo $tarefa['id']; ?>" class= "btn btn-sm btn-danger" onclick="return confirm('Tem certeza?');">Excluir
                    </a>
                </div>
            </div>

        <?php endforeach; ?>
        <?php if(count($tarefas) == 0): ?>
            <p class="text-center text-muted">Nenhuma tarefa ainda.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>