<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Inicia a sessão se ainda não estiver ativa
}
include_once('../backend/Conexao.php');

if (!isset($_SESSION['id_cliente'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não está logado.']);
    exit;
}

$id_cliente = $_SESSION['id_cliente'];

// Consulta para obter os trabalhadores favoritos
$sql = "SELECT * FROM trabalhadores 
        INNER JOIN favoritos ON trabalhadores.id_trabalhador = favoritos.id_trabalhador 
        WHERE favoritos.id_cliente = '$id_cliente'";
$result = mysqli_query($conn, $sql);

$favoritos = []; // Inicializa o array de favoritos

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $favoritos[] = $row; // Adiciona cada trabalhador ao array de favoritos
    }
}

// Retorna a resposta como JSON
echo json_encode(['success' => true, 'favoritos' => $favoritos]);
