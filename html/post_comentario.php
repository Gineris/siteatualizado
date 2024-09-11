<?php
session_start();
require '../backend/Conexao.php';

// Verificar se o cliente ou trabalhador está logado
if (!isset($_SESSION['user_id']) || (!isset($_SESSION['id_cliente']) && !isset($_SESSION['id_trabalhador']))) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conteudo = $_POST['conteudo'];

    if (!empty($conteudo)) {
        // Definir as variáveis de cliente_id e trabalhador_id
        $cliente_id = isset($_SESSION['cliente']) ? $_SESSION['user_id'] : null;
        $trabalhador_id = isset($_SESSION['trabalhador']) ? $_SESSION['user_id'] : null;

        // Inserir o comentário no banco de dados
        $stmt = $pdo->prepare('INSERT INTO comentarios (cliente_id, trabalhador_id, conteudo) VALUES (?, ?, ?)');
        $stmt->execute([$cliente_id, $trabalhador_id, $conteudo]);

        // Redirecionar para a página principal após o comentário
        header('Location: index.php');
        exit();
    } else {
        // Mensagem de erro se o conteúdo do comentário estiver vazio
        $error = 'O comentário não pode estar vazio.';
        header('Location: index.php?error=' . urlencode($error));
        exit();
    }
}
