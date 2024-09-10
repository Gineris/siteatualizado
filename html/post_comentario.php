<?php

session_start();
include_once('../backend/Conexao.php');
// require '../backend/Conexao.php';

// Verificar se o trabalhador está logado
if (!isset($_SESSION['id_trabalhador']) || !isset($_SESSION['id_cliente'])) {
    header('Location: loginGeral.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comentario = $_POST['comentario'];
    $id_trabalhador = $_SESSION['id_trabalhador'];
    // $id_cliente = $_SESSION['id_cliente'];

    // Inserir o comentário no banco de dados
    $stmt = $pdo->prepare('INSERT INTO comentarios (comentario, id_trabalhador) VALUES (?, ?)');
    $stmt->execute([$comentario, $id_trabalhador]);

    // Redirecionar para a página principal
    header('Location: Perfil.php');
    exit();
}