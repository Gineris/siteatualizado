<?php
session_start();
include_once('../../backend/Conexao.php');

// Verifica se o trabalhador está logado
if (!isset($_SESSION['id_trabalhador'])) {
    echo 'Usuário não está logado.';
    exit;
}

// ID do trabalhador logado
$id_trabalhador = $_SESSION['id_trabalhador'];

// Consulta para obter mensagens enviadas pelos clientes
$sql_mensagens = "SELECT m.mensagem, m.data_envio, c.nome AS remetente_nome 
                  FROM mensagens m 
                  JOIN cliente c ON m.id_cliente = c.id_cliente 
                  WHERE m.id_trabalhador = ? 
                  ORDER BY m.data_envio";

$stmt = $conn->prepare($sql_mensagens);
$stmt->bind_param("i", $id_trabalhador);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    echo "<p><strong>{$row['remetente_nome']}:</strong> {$row['mensagem']} <small>{$row['data_envio']}</small></p>";
}
?>

<!-- Formulário para envio de mensagens ao cliente -->
<form action="post_mensagem_trabalhador.php" method="POST">
    <textarea name="mensagem" required></textarea>
    <input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>"> <!-- Certifique-se de definir o id_cliente conforme necessário -->
    <button type="submit">Enviar Mensagem</button>
</form>