<?php
session_start();
// include_once('../backend/Conexao.php');


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
                    <a href="./SeuPerfil.php">
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
        

                <div class="container">
                    <div class="row me-0 mb-5 topoPerfil">
                        <div class="col-1 sucess imgPerfil" >
                            <img src="../uploads/<?php echo !empty($_SESSION['foto_perfil']) ? $_SESSION['foto_perfil'] : '../img/images100x100.png' ?>" alt="Foto de perfil">
                    </div>
                    <div class="col txtPerfil d-flex flex-column justify-content-center">
                        <h3><?php echo $_SESSION['nome']; ?></h3>
                        <p><?php echo !empty($_SESSION['descricao']) ? $_SESSION['descricao'] : 'Sua descrição...' ?></p>
                    </div>
                                </div>
                    
                    <form method="POST" action="../backend/AtualizaDados.php" enctype="multipart/form-data">
                        <div class="row me-0 ">
                            <div class="col coluna1">
                                <div class="EstiloInputs">
                                    <input type="text" name="nome" id="nome" value="<?php echo $_SESSION['nome']; ?>">
                                </div>
                                <div class="EstiloInputs">
                                    <input type="email" name="email" id="" value="<?php echo $_SESSION['email']; ?>">
                                </div>
                                <div class="EstiloInputs">
                                    <input type="password" name="senha" id="Senha" placeholder="Nova senha">
                                </div>
                                <div class="EstiloInputs">
                                    <input type="text" name="contato" id="contato" value="<?php echo !empty($_SESSION['contato']) ? $_SESSION['contato'] : 'Atulize seu Telefone'  ?>">
                                </div>
                                <div class="EstiloInputs mb-5">
                                    <input type="date" name="data_nasc" id="data_nasc" value="<?php echo !empty($_SESSION['data_nasc']) ? $_SESSION['data_nasc'] : '' ?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="box">
                                        <select name="id_area" id="id_area">
                                            <option value="">Altere a cidade</option>
                                        </select>
                                </div>
                                <div class="box marginteste">
                                    <select name="id_categoria" id="id_categoria">
                                        <option value="">Selecione uma categoria</option>
                                    </select>
                                </div>
                                <div>
                                    <textarea name="descricao" id="" placeholder="<?php echo !empty($_SESSION['descricao']) ? $_SESSION['descricao'] : 'Fale sobre você...' ?>"> <?php echo !empty($_SESSION['descricao']) ? $_SESSION['descricao'] : 'Fale sobre você...' ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="rol d-flex me-0">
                            <input type="file" name="foto_perfil" id="foto_perfil">
                        </div>
                        <div class="rol d-flex mt-0">
                            <div class="col txtMargin mt-5 ">
                                <label for="foto_trabalho1">foto trabalho 1</label>
                                <input type="file" name="foto_trabalho1" id="foto_trabalho1">
                            </div>
                            <div class="col mt-5">
                                <label for="foto_trabalho2">foto trabalho 2</label>
                                <input type="file" name="foto_trabalho2" id="foto_trabalho2">
                            </div>
                            <div class="col mt-5">
                                <label for="foto_trabalho3">foto trabalho 3</label>
                                <input type="file" name="foto_trabalho3" id="foto_trabalho3">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col txtMargin botaoSalvar d-flex justify-content-end mt-5">
                                <input type="submit" value="Salvar">
                            </div>
                        </div>
                        </div>
                    </form>
                </div>

    </main>

    

    <footer class="d-flex justify-content-center ">
        <p>N</p>
        <p>Terms of Service</p>
        <p>Privacy Policy</p>
        <p>@2022yanliudesign</p>
    </footer>
    
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const areaSelect = document.getElementById('id_area');
        const categoriaSelect = document.getElementById('id_categoria');

        // Carregar áreas
        fetch('./getcidades.php')
            .then(response => response.json())
            .then(areas => {
                console.log(areas); 
                areaSelect.innerHTML = '<option value="">Altere a Cidade</option>'; 
                areas.forEach(area => {
                    const option = document.createElement('option'); 
                    option.value = area.id_area; 
                    option.textContent = area.cidade; 
                    areaSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Erro ao carregar áreas:', error));

        // Carregar categorias
        fetch('./getcategoriacadastro.php')
            .then(response => response.json())
            .then(categorias => {
                console.log(categorias); 
                categoriaSelect.innerHTML = '<option value="">Selecione uma categoria</option>'; 
                categorias.forEach(categoria => {
                    const option = document.createElement('option');
                    option.value = categoria.id_categoria; 
                    option.textContent = categoria.nome; 
                    categoriaSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Erro ao carregar categorias:', error));
      });
    </script>
    <script src="../js/funcaoMenuLateral.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>