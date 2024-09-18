<?php
session_start();
require '../backend/Conexao.php';

// Verificar se o cliente ou trabalhador está logado
if ((!isset($_SESSION['id_cliente']) && !isset($_SESSION['id_trabalhador']))) {
    // fazer um echo de usuario nao logado
    header('Location: loginGeral.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $comentario = $_POST['comentario'];

    if (!empty($comentario)) {
        // Definir as variáveis de cliente_id e trabalhador_id
        $id_cliente = isset($_SESSION['id_cliente']) ? $_SESSION['id_cliente'] : null;
        $id_trabalhador = isset($_SESSION['id_trabalhador']) ? $_SESSION['id_trabalhador'] : null;

        echo "<pre>";
        echo "ID Cliente: " . ($id_cliente !== null ? $id_cliente : 'Não definido') . "<br>";
        echo "ID Trabalhador: " . ($id_trabalhador !== null ? $id_trabalhador : 'Não definido') . "<br>";
        echo "</pre>";

        if ($id_cliente !== null || $id_trabalhador !== null) {
        // Inserir o comentário no banco de dados
        $stmt = $conn->prepare('INSERT INTO comentarios (id_cliente, id_trabalhador, comentario) VALUES (?, ?, ?)');
        $stmt->execute([$id_cliente, $id_trabalhador, $comentario]);

        // Redirecionar para a página principal após o comentário
        header('Location: ./Perfil.php');
        exit();
    } else {
        echo "Erro: Nenhum cliente ou trabalhador identificado.";
    }
    
    } else {
        // Mensagem de erro se o conteúdo do comentário estiver vazio
        $error = 'O comentário não pode estar vazio.';
        header('Location: Perfil.php?error=' . urlencode($error));
        exit();
    }
}
