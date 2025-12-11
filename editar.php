<?php
require 'conexao.php';
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$erro = null;

if(!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id_tarefa = $_GET['id'];
$usuario_id = $_SESSION['usuario_id'];

$sql = "SELECT * FROM tarefas WHERE id = :id AND usuario_id = :usuario_id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id_tarefa, ':usuario_id' => $usuario_id]);
$tarefa = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$tarefa) {
    header("Location: dashboard.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $data_limite = $_POST['data_limite'];

    $sql_update = "UPDATE tarefas SET titulo = :titulo, descricao = :descricao, data_limite = :data_limite WHERE id = :id AND usuario_id = :usuario_id";
    $stmt_update = $pdo->prepare($sql_update);

    try {
        $stmt_update->execute([
            ':titulo' => $titulo,
            ':descricao' => $descricao,
            ':data_limite' => $data_limite,
            ':id' => $id_tarefa,
            ':usuario_id' => $usuario_id
        ]);
        header("Location: dashboard.php");
        exit;
    } catch(PDOException $e) {
        $erro = "Erro ao atualizar. " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarefa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-sm" style="max-width: 600px; margin: 0 auto;">
            <div class="card-body">
                <h3>Editar Tarefa</h3>

                <?php if($erro): ?>
                    <div class="alert alert-danger"><?php echo $erro; ?></div>
                <?php endif; ?>

                <form method="POST">
                    <div class="m-3">
                        <label>Título</label>
                        <input type="text" name="titulo" class="form-control" value="<?php echo htmlspecialchars($tarefa['titulo']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label>Data Limite</label>
                        <input type="date" name="data_limite" class="form-control" value="<?php echo $tarefa['data_limite']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label>Descrição</label>
                        <textarea name="descricao" class="form-control" rows="3"><?php echo $tarefa['descricao']; ?></textarea>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="dashboard.php" class="btn btn-danger">Cancelar</a>
                        <button type="submit" class="btn btn-success">Salvar Alterações</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>