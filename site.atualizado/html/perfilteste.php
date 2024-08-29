<?php
include_once('../backend/php/Conexao.php');

$id_trabalhador = $_GET['id_trabalhador'];


$sql = "SELECT * FROM trabalhador WHERE id_trabalhador = '$id_trabalhador'";
$result = $conn->query($sql);

$resultado_pesquisar = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($resultado_pesquisar);


echo '<p>' . htmlspecialchars($row['nome']) . '</p>'

?>