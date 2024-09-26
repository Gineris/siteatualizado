<?php
session_start();
include_once('../../backend/Conexao.php');

$id_cliente = $_SESSION['id_cliente'];

// Consulta para pegar as informações do cliente
$sql = "SELECT * FROM cliente WHERE id_cliente = '$id_cliente'";
$result = $conn->query($sql);
$row = mysqli_fetch_assoc($result);

// Consulta para pegar todas as categorias
$sql_categorias = "SELECT * FROM categorias";
$resultado_categorias = $conn->query($sql_categorias);
?>
<style>
    nav.menuLateral {
        width: 50px;
        height: 300px;
    }
</style>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JundTask - Pesquisar</title>
    <link rel="stylesheet" href="../../css/styleCategoria.css">
    <link rel="stylesheet" href="../../bootstrap-5.3.3-dist/css/bootstrap-grid.min.css">
    <link rel="shortcut icon" href="../../img/logo@2x.png" type="image/x-icon">
</head>
<body>
    <header>
        <nav class="BarraNav">
            <img src="../../img/LogoJundtaskCompleta.png" alt="Logo JundTask">
            <div class="perfil">
                <a href="#">
                <img class="FotoPerfilNav" src="../../uploads/<?php echo !empty($row['foto_perfil']) ? $row['foto_perfil'] : '../img/FotoPerfilGeral.png' ?>" alt="">
                </a>
            </div>
        </nav>
    </header>

    <main> 
    <nav class="menuLateral">
            <div class="IconExpandir">
                <ion-icon name="menu-outline" id="btn-exp"></ion-icon>
            </div>

            <ul style="padding-left: 0rem;">
                <li class="itemMenu ">
                    <a href="./homeClienteLogado.php">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <span class="txtLink">Inicio</span>
                    </a>
                </li>
                <li class="itemMenu">
                    <a href="./EditarPerfilCliente.php">
                        <span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
                        <span class="txtLink">Configurações</span>
                    </a>
                </li>
                <li class="itemMenu ativo">
                    <a href="./Categorias.php">
                        <span class="icon"><ion-icon name="search-outline"></ion-icon></ion-icon></span>
                        <span class="txtLink">Pesquisar</span>
                    </a>
                </li>
                <li class="itemMenu">
                    <a href="./favorito.php">
                        <span class="icon"><ion-icon name="heart-outline"></ion-icon></span>
                        <span class="txtLink">Favoritos</span>
                    </a>
                </li>
                
                <li class="itemMenu">
                    <a href="./LogoutCliente.php">
                        <span class="icon"><ion-icon name="exit-outline"></ion-icon></span>
                        <span class="txtLink">Sair</span>
                    </a>
                </li>
                
            </ul>

        </nav> 

        <h1>Categorias de Trabalhos</h1>

        <div class="container">
            <?php if ($resultado_categorias->num_rows > 0): ?>
                <?php while ($categoria = $resultado_categorias->fetch_assoc()): ?>
                    <div class="card">
                        <a href="usuarios_por_categoria.php?id_categoria=<?= $categoria['id_categoria'] ?>">
                        <img src="../../uploads/categorias/<?= !empty($categoria['imagem']) ? $categoria['imagem'] : 'default.png' ?>" alt="<?= htmlspecialchars($categoria['nome']) ?>">
                            <p><?= htmlspecialchars($categoria['nome']) ?></p>
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Nenhuma categoria disponível.</p>
            <?php endif; ?>
        </div>
    </main>

    <footer class="d-flex justify-content-center">
        <p>N</p>
        <p>Terms of Service</p>
        <p>Privacy Policy</p>
        <p>@2022yanliudesign</p>
    </footer>

    <script src="../../js/funcaoMenuLateral.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="../../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
