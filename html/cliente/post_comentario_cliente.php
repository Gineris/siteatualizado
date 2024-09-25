<?php
session_start();
require '../../backend/Conexao.php';

// Verificar se o cliente está logado
if (!isset($_SESSION['id_cliente'])) {
    echo "Erro: Nenhum cliente identificado.";
    exit();
}

$id_cliente = $_SESSION['id_cliente']; // Cliente logado
$id_trabalhador = $_POST['id_trabalhador']; // Trabalhador que recebe o comentário
$comentario = $_POST['comentario'];

if (!empty($comentario)) {
    // Inserir comentário no banco
    $sql = "INSERT INTO comentarios (id_cliente, id_trabalhador, comentario) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $id_cliente, $id_trabalhador, $comentario);
    $stmt->execute();

    // Redirecionar para o perfil
    header("Location: Perfil.php?id_trabalhador=$id_trabalhador");
    exit();
} else {
    echo "Erro: Comentário não pode estar vazio.";
}

