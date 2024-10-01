<?php
session_start();
include_once('../backend/Conexao.php');

// Verifica se o cliente está logado
if (!isset($_SESSION['id_cliente'])) {
    echo "Usuário não está logado.";
    exit;
}

$id_cliente = $_SESSION['id_cliente'];  // Cliente logado
$id_trabalhador = $_POST['id_trabalhador'];  // Trabalhador destinatário
$mensagem = $_POST['mensagem'];

if (!empty($mensagem)) {
    $stmt = $conn->prepare("INSERT INTO mensagens (id_remetente, id_destinatario, mensagem) VALUES (?, ?, ?)");
    $stmt->bind_param('iis', $id_cliente, $id_trabalhador, $mensagem);
    $stmt->execute();

    echo "Mensagem enviada com sucesso!";
} else {
    echo "A mensagem não pode estar vazia.";
}