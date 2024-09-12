<?php
include_once('../backend/Conexao.php');

// include_once('../html/registerTrabalhador.php');

$id_trabalhador = $_GET['id_trabalhador'];

$sql = "SELECT * FROM trabalhador WHERE id_trabalhador = '$id_trabalhador'";
$result = $conn->query($sql);

$resultado_pesquisar = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($resultado_pesquisar);


//verifica se o trabalhador esta logado para fazer o comentario
// session_start();
// require '../backend/Conexao.php';

// if (!isset($_SESSION['id_trabalhador'])) {
//     header('Location: login.php');
//     exit();
// }

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $comentario = $_POST['comentario'];
//     $id_trabalhador = $_SESSION['id_trabalhador'];
// }

// //cliente
// if (!isset($_SESSION['id_cliente'])) {
//     header('Location: login.php');
//     exit();
// }

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $comentario = $_POST['comentario'];
//     $id_cliente = $_SESSION['id_cliente'];
// }
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JundTask - Perfil</title>
    <link rel="stylesheet" href="../css/stylePerfil.css">
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap-grid.min.css">
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

            <ul>
                <li class="itemMenu">
                    <a href="./homeLogado.php">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <span class="txtLink">Inicio</span>
                    </a>
                </li>
                <li class="itemMenu ativo">
                    <a href="./Categorias.php">
                        <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                        <span class="txtLink">Perfil</span>
                    </a>
                </li>
                <li class="itemMenu">
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
                    <a href="#">
                        <span class="icon"><ion-icon name="exit-outline"></ion-icon></span>
                        <span class="txtLink">Sair</span>
                    </a>
                </li>
                
            </ul>

        </nav>
        
        <div class="FotoFundo">
            <!-- foto background -->
            <div class="BlocoPerfilPrincipal">
                <div class="FotoPerfil"><img src="../img/FotoTesteMuie.png" alt=""></div>
                <div class="NomeTrabalhador"><?php echo '<p>' . htmlspecialchars($row['nome']) . '</p>'?></div>
                <!-- <div class="Categoria"><p>Confeiteira</p></div> -->
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
                <div class="LocaleLikes">
                    <!-- <ion-icon name="location-outline"></ion-icon> -->
                    <i class="bi bi-heart" id="curtida" onclick="curtir()"></i>
                    <?php
                        // echo "<p>Curtidas: <span id='curtidas'>{$trabalhador['curtidas']}</span></p>";
                        // echo "<button onclick='curtirPerfil({$trabalhador['id']})'>Curtir</button>";
                    ?>
                </div>
            </div>

            <div class="txt">
                <?php echo '<p>' . htmlspecialchars($row['descricao']) . '</p>' ?>
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
        <textarea name="comment" id="comment" placeholder="Escreva seu comentário" required></textarea>
        <label for="comment"></label>

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