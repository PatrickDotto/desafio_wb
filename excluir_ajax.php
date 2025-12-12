<?php
require 'conexao.php';
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['usuario_id']) || !isset($_POST['id'])) {
    echo json_encode(['sucesso' => false, 'msg' => 'Dados inválidos']);
    exit;
}

$id_tarefa = $_POST['id'];
$usuario_id = $_SESSION['usuario_id'];

try {
    
    $sql = "DELETE FROM tarefas WHERE id = :id AND usuario_id = :usuario_id";
    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':id' => $id_tarefa, 
        ':usuario_id' => $usuario_id
    ]);
    
    echo json_encode(['sucesso' => true]);

} catch (PDOException $e) {
    echo json_encode(['sucesso' => false, 'msg' => 'Erro no banco']);
}
?>