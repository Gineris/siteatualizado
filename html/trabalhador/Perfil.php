<?php
session_start();
include_once('../../backend/Conexao.php');

$id_trabalhador = $_GET['id_trabalhador']; // Trabalhador da página

// Verifica se o usuário está logado
if (!isset($_SESSION['id_trabalhador'])) {
    header('Location: loginGeral.php');
    exit();
}

$id_trabalhador_sessao = $_SESSION['id_trabalhador']; // Trabalhador logado

// Inicializa as variáveis isFavorito e hasLiked
$isFavorito = false;
$hasLiked = false;

// Consulta para obter os dados do trabalhador
$sql = "SELECT * FROM trabalhador WHERE id_trabalhador = '$id_trabalhador'";
$resultado_pesquisar = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($resultado_pesquisar);

// if ($row = mysqli_fetch_assoc($resultado_pesquisar)) {
//     // Verifica se o trabalhador é favorito
//     $sqlFavorito = "SELECT * FROM favoritos WHERE id_trabalhador = '$id_trabalhador_sessao' AND id_trabalhador_favorito = '$id_trabalhador'";
//     $resultFavorito = mysqli_query($conn, $sqlFavorito);
//     if (mysqli_num_rows($resultFavorito) > 0) {
//         $isFavorito = true;
//     }

//     // Consulta para contar as curtidas
//     $sqlCurtidas = "SELECT COUNT(*) as total_curtidas FROM curtidas WHERE id_trabalhador_curtiu = '$id_trabalhador'";
//     $resultCurtidas = mysqli_query($conn, $sqlCurtidas);
//     $rowCurtidas = mysqli_fetch_assoc($resultCurtidas);
//     $totalCurtidas = $rowCurtidas['total_curtidas'];

//     // Verifica se o trabalhador foi curtido pelo trabalhador logado
//     $sqlLike = "SELECT * FROM curtidas WHERE id_trabalhador = '$id_trabalhador_sessao' AND id_trabalhador_curtiu = '$id_trabalhador'";
//     $resultLike = mysqli_query($conn, $sqlLike);
//     if (mysqli_num_rows($resultLike) > 0) {
//         $hasLiked = true;
//     }
//     } else {
//         echo 'Trabalhador não encontrado.';
//         exit;
//     }

// Consulta para obter os dados do trabalhador logado
$sql_id = "SELECT * FROM trabalhador WHERE id_trabalhador = '$id_trabalhador_sessao'";
$resultado_id = mysqli_query($conn, $sql_id);
$row_id = mysqli_fetch_assoc($resultado_id);
?>
<style>
    nav.menuLateral{
    width: 65px;
    height: 380px;
    }
</style>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JundTask - Perfil</title>
    <link rel="stylesheet" href="../../css/stylePerfil.css">
    <link rel="stylesheet" href="../../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="../../img/logo@2x.png" type="image/x-icon">
</head>
<body>
    <header>
        <nav class="BarraNav">
            <img src="../../img/LogoJundtaskCompleta.png" alt="Logo JundTask">
            <h1>Perfil</h1>
            <div class="perfil">
                <img class="FotoPerfilNav" src="../../uploads/<?php echo !empty($row_id['foto_perfil']) ? $row_id['foto_perfil'] : '../../img/FotoPerfilGeral.png' ?>" alt="">
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
                    <a href="./homeLogado.php">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <span class="txtLink">Inicio</span>
                    </a>
                </li>
                <li class="itemMenu">
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
            <img src="../../uploads/<?php echo !empty($row['foto_banner']) ? $row['foto_banner'] : '../img/TelaPredefinida.png' ?>" alt="Banner">
            <div class="BlocoPerfilPrincipal">
                <div class="FotoPerfil">
                    <img src="../../uploads/<?php echo !empty($row['foto_perfil']) ? $row['foto_perfil'] : '../img/images100x100.png' ?>" alt="Perfil">
                </div>
                <div class="NomeTrabalhador">
                    <p><?php echo htmlspecialchars($row['nome']); ?></p>
                </div>
                <div class="tel">
                    <p>Tel: <?php echo htmlspecialchars($row['contato']); ?></p>
                </div>
            </div>
            <div class="txt">
                <p><?php echo htmlspecialchars($row['descricao']); ?></p>
            </div>
        </div>

        <div class="trabalhos">
            <div class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../../uploads/<?php echo !empty($row['foto_trabalho1']) ? $row['foto_trabalho1'] : '../../img/TelaPredefinidaTrabalhos1.png' ?>" class="d-block w-100 img-fluid" alt="">
                    </div>
                    <div class="carousel-item">
                        <img src="../../uploads/<?php echo !empty($row['foto_trabalho2']) ? $row['foto_trabalho2'] : '../../img/TelaPredefinidaTrabalhos2.png' ?>" class="d-block w-100 img-fluid" alt="">
                    </div>
                    <div class="carousel-item">
                        <img src="../../uploads/<?php echo !empty($row['foto_trabalho3']) ? $row['foto_trabalho3'] : '../../img/TelaPredefinidaTrabalhos3.png' ?>" class="d-block w-100 img-fluid" alt="">
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

        
    </main>

    <footer class="d-flex justify-content-center">
        <p>Terms of Service</p>
        <p>Privacy Policy</p>
        <p>@2022yanliudesign</p>
    </footer>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="../../js/funcaoMenuLateral.js"></script>
    <script src="../../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const likeBtn = document.getElementById('likeBtn');
        const likeCount = document.getElementById('likeCount');
        let hasLiked = <?php echo json_encode($hasLiked); ?>;
        let count = <?php echo $totalCurtidas; ?>;

        likeBtn.addEventListener('click', function() {
            const trabalhadorId = <?php echo $id_trabalhador; ?>;

            if (!hasLiked) {
                count++;
                likeCount.textContent = count + " Likes";
                likeBtn.innerHTML = '<i class="bi bi-heart-fill"></i> Descurtir';
                hasLiked = true;

                fetch('curtir.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id: trabalhadorId, action: 'curtir' })
                });
            } else {
                count--;
                likeCount.textContent = count + " Likes";
                likeBtn.innerHTML = '<i class="bi bi-heart"></i> Curtir';
                hasLiked = false;

                fetch('curtir.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id: trabalhadorId, action: 'descurtir' })
                });
            }
        });

        document.getElementById('favoritarBtn').addEventListener('click', function() {
    const idTrabalhador = this.getAttribute('data-id');

    fetch('favoritos_action.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id_trabalhador: idTrabalhador })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            this.textContent = this.textContent.includes('Adicionar') ? 'Remover dos Favoritos' : 'Adicionar aos Favoritos';
        } else {
            alert(data.message); // Mostra mensagem de erro
        }
    })
    .catch(error => console.error('Erro ao processar favoritos:', error));
});

    </script>
</body>
</html>
