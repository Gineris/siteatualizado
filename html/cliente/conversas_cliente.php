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

// Consulta para obter as conversas com trabalhadores
$sql = "SELECT t.id_trabalhador, t.nome as nome_trabalhador
        FROM mensagens m
        JOIN trabalhador t ON (m.id_remetente = t.id_trabalhador OR m.id_destinatario = t.id_trabalhador)
        WHERE (m.id_remetente = ? OR m.id_destinatario = ?)
        GROUP BY t.id_trabalhador";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id_cliente, $id_cliente);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Conversas</title>
</head>
<body>
    <h1>Conversas com Trabalhadores</h1>
    <ul>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <li><a href="mensagem_cliente.php?id_trabalhador=<?php echo $row['id_trabalhador']; ?>"><?php echo $row['nome_trabalhador']; ?></a></li>
        <?php } ?>
    </ul>
</body>
</html>
