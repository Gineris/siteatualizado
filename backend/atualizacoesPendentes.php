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
$descricao = $_POST['descricao'] ?? '';
$id_area = $_POST['id_area'] ?? '';
$id_categoria = $_POST['id_categoria'] ?? '';

$foto_perfil = '';
$foto_trabalho1 = '';
$foto_trabalho2 = '';
$foto_trabalho3 = '';
$foto_banner = '';

// Função para fazer o upload dos arquivos
function uploadArquivo($campoNome) {
    global $conn;
    if (isset($_FILES[$campoNome]) && $_FILES[$campoNome]['error'] == 0) {
        $diretorio = '../uploads/';
        $nomeArquivo = basename($_FILES[$campoNome]['name']);
        $caminhoCompleto = $diretorio . $nomeArquivo;
        $tipoArquivo = strtolower(pathinfo($caminhoCompleto, PATHINFO_EXTENSION));
        $tiposPermitidos = array("jpg", "jpeg", "png", "jfif");
        
        if (in_array($tipoArquivo, $tiposPermitidos)) {
            if (move_uploaded_file($_FILES[$campoNome]['tmp_name'], $caminhoCompleto)) {
                return $nomeArquivo;
            } else {
                $_SESSION['mensagem'] = "Erro ao mover o arquivo de upload.";
            }
        } else {
            $_SESSION['mensagem'] = "Formato de arquivo não suportado. Use JPG, JPEG, JFIF ou PNG.";
        }
    }
    return '';
}

// Atualizar variáveis de fotos
$foto_perfil = uploadArquivo('foto_perfil');
$foto_trabalho1 = uploadArquivo('foto_trabalho1');
$foto_trabalho2 = uploadArquivo('foto_trabalho2');
$foto_trabalho3 = uploadArquivo('foto_trabalho3');
$foto_banner = uploadArquivo('foto_banner');

// Verificar se os campos obrigatórios foram preenchidos
if (empty($nome) || empty($email) || empty($senha) || empty($id_area) || empty($id_categoria)) {
    $_SESSION['mensagem'] = "Preencha todos os campos obrigatórios.";
    header('Location: ../html/trabalhador/EditarPerfil.php');
    exit();
}

// Hashear a nova senha se ela foi preenchida
$senhaHasheada = !empty($senha) ? password_hash($senha, PASSWORD_DEFAULT) : null;

// Inserir a solicitação na tabela `atualizacoes_pendentes`
$sql = "INSERT INTO atualizacoes_pendentes 
        (id_trabalhador, nome, email, senha, contato, data_nasc, descricao, id_area, id_categoria, foto_perfil, foto_trabalho1, foto_trabalho2, foto_trabalho3, foto_banner) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Preparar a declaração
$stmt = $conn->prepare($sql);

// Bind dos parâmetros
$stmt->bind_param("isssssssssssss", $idTrabalhador, $nome, $email, $senhaHasheada, $contato, $data_nasc,$descricao, $id_area, $id_categoria, $foto_perfil, $foto_trabalho1, $foto_trabalho2, $foto_trabalho3, $foto_banner);

// Executa a query
if ($stmt->execute()) {
    $_SESSION['mensagem'] = "Solicitação de atualização enviada para aprovação!";
} else {
    $_SESSION['mensagem'] = "Erro ao enviar a solicitação. Tente novamente.";
}

$stmt->close();
$conn->close();

// Redireciona para o perfil
header('Location: ../html/trabalhador/EditarPerfil.php');
