<?php
session_start();
include_once('../backend/Conexao.php');

// Verifica se o cliente está logado
if (!isset($_SESSION['id_cliente'])) {
    echo 'Usuário não está logado.';
    exit;
}

// Recupera os dados enviados pelo AJAX
$id_cliente = $_POST['id_cliente'];
$id_trabalhador = $_POST['id_trabalhador'];

// Verifica se o trabalhador já é favorito
$sqlFavorito = "SELECT * FROM favoritos WHERE id_trabalhador = '$id_trabalhador' AND id_cliente = '$id_cliente'";
$resultFavorito = $conn->query($sqlFavorito);

if ($resultFavorito->num_rows > 0) {
    // Se já for favorito, remove o favorito
    $sqlRemover = "DELETE FROM favoritos WHERE id_trabalhador = '$id_trabalhador' AND id_cliente = '$id_cliente'";
    if ($conn->query($sqlRemover)) {
        echo 'removido'; // Retorna 'removido' para o AJAX
    } else {
        echo 'Erro ao remover favorito: ' . $conn->error;
    }
} else {
    // Se não for favorito, adiciona o favorito
    $sqlAdicionar = "INSERT INTO favoritos (id_cliente, id_trabalhador) VALUES ('$id_cliente', '$id_trabalhador')";
    if ($conn->query($sqlAdicionar)) {
        echo 'favoritado'; // Retorna 'favoritado' para o AJAX
    } else {
        echo 'Erro ao adicionar favorito: ' . $conn->error;
    }
}

$conn->close();
?>
