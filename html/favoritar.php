
<?php
session_start();
include_once('../backend/Conexao.php');

if (!isset($_SESSION['id_cliente'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não está logado.']);
    exit;
}

$id_cliente = $_SESSION['id_cliente'];
$id_trabalhador = $_POST['id_trabalhador'];

// Verifica se o trabalhador já está favoritado
$sqlFavorito = "SELECT * FROM favoritos WHERE id_trabalhador = '$id_trabalhador' AND id_cliente = '$id_cliente'";
$resultFavorito = mysqli_query($conn, $sqlFavorito);
$favorited = mysqli_num_rows($resultFavorito) > 0;

if ($favorited) {
    // Se já está favoritado, desfavorita
    $sqlRemove = "DELETE FROM favoritos WHERE id_trabalhador = '$id_trabalhador' AND id_cliente = '$id_cliente'";
    mysqli_query($conn, $sqlRemove);
    $favorited = false; // Define como não favoritado
} else {
    // Se não está favoritado, favorita
    $sqlAdd = "INSERT INTO favoritos (id_trabalhador, id_cliente) VALUES ('$id_trabalhador', '$id_cliente')";
    mysqli_query($conn, $sqlAdd);
    $favorited = true; // Define como favoritado
}

// Retorna a resposta
echo json_encode(['success' => true, 'favorited' => $favorited]);
?>