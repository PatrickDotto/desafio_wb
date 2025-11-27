<?php
require 'conexao.php';
session_start();

if(!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

if(isset($_GET['id'])) {
    $id_tarefa = $_GET['id'];
    $usuario_id = $_SESSION['usuario_id'];

    $sql = "DELETE FROM tarefas WHERE id = :id AND usuario_id = :usuario_id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':id' => $id_tarefa,
        ':usuario_id' => $usuario_id ]);
}

header("Location: dashboard.php");
exit;
?>