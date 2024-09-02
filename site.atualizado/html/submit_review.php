<?php

include_once('../backend/php/Conexao.php');
header('Content-Type: application/json');


try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    exit();
}

// Obter dados do formulário
$rating = isset($_POST['rating']) ? intval($_POST['rating']) : 0;
$comment = isset($_POST['comment']) ? $_POST['comment'] : '';

if ($rating > 0 && $rating <= 5 && !empty($comment)) {
    // Inserir no banco de dados
    $sql = 'INSERT INTO reviews (rating, comment) VALUES (:rating, :comment)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['rating' => $rating, 'comment' => $comment]);

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Dados inválidos']);
}
?>