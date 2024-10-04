<?php
session_start();
include_once('../../backend/Conexao.php');

// Verifica se o trabalhador está logado
if (!isset($_SESSION['id_trabalhador'])) {
    echo 'Usuário não está logado.';
    exit;
}

// ID do trabalhador logado
$id_trabalhador = $_SESSION['id_trabalhador'];
// ID do cliente para o qual a mensagem está sendo enviada
$id_cliente = $_POST['id_cliente'];
// Mensagem a ser enviada
$mensagem = $_POST['mensagem'];

// Prepara e executa a consulta para inserir a mensagem no banco de dados
$sql = "INSERT INTO mensagens (id_cliente, id_trabalhador, mensagem, data_envio) VALUES (?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iis", $id_cliente, $id_trabalhador, $mensagem);

if ($stmt->execute()) {
    // Redireciona de volta para a página de mensagens do trabalhador
    header("Location: mensagens_trabalhador.php");
    exit;
} else {
    echo "Erro ao enviar a mensagem: " . $conn->error;
}