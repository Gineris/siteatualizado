<?php
    session_start();
    include_once('../backend/php/Conexao.php');

    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true))
    {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: login.php');
    }

    $logado = $_SESSION['email'];

?>


<!-- <!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JundTask - Seu perfil</title>
    <link rel="stylesheet" href="../css/stylePerfilcliente.css">
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap-grid.min.css">
    <link rel="shortcut icon" href="../img/logo@2x.png" type="image/x-icon">
</head>
<body>
    <header>
        <nav class="BarraNav">
            <img src="../img/LogoJundtaskCompleta.png" alt="Logo JundTask">
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
                    <a href="#">
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
        
        <div class="FotoFundo"> -->
            <!-- foto background -->
            <!-- <div class="BlocoPerfilPrincipal">
                <div class="FotoPerfil"><img src="../img/FotoTesteMuie.png" alt=""></div>
                <div class="NomeTrabalhador"><p>Gionava Neiers</p></div>
                <div class="Categoria"><p>Confeiteira</p></div>
                <div class="Avaliacao">
                    <ion-icon name="star"></ion-icon>   
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                </div>
                <div class="LocaleLikes">
                    <ion-icon name="location-outline"></ion-icon>
                    <p>Jundiai</p>
                    <ion-icon name="heart-outline"></ion-icon>
                    <p>37K likes</p>
                </div>
            </div>

            <div class="txt">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, commodi numquam, iusto in minus eum quibusdam neque deserunt dignissimos veniam assumenda reiciendis explicabo autem veritatis, omnis blanditiis quae molestias obcaecati.</p>
            </div>
        </div> -->






        <form method="POST" action="processacomentario.php">
    <div class="estrelas">
        <input type="radio" name="estrela" id="vazio" value="" checked>
        <label for="estrela_um"><i class="opcao fa"></i></label>
        <input type="radio" name="estrela" id="estrela_um" value="1">
        <label for="estrela_dois"><i class="opcao fa"></i></label>
        <input type="radio" name="estrela" id="estrela_dois" value="2">
        <label for="estrela_tres"><i class="opcao fa"></i></label>
        <input type="radio" name="estrela" id="estrela_tres" value="3">
        <label for="estrela_quatro"><i class="opcao fa"></i></label>
        <input type="radio" name="estrela" id="estrela_quatro" value="4">
        <label for="estrela_cinco"><i class="opcao fa"></i></label>
        <input type="radio" name="estrela" id="estrela_cinco" value="5">
        <br><br>
        <textarea name="mensagem" rows="4" cols="30" placeholder="Digite o seu comentário..."></textarea><br><br>
        <input type="submit" value="Comentar"><br><br>
    </div>
</form>

<div id="comentarios">
    <!-- Os comentários serão adicionados aqui -->
</div>

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