<?php

session_start(); // Iniciar a sessão

// Incluir o arquivo com a conexão com banco de dados
include_once '../backend/php/Conexao.php';

// Definir fuso horário de São Paulo
date_default_timezone_set('America/Sao_Paulo');

// Acessar o IF quando é selecionado ao menos uma estrela
if (!empty($_POST['estrela'])) {

    // Receber os dados do formulário
    $estrela = filter_input(INPUT_POST, 'estrela', FILTER_DEFAULT);
    $mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_DEFAULT);

    // Criar a QUERY cadastrar no banco de dados
    $query_avaliacao = "INSERT INTO avaliacoes (qtd_estrela, mensagem, created) VALUES (:qtd_estrela, :mensagem, :created)";

    // Preparar a QUERY
    $cad_avaliacao = $conn->prepare($query_avaliacao);

    // Substituir os links pelo valor
    $cad_avaliacao->bindParam(':qtd_estrela', $estrela, PDO::PARAM_INT);
    $cad_avaliacao->bindParam(':mensagem', $mensagem, PDO::PARAM_STR);
    $cad_avaliacao->bindParam(':created', date("Y-m-d H:i:s"));

    // Acessa o IF quando cadastrar corretamente
    if ($cad_avaliacao->execute()) {

        // Criar a mensagem de erro
        $_SESSION['msg'] = "<p style='color: green;'>Avaliação cadastrar com sucesso.</p>";

        // Redirecionar o usuário para a página inicial
        header("Location: PerfilCliente.php");
    } else {

        // Criar a mensagem de erro
        $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Avaliação não cadastrar.</p>";

        // Redirecionar o usuário para a página inicial
        header("Location: PerfilCliente.php");
    }
} else {

    // Criar a mensagem de erro
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Necessário selecionar pelo menos 1 estrela.</p>";

    // Redirecionar o usuário para a página inicial
    header("Location: PerfilCliente.php");
}
