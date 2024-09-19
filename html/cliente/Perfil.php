<?php
session_start(); // Inicia a sessão
include_once('../../backend/Conexao.php');


$id_cliente = $_SESSION['id_cliente'];  

// // Verifica se o usuário está logado
if (!isset($_SESSION['id_cliente'])) {
    echo 'Usuário não está logado.';
    exit;
}

// $id_cliente = $_SESSION['id_cliente']; // Use o ID do cliente
//cu

// $id_trabalhador = isset($_GET['id_trabalhador']) ? $_GET['id_trabalhador'] : null;

// if ($id_trabalhador === null) {
//     echo 'ID do trabalhador não fornecido.';
//     exit;
// }

// // Verifica se o usuário está logado
// if (!isset($_SESSION['tipo_usuario'])) {
//     echo 'Usuário não está logado.';
//     exit;
// }

// $id_cliente = isset($_SESSION['id_cliente']) ? $_SESSION['id_cliente'] : null; // Use o ID do cliente
// $id_trabalhador = isset($_SESSION['id_trabalhador']) ? $_SESSION['id_trabalhador'] : null; // Use o ID do trabalhador

// Consulta para obter os dados do trabalhador
$sql = "SELECT * FROM trabalhador WHERE id_trabalhador = '$id_trabalhador'";
$result = $conn->query($sql);
$resultado_pesquisar = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($resultado_pesquisar);

// $isFavorito = false; // Inicializa como false
// if ($row) {
//     // Verifica se o trabalhador é favorito
//     $sqlFavorito = "SELECT * FROM favoritos WHERE id_trabalhador = '$id_trabalhador' AND id_cliente = '$id_cliente'";
//     $resultFavorito = $conn->query($sqlFavorito);
//     $isFavorito = mysqli_num_rows($resultFavorito) > 0; // true se for favorito, false caso contrário
// } else {
//     echo 'Trabalhador não encontrado.';
//     exit; // Sai do script se não encontrar o trabalhador
// }




?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JundTask - Perfil</title>
    <link rel="stylesheet" href="../../css/stylePerfil.css">
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="../img/logo@2x.png" type="image/x-icon">
</head>
<body>
    <header>
        <nav class="BarraNav">
            <img src="../img/LogoJundtaskCompleta.png" alt="Logo JundTask">
            <h1>Perfil</h1>

            <div class="perfil">
                <a href="#">
                <ion-icon name="person"></ion-icon>
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
                    <a href="./homeLogado.php">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <span class="txtLink">Inicio</span>
                    </a>
                </li>
                <li class="itemMenu ">
                    <a href="./SeuPerfil.php">
                        <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                        <span class="txtLink">Perfil</span>
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
                <li class="itemMenu ">
                    <a href="./EditarPerfil.html">
                        <span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
                        <span class="txtLink">Configurações</span>
                    </a>
                </li>
                <li class="itemMenu">
                    <a href="./Logout.php">
                        <span class="icon"><ion-icon name="exit-outline"></ion-icon></span>
                        <span class="txtLink">Sair</span>
                    </a>
                </li>
                
            </ul>

        </nav>
        
        <div class="FotoFundo">
            <!-- foto background -->
            <img src="../uploads/<?php echo !empty($row['foto_banner']) ? $row['foto_banner'] : '../img/TesteBackPerfil.png' ?>" alt="">
            <div class="BlocoPerfilPrincipal">
                <div class="FotoPerfil"><img src="../uploads/<?php echo !empty($row['foto_perfil']) ? $row['foto_perfil'] : '../img/images100x100.png' ?>" alt=""></div>
                <div class="NomeTrabalhador"><?php echo '<p>' . htmlspecialchars($row['nome']) . '</p>'?></div>
                <div class="Avaliacao">
                    <ion-icon name="star"></ion-icon>   
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                </div>
                <div class="tel">
                    <?php echo '<p> Tel: ' . htmlspecialchars($row['contato']) . '</p>' ?>
                </div>
                <button class="favorite-btn" data-id="<?php echo $row['id_trabalhador']; ?>">
                    <?php if ($isFavorito): ?>
                     <i class="bi bi-heart-fill favorite-icon"></i>
                    <?php else: ?>
                     <i class="bi bi-heart favorite-icon"></i>
                    <?php endif; ?>
                </button>


            </div>

            <div class="txt">
                <?php echo '<p>' . htmlspecialchars($row['descricao']) . '</p>' ?>
            </div>
        </div>
        <div class="trabalhos">
                <div class="carrousel">
                <div class="col">
                        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active ">
                                <img src="../uploads/<?php echo !empty($row['foto_trabalho1']) ? $row['foto_trabalho1'] : '../img/avaliacao1.png' ?>" class="d-block w-100 img-fluid" alt="">
                                </div>
                                <div class="carousel-item">
                                    <img src="../uploads/<?php echo !empty($row['foto_trabalho2']) ? $row['foto_trabalho2'] : '../img/avaliacao1.png' ?>" class="d-block w-100 img-fluid" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="../uploads//<?php echo !empty($row['foto_trabalho3']) ? $row['foto_trabalho3'] : '../img/avaliacao1.png' ?>" class="d-block w-100 img-fluid" alt="...">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
        </div>


        <h1>Comentários e Avaliações</h1>

    <div id="reviews">
        <!-- Comentários e avaliações serão carregados aqui -->
    </div>

    <form id="reviewForm">
        <div class="star-rating">
            <input type="radio" id="star5" name="rating" value="5"><label for="star5" title="5 stars">&#9733;</label>
            <input type="radio" id="star4" name="rating" value="4"><label for="star4" title="4 stars">&#9733;</label>
            <input type="radio" id="star3" name="rating" value="3"><label for="star3" title="3 stars">&#9733;</label>
            <input type="radio" id="star2" name="rating" value="2"><label for="star2" title="2 stars">&#9733;</label>
            <input type="radio" id="star1" name="rating" value="1"><label for="star1" title="1 star">&#9733;</label>
        </div>
    </form>

    <!-- <form method="POST" action="post_comment.php">
    <textarea name="conteudo" placeholder="Escreva seu comentário..." required></textarea><br>
    <button type="submit">Comentar</button>
    </form> -->
    
    <form id="comentario" method="POST" action="post_comentario.php">
        <textarea name="comentario" id="comentario" placeholder="Escreva seu comentário" required></textarea>
        <label for="comentario"></label>

        <input type="submit" form="comentario" class="." value="Enviar Comentário"/><br><br>
    </form>
    
    </main>     

    

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

    <script src="../js/FuncaoCurtirPerfil.js"></script>

</body>
</html>