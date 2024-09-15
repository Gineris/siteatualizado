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
$id_area = $_POST['id_area'] ?? '';
$id_categoria = $_POST['id_categoria'] ?? '';
$foto_perfil = $_POST['foto_perfil'] ?? '';

// Verificar se os campos obrigatórios foram preenchidos
if (empty($nome) || empty($email) || empty($senha) || empty($id_area) || empty($id_categoria)) {
    $_SESSION['mensagem'] = "Preencha todos os campos obrigatórios.";
    header('Location: ./EditarPerfil.php');
    exit();
}

// Iniciar a query de atualização
$sql = "UPDATE trabalhador SET nome = ?, email = ?, contato = ?, data_nasc = ?, descricao = ?, id_area = ?, id_categoria = ?";

// Verificar se a senha foi preenchida e se a confirmação está correta
if (!empty($senha)) {    
    // Hashear a nova senha
    $senhaHasheada = password_hash($senha, PASSWORD_DEFAULT);
    $sql .= ", senha = ?"; // Adiciona o campo de senha na query
}
if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] == 0) {
    // Diretório onde as imagens serão salvas
    $diretorio = '../uploads/';
    
    // Nome do arquivo
    $foto_perfil = basename($_FILES['foto_perfil']['name']);
    
    // Caminho completo para onde a imagem será movida
    $caminhoCompleto = $diretorio . $foto_perfil;

    // Verifica se o arquivo é uma imagem
    $tipoArquivo = strtolower(pathinfo($caminhoCompleto, PATHINFO_EXTENSION));
    $tiposPermitidos = array("jpg", "jpeg", "png");
    
    if (in_array($tipoArquivo, $tiposPermitidos)) {
        // Move o arquivo para o diretório de uploads
        if (move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $caminhoCompleto)) {
            $_SESSION['mensagem'] = "Foto de perfil atualizada com sucesso!";
        } else {
            $_SESSION['mensagem'] = "Erro ao mover o arquivo de upload.";
        }
    } else {
        $_SESSION['mensagem'] = "Formato de arquivo não suportado. Use JPG, JPEG, ou PNG.";
    }
}

// Atualize o campo foto_perfil no banco de dados
if (!empty($foto_perfil)) {
    $sql .= ", foto_perfil = ?";
}

// Finaliza a query
$sql .= " WHERE id_trabalhador = ?";

// Preparar a declaração
$stmt = $conn->prepare($sql);

// Verifica se a senha foi atualizada ou não
if (!empty($senha) && !empty($foto_perfil)) {
    $stmt->bind_param("sssssssssi", $nome, $email, $contato, $data_nasc, $descricao, $id_categoria, $id_area, $senhaHasheada, $foto_perfil, $idTrabalhador);
} elseif (!empty($foto_perfil)) {
    $stmt->bind_param("ssssssssi", $nome, $email, $contato, $data_nasc, $descricao, $id_categoria, $id_area, $foto_perfil, $idTrabalhador);
} elseif (!empty($senha)) {
    $stmt->bind_param("ssssssssi", $nome, $email, $contato, $data_nasc, $descricao, $id_categoria, $id_area, $senhaHasheada, $idTrabalhador);
} else {
    $stmt->bind_param("sssssssi", $nome, $email, $contato, $data_nasc, $descricao, $id_categoria, $id_area, $idTrabalhador);
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
    // $_SESSION['cidade'] = $cidade;
    $_SESSION['descricao'] = $descricao;
    $_SESSION['id_area'] = $id_area;
    $_SESSION['id_categoria'] = $id_categoria;
    $_SESSION['foto_perfil'] = $foto_perfil;
} else {
    $_SESSION['mensagem'] = "Erro ao atualizar o perfil. Tente novamente.";
}

$stmt->close();
$conn->close();

// Redireciona para o perfil
header('Location: ../html/EditarPerfil.php');
