<?php
include_once('../backend/Conexao.php'); // Incluindo o arquivo de conexão

// Verifica se uma ação foi solicitada
$action = $_GET['action'] ?? '';
$id = $_GET['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Adicionar ou atualizar cliente
    if ($action === 'create' || $action === 'update') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'] ? password_hash($_POST['senha'], PASSWORD_DEFAULT) : ''; // Atualizar senha se fornecida
        $foto_perfil = $_POST['foto_perfil'];
        $tipo = $_POST['tipo'];
        $status = $_POST['status'];
        $id_area = $_POST['id_area'];

        if ($action === 'create') {
            $sql = "INSERT INTO cliente (nome, email, senha, foto_perfil, tipo, status, id_area) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nome, $email, $senha, $foto_perfil, $tipo, $status, $id_area]);
        } elseif ($action === 'update' && $id) {
            $sql = "UPDATE cliente SET nome = ?, email = ?, senha = ?, foto_perfil = ?, tipo = ?, status = ?, id_area = ? WHERE id_cliente = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nome, $email, $senha, $foto_perfil, $tipo, $status, $id_area, $id]);
        }

        header('Location: sistemacrudCliente.php');
        exit();
    }
}

// Excluir cliente
if ($action === 'delete' && $id) {
    $sql = "DELETE FROM cliente WHERE id_cliente = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    header('Location: sistemacrudCliente.php');
    exit();
}

// Buscar cliente para edição
$cliente = [];
if ($action === 'edit' && $id) {
    $sql = "SELECT * FROM cliente WHERE id_cliente = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Listar todos os clientes
$sql = "SELECT * FROM cliente";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Clientes</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Gerenciar Clientes</h1>
    
    <!-- Formulário para adicionar ou editar cliente -->
    <h2><?php echo $action === 'edit' ? 'Editar Cliente' : 'Adicionar Novo Cliente'; ?></h2>
    <form action="sistemacrudCliente.php?action=<?php echo $action === 'edit' ? 'update' : 'create'; ?>" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($cliente['id_cliente'] ?? ''); ?>">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($cliente['nome'] ?? ''); ?>" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($cliente['email'] ?? ''); ?>" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" placeholder="Deixe em branco para não alterar">
        <br>
        <label for="foto_perfil">Foto do Perfil:</label>
        <input type="text" id="foto_perfil" name="foto_perfil" value="<?php echo htmlspecialchars($cliente['foto_perfil'] ?? ''); ?>">
        <br>
        <label for="tipo">Tipo:</label>
        <input type="text" id="tipo" name="tipo" value="<?php echo htmlspecialchars($cliente['tipo'] ?? ''); ?>" required>
        <br>
        <label for="status">Status:</label>
        <input type="text" id="status" name="status" value="<?php echo htmlspecialchars($cliente['status'] ?? ''); ?>" required>
        <br>
        <label for="id_area">ID da Área:</label>
        <input type="number" id="id_area" name="id_area" value="<?php echo htmlspecialchars($cliente['id_area'] ?? ''); ?>" required>
        <br>
        <button type="submit"><?php echo $action === 'edit' ? 'Atualizar Cliente' : 'Adicionar Cliente'; ?></button>
    </form>
    
    <!-- Lista de clientes -->
    <h2>Lista de Clientes</h2>
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
                    <td><img src="<?php echo htmlspecialchars($cliente['foto_perfil']); ?>" alt="Foto" style="width: 50px;"></td>
                    <td>
                        <a href="sistemacrudCliente.php?action=edit&id=<?php echo $cliente['id_cliente']; ?>">Editar</a>
                        <a href="sistemacrudCliente.php?action=delete&id=<?php echo $cliente['id_cliente']; ?>" onclick="return confirm('Você tem certeza que deseja excluir?');">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

