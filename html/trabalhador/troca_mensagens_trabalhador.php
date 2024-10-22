<?php
session_start(); // Inicia a sessão
include_once('../../backend/Conexao.php');

// Verifica se o trabalhador está logado
if (!isset($_SESSION['id_trabalhador'])) {
    echo 'Trabalhador não está logado.';
    exit;
}

// ID do trabalhador logado
$id_trabalhador = $_SESSION['id_trabalhador'];

// ID do cliente a ser visualizado
$id_cliente = isset($_GET['id_cliente']) ? $_GET['id_cliente'] : null;

// Verifica se o ID do cliente foi passado
if ($id_cliente === null) {
    echo 'ID do cliente não fornecido.';
    exit;
}

// Inserir nova mensagem se o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mensagem = $conn->real_escape_string($_POST['mensagem']);

    $sql = "INSERT INTO mensagens (id_cliente, id_trabalhador, mensagem, remetente, data_envio) 
            VALUES ('$id_cliente', '$id_trabalhador', '$mensagem', 'trabalhador', NOW())";
    
    if ($conn->query($sql) === TRUE) {
        // Redirecionar para a tela de troca de mensagens
        header("Location: troca_mensagens_trabalhador.php?id_cliente=$id_cliente");
        exit();
    } else {
        echo "Erro: " . $conn->error;
    }
}

// Consulta para obter mensagens trocadas entre trabalhador e cliente
$sql_mensagens = "SELECT * FROM mensagens 
                  WHERE (id_cliente = '$id_cliente' AND id_trabalhador = '$id_trabalhador') 
                     OR (id_cliente = '$id_trabalhador' AND id_trabalhador = '$id_cliente') 
                  ORDER BY data_envio ASC"; // Ordena pela data de envio

$resultado_mensagens = $conn->query($sql_mensagens);

// Verifica se a consulta foi bem-sucedida
if ($resultado_mensagens === false) {
    echo "Erro na consulta: " . $conn->error;
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Troca de Mensagens</title>
    <link rel="stylesheet" href="../../css/estilos.css"> <!-- Ajuste o caminho conforme necessário -->
    <script>
        function scrollToBottom() {
            var mensagensContainer = document.getElementById('mensagens');
            mensagensContainer.scrollTop = mensagensContainer.scrollHeight;
        }

        window.onload = scrollToBottom; // Chama a função ao carregar a página
    </script>
</head>
<body>

<div class="container">
    <h2>Troca de Mensagens</h2>
    
    <div class="mensagens" id="mensagens"> <!-- Adicionei o ID aqui -->
        <?php if ($resultado_mensagens->num_rows > 0): ?>
            <?php while ($mensagem = $resultado_mensagens->fetch_assoc()): ?>
                <div class="mensagem <?= $mensagem['remetente'] === 'trabalhador' ? 'mensagem-trabalhador' : 'mensagem-cliente' ?>">
                    <p><strong><?= $mensagem['remetente'] === 'trabalhador' ? 'Você' : 'Cliente' ?>:</strong></p>
                    <p><?= htmlspecialchars($mensagem['mensagem']) ?></p>
                    <p class="data"><?= date('d/m/Y H:i', strtotime($mensagem['data_envio'])) ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Nenhuma mensagem encontrada.</p>
        <?php endif; ?>
    </div>
    
    <!-- Formulário para enviar nova mensagem -->
    <div class="EnviarMensagem">
        <h3>Enviar nova mensagem</h3>
        <form action="" method="POST">
            <textarea name="mensagem" rows="4" placeholder="Escreva sua mensagem..." required></textarea>
            <button type="submit">Enviar</button>
        </form>
    </div>
    
    <div class="navegacao">
        <a href="index.php">Voltar à página inicial</a>
    </div>
</div>

<style>
    /* Estilos básicos para a página */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background-color: #f8f8f8;
    }
    .container {
        max-width: 800px;
        margin: auto;
        background: white;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .mensagens {
        max-height: 400px;
        overflow-y: auto;
        margin-bottom: 20px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
    }
    .mensagem {
        margin-bottom: 10px;
        padding: 10px;
        border-radius: 5px;
    }
    .mensagem-cliente {
        background-color: #d1e7dd;
    }
    .mensagem-trabalhador {
        background-color: #f8d7da;
    }
    .data {
        font-size: 0.8em;
        color: #777;
    }
    .EnviarMensagem {
        margin-top: 20px;
    }
    textarea {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }
    button {
        padding: 10px 15px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    button:hover {
        background-color: #0056b3;
    }
    .navegacao {
        margin-top: 20px;
    }
    .navegacao a {
        margin-right: 10px;
        text-decoration: none;
        color: #007bff;
    }
    .navegacao a:hover {
        text-decoration: underline;
    }
</style>

</body>
</html>
