<?php
session_start();
include_once('../../backend/Conexao.php');

// Verifica se o cliente está logado
if (!isset($_SESSION['id_cliente'])) {
    echo 'Usuário não está logado.';
    exit;
}

// ID do cliente logado
$id_cliente = $_SESSION['id_cliente'];
// ID do trabalhador para o qual a mensagem está sendo enviada
$id_trabalhador = $_POST['id_trabalhador'];
// Mensagem a ser enviada
$mensagem = $_POST['mensagem'];

// Prepara e executa a consulta para inserir a mensagem no banco de dados
$sql = "INSERT INTO mensagens (id_cliente, id_trabalhador, mensagem, data_envio) VALUES (?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iis", $id_cliente, $id_trabalhador, $mensagem);

if ($stmt->execute()) {
    // Redireciona de volta para a página de mensagens do cliente
    header("Location: mensagem_cliente.php");
    exit;
} else {
    echo "Erro ao enviar a mensagem: " . $conn->error;
}

