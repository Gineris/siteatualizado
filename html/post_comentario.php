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
    $id_trabalhador = $_POST['id_trabalhador']; // Pegue o id_trabalhador correto do formulário

    if (!empty($comentario)) {

        $id_cliente = null;

        // $id_trabalhador = null;

        // Definir as variáveis de cliente_id e trabalhador_id
        if ($_SESSION['tipo_usuario'] === 'cliente' && isset($_SESSION['id_cliente'])) {
            $id_cliente = $_SESSION['id_cliente'];  // Define o ID do cliente
        } 
        // elseif ($_SESSION['tipo_usuario'] === 'trabalhador' && isset($_SESSION['id_trabalhador'])) {
        //     $id_trabalhador = $_SESSION['id_trabalhador'];  // Define o ID do trabalhador
        // }

        echo "<pre>";
        echo "ID Cliente: " . ($id_cliente !== null ? $id_cliente : 'Não definido') . "<br>";
        echo "ID Trabalhador: " . ($id_trabalhador !== null ? $id_trabalhador : 'Não definido') . "<br>";
        echo "</pre>";

        if ($id_cliente !== null || $id_trabalhador !== null) {
        // Inserir o comentário no banco de dados
        $stmt = $conn->prepare('INSERT INTO comentarios (id_cliente, id_trabalhador, comentario) VALUES (?, ?, ?)');
        $stmt->execute([empty($id_cliente) ? null : $id_cliente, $id_trabalhador, $comentario]);
        
        // $stmt->execute([empty($id_cliente) ? null : $id_cliente, empty($id_trabalhador) ? null : $id_trabalhador, $comentario]);

        // Redirecionar para a página principal após o comentário
        header('Location: ./Perfil.php?id_trabalhador=' . $id_trabalhador);
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
