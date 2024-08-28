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


       


   

    <?php
    // Imprimir a mensagem de erro ou sucesso salvo na sessão
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>

    <!-- Inicio do formulário -->
    <form method="POST" action="processacomentarios.php">

        <div class="estrelas">

            <!-- Carrega o formulário definindo nenhuma estrela selecionada -->
            <input type="radio" name="estrela" id="vazio" value="" checked>

            <!-- Opção para selecionar 1 estrela -->
            <label for="estrela_um"><i class="opcao fa"></i></label>
            <input type="radio" name="estrela" id="estrela_um" id="vazio" value="1">

            <!-- Opção para selecionar 2 estrela -->
            <label for="estrela_dois"><i class="opcao fa"></i></label>
            <input type="radio" name="estrela" id="estrela_dois" id="vazio" value="2">

            <!-- Opção para selecionar 3 estrela -->
            <label for="estrela_tres"><i class="opcao fa"></i></label>
            <input type="radio" name="estrela" id="estrela_tres" id="vazio" value="3">

            <!-- Opção para selecionar 4 estrela -->
            <label for="estrela_quatro"><i class="opcao fa"></i></label>
            <input type="radio" name="estrela" id="estrela_quatro" id="vazio" value="4">

            <!-- Opção para selecionar 5 estrela -->
            <label for="estrela_cinco"><i class="opcao fa"></i></label>
            <input type="radio" name="estrela" id="estrela_cinco" id="vazio" value="5"><br><br>

            <!-- Campo para enviar a mensagem -->
            <textarea name="mensagem" rows="4" cols="30" placeholder="Digite o seu comentário..."></textarea><br><br>

            <!-- Botão para enviar os dados do formulário -->
            <input type="submit" value="Comentar"><br><br>

        </div>

    </form>
    <!-- Fim do formulário -->


    <h1>Avaliações dos Usuários</h1>

    <?php

    // Recuperar as avaliações do banco de dados
    $query_avaliacoes = "SELECT id, qtd_estrela, mensagem 
                        FROM avaliacoes
                        ORDER BY id DESC";

    // Preparar a QUERY
    $result_avaliacoes = $conn->prepare($query_avaliacoes);

    // Executar a QUERY
    $result_avaliacoes->execute();

    // Percorrer a lista de registros recuperada do banco de dados
    while ($row_avaliacao = $result_avaliacoes->fetch(PDO::FETCH_ASSOC)) {
        //var_dump($row_avaliacao);

        // Extrair o array para imprimir pelo nome do elemento do array
        extract($row_avaliacao);

        echo "<p>Avaliação: $id</p>";

        // Criar o for para percorrer as 5 estrelas
        for ($i = 1; $i <= 5; $i++) {

            // Acessa o IF quando a quantidade de estrelas selecionadas é menor a quantidade de estrela percorrida e imprime a estrela preenchida
            if ($i <= $qtd_estrela) {
                echo '<i class="estrela-preenchida fa-solid fa-star"></i>';
            } else {
                echo '<i class="estrela-vazia fa-solid fa-star"></i>';
            }
        }

        echo "<p>Mensagem: $mensagem</p><hr>";
    }
    ?>

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