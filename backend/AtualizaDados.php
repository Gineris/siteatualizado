<?php
session_start();
include_once('../backend/Conexao.php');
// Verificar se o trabalhador está logado
if (!isset($_SESSION['id_trabalhador']) || !$_SESSION['logado']) {
    $_SESSION['mensagem'] = "Você precisa estar logado para atualizar suas informações.";
    header('Location: ./LoginTrabalhador.php');
    exit();
}

// Pegar o ID do trabalhador logado
$idTrabalhador = $_SESSION['id_trabalhador'];

// Capturar dados do formulário
$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';
$contato = $_POST['contato'] ?? '';
$data_nasc = $_POST['data_nasc'] ?? '';
$cidade = $_POST['cidade'] ?? '';
$descricao = $_POST['descricao'] ?? '';

// Verificar se os campos obrigatórios foram preenchidos
if (empty($nome) || empty($email) || empty($senha)) {
    $_SESSION['mensagem'] = "Preencha todos os campos obrigatórios.";
    header('Location: ./EditarPerfil.php');
    exit();
}
// Iniciar a query de atualização
$sql = "UPDATE trabalhador SET nome = ?, email = ?, contato = ?, data_nasc = ?, descricao = ?";

// Verificar se a senha foi preenchida e se a confirmação está correta
if (!empty($senha)) {    
    // Hashear a nova senha
    $senhaHasheada = password_hash($senha, PASSWORD_DEFAULT);
    $sql .= ", senha = ?"; // Adiciona o campo de senha na query
}

// Finaliza a query
$sql .= " WHERE id_trabalhador = ?";

// Preparar a declaração
$stmt = $conn->prepare($sql);

// Verifica se a senha foi atualizada ou não
if (!empty($senha)) {
    $stmt->bind_param("ssssssi", $nome, $email, $contato, $data_nasc, $descricao ,$senhaHasheada, $idTrabalhador);
} else {
    $stmt->bind_param("sssssi", $nome, $email, $contato, $data_nasc, $descricao, $idTrabalhador);
}

// Executa a query
if ($stmt->execute()) {
    $_SESSION['mensagem'] = "Perfil atualizado com sucesso!";
    
    // Atualizar dados da sessão com as novas informações
    $_SESSION['nome'] = $nome;
    $_SESSION['email'] = $email;
    $_SESSION['senha'] = $senha;
    $_SESSION['contato'] = $contato;
    $_SESSION['data_nasc'] = $data_nasc;
    $_SESSION['cidade'] = $cidade;
    $_SESSION['descricao'] = $descricao;
} else {
    $_SESSION['mensagem'] = "Erro ao atualizar o perfil. Tente novamente.";
}

$stmt->close();
$conn->close();

// Redireciona para o perfil
header('Location: ../html/EditarPerfil.php');
