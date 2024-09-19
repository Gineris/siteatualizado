
<?php
session_start();
include_once('../backend/Conexao.php');

$id_trabalhador = $_GET['id_trabalhador'];
$id_usuario = $_SESSION['id_usuario']; // Certifique-se de que isso está definido

$sql = "SELECT * FROM trabalhador WHERE id_trabalhador = '$id_trabalhador'";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);

// Verifica se o trabalhador é favorito
$sqlFavorito = "SELECT * FROM favoritos WHERE id_trabalhador = '$id_trabalhador' AND id_usuario = '$id_usuario'";
$resultFavorito = $conn->query($sqlFavorito);
$isFavorito = mysqli_num_rows($resultFavorito) > 0; // true ou false

?>
