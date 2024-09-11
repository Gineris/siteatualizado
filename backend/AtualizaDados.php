<?php
session_start();
include_once('../backend/Conexao.php');

// Verificar se o trabalhador está logado
if (!isset($_SESSION['id_trabalhador']) || !$_SESSION['logado']) {
    $_SESSION['mensagem'] = "Você precisa estar logado para atualizar suas informações.";
    header('Location: ./LoginTrabalhador.php');
    exit();
}

// Pegar os dados enviados pelo formulário
$novoNome = $_POST['nome'] ?? ''; //senha tel dt nasc cidade desc
$novoEmail = $_POST['email'] ?? '';
$novoSenha = $_POST['senha'] ?? '';
$novoTelefone = $_POST['telefone'] ?? '';
$novoDataNasc = $_POST['datanasc'] ?? '';
$novoCidade = $_POST['cidade'] ?? '';
$novoDescricao = $_POST['descricao'] ?? '';

// Validar os dados
if (empty($novoNome) || empty($novoEmail) || empty($novoSenha)) || empty($novoDescricao)) || empty($novoTelefone)) || empty($novoDataNasc)) || empty($novoCidade))) {
    $_SESSION['mensagem'] = "Preencha todos os campos.";
    header('Location: ./editarPerfil.php');
    exit();
}

// Pegar o ID do trabalhador logado
$idTrabalhador = $_SESSION['id_trabalhador'];

// Preparar a consulta SQL para atualizar as informações
$sql = "UPDATE trabalhador SET nome = ?, email = ?, senha = ?, telefone = ?, datanasc = ?, cidade = ?, descricao = ? WHERE id_trabalhador = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ssi", $novoNome, $novoEmail, $novoSenha, $novoTelefone, $novoDataNasc, $novoCidade, $novoDescricao, $idTrabalhador);

    // Executar a consulta
    if ($stmt->execute()) {
        $_SESSION['mensagem'] = "Informações atualizadas com sucesso!";
        // Atualizar a sessão com os novos dados
        $_SESSION['nome'] = $novoNome;
        $_SESSION['email'] = $novoEmail;
        $_SESSION['senha'] = $novoSenha;
        $_SESSION['telefone'] = $novoTelefone;
        $_SESSION['datanasc'] = $novoDataNasc;
        $_SESSION['cidade'] = $novoCidade;
        $_SESSION['descricao'] = $novoDescricao;
    } else {
        $_SESSION['mensagem'] = "Erro ao atualizar informações. Tente novamente.";
    }

    $stmt->close();
} else {
    $_SESSION['mensagem'] = "Erro ao preparar a consulta.";
}



?>
