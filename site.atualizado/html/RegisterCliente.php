<?php
include_once('../backend/Conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);
    $confirmaSenha = trim($_POST['ConfirmaSenha']);
    $id_area = intval($_POST['id_area']); 
    $fotoDePerfil = $_FILES['foto_de_perfil'];

    // Verifica se todos os campos obrigatórios foram preenchidos
    if (empty($nome) || empty($email) || empty($senha) || empty($confirmaSenha) || empty($id_area)) {
        echo "Todos os campos são obrigatórios.";
        exit;
    }

    // Verifica se as senhas coincidem
    if ($senha !== $confirmaSenha) {    
        echo "As senhas não coincidem.";  
        exit;
    }

    // Processa o upload da foto de perfil
    $diretorio = '../uploads/'; 
    $nomeArquivo = basename($fotoDePerfil['name']);
    $caminhoCompleto = $diretorio . $nomeArquivo;

    if (!is_dir($diretorio)) {
        mkdir($diretorio, 0777, true); 
    }

    $tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($fotoDePerfil['type'], $tiposPermitidos)) {
        echo "Tipo de arquivo não permitido.";
        exit;
    }

    if (!move_uploaded_file($fotoDePerfil['tmp_name'], $caminhoCompleto)) {
        $erro = error_get_last();
        echo "Erro ao enviar a foto de perfil: " . $erro['message'];
        exit;
    }

    // Criptografa a senha
    $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

    // Insere o novo cliente na base de dados
    try {
        $sql = "INSERT INTO cliente (nome, email, senha, id_area, foto_perfil) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssds", $nome, $email, $senhaCriptografada, $id_area, $caminhoCompleto);

        if ($stmt->execute()) {
            // Redireciona para a página de verificação de login
            header("Location: ./verificaLoginUsuario.php");
            exit;
        } else {
            echo "Erro ao realizar o cadastro: " . $stmt->error;
        }
    } catch (Exception $e) {
        echo "Erro: " . $e->getMessage();
    } finally {
        $stmt->close();
        $conn->close();
    }
} else {
    echo "Método de requisição inválido.";
}
?>
