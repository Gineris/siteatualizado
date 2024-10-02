<?php
// Conexão com o banco de dados
$conn = new mysqli('localhost', 'usuario', 'senha', 'banco_de_dados');

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Pegue os dados do formulário (supomos que o cliente ou trabalhador já está logado e tem um ID)
$id_remetente = $_POST['id_remetente'];
$id_destinatario = $_POST['id_destinatario'];
$mensagem = $_POST['mensagem'];
$remetente_tipo = $_POST['remetente_tipo']; // cliente ou trabalhador

// Inserir a mensagem no banco de dados
$sql = "INSERT INTO mensagens (id_remetente, id_destinatario, mensagem, remetente_tipo)
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iiss", $id_remetente, $id_destinatario, $mensagem, $remetente_tipo);

if ($stmt->execute()) {
    echo "Mensagem enviada com sucesso!";
} else {
    echo "Erro ao enviar a mensagem: " . $stmt->error;
}
header("Location:../mensagens.php");

$stmt->close();
$conn->close();