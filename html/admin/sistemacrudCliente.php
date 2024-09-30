<?php
include_once('../../backend/Conexao.php'); 


if (!$conn || !($conn instanceof mysqli)) {
    die("Erro: Conexão com o banco de dados não estabelecida ou não é uma instância de mysqli.");
}

$action = isset($_GET['action']) ? $_GET['action'] : '';
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tipo = $_POST['tipo'];
    $status = $_POST['status'];
    $id_area = $_POST['id_area'];
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    
    if (empty($nome) || empty($email)) {
        echo "Os campos de nome e email são obrigatórios.";
        exit;
    }

    $fotoPerfil = ''; 
    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $fileName = basename($_FILES['foto_perfil']['name']);
        $uploadFile = $uploadDir . $fileName;

       
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }


        if (move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $uploadFile)) {
            $fotoPerfil = $fileName;  
        } else {
            echo "Erro ao fazer upload da foto.";
            exit;
        }
    }

    if ($action === 'update' && $id) {
        
        $sql = "UPDATE cliente SET nome = ?, email = ?, senha = ?, tipo = ?, status = ?, id_area = ?, foto_perfil = ? WHERE id_cliente = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Erro na preparação da consulta: " . $conn->error);
        }

        $senhaHash = !empty($senha) ? password_hash($senha, PASSWORD_DEFAULT) : $_POST['senha_atual']; 
        $stmt->bind_param('sssssssi', $nome, $email, $senhaHash, $tipo, $status, $id_area, $fotoPerfil, $id);

        if ($stmt->execute()) {
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo "Erro ao atualizar cliente: " . $stmt->error;
        }
    } else if ($action === 'create') {
    
        $sql = "INSERT INTO cliente (nome, email, senha, tipo, status, id_area, foto_perfil) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Erro na preparação da consulta: " . $conn->error);
        }

        $stmt->bind_param('sssssss', $nome, $email, password_hash($senha, PASSWORD_DEFAULT), $tipo, $status, $id_area, $fotoPerfil);

        
        if ($stmt->execute()) {
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        } else {
            echo "Erro ao adicionar cliente: " . $stmt->error;
        }
    }
}


if ($action === 'delete' && $id) {
    $sql = "DELETE FROM cliente WHERE id_cliente = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Erro na preparação da consulta: " . $conn->error);
    }
    
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    } else {
        die("Erro ao excluir cliente: " . $stmt->error);
    }
}

$cliente = [];
if ($action === 'edit' && $id) {
    $sql = "SELECT * FROM cliente WHERE id_cliente = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Erro na preparação da consulta: " . $conn->error);
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $cliente = $result->fetch_assoc();
    if ($cliente === false) {
        die("Erro ao buscar cliente: " . $stmt->error);
    }
}

$sql = "SELECT * FROM cliente";
$result = $conn->query($sql);
if ($result === false) {
    die("Erro na consulta: " . $conn->error);
}
$clientes = $result->fetch_all(MYSQLI_ASSOC);

// Captura o valor da pesquisa pelo nome
$nome_pesquisa = isset($_POST['nome_pesquisa']) ? trim($_POST['nome_pesquisa']) : '';

// Consulta para pegar todas as categorias, com condição de busca se o nome for preenchido
$sql_categorias = "SELECT * FROM cliente  WHERE nome LIKE '%$nome_pesquisa%'";
$resultado_categorias = $conn->query($sql_categorias);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento Clientes</title>
    <link rel="stylesheet" href="../../css/stylecrudcliente.css">
    <link rel="stylesheet" href="../../bootstrap-5.3.3-dist/css/bootstrap-grid.min.css">
    <link rel="shortcut icon" href="../../img/logo@2x.png" type="image/x-icon">
</head>
<body>

<header>
    <nav class="BarraNav">
        <img src="../../img/LogoJundtaskCompleta.png" alt="Logo JundTask">
        <div class="perfil">
            <a href="./homeAdm.php">
                Voltar
            </a>
        </div>
    </nav>
</header>

<main class=""> 

    <h2><?php echo $action === 'edit' ? 'Editar Cliente' : 'Adicionar Novo Cliente'; ?></h2>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?action=<?php echo $action === 'edit' ? 'update' : 'create'; ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($cliente['id_cliente'] ?? ''); ?>">

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($cliente['nome'] ?? ''); ?>" required>
        <br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($cliente['email'] ?? ''); ?>" required>
        <br>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" placeholder="">
        <br>

        <label for="foto_perfil">Foto do Perfil:</label>
        <div class="InputsLogin FotodePerfil">
            <input type="file" name="foto_perfil" id="foto_perfil">
        </div>
        <?php if (!empty($cliente['foto_perfil'])): ?>
            <br>
            <img src="uploads/<?php echo htmlspecialchars($cliente['foto_perfil']); ?>" alt="Foto de Perfil" width="100">
            <br>
        <?php endif; ?>
        
         <br>

        <label for="id_area">Cidade:</label>
        <div class="box">
            <select name="id_area" id="id_area">
                <option value="">Selecione uma área</option>
            </select>
        </div>
        <br>

        <button type="submit"><?php echo $action === 'edit' ? 'Atualizar Cliente' : 'Adicionar Cliente'; ?></button>
    </form>

    <h2>Lista de Clientes</h2>

    
    <div class="containerbusca">
            <div class="sistemabusca">
                <div class="search-container">
                    <form action="" method="POST" class="search-form">
                        <div class="pesquisarTrabalhos">
                            <input type="text" name="nome_pesquisa" placeholder="O que você está buscando?..." value="<?php echo htmlspecialchars($nome_pesquisa); ?>">
                        </div>
                        <input class="search-button" type="submit" value="Buscar">
                    </form>
                </div>
            </div>
        </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Foto</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $cliente): ?>
                <tr>
                    <td><?php echo htmlspecialchars($cliente['id_cliente']); ?></td>
                    <td><?php echo htmlspecialchars($cliente['nome']); ?></td>
                    <td><?php echo htmlspecialchars($cliente['email']); ?></td>
                    <td><img src="../../uploads/<?php echo htmlspecialchars($cliente['foto_perfil']); ?>" alt="Foto" style="width: 50px;"></td>
                    <td class="actions">
                        <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?action=edit&id=<?php echo $cliente['id_cliente']; ?>" title="Editar">
                            <img src="../../img/editar-arquivo.png" alt="Editar">
                        </a>
                        <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?action=delete&id=<?php echo $cliente['id_cliente']; ?>" title="Excluir" onclick="return confirm('Você tem certeza que deseja excluir?');">
                            <img src="../../img/botao-apagar.png" alt="Excluir">
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script src="../../js/funcaoMenuLateral.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cidadeSelect = document.getElementById('id_area');

            fetch('./getcidades.php')
                .then(response => response.json())
                .then(cidades => {
                    console.log(cidades); 
                    cidadeSelect.innerHTML = '<option value="">Selecione uma área</option>'; 
                    cidades.forEach(cidade => {
                        const option = document.createElement('option');
                        option.value = cidade.id_area; 
                        option.textContent = cidade.cidade; 
                        cidadeSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Erro ao carregar áreas:', error));
        });
    </script>

    <footer class="d-flex justify-content-center ">
        <p>N</p>
        <p>Terms of Service</p>
        <p>Privacy Policy</p>
        <p>@2022yanliudesign</p>
    </footer>
</body>
</html>
