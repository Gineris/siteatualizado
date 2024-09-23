<?php
session_start(); // Inicia a sessão
include_once('../backend/Conexao.php');

$id_trabalhador = $_GET['id_trabalhador'];

// // Verifica se o usuário está logado
if (!isset($_SESSION['id_trabalhador'])) {
    echo 'Usuário não está logado.';
    exit;
}

// Consulta para obter os dados do trabalhador
$sql = "SELECT * FROM trabalhador WHERE id_trabalhador = '$id_trabalhador'";
$result = $conn->query($sql);
$resultado_pesquisar = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($resultado_pesquisar);

$id_trabalhador_sessao = $_SESSION['id_trabalhador'];

// // Verifica se o usuário está logado
if (!isset($_SESSION['id_trabalhador_sessao'])) {
    echo 'Usuário não está logado.';
    exit;
}

$result_id = "SELECT * FROM trabalhador WHERE id_trabalhador = '$id_trabalhador_sessao'";
$resultado_id = mysqli_query($conn, $result_id);
$row_id = mysqli_fetch_assoc($resultado_id);
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

// Consulta para obter os comentários do trabalhador
$sqlComentarios = " SELECT c.comentario, c.data_comentario, 
                    COALESCE(cl.nome, tw.nome) AS nome_usuario
                    FROM comentarios c
                    LEFT JOIN cliente cl ON c.id_cliente = cl.id_cliente
                    LEFT JOIN trabalhador tw ON c.id_trabalhador = tw.id_trabalhador
                    WHERE c.id_trabalhador = '$id_trabalhador_sessao'";
$resultComentarios = mysqli_query($conn, $sqlComentarios);

if (!$resultComentarios) {
    echo "Erro na consulta: " . mysqli_error($conn);
    exit;
}


?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JundTask - Perfil</title>
    <link rel="stylesheet" href="../css/stylePerfil.css">
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
                <img class="FotoPerfilNav" src="../uploads/<?php echo !empty($row_id['foto_perfil']) ? $row_id['foto_perfil'] : '../img/FotoPerfilGeral.png' ?>" alt="">
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
                    <a href="./favoritos.php">
                        <span class="icon"><ion-icon name="heart-outline"></ion-icon></span>
                        <span class="txtLink">Favoritos</span>
                    </a>
                </li>
                <li class="itemMenu ">
                    <a href="./EditarPerfil.php">
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
        <!-- Exibe os comentários -->
        <?php
            if ($resultComentarios && mysqli_num_rows($resultComentarios) > 0) {
                while ($comentario = mysqli_fetch_assoc($resultComentarios)) {
                    echo '<p><strong>' . htmlspecialchars($comentario['nome_usuario']) . '</strong>: ' . htmlspecialchars($comentario['comentario']) . ' <em>(' . htmlspecialchars($comentario['data_comentario']) . ')</em></p>';
                }
            } else {
                echo '<p>Nenhum comentário encontrado.</p>';
            }
        ?>
    </div>
    
    <form id="comentario" method="POST" action="post_comentario.php">
        <textarea name="comentario" id="comentario" placeholder="Escreva seu comentário" required></textarea>
        <label for="comentario"></label>

        <!-- Campo oculto para passar o id_trabalhador correto -->
        <input type="hidden" name="id_trabalhador_sessao" value="<?php echo $id_trabalhador_sessao; ?>">

        <input type="submit" form="comentario" class="." value="Enviar comentario"/><br>
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