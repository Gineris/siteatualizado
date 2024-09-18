<?php
session_start();

include_once('../backend/Conexao.php');


$email = $_POST['email'];
$senha = $_POST['senha'];


$sql_adm = "SELECT * FROM adm WHERE email = ?";
$stmt_adm = $conn->prepare($sql_adm);
$stmt_adm->bind_param("s", $email);
$stmt_adm->execute();
$result_adm = $stmt_adm->get_result();

if ($result_adm->num_rows > 0) {
 
    $row_adm = $result_adm->fetch_assoc();


    if (password_verify($senha, $row_adm['senha'])) {
        
        $_SESSION['email'] = $email;
        echo json_encode(['sucesso' => true, 'tipo' => 'admin', 'redirect' => './homeAdm.php']);
    } else {
        
        echo json_encode(['sucesso' => false, 'mensagem' => 'Email ou senha inválidos']);
    }
} else {
   
    $sql_cliente = "SELECT * FROM cliente WHERE email = ?";
    $stmt_cliente = $conn->prepare($sql_cliente);
    $stmt_cliente->bind_param("s", $email);
    $stmt_cliente->execute();
    $result_cliente = $stmt_cliente->get_result();

    if ($result_cliente->num_rows > 0) {
      
        $row_cliente = $result_cliente->fetch_assoc();

        
        if (password_verify($senha, $row_cliente['senha'])) {
          
            $_SESSION['email'] = $email;
            echo json_encode(['sucesso' => true, 'tipo' => 'cliente', 'redirect' => '']);
        } else {
           
            echo json_encode(['sucesso' => false, 'mensagem' => 'Email ou senha inválidos']);
        }
    } else {
       
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
