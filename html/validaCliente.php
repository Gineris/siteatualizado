<?php
session_start();
include_once('../backend/Conexao.php');

header('Content-Type: application/json');

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if (empty($email) || empty($senha)) {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Preencha todos os campos.']);
    exit();
}

// Verifica se o email é o do admin
if ($email === 'Admin@gmail.com') {
    $sql = "SELECT * FROM adm WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $registroAdmin = $result->fetch_object();

        if ($registroAdmin) {
            if (password_verify($senha, $registroAdmin->senha)) {
                // Senha correta
                $_SESSION['mensagem'] = "Administrador Logado com sucesso!";
                $_SESSION['user_id'] = $registroAdmin->id_adm;
                $_SESSION['nome'] = $registroAdmin->nome;
                $_SESSION['email'] = $registroAdmin->email;
                $_SESSION['senha'] = $registroAdmin->senha;
                $_SESSION['logado'] = true;

                echo json_encode(['sucesso' => true, 'redirect' => 'homeAdm.php']);
                exit();
            } else {
                echo json_encode(['sucesso' => false, 'mensagem' => 'Senha incorreta!']);
                exit();
            }
        } else {
            echo json_encode(['sucesso' => false, 'mensagem' => 'Administrador não encontrado!']);
            exit();
        }

        $stmt->close();
    } else {
        echo json_encode(['sucesso' => false, 'mensagem' => 'Erro na preparação da consulta.']);
        exit();
    }
} else {
    // Verifica na tabela de clientes
    $sql = "SELECT * FROM cliente WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $registroCliente = $result->fetch_object();

        if ($registroCliente) {
            if (password_verify($senha, $registroCliente->senha)) {
                // Senha correta
                $_SESSION['mensagem'] = "Cliente Logado com sucesso!";
                $_SESSION['user_id'] = $registroCliente->id_cliente;
                $_SESSION['nome'] = $registroCliente->nome;
                $_SESSION['email'] = $registroCliente->email;
                $_SESSION['senha'] = $registroCliente->senha;
                $_SESSION['logado'] = true;

                echo json_encode(['sucesso' => true, 'redirect' => 'homeCliente.php']);
                exit();
            } else {
                echo json_encode(['sucesso' => false, 'mensagem' => 'Senha incorreta!']);
                exit();
            }
        } else {
            echo json_encode(['sucesso' => false, 'mensagem' => 'Cliente não encontrado!']);
            exit();
        }

        $stmt->close();
    } else {
        echo json_encode(['sucesso' => false, 'mensagem' => 'Erro na preparação da consulta.']);
        exit();
    }
}

$conn->close();
?>
