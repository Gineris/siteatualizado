<?php
session_start();
include_once('../backend/Conexao.php');

// Verifica se o trabalhador está logado
if (!isset($_SESSION['id_trabalhador'])) {
    echo "Usuário não está logado.";
    exit;
}

$id_trabalhador = $_SESSION['id_trabalhador'];  // Trabalhador logado
$id_cliente = $_POST['id_cliente'];  // Cliente destinatário
$mensagem = $_POST['mensagem'];

if (!empty($mensagem)) {
    $stmt = $conn->prepare("INSERT INTO mensagens (id_remetente, id_destinatario, mensagem) VALUES (?, ?, ?)");
    $stmt->bind_param('iis', $id_trabalhador, $id_cliente, $mensagem);
    $stmt->execute();

    echo "Mensagem enviada com sucesso!";
} else {
    echo "A mensagem não pode estar vazia.";
}