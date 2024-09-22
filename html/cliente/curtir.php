<?php
session_start();
include_once ('../../backend/Conexao.php');

$data = json_decode(file_get_contents("php://input"));

$id_trabalhador = $data->id;
$action = $data->action;

if ($action === 'curtir') {
    $query = "UPDATE trabalhador SET curtidas = curtidas + 1 WHERE id_trabalhador = '$id_trabalhador'";
} elseif ($action === 'descurtir') {
    $query = "UPDATE trabalhador SET curtidas = GREATEST(curtidas - 1, 0) WHERE id_trabalhador = '$id_trabalhador'";
}

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Erro ao atualizar curtidas: " . mysqli_error($conn));
}
?>
