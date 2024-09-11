<?php
session_start();
include_once('../backend/Conexao.php');


$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if (empty($email) || empty($senha)) {
    $_SESSION['mensagem'] = "Preencha todos os campos.";
    header('Location: ./LoginTrabalhador.php');
    exit();
}


$sql = "SELECT * FROM trabalhador WHERE email = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $registroUsuario = $result->fetch_object();

    if ($registroUsuario) {

        if (password_verify($senha, $registroUsuario->senha)) {

            $_SESSION['mensagem'] = "Usuário Logado com sucesso!!!!";
            $_SESSION['id_trabalhador'] = $registroUsuario->id_trabalhador;  // tirar em caso de duvida
            $_SESSION['nome'] = $registroUsuario->nome;
            $_SESSION['email'] = $registroUsuario->email;
            $_SESSION['senha'] = $registroUsuario->senha;
            $_SESSION['status'] = $registroUsuario->status;
            $_SESSION['logado'] = true;

            
            header('Location: ./homeLogado.php');
            exit();
        } else {

            $_SESSION['mensagem'] = "Senha incorreta!!!!!";
            $_SESSION['logado'] = false;
            header('Location: ./LoginTrabalhador.php');
            exit();
        }
    } else {

        $_SESSION['mensagem'] = "Usuário não encontrado!!!!!";
        $_SESSION['logado'] = false;
        header('Location: ./LoginTrabalhador.php');
        exit();
    }

    $stmt->close();
} else {

    $_SESSION['mensagem'] = "Erro na preparação da consulta.";
    header('Location: ./LoginTrabalhador.php');
    exit();
}

$conn->close();
?>

