<?php

include_once('../backend/Conexao.php');

if (!isset($_SESSION['id_cliente'])) {
    exit;
}

$id_cliente = $_SESSION['id_cliente'];

$sql = "SELECT trabalhador.* FROM favoritos 
        JOIN trabalhador ON favoritos.id_trabalhador = trabalhador.id_trabalhador 
        WHERE favoritos.id_cliente = '$id_cliente'";
$resultado = mysqli_query($conn, $sql);

$favoritos = [];

while ($row = mysqli_fetch_assoc($resultado)) {
    $favoritos[] = $row;
}

// Remova qualquer retorno JSON e apenas deixe a variável $favoritos com os dados
?>
