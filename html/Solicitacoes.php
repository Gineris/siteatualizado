<?php
session_start();
include_once('../backend/Conexao.php');

// Escreva a consulta para pegar os trabalhadores com permissão 2
$sql = "SELECT id_trabalhador FROM trabalhador WHERE permissao = 2";

// Executar a consulta usando o mysqli
$resultado_pesquisar = mysqli_query($conn, $sql);

// Verificar se retornou algum resultado
if (mysqli_num_rows($resultado_pesquisar) > 0) {
    echo "<h3>Lista de Trabalhadores com permissão 2:</h3>";
    echo "<ul>";
    
    // Laço de repetição para exibir os IDs dos trabalhadores
    while ($row = mysqli_fetch_assoc($resultado_pesquisar)) {
        echo "<li>ID Trabalhador: " . $row['id_trabalhador'] . "</li>";
    }
    
    echo "</ul>";
} else {
    echo "Nenhum trabalhador encontrado com permissão 2.";
}

// Fechar a conexão
mysqli_close($conn);
?>