<?php
session_start();

include_once('../backend/Conexao.php');

// Recebe os dados do formulário de login
$email = $_POST['email'];
$senha = $_POST['senha'];

// Consulta para verificar se o usuário é um administrador
$sql_adm = "SELECT * FROM adm WHERE email = ?";
$stmt_adm = $conn->prepare($sql_adm);
$stmt_adm->bind_param("s", $email);
$stmt_adm->execute();
$result_adm = $stmt_adm->get_result();

if ($result_adm->num_rows > 0) {
    // Usuário encontrado na tabela 'adm'
    $row_adm = $result_adm->fetch_assoc();

    // Verifica se a senha fornecida corresponde ao hash armazenado
    if (password_verify($senha, $row_adm['senha'])) {
        // Login bem-sucedido
        $_SESSION['email'] = $email;
        echo json_encode(['sucesso' => true, 'tipo' => 'admin', 'redirect' => './homeAdm.php']);
    } else {
        // Senha inválida
        echo json_encode(['sucesso' => false, 'mensagem' => 'Email ou senha inválidos']);
    }
} else {
    // Verifica se o usuário é cliente
    $sql_cliente = "SELECT * FROM cliente WHERE email = ?";
    $stmt_cliente = $conn->prepare($sql_cliente);
    $stmt_cliente->bind_param("s", $email);
    $stmt_cliente->execute();
    $result_cliente = $stmt_cliente->get_result();

    if ($result_cliente->num_rows > 0) {
        // Usuário encontrado na tabela 'cliente'
        $row_cliente = $result_cliente->fetch_assoc();

        // Verifica se a senha fornecida corresponde ao hash armazenado
        if (password_verify($senha, $row_cliente['senha'])) {
            // Login bem-sucedido
            $_SESSION['email'] = $email;
            $_SESSION['id_cliente'] = $row_cliente['id_cliente'];
            // $_SESSION['id_cliente'] = $result['id_cliente'];

            echo json_encode(['sucesso' => true, 'tipo' => 'cliente', 'redirect' => './cliente/homeClienteLogado.php']);
        } else {
            // Senha inválida
            echo json_encode(['sucesso' => false, 'mensagem' => 'Email ou senha inválidos']);
        }
    } else {
        // Email não encontrado nem em 'adm' nem em 'cliente'
        echo json_encode(['sucesso' => false, 'mensagem' => 'Email ou senha inválidos']);
    }
}

// Fecha as conexões com o banco de dados
$stmt_adm->close();
if (isset($stmt_cliente)) {
    $stmt_cliente->close();
}
$conn->close();
?>
