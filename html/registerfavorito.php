<?php
session_start();
include_once('../backend/Conexao.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['id_cliente'])) {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Usuário não está logado']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);
$id_trabalhador = $data['id_trabalhador'];
$id_cliente = $_SESSION['id_cliente'];

// Lógica para adicionar aos favoritos
$sql = "INSERT INTO favoritos ($id_trabalhador, $id_cliente) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id_trabalhador, $id_cliente);

if ($stmt->execute()) {
    // Registro bem-sucedido no banco de dados
    registrarFavorito($id_trabalhador, $id_cliente);
    echo json_encode(['sucesso' => true]);
} else {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Erro ao adicionar aos favoritos']);
}

$stmt->close();
$conn->close();

function registrarFavorito($id_trabalhador, $id_cliente) {
    $data = date('Y-m-d H:i:s');
    $linha = "Usuário ID: $id_cliente, Trabalhador ID: $id_trabalhador, Data: $data\n";
    file_put_contents('favoritos.txt', $linha, FILE_APPEND);
}
?>
