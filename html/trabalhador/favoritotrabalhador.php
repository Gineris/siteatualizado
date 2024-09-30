<?php 
session_start();
include_once('../../backend/Conexao.php');

if (!isset($_SESSION['id_trabalhador'])) {
    echo 'Usuário não está logado.';
    exit;
}

$id_trabalhador = $_SESSION['id_trabalhador'];
$sql_trab = "SELECT * FROM trabalhador WHERE id_trabalhador = '$id_trabalhador'";
$result_trab = $conn->query($sql_trab);
$row_trab = mysqli_fetch_assoc($result_trab);

// Consulta para obter os favoritos, incluindo a categoria
$sql = "SELECT t.*, c.nome AS categoria 
        FROM favoritos f 
        JOIN trabalhador t ON f.id_trabalhador = t.id_trabalhador 
        JOIN categorias c ON t.id_categoria = c.id_categoria 
        WHERE f.id_trabalhador = '$id_trabalhador'";
$resultado_favoritos = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JundTask - Trabalhadores Favoritos</title>
    <link rel="stylesheet" href="../../css/styleFavoritos.css">
    <link rel="stylesheet" href="../../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../../img/logo@2x.png" type="image/x-icon">
</head>
<body>
    <header>
        <nav class="BarraNav">
            <img src="../../img/LogoJundtaskCompleta.png" alt="Logo JundTask">
            <div class="perfil">
                <a href="#">
                <img class="FotoPerfil" src="../../uploads/<?php echo !empty($row_trab['foto_perfil']) ? $row_trab['foto_perfil'] : '../../img/FotoPerfilGeral.png' ?>" alt="">
                </a>
            </div>
        </nav>
    </header>

    <main> 
        <nav class="menuLateral">
            <ul style="padding-left: 0rem;">
                <li class="itemMenu">
                    <a href="homeTrabalhadorLogado.php">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <span class="txtLink">Inicio</span>
                    </a>
                </li>
                <li class="itemMenu ativo">
                    <a href="favorito.php">
                        <span class="icon"><ion-icon name="heart-outline"></ion-icon></span>
                        <span class="txtLink">Favoritos</span>
                    </a>
                </li>
                <li class="itemMenu">
                    <a href="LogoutTrabalhador.php">
                        <span class="icon"><ion-icon name="exit-outline"></ion-icon></span>
                        <span class="txtLink">Sair</span>
                    </a>
                </li>
            </ul>
        </nav> 
        
        <div class="resultado">
            <h1 class="mb-4">Trabalhadores Favoritos</h1>
            <div class="usuario">
                <?php
                if (mysqli_num_rows($resultado_favoritos) > 0) {
                    while($row = mysqli_fetch_assoc($resultado_favoritos)) {?> 
                        <div class="CampoEscolhaTrabalhador">
                            <a href="./Perfil.php?id_trabalhador=<?php echo $row['id_trabalhador']; ?>">
                                <div class="CardBox"> 
                                    <div class="imagem">
                                        <img src="../../uploads/<?php echo $row['foto_perfil']; ?>" alt="">
                                    </div>
                                    <div class="txtTrabalhador">
                                        <h3><?php echo htmlspecialchars($row['nome']); ?></h3>
                                        <p style="margin-bottom:0rem"><?php echo htmlspecialchars($row['categoria']); ?></p>
                                        <p style="margin-bottom:0rem"><?php echo htmlspecialchars($row['media_avaliacao']); ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php }
                } else {
                    echo '<div class="tituloDEnaoEncontrado">';
                    echo '<p>Nenhum trabalhador favoritado</p>';
                    echo '</div>';
                }    
                ?>
            </div>
        </div>
    </main>
   
    <script src="../../js/funcaoMenuLateral.js"></script>
    <script src="../../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
