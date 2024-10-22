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

// Consulta para obter todos os clientes que trocaram mensagens com o trabalhador
$sql_historico = "SELECT DISTINCT c.id_cliente, c.nome, c.foto_perfil
                  FROM mensagens m 
                  JOIN cliente c ON c.id_cliente = m.id_cliente 
                  WHERE m.id_trabalhador = '$id_trabalhador' 
                  ORDER BY c.nome ASC";

$resultado_historico = $conn->query($sql_historico);

// Verifica se a consulta foi bem-sucedida
if ($resultado_historico === false) {
    echo "Erro na consulta: " . $conn->error;
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Conversas</title>
    <link rel="stylesheet" href="../../css/estilos.css"> <!-- Ajuste o caminho conforme necessário -->
</head>
<body>

<div class="container">
    <h2>Histórico de Conversas</h2>
    
    <div class="historico">
        <?php if (mysqli_num_rows($resultado_historico) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($resultado_historico)): ?> 
                <div class="CampoEscolhaCliente">
                    <a href="troca_mensagens_trabalhador.php?id_cliente=<?php echo $row['id_cliente']; ?>">
                        <div class="CardBox"> 
                            <div class="imagem">
                                <img src="../../uploads/<?php echo $row['foto_perfil']; ?>" alt="">
                            </div>
                            <div class="txtCliente">
                                <h3><?php echo htmlspecialchars($row['nome']); ?></h3>

                            </div>
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="tituloDEnaoEncontrado">
                <p>Nenhuma conversa encontrada.</p>
            </div>
        <?php endif; ?>
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
    .historico {
        display: flex;
        flex-direction: column;
    }
    .CampoEscolhaCliente {
        margin-bottom: 15px;
    }
    .CardBox {
        display: flex;
        align-items: center;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #fff;
        text-decoration: none;
        color: inherit;
    }
    .imagem {
        margin-right: 10px;
    }
    .imagem img {
        width: 50px; /* Ajuste o tamanho conforme necessário */
        height: 50px; /* Ajuste o tamanho conforme necessário */
        border-radius: 50%;
    }
    .txtCliente h3 {
        margin: 0;
        font-size: 18px;
    }
    .txtCliente p {
        margin: 0;
        font-size: 14px;
    }
    .tituloDEnaoEncontrado {
        color: #888;
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
