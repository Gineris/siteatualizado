<?php
session_start();
include_once ('../../backend/Conexao.php');
$id_cliente = $_SESSION['id_cliente'];

$sql = "SELECT * FROM cliente WHERE id_cliente = '$id_cliente'";
$result = $conn->query($sql);

$resultado_pesquisar = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($resultado_pesquisar);

// Defina as categorias com IDs e imagens estáticas
$categorias = [
    ['id' => 1, 'nome' => 'Serviços Domésticos', 'imagem' => 'servico-de-limpeza.png'],
    ['id' => 2, 'nome' => 'Reparos e manutenção', 'imagem' => 'manutencao.png'],
    ['id' => 3, 'nome' => 'Serviços Tecnológicos', 'imagem' => 'servicos-digitais.png'],
    ['id' => 4, 'nome' => 'Restaurante', 'imagem' => 'restaurante.png'],
    ['id' => 5, 'nome' => 'Confeitaria', 'imagem' => 'bolo.png'],
    ['id' => 6, 'nome' => 'Serviços para Eventos e Festa', 'imagem' => 'festa-de-aniversario.png'],
    ['id' => 7, 'nome' => 'Saúde e Beleza', 'imagem' => 'secador-de-cabelo.png'],
    ['id' => 8, 'nome' => 'Assessoria Judicial', 'imagem' => 'judicial.png'],
    ['id' => 9, 'nome' => 'Educação e Aulas particulares', 'imagem' => 'educacao.png'],
    ['id' => 10, 'nome' => 'Serviços Automotivos', 'imagem' => 'servico-automotivo.png'],
    ['id' => 11, 'nome' => 'Artesanato', 'imagem' => 'artesanato.png'],
];

?>
<style>
    nav.menuLateral{
    width: 65px;
    height: 370px;
    }
</style>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JundTask - Pesquisar</title>
    <link rel="stylesheet" href="../../css/styleCategoria.css">
    <link rel="stylesheet" href="../../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../../img/logo@2x.png" type="image/x-icon">
    
</head>
<body>
    <header>
        <nav class="BarraNav">
            <img src="../../img/LogoJundtaskCompleta.png" alt="Logo JundTask">
            <div class="perfil">
                <a href="#">
                <img class="FotoPerfilNav" src="../../uploads/<?php echo !empty($row['foto_perfil']) ? $row['foto_perfil'] : '../../img/FotoPerfilGeral.png' ?>" alt="">
                </a>
            </div>
        </nav>
    </header>

    <main class=""> 
        
        <nav class="menuLateral">
            <div class="IconExpandir">
                <ion-icon name="menu-outline" id="btn-exp"></ion-icon>
            </div>

            <ul style="padding-left: 0rem;">
                <li class="itemMenu">
                    <a href="./homeClienteLogado.php">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <span class="txtLink">Inicio</span>
                    </a>
                </li>
                <li class="itemMenu ">
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
                    <a href="#">
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
    <?php foreach ($categorias as $categoria): ?>
        <div class="card" style="background-color: #f0f0f0;border-radius: 20px;">
            <a href="usuarios_por_categoria.php?id_categoria=<?= $categoria['id'] ?>">
                <img src="../../img/<?= $categoria['imagem'] ?>" alt="<?= $categoria['nome'] ?>">
                <p><?= $categoria['nome'] ?></p>
            </a>
        </div>
    <?php endforeach; ?>
</div>
    
</div>
    </main>

    <footer class="d-flex justify-content-center ">
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