<?php
session_start();
include_once('../backend/Conexao.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['id_cliente']) && !isset($_SESSION['id_trabalhador'])) {
    echo "Usuário não está logado.";
    exit;
}

$id_usuario = isset($_SESSION['id_cliente']) ? $_SESSION['id_cliente'] : $_SESSION['id_trabalhador'];
$id_destinatario = $_GET['id_destinatario'];

// Seleciona as mensagens trocadas entre o cliente e o trabalhador
$sql_mensagens = "SELECT m.mensagem, m.data_envio, IF(m.id_remetente = ?, 'Eu', 'Outro') as remetente
                  FROM mensagens m
                  WHERE (m.id_remetente = ? AND m.id_destinatario = ?)
                  OR (m.id_remetente = ? AND m.id_destinatario = ?)
                  ORDER BY m.data_envio ASC";

$stmt = $conn->prepare($sql_mensagens);
$stmt->bind_param('iiiii', $id_usuario, $id_usuario, $id_destinatario, $id_destinatario, $id_usuario);
$stmt->execute();
$result_mensagens = $stmt->get_result();

while ($mensagem = $result_mensagens->fetch_assoc()) {
    echo "<p><strong>" . $mensagem['remetente'] . ":</strong> " . $mensagem['mensagem'] . " <i>(" . $mensagem['data_envio'] . ")</i></p>";
}