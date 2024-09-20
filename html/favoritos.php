<?php
session_start();
include_once('../backend/Conexao.php');

if (!isset($_SESSION['id_cliente'])) {
    echo 'Usuário não está logado.';
    exit;
}

include_once('../html/get_favoritos.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favoritos</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Trabalhadores Favoritos</h1>
    <div id="favoritos-container">
        <?php
        if (isset($favoritos) && is_array($favoritos) && !empty($favoritos)) {
            echo '<ul>';

            foreach ($favoritos as $trabalhador) {
                echo '<li>';
                echo '<img src=" ../uploads/' . (!empty($trabalhador['foto_perfil']) ? $trabalhador['foto_perfil'] : '../img/default.png') . '" alt="Perfil">';
                echo '<p>' . htmlspecialchars($trabalhador['nome']) . '</p>';
                echo '<p>Tel: ' . htmlspecialchars($trabalhador['contato']) . '</p>';
                // Remover a linha abaixo que exibe a descrição
                // echo '<p>Descrição: ' . htmlspecialchars($trabalhador['descricao']) . '</p>';
                echo '</li>';
            }

            echo '</ul>';
        } else {
            echo '<p>Nenhum trabalhador favorito encontrado.</p>';
        }
        ?>
    </div>

    <script src="../js/favoritos.js"></script>
</body>
</html>
