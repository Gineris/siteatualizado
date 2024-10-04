<?php
session_start();
include_once('../../backend/Conexao.php');

// Verifica se o trabalhador está logado
if (!isset($_SESSION['id_trabalhador'])) {
    echo 'Trabalhador não está logado.';
    exit;
}

$id_trabalhador_sessao = $_SESSION['id_trabalhador'];

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['mensagem']) || !isset($_POST['id_cliente'])) {
        echo 'Dados incompletos.';
        exit;
    }

    $mensagem = $_POST['mensagem'];
    $id_cliente = $_POST['id_cliente'];

    // Insere a mensagem no banco de dados
    $sql_insert = "INSERT INTO mensagens (id_remetente, id_destinatario, mensagem, tipo_remetente) VALUES (?, ?, ?, 'trabalhador')";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("iis", $id_trabalhador_sessao, $id_cliente, $mensagem);

    if ($stmt_insert->execute()) {
        header("Location: mensagem_trabalhador.php?id_cliente=" . $id_cliente);
        exit;
    } else {
        echo 'Erro ao enviar a mensagem.';
    }
}
?>
