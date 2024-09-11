<?php



?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JundTask - Editar Pefil</title>
    <link rel="stylesheet" href="../css/styleEditarPerfil.css">
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap-grid.min.css">
    <link rel="shortcut icon" href="../img/logo@2x.png" type="image/x-icon">
</head>
<body>
    <header>
        <nav class="BarraNav">
            <img src="../img/LogoJundtaskCompleta.png" alt="Logo JundTask">
            <h1>Editar Perfil</h1>
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
                <li class="itemMenu">
                    <a href="./SeuPerfil.html">
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
                <li class="itemMenu ativo">
                    <a href="#">
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
        

                <div class="row me-0 mb-5 topoPerfil">
                    <div class="col-1 sucess imgPerfil" >
                        <img src="../img/images100x100.png" alt="Foto de perfil">
                </div>
                <div class="col txtPerfil d-flex flex-column justify-content-center">
                    <h3 >Nome</h3>
                    <p>Descrição</p>
                </div>
            </div>

            <div class="row me-0 ">
                <div class="col coluna1 ">
                    <div class="EstiloInputs">
                        <input type="text" name="" id="" placeholder="Nome Completo">
                    </div>
                    <div class="EstiloInputs">
                        <input type="email" name="" id="" placeholder="Email">
                    </div class="EstiloInputs">
                    <div class="EstiloInputs">
                        <input type="password" name="" id="Senha" placeholder="Senha">
                    </div>
                    <div class="EstiloInputs"> 
                        <input type="tel" name="" id="Telefone" placeholder="Telefone">
                    </div>
                    <div class="EstiloInputs mb-5">
                        <input type="date" name="" id="">
                    </div>
                </div>
                <div class="col">
                    <div class="box">
                        
                            <select name="id_area" id="id_area"> 
                                <option value="">Altere a cidade</option>
                             </select>
                        </div>
                    </div>
                    <div>
                        <textarea name="" id="" placeholder="Fale sobre você..."></textarea>
                    </div>
                </div>

                <div class="rol d-flex me-0 imgServicos">
                    <div class="col txtMargin "><img src="../img/images100x100.png" alt="Fotos do serviço"></div>
                    <div class="col"><img src="../img/images100x100.png" alt="Fotos do serviço"></div>
                    <div class="col"><img src="../img/images100x100.png" alt="Fotos do serviço"></div>
                </div>

                <div class="row">
                    <div class="col txtMargin botaoSalvar d-flex justify-content-end mt-5">
                        <input type="submit" value="Salvar">
                    </div>
                </div>
            </div>
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

</body>
</html>