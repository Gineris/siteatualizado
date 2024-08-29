<?php

session_start(); 
include_once '../backend/php/Conexao.php';
date_default_timezone_set('America/Sao_Paulo');

if (!empty($_POST['estrela'])) {

    // Filtra e obtém os dados do formulário
    $estrela = filter_input(INPUT_POST, 'estrela', FILTER_SANITIZE_NUMBER_INT);
    $mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_STRING);

    // Insere a avaliação no banco de dados
    $query_avaliacao = "INSERT INTO avaliacoes (qtd_estrela, mensagem, created) VALUES (?, ?, ?)";
    $cad_avaliacao = $conn->prepare($query_avaliacao);

    $created_at = date("Y-m-d H:i:s");
    $cad_avaliacao->bind_param('iss', $estrela, $mensagem, $created_at);

    if ($cad_avaliacao->execute()) {

        // ID da avaliação recém inserida
        $id_avaliacao = $conn->insert_id;

        // Aqui você precisa do ID do cliente, não do ID da avaliação.
        // Por exemplo, suponha que você tenha o ID do cliente armazenado na sessão:
        $id_cliente = $_SESSION['6']; // Certifique-se de que o ID do cliente esteja corretamente armazenado na sessão.

        // Recupera o nome e email do cliente
        $query_usuario = "SELECT c.nome, c.email FROM cliente c WHERE c.id_cliente = ?";
        $stmt = $conn->prepare($query_usuario);
        $stmt->bind_param('i', $id_cliente);
        $stmt->execute();

        $resultado = $stmt->get_result();
        $cliente = $resultado->fetch_assoc();

        if ($cliente) {
            $nome = $cliente['nome'];
        } else {
            $nome = 'Nome não encontrado'; }

        // Exibe os detalhes da avaliação
        echo "<p>Avaliação: $id_avaliacao</p>";

        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $estrela) {
                echo '<i class="estrela-preenchida fa-solid fa-star"></i>';
            } else {
                echo '<i class="estrela-vazia fa-solid fa-star"></i>';
            }
        }

        echo "<p>Mensagem: $mensagem</p>";
        echo "<p>Nome do Cliente: $nome</p>";
       

    } else {
        echo "<p style='color: #f00;'>Erro: Avaliação não cadastrada.</p>";
    }
} else {
    echo "<p style='color: #f00;'>Erro: Necessário selecionar pelo menos 1 estrela.</p>";
}

?>
