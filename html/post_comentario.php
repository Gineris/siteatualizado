<?php
session_start();
require '../backend/Conexao.php';

// Verificar se o cliente ou trabalhador está logado
if ((!isset($_SESSION['id_cliente']) && !isset($_SESSION['id_trabalhador']))) {
    // fazer um echo de usuario nao logado
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comentario = $_POST['comentario'];

    if (!empty($comentario)) {
        // Definir as variáveis de cliente_id e trabalhador_id
        $id_cliente = isset($_SESSION['id_cliente']) ? $_SESSION['user_id'] : null;
        $id_trabalhador = isset($_SESSION['trabalhador']) ? $_SESSION['user_id'] : null;

        // Inserir o comentário no banco de dados
        $stmt = $pdo->prepare('INSERT INTO comentarios (id_cliente, id_trabalhador, comentario) VALUES (?, ?, ?)');
        $stmt->execute([$id_cliente, $id_trabalhador, $comentario]);

        // Redirecionar para a página principal após o comentário
        header('Location: ./Perfil.php');
        exit();
    } else {
        // Mensagem de erro se o conteúdo do comentário estiver vazio
        $error = 'O comentário não pode estar vazio.';
        header('Location: index.php?error=' . urlencode($error));
        exit();
    }
}
