<?php
session_start();
include_once('../../backend/Conexao.php');

// Buscar atualizações pendentes
$sql = "SELECT * FROM atualizacoes_pendentes WHERE aprovado = 0";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Solicitações</title>
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
<body>

<h1>Solicitações de Atualizações Pendentes</h1>

<?php if ($result->num_rows > 0): ?>
    <table border="1">
        <thead>
            <tr>
                <th>ID Trabalhador</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Contato</th>
                <th>Data de Nascimento</th>
                <th>Descrição</th>
                <th>Área</th>
                <th>Categoria</th>
                <th>Fotos</th>
                <th>Aprovar/Rejeitar</th>
                
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id_trabalhador'] ?></td>
                <td><?= $row['nome'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['contato'] ?></td>
                <td><?= $row['data_nasc'] ?></td>
                <td><?= $row['descricao'] ?></td>
                <td><?= $row['id_area'] ?></td>
                <td><?= $row['id_categoria'] ?></td>
                <td>
                    <?php if (!empty($row['foto_perfil'])): ?>
                        <img src="../../uploads/<?= $row['foto_perfil'] ?>" width="50">
                    <?php endif; ?>
                    <?php if (!empty($row['foto_trabalho1'])): ?>
                        <img src="../../uploads/<?= $row['foto_trabalho1'] ?>" width="50">
                    <?php endif; ?>
                    <?php if (!empty($row['foto_trabalho2'])): ?>
                        <img src="../../uploads/<?= $row['foto_trabalho2'] ?>" width="50">
                    <?php endif; ?>
                    <?php if (!empty($row['foto_trabalho3'])): ?>
                        <img src="../../uploads/<?= $row['foto_trabalho3'] ?>" width="50">
                    <?php endif; ?>
                    <?php if (!empty($row['foto_banner'])): ?>
                        <img src="../../uploads/<?= $row['foto_banner'] ?>" width="50">
                    <?php endif; ?>
                </td>
                <td>
                    <form action="../backend/aprovar_rejeitar.php" method="POST">
                        <input type="hidden" name="id_atualizacao" value="<?php echo $row['id_atualizacoes_pendentes']; ?>">
                        <button type="submit" name="acao" value="aprovar">Aprovar</button>
                        <button type="submit" name="acao" value="rejeitar">Rejeitar</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Não há atualizações pendentes.</p>
<?php endif; ?>

</body>
</html>

<?php
$conn->close();
?>
