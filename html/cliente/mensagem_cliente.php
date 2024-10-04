<?php
session_start();
include_once('../../backend/Conexao.php');

// Verifica se o cliente está logado
if (!isset($_SESSION['id_cliente'])) {
    echo 'Usuário não está logado.';
    exit;
}

// Obtém o ID do cliente logado
$id_cliente = $_SESSION['id_cliente'];

// Verifica se o trabalhador foi selecionado para a conversa
if (!isset($_GET['id_trabalhador'])) {
    echo 'Trabalhador não foi selecionado.';
    exit;
}

$id_trabalhador = $_GET['id_trabalhador'];

// Consulta para buscar o nome do trabalhador
$sql_trabalhador = "SELECT nome FROM trabalhador WHERE id_trabalhador = ?";
$stmt_trabalhador = $conn->prepare($sql_trabalhador);
$stmt_trabalhador->bind_param("i", $id_trabalhador);
$stmt_trabalhador->execute();
$result_trabalhador = $stmt_trabalhador->get_result();

if ($result_trabalhador->num_rows > 0) {
    $trabalhador = $result_trabalhador->fetch_assoc();
    $nome_trabalhador = $trabalhador['nome'];
} else {
    echo 'Trabalhador não encontrado.';
    exit;
}

// Consulta para buscar as mensagens entre o cliente e o trabalhador
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
$stmt_mensagens->bind_param("iiii", $id_cliente, $id_trabalhador, $id_trabalhador, $id_cliente);
$stmt_mensagens->execute();
$result_mensagens = $stmt_mensagens->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensagens com o <?php echo htmlspecialchars($nome_trabalhador); ?></title>
</head>
<body>
    <h1>Mensagens com o <?php echo htmlspecialchars($nome_trabalhador); ?></h1>

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
    <form action="post_mensagem_cliente.php" method="post">
        <input type="hidden" name="id_trabalhador" value="<?php echo $id_trabalhador; ?>">
        <textarea name="mensagem" rows="4" placeholder="Digite sua mensagem aqui..."></textarea>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>