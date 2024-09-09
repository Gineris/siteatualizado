<?php
session_start();
include_once('../backend/Conexao.php');

// Obtenha o email e senha do formulário
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

// Verifique se os campos estão preenchidos
if (empty($email) || empty($senha)) {
    $_SESSION['mensagem'] = "Preencha todos os campos.";
    header('Location: ./LoginTrabalhador.php');
    exit();
}

// Prepare a consulta SQL para buscar o trabalhador com o email fornecido
$sql = "SELECT * FROM cliente WHERE email = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $registroUsuario = $result->fetch_object();

    if ($registroUsuario) {
        // Verifique a senha usando password_verify
        if (password_verify($senha, $registroUsuario->senha)) {
            // Senha correta
            $_SESSION['mensagem'] = "Usuário Logado com sucesso!!!!";
            $_SESSION['nome'] = $registroUsuario->nome;
            $_SESSION['email'] = $registroUsuario->email;
            $_SESSION['senha'] = $registroUsuario->senha;
            $_SESSION['status'] = $registroUsuario->status;
            $_SESSION['logado'] = true;

            // Redirecionar para a página inicial do trabalhador
            header('Location: ./homeLogado.php');
            exit();
        } else {
            // Senha incorreta
            $_SESSION['mensagem'] = "Senha incorreta!!!!!";
            $_SESSION['logado'] = false;
            header('Location: ./LoginUsuario.php');
            exit();
        }
    } else {
        // Email não encontrado
        $_SESSION['mensagem'] = "Usuário não encontrado!!!!!";
        $_SESSION['logado'] = false;
        header('Location: ./LoginUsuario.php');
        exit();
    }

    $stmt->close();
} else {
    // Erro na preparação da consulta
    $_SESSION['mensagem'] = "Erro na preparação da consulta.";
    header('Location: ./LoginTrabalhador.php');
    exit();
}

$conn->close();
?>