<?php
include_once('../backend/Conexao.php');

// Obter dados do formulário
$nome = trim($_POST['nome']);
$email = trim($_POST['email']);
$senha = trim($_POST['senha']);
$confirmaSenha = trim($_POST['ConfirmaSenha']);
$id_area = intval($_POST['id_area']);
$id_categoria = intval($_POST['id_categoria']);
$fotoDePerfil = $_FILES['foto_de_perfil'];

// Validar se todos os campos obrigatórios foram preenchidos
if (empty($nome) || empty($email) || empty($senha) || empty($confirmaSenha) || empty($id_area) || empty($id_categoria)) {
    die("Todos os campos são obrigatórios.");
}

// Validar senhas
if ($senha !== $confirmaSenha) {
    die("As senhas não coincidem.");
}

// Verificar se o e-mail já está em uso
$sql = "SELECT id_trabalhador FROM trabalhador WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    die("Já existe um trabalhador com este e-mail.");
}
$stmt->close();

// Processar o upload da foto de perfil
$diretorio = '../uploads/';
$nomeArquivo = basename($fotoDePerfil['name']);
$caminhoCompleto = $diretorio . $nomeArquivo;
$tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif'];

if (!is_dir($diretorio)) {
    mkdir($diretorio, 0777, true);
}

if (!in_array($fotoDePerfil['type'], $tiposPermitidos)) {
    die("Tipo de arquivo não permitido.");
}

if (!move_uploaded_file($fotoDePerfil['tmp_name'], $caminhoCompleto)) {
    die("Erro ao enviar a foto de perfil.");
}

// Criptografar senha
$senhaHash = password_hash($senha, PASSWORD_BCRYPT);

// Preparar a consulta SQL
$sql = "INSERT INTO trabalhador (nome, email, senha, id_area, id_categoria, foto_perfil) VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $nome, $email, $senhaHash, $id_area, $id_categoria, $caminhoCompleto);

if ($stmt->execute()) {
            
    header("Location: LoginTrabalhador.php");
    exit;
} else {
    echo "Erro ao realizar o cadastro: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
