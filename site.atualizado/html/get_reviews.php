<?php
include_once('../backend/php/Conexao.php');

header('Content-Type: application/json');


try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    exit();
}

// Recuperar avaliações
$sql = 'SELECT rating, comment FROM reviews ORDER BY id DESC';
$stmt = $pdo->query($sql);
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(['reviews' => $reviews]);
?>
