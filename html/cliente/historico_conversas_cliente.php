<?php
session_start(); // Inicia a sessão
include_once('../../backend/Conexao.php');

// Verifica se o cliente está logado
if (!isset($_SESSION['id_cliente'])) {
    echo 'Cliente não está logado.';
    exit;
}

// ID do cliente logado
$id_cliente = $_SESSION['id_cliente'];

// Consulta para obter todos os trabalhadores que trocaram mensagens com o cliente, incluindo a categoria
$sql_historico = "SELECT DISTINCT t.id_trabalhador, t.nome, t.foto_perfil, c.nome_cat AS categoria 
                  FROM mensagens m 
                  JOIN trabalhador t ON t.id_trabalhador = m.id_trabalhador 
                  JOIN categorias c ON t.id_categoria = c.id_categoria 
                  WHERE m.id_cliente = '$id_cliente' 
                  ORDER BY t.nome ASC";

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
    <link rel="shortcut icon" href="../../img/logo@2x.png" type="image/x-icon">
    <link rel="stylesheet" href="../../css/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../../css/estilos.css"> <!-- Ajuste o caminho conforme necessário -->
</head>
<body>

<div class="container">
    <h2>Histórico de Conversas</h2>
    
    <div class="historico">
        <?php if (mysqli_num_rows($resultado_historico) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($resultado_historico)): ?> 
                <div class="CampoEscolhaTrabalhador">
                    <a href="troca_mensagens_cliente.php?id_trabalhador=<?php echo $row['id_trabalhador']; ?>">
                        <div class="CardBox"> 
                            <div class="imagem">
                                <img src="../../uploads/<?php echo $row['foto_perfil']; ?>" alt="">
                            </div>
                            <div class="txtTrabalhador">
                                <h3><?php echo htmlspecialchars($row['nome']); ?></h3>
                                <p style="margin-bottom:0rem"><?php echo htmlspecialchars($row['categoria']); ?></p> <!-- Categoria do trabalhador -->
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
        <a href="./homeClienteLogado.php">Voltar à página inicial</a>
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
    .CampoEscolhaTrabalhador {
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
    .txtTrabalhador h3 {
        margin: 0;
        font-size: 18px;
    }
    .txtTrabalhador p {
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
