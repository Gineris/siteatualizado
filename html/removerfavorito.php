<?php
include_once('../backend/Conexao.php');

$data = json_decode(file_get_contents('php://input'), true);
$id_trabalhador = $data['id_trabalhador'];

// Aqui você deve implementar a lógica para remover o trabalhador dos favoritos
$sql = "DELETE FROM favoritos WHERE id_trabalhador = '$id_trabalhador' AND id_usuario = '{id_usuario}'";
$conn->query($sql);
?>
