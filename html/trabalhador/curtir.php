<?php
session_start();
include_once('../../backend/Conexao.php');

$id_trabalhador_logado = $_SESSION['id_trabalhador'];
$data = json_decode(file_get_contents('php://input'), true);
$action = $data['action'];
$id_trabalhador_curtiu = $data['id'];

if ($action === 'curtir') {
    $sql = "INSERT INTO curtidas (id_trabalhador, id_trabalhador_curtiu) VALUES ('$id_trabalhador_logado', '$id_trabalhador_curtiu')";
    mysqli_query($conn, $sql);
} else if ($action === 'descurtir') {
    $sql = "DELETE FROM curtidas WHERE id_trabalhador = '$id_trabalhador_logado' AND id_trabalhador_curtiu = '$id_trabalhador_curtiu'";
    mysqli_query($conn, $sql);
}

echo json_encode(['success' => true]);
?>
