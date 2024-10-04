<?php
session_start();
include_once('../../backend/Conexao.php');

// Verifica se o trabalhador está logado
if (!isset($_SESSION['id_trabalhador'])) {
    echo 'Trabalhador não está logado.';
    exit;
}

$id_trabalhador_sessao = $_SESSION['id_trabalhador'];

// Consulta para buscar todas as conversas com clientes
$sql_conversas = "SELECT DISTINCT c.id_cliente, c.nome
                  FROM mensagens m
                  INNER JOIN cliente c ON m.id_remetente = c.id_cliente OR m.id_destinatario = c.id_cliente
                  WHERE m.id_remetente = ? OR m.id_destinatario = ?";
$stmt_conversas = $conn->prepare($sql_conversas);
$stmt_conversas->bind_param("ii", $id_trabalhador_sessao, $id_trabalhador_sessao);
$stmt_conversas->execute();
$result_conversas = $stmt_conversas->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversas com Clientes</title>
</head>
<body>
    <h1>Conversas com Clientes</h1>

    <ul>
        <?php
        if ($result_conversas->num_rows > 0) {
            while ($conversa = $result_conversas->fetch_assoc()) {
                echo '<li><a href="mensagem_trabalhador.php?id_cliente=' . $conversa['id_cliente'] . '">' . htmlspecialchars($conversa['nome']) . '</a></li>';
            }
        } else {
            echo "<p>Você ainda não teve conversas com clientes.</p>";
        }
        ?>
    </ul>
</body>
</html>
