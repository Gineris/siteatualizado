<?php
// Conexão com o banco de dados
include_once('../backend/Conexao.php');

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Defina os IDs do cliente e do trabalhador
$id_cliente = $_SESSION['id_cliente'];
$id_trabalhador = $_GET['id_trabalhador'];

// Buscar as mensagens trocadas entre o cliente e o trabalhador
$sql = "SELECT * FROM mensagens 
        WHERE (id_remetente = ? AND id_destinatario = ?) 
           OR (id_remetente = ? AND id_destinatario = ?)
        ORDER BY data_envio ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iiii", $id_cliente, $id_trabalhador, $id_trabalhador, $id_cliente);
$stmt->execute();
$result = $stmt->get_result();

// Exibir as mensagens
while ($row = $result->fetch_assoc()) {
    $remetente_tipo = $row['remetente_tipo'];
    $mensagem = $row['mensagem'];
    $data_envio = $row['data_envio'];
    
    echo "<p><strong>$remetente_tipo:</strong> $mensagem <em>($data_envio)</em></p>";
}

$stmt->close();
$conn->close();