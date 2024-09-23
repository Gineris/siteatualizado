<?php
session_start();
include_once('../../backend/Conexao.php');

// Pegar o id_categoria da URL (via GET)
$id_categoria = $_GET['id_categoria'];

if (!is_numeric($id_categoria)) {
    die("ID da categoria inválido.");
}

// Consulta para obter todos os trabalhadores da categoria selecionada, ordenados por curtidas
$query = "
    SELECT t.*, COUNT(c.id_trabalhador) AS total_curtidas 
    FROM trabalhador t 
    LEFT JOIN curtidas c ON t.id_trabalhador = c.id_trabalhador 
    WHERE t.id_categoria = $id_categoria 
    GROUP BY t.id_trabalhador 
    ORDER BY total_curtidas DESC
";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Erro na consulta: " . mysqli_error($conn));
}
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
    <link rel="stylesheet" href="../../css/stylebusca.css">
    <link rel="stylesheet" href="../../bootstrap-5.3.3-dist/css/bootstrap-grid.min.css">
    <link rel="shortcut icon" href="../../img/logo@2x.png" type="image/x-icon">
</head>
<body>
<header>
    <nav class="BarraNav">
        <img src="../../img/LogoJundtaskCompleta.png" alt="Logo JundTask">
        <div class="perfil">
            <a href="#">
                <img class="FotoPerfilNav" src="../../uploads/<?php echo !empty($row['foto_perfil']) ? htmlspecialchars($row['foto_perfil']) : '../../img/FotoPerfilGeral.png'; ?>" alt="Perfil">
            </a>
        </div>
    </nav>
</header>

<nav class="menuLateral">
    <div class="IconExpandir">
        <ion-icon name="menu-outline" id="btn-exp"></ion-icon>
    </div>
    <ul style="padding-left: 0rem;">
        <li class="itemMenu ativo">
            <a href="homeClienteLogado.php">
                <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                <span class="txtLink">Início</span>
            </a>
        </li>
        <li class="itemMenu">
            <a href="EditarPerfilCliente.php">
                <span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
                <span class="txtLink">Configurações</span>
            </a>
        </li>
        <li class="itemMenu">
            <a href="Categorias.php">
                <span class="icon"><ion-icon name="search-outline"></ion-icon></span>
                <span class="txtLink">Pesquisar</span>
            </a>
        </li>
        <li class="itemMenu">
            <a href="favorito.php">
                <span class="icon"><ion-icon name="heart-outline"></ion-icon></span>
                <span class="txtLink">Favoritos</span>
            </a>
        </li>
        <li class="itemMenu">
            <a href="LogoutCliente.php">
                <span class="icon"><ion-icon name="exit-outline"></ion-icon></span>
                <span class="txtLink">Sair</span>
            </a>
        </li>
    </ul>
</nav>

<div class="worker-list">
    <?php
    // Verifica se há resultados e exibe os dados ou uma mensagem de erro
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {?> 
            <div class="CampoEscolhaTrabalhador">
                <a href="./Perfil.php?id_trabalhador=<?php echo $row['id_trabalhador']; ?>">
                    <div class="CardBox"> 
                        <div class="imagem">
                            <img src="../uploads/<?php echo $row['foto_perfil']; ?>" alt="">
                        </div>
                        <div class="txtTrabalhador">
                            <h3><?php echo htmlspecialchars($row['nome']); ?></h3>
                            <p><?php echo htmlspecialchars($row['media_avaliacao']); ?></p>
                            <p>Curtidas: <?php echo htmlspecialchars($row['total_curtidas']); ?></p>
                        </div>
                    </div>
                </a>
            </div>
        <?php 
        }
    } else {
        echo '<div class="tituloDEnaoEncontrado">';
        echo '<p>Trabalhador não encontrado</p>';
        echo '</div>';
    }
    ?>
</div>

<footer class="d-flex justify-content-center ">
    <p>N</p>
    <p>Terms of Service</p>
    <p>Privacy Policy</p>
    <p>@2022yanliudesign</p>
</footer>

<script src="../js/funcaoMenuLateral.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php 
$conn->close(); 
?>
