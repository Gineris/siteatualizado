<?php

session_start();
require '../backend/Conexao.php';

// Verificar se o cliente ou trabalhador está logado
if (!isset($_SESSION['tipo_usuario'])) {
    echo "Erro: Nenhum cliente ou trabalhador identificado. Faça login primeiro.";
    header('Location: loginGeral.php');
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comentario = $_POST['comentario'];
    $id_trabalhador_sessao = $_POST['id_trabalhador_sessao'];

    if (!empty($comentario)) {
        $id_cliente = null;

        // Verifica se é cliente
        if ($_SESSION['tipo_usuario'] === 'cliente' && isset($_SESSION['id_cliente'])) {
            $id_cliente = $_SESSION['id_cliente'];
        }

        // Insere o comentário no banco de dados
        $stmt = $conn->prepare('INSERT INTO comentarios (id_cliente, id_trabalhador, comentario) VALUES (?, ?, ?)');
        $stmt->bind_param('iis', $id_cliente, $id_trabalhador, $comentario);
        $stmt->execute();

        // Redireciona para o perfil do trabalhador após o comentário
        header("Location: Perfil.php?id_trabalhador=$id_trabalhador");
        exit();
    } else {
        echo "Erro: O comentário não pode estar vazio.";
    }
}

