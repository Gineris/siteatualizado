<?php
session_start();
include_once('../../backend/Conexao.php');

header('Content-Type: application/json');

if (!isset($_SESSION['id_trabalhador'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não está logado.']);
    exit;
}

$id_trabalhador_favorito = $_POST['id_trabalhador'];
$id_trabalhador = $_SESSION['id_trabalhador'];

// Verifica se o favorito já existe
$sql_check = "SELECT * FROM favoritos WHERE id_trabalhador = '$id_trabalhador_favorito' AND id_cliente = '$id_trabalhador'";
$result_check = mysqli_query($conn, $sql_check);

if (!$result_check) {
    echo json_encode(['success' => false, 'message' => 'Erro na consulta: ' . mysqli_error($conn)]);
    exit;
}

if (mysqli_num_rows($result_check) > 0) {
    // Se já existe, removemos
    $sql_delete = "DELETE FROM favoritos WHERE id_trabalhador = '$id_trabalhador_favorito' AND id_cliente = '$id_trabalhador'";
    if (mysqli_query($conn, $sql_delete)) {
        echo json_encode(['success' => true, 'message' => 'Favorito removido.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao remover favorito: ' . mysqli_error($conn)]);
    }
} else {
    // Se não existe, adicionamos
    $sql_insert = "INSERT INTO favoritos (id_trabalhador, id_cliente) VALUES ('$id_trabalhador_favorito', '$id_trabalhador')";
    if (mysqli_query($conn, $sql_insert)) {
        echo json_encode(['success' => true, 'message' => 'Favorito adicionado.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao adicionar favorito: ' . mysqli_error($conn)]);
    }
}
?>

