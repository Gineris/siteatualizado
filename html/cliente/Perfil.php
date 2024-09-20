<?php
session_start(); // Inicia a sessão
include_once('../../backend/Conexao.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['id_cliente'])) {
    echo 'Usuário não está logado.';
    exit;
}

// ID do cliente logado
$id_cliente = $_SESSION['id_cliente'];

// ID do trabalhador a ser visualizado
$id_trabalhador = isset($_GET['id_trabalhador']) ? $_GET['id_trabalhador'] : null;

// Verifica se o ID do trabalhador foi passado
if ($id_trabalhador === null) {
    echo 'ID do trabalhador não fornecido.';
    exit;
}

// Inicializa a variável isFavorito como false
$isFavorito = false;

// Consulta para obter os dados do trabalhador
$sql = "SELECT * FROM trabalhador WHERE id_trabalhador = '$id_trabalhador'";
$resultado_pesquisar = mysqli_query($conn, $sql);

// Verifica se o trabalhador foi encontrado
if ($row = mysqli_fetch_assoc($resultado_pesquisar)) {

    // Consulta para verificar se o trabalhador é favorito
    $sqlFavorito = "SELECT * FROM favoritos WHERE id_trabalhador = '$id_trabalhador' AND id_cliente = '$id_cliente'";
    $resultFavorito = mysqli_query($conn, $sqlFavorito);

    if (mysqli_num_rows($resultFavorito) > 0) {
        $isFavorito = true; // Define como true se o trabalhador for favorito
    }

} else {
    echo 'Trabalhador não encontrado.';
    exit;
}
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
            <img src="../../img/LogoJundtaskCompleta.png" alt="Logo JundTask">
            <h1>Perfil</h1>

            <div class="perfil">
                <a href="#">
                <ion-icon name="person"></ion-icon>
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
                <li class="itemMenu"><a href="./homeClienteLogado.php"><span class="icon"><ion-icon name="home-outline"></ion-icon></span><span class="txtLink">Início</span></a></li>
                <li class="itemMenu ativo"><a href="./Categorias.php"><span class="icon"><ion-icon name="search-outline"></ion-icon></span><span class="txtLink">Pesquisar</span></a></li>
                <li class="itemMenu"><a href="../favoritos.php"><span class="icon"><ion-icon name="heart-outline"></ion-icon></span><span class="txtLink">Favoritos</span></a></li>
                <li class="itemMenu"><a href="./EditarPerfil.html"><span class="icon"><ion-icon name="settings-outline"></ion-icon></span><span class="txtLink">Configurações</span></a></li>
                <li class="itemMenu"><a href="./Logout.php"><span class="icon"><ion-icon name="exit-outline"></ion-icon></span><span class="txtLink">Sair</span></a></li>
            </ul>
        </nav>
        
        <div class="FotoFundo">
            <img src="../../uploads/<?php echo !empty($row['foto_banner']) ? $row['foto_banner'] : '../img/TesteBackPerfil.png' ?>" alt="Banner">
            <div class="BlocoPerfilPrincipal">
                <div class="FotoPerfil">
                    <img src="../../uploads/<?php echo !empty($row['foto_perfil']) ? $row['foto_perfil'] : '../img/images100x100.png' ?>" alt="Perfil">
                </div>
                <div class="NomeTrabalhador">
                    <p><?php echo htmlspecialchars($row['nome']); ?></p>
                </div>
                <div class="Avaliacao">
                    <ion-icon name="star"></ion-icon>   
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                </div>
                <div class="tel">
                    <p>Tel: <?php echo htmlspecialchars($row['contato']); ?></p>
                </div>
            </div>

            <div class="favoritar-container">
                <button id="favoritar-btn" data-id-trabalhador="<?php echo $id_trabalhador; ?>">
                     <i class="bi <?php echo $isFavorito ? 'bi-bookmark-star-fill' : 'bi-bookmark-star'; ?>"></i>
                </button>
             </div>
             
            <div class="txt">
                <p><?php echo htmlspecialchars($row['descricao']); ?></p>
            </div>
        </div>

        <div class="trabalhos">
            <div class="carrousel">
                <div class="col">
                    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="../../uploads/<?php echo !empty($row['foto_trabalho1']) ? $row['foto_trabalho1'] : '../img/avaliacao1.png' ?>" class="d-block w-100 img-fluid" alt="">
                            </div>
                            <div class="carousel-item">
                                <img src="../../uploads/<?php echo !empty($row['foto_trabalho2']) ? $row['foto_trabalho2'] : '../img/avaliacao1.png' ?>" class="d-block w-100 img-fluid" alt="">
                            </div>
                            <div class="carousel-item">
                                <img src="../../uploads/<?php echo !empty($row['foto_trabalho3']) ? $row['foto_trabalho3'] : '../img/avaliacao1.png' ?>" class="d-block w-100 img-fluid" alt="">
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

        <form id="comentario" method="POST" action="post_comentario.php">
            <textarea name="comentario" id="comentario" placeholder="Escreva seu comentário" required></textarea>
            <label for="comentario"></label>
            <input type="hidden" name="id_trabalhador" value="<?php echo $id_trabalhador; ?>" />
            <input type="submit" value="Comentar"/><br>
        </form>
        
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
    <script src="../../js/favoritar.js"></script> 

    <script>
        document.getElementById('favoritar-btn').addEventListener('click', function() {
            var idTrabalhador = this.getAttribute('data-id-trabalhador');
            var isFavorito = this.textContent === 'Favoritar';

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../../html/favoritar.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        document.getElementById('favoritar-btn').textContent = isFavorito ? 'Desfavoritar' : 'Favoritar';
                    } else {
                        alert(response.message);
                    }
                }
            };

            xhr.send('id_trabalhador=' + idTrabalhador + '&isFavorito=' + (isFavorito ? 1 : 0));
        });
    </script>
</body>
</html>
