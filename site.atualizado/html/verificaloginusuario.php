<?php
include_once('../backend/Conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);
    

    if (empty($email) || empty($senha)) {
        die("Por favor, preencha todos os campos.");
    }

    function verificarCliente($conn, $email, $senha) {
        $id_cliente = null;
        $senhaHash = null;
        $sql = "SELECT id_cliente, senha FROM cliente WHERE email = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Erro na preparação da consulta: " . $conn->error);
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id_cliente, $senhaHash);
            $stmt->fetch();

            if (password_verify($senha, $senha)) {
                return ['id' => $id_cliente];
            }
        }

        $stmt->close();
        return null;
    }

    $cliente = verificarCliente($conn, $email, $senha);

    if ($cliente) {
        session_start();
        $_SESSION['id_cliente'] = $cliente['id'];
        header("Location: ../html/dashboardCliente.php");
        exit;
    } else {
        die("E-mail ou senha incorretos.");
    }

    $conn->close();
} else {
    echo "Método de requisição inválido.";
}
