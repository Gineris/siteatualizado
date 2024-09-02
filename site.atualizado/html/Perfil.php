<?php
include_once('../backend/php/Conexao.php');

$id_trabalhador = $_GET['id_trabalhador'];

$sql = "SELECT * FROM trabalhador WHERE id_trabalhador = '$id_trabalhador'";
$result = $conn->query($sql);

$resultado_pesquisar = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($resultado_pesquisar); 
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JundTask - Perfil</title>
    <link rel="stylesheet" href="../css/stylePerfil.css">
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap-grid.min.css">
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
                    <a href="#">
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
                    <ion-icon name="heart-outline"></ion-icon>
                    <p>37K likes</p>
                </div>
            </div>

            <div class="txt">
                <?php echo '<p>' . htmlspecialchars($row['desc']) . '</p>' ?>
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
        <textarea id="comment" placeholder="Escreva seu comentário"></textarea>
        <button type="submit">Enviar</button>
    </form>

    <script>
        document.getElementById('reviewForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Impede o envio padrão do formulário

            const rating = document.querySelector('input[name="rating"]:checked').value;
            const comment = document.getElementById('comment').value;

            const data = new FormData();
            data.append('rating', rating);
            data.append('comment', comment);

            fetch('submit_review.php', {
                method: 'POST',
                body: data
            })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
                loadReviews(); // Recarrega os comentários após envio
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        });

        // Função para carregar os comentários
        function loadReviews() {
            fetch('get_reviews.php')
            .then(response => response.json())
            .then(data => {
                const reviewsDiv = document.getElementById('reviews');
                reviewsDiv.innerHTML = '';
                data.reviews.forEach(review => {
                    const reviewElement = document.createElement('div');
                    reviewElement.innerHTML = `<strong>${'★'.repeat(review.rating)}</strong><p>${review.comment}</p>`;
                    reviewsDiv.appendChild(reviewElement);
                });
            });
        }

        // Carregar os comentários ao iniciar a página
        document.addEventListener('DOMContentLoaded', loadReviews);
    </script>

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

</body>
</html>