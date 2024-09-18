<?php
include_once('../backend/Conexao.php');

$data = json_decode(file_get_contents('php://input'), true);
$id_trabalhador = $data['id_trabalhador'];

// Aqui você deve implementar a lógica para salvar o trabalhador como favorito
$sql = "INSERT INTO favoritos (id_trabalhador, id_usuario) VALUES ('$id_trabalhador', '{id_usuario}')";
$conn->query($sql);
?>
