<?php
session_start();
include_once('../../backend/Conexao.php');

// Verifica se o cliente está logado
if (!isset($_SESSION['id_cliente'])) {
    echo 'Usuário não está logado.';
    exit;
}

// ID do cliente logado
$id_cliente = $_SESSION['id_cliente'];

// Consulta para obter mensagens enviadas ao trabalhador
$sql_mensagens = "SELECT m.mensagem, m.data_envio, t.nome AS remetente_nome 
                  FROM mensagens m 
                  JOIN trabalhador t ON m.id_trabalhador = t.id_trabalhador 
                  WHERE m.id_cliente = ? 
                  ORDER BY m.data_envio";

$stmt = $conn->prepare($sql_mensagens);
$stmt->bind_param("i", $id_cliente);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    echo "<p><strong>{$row['remetente_nome']}:</strong> {$row['mensagem']} <small>{$row['data_envio']}</small></p>";
}
?>

<!-- Formulário para envio de mensagens ao trabalhador -->
<form action="post_mensagem_cliente.php" method="POST">
    <textarea name="mensagem" required></textarea>
    <input type="hidden" name="id_trabalhador" value="<?php echo $id_trabalhador; ?>"> <!-- Certifique-se de definir o id_trabalhador conforme necessário -->
    <button type="submit">Enviar Mensagem</button>
</form>