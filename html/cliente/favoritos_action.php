<?php
session_start();
include_once('../../backend/Conexao.php');

if (!isset($_SESSION['id_cliente'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não está logado.']);
    exit;
}

$id_cliente = $_SESSION['id_cliente'];
$data = json_decode(file_get_contents('php://input'), true);
$id_trabalhador = $data['id_trabalhador'];
$action = $data['action'];

if ($action === 'adicionar') {
    $sql = "INSERT INTO favoritos (id_trabalhador, id_cliente) VALUES ('$id_trabalhador', '$id_cliente')";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} elseif ($action === 'remover') {
    $sql = "DELETE FROM favoritos WHERE id_trabalhador = '$id_trabalhador' AND id_cliente = '$id_cliente'";
    if (mysqli_query($conn, $sql)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
