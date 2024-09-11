<?php 
    session_start();
    include_once ('../backend/Conexao.php');
    
    
    if (isset($_SESSION['id_trabalhador'])) {
        $idTrabalhador = $_SESSION['id_trabalhador']; // Pega o ID do trabalhador logado
        
        // Verificar se há erros na conexão
        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }
    
        // Preparar a consulta SQL
        $sql = "SELECT * FROM trabalhador WHERE id_trabalhador = ?";
        $stmt = $conn->prepare($sql); // Preparar a consulta
        if ($stmt === false) {
            die("Erro ao preparar a consulta: " . $conn->error);
        }
    
        // Vincular o parâmetro (i significa integer)
        $stmt->bind_param("i", $idTrabalhador); // "i" indica que o parâmetro é um inteiro
        $stmt->execute(); // Executar a consulta
    
        // Obter o resultado
        $resultado_pesquisar = $stmt->get_result();
    
        // Verificar se encontrou o trabalhador
        if ($resultado_pesquisar->num_rows > 0) {
            $row = $resultado_pesquisar->fetch_assoc();
        } else {
            echo "Trabalhador não encontrado.";
        }
    
        // Fechar o statement
        $stmt->close();
    } else {
        echo "Nenhum trabalhador está logado.";
    }
    
    // Fechar a conexão
?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JundTask - Seu Perfil</title>
    <link rel="stylesheet" href="../css/stylePerfil.css">
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap-grid.min.css">
    <link rel="shortcut icon" href="../img/logo@2x.png" type="image/x-icon">
</head>
<body>
    <header>
        <nav class="BarraNav">
            <img src="../img/LogoJundtaskCompleta.png" alt="Logo JundTask">
            <h1>Seu Perfil</h1>

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
                    <a href="./EditarPerfil.php">
                        <span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
                        <span class="txtLink">Configurações</span>
                    </a>
                </li>
                <li class="itemMenu">
                    <a href="../backend/login/logout.php">
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
                <div class="NomeTrabalhador"> <?php echo $row['nome']; ?></div>
                <!-- <div class="Categoria"><p>Confeiteira</p></div> -->
                <div class="Avaliacao">
                    <ion-icon name="star"></ion-icon>   
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                </div>
                <div class="tel">
                    <p><?php echo $row['contato'];?></p>
                </div>
                <div class="LocaleLikes">
                    <!-- <ion-icon name="location-outline"></ion-icon> -->
                    <ion-icon name="heart-outline"></ion-icon>
                    <p>37K likes</p>
                </div>
            </div>

            <div class="txt">
                <p><?php echo $row['desc'];?></p>
            </div>
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