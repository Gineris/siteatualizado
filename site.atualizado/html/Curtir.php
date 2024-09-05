<?php
include_once('../backend/Conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $trabalhador_id = $_POST['id'];

    // Incrementa o número de curtidas
    $stmt = $pdo->prepare("UPDATE trabalhadores SET curtidas = curtidas + 1 WHERE id = ?");
    $stmt->execute([$trabalhador_id]);

    // Busca o número atualizado de curtidas
    $stmt = $pdo->prepare("SELECT curtidas FROM trabalhadores WHERE id = ?");
    $stmt->execute([$trabalhador_id]);
    $trabalhador = $stmt->fetch();

    // Retorna o número atualizado de curtidas
    echo $trabalhador['curtidas'];
}
?>
