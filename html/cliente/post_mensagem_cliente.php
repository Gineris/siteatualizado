<?php
session_start();
include_once('../../backend/Conexao.php');

// Verifica se o cliente está logado
if (!isset($_SESSION['id_cliente'])) {
    echo 'Usuário não está logado.';
    exit;
}

// Obtém o ID do cliente logado
$id_cliente = $_SESSION['id_cliente'];

// Verifica se os dados foram enviados corretamente
if (isset($_POST['id_trabalhador']) && isset($_POST['mensagem'])) {
    $id_trabalhador = $_POST['id_trabalhador'];
    $mensagem = trim($_POST['mensagem']); // Remover espaços extras

    // Verifica se a mensagem não está vazia
    if (empty($mensagem)) {
        echo 'A mensagem não pode estar vazia.';
        exit;
    }

    // Verifica se a conexão foi estabelecida corretamente
    if (!$conn || !$conn instanceof mysqli) {
        die("Erro: Conexão com o banco de dados não estabelecida.");
    }

    // Prepara a consulta para inserir a mensagem
    $sql = "INSERT INTO mensagens (id_remetente, id_destinatario, mensagem, data_envio, tipo_remetente) 
            VALUES (?, ?, ?, NOW(), 'cliente')";
    $stmt = $conn->prepare($sql);

    // Verifica se a preparação da consulta foi bem-sucedida
    if ($stmt === false) {
        die("Erro na preparação da consulta: " . $conn->error);
    }

    // Insere o cliente como remetente e o trabalhador como destinatário
    $stmt->bind_param("iis", $id_cliente, $id_trabalhador, $mensagem);

    if ($stmt->execute()) {
        // Redireciona de volta para a página de mensagens após o envio
        header("Location: mensagem_cliente.php?id_trabalhador=$id_trabalhador");
        exit;
    } else {
        echo "Erro ao enviar a mensagem: " . $stmt->error;
    }

} else {
    echo 'Dados insuficientes para o envio da mensagem.';
}
