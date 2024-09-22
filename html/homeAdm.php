<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JundTask - ADM</title>
    <link rel="stylesheet" href="../css/styleADM.css">
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap.min.css">

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

            <ul style="padding-left: 0rem;">
                <li class="itemMenu ativo">
                    <a href="#">
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
                <li class="itemMenu ">
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

        <div class="row me-0 inicioPage d-flex justify-content-center BGblob">
            <div class="col d-flex justify-content-center flex-column ">
                <h1>Seja Bem-vindo(a)! <br> ADM</h1>
                <p>Aqui você poderá administrar seu banco de dados de trabalhadores!</p>
            </div>
            <div class="col me-0 pe-0 imgfundo">
                <img src="../img/boasvindasCliente.png" alt="" >
            </div>
       </div>
       <div class="container">
    <div class="card">
        <a href="./sistemacrudCliente.php" class="card-button">
            <img src="../img/admin-panel (1).png" alt="Imagem do Card" class="card-image">
            <div class="card-content">
                <h2 class="card-title">Gerenciamento Cliente</h2>
            </div>
        </a>
    </div>
    <div class="card">
        <a href="./sistemacrudtrabalhador.php" class="card-button">
            <img src="../img/admin-panel.png" alt="Imagem do Card" class="card-image">
            <div class="card-content">
                <h2 class="card-title">Gerenciamento Trabalhador</h2>
            </div>
        </a>
    </div>
    <div class="card">
        <a href="./sistemacrudCategoria.php" class="card-button">
            <img src="../img/app-settings.png" alt="Imagem do Card" class="card-image">
            <div class="card-content">
                <h2 class="card-title">Adicionar Categorias</h2>
            </div>
        </a>
    </div>
    <div class="card">
        <a href="./Solicitacoes.php" class="card-button">
            <img src="../img/aprovartrabalhadores.png" alt="Imagem do Card" class="card-image">
            <div class="card-content">
                <h2 class="card-title">Verificar solicitações</h2>
            </div>
        </a>
    </div>
</div>

    </main>

    <footer class="d-flex justify-content-center " >
        <p style="margin-bottom: 0rem;">N</p>
        <p style="margin-bottom: 0rem;">Terms of Service</p>
        <p style="margin-bottom: 0rem;">Privacy Policy</p>
        <p style="margin-bottom: 0rem;">@2022yanliudesign</p>
    </footer>
    

    <script src="../js/funcaoMenuLateral.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>