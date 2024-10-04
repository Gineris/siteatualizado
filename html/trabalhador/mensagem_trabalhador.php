<?php
session_start();
include_once('../../backend/Conexao.php');

// Verifica se o trabalhador está logado
if (!isset($_SESSION['id_trabalhador'])) {
    echo 'Trabalhador não está logado.';
    exit;
}

// Obtém o ID do trabalhador logado
$id_trabalhador_sessao = $_SESSION['id_trabalhador'];

// Verifica se o cliente foi selecionado para a conversa
if (!isset($_GET['id_cliente'])) {
    echo 'Cliente não foi selecionado.';
    exit;
}

$id_cliente = $_GET['id_cliente'];

// Consulta para buscar o nome do cliente
$sql_cliente = "SELECT nome FROM cliente WHERE id_cliente = ?";
$stmt_cliente = $conn->prepare($sql_cliente);
$stmt_cliente->bind_param("i", $id_cliente);
$stmt_cliente->execute();
$result_cliente = $stmt_cliente->get_result();

if ($result_cliente->num_rows > 0) {
    $cliente = $result_cliente->fetch_assoc();
    $nome_cliente = $cliente['nome'];
} else {
    echo 'Cliente não encontrado.';
    exit;
}

// Consulta para buscar as mensagens entre o trabalhador e o cliente
$sql_mensagens = "SELECT m.mensagem, m.data_envio, 
                    CASE 
                        WHEN m.tipo_remetente = 'cliente' THEN c.nome 
                        ELSE t.nome 
                    END AS remetente
                  FROM mensagens m
                  LEFT JOIN cliente c ON m.id_remetente = c.id_cliente AND m.tipo_remetente = 'cliente'
                  LEFT JOIN trabalhador t ON m.id_remetente = t.id_trabalhador AND m.tipo_remetente = 'trabalhador'
                  WHERE (m.id_remetente = ? AND m.id_destinatario = ?)
                     OR (m.id_remetente = ? AND m.id_destinatario = ?)
                  ORDER BY m.data_envio ASC";
$stmt_mensagens = $conn->prepare($sql_mensagens);
$stmt_mensagens->bind_param("iiii", $id_trabalhador_sessao, $id_cliente, $id_cliente, $id_trabalhador_sessao);
$stmt_mensagens->execute();
$result_mensagens = $stmt_mensagens->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensagens com <?php echo htmlspecialchars($nome_cliente); ?></title>
</head>
<body>
    <h1>Mensagens com <?php echo htmlspecialchars($nome_cliente); ?></h1>

    <!-- Exibe as mensagens -->
    <div class="mensagens">
        <?php
        if ($result_mensagens->num_rows > 0) {
            while ($mensagem = $result_mensagens->fetch_assoc()) {
                echo "<p><strong>" . htmlspecialchars($mensagem['remetente']) . ":</strong> " . htmlspecialchars($mensagem['mensagem']) . " <em>(" . $mensagem['data_envio'] . ")</em></p>";
            }
        } else {
            echo "<p>Nenhuma mensagem encontrada.</p>";
        }
        ?>
    </div>

    <!-- Formulário para enviar mensagem -->
    <form action="post_mensagem_trabalhador.php" method="post">
        <input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>">
        <textarea name="mensagem" rows="4" placeholder="Digite sua mensagem aqui..."></textarea>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>
