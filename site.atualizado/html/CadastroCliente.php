<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JundTask - Login</title>
    <link rel="stylesheet" href="../css/styleCadastros.css">
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="../img/logo@2x.png" type="image/x-icon">
</head>
<body>
    <header>
        <nav class="BarraNav">
            <img src="../img/JUNDTASK.png" alt="Logo JundTask">
            <a href="../html/home.php">Sair</a>
        </nav>
    </header>
    <main class="LoginGeral">
    <form method="POST" action="../backend/php/RegisterCliente.php" enctype="multipart/form-data">
        <div class="row me-0 ">
            <div class="col ">
                <!-- <img class="imgFundoLogin d-flex align-items-end" src="../img/Vector (2).png" alt="vetor1"> -->
                <div class="tituloLogin">
                    <img src="../img/logo@2x.png" alt="Logo JundTask">
                    <h1>Cadastro Cliente</h1>
                </div>

                <div class="InputsLogin">
                    <input type="text" id="nome" name="nome" placeholder="Nome" required><br>
                    <label for="nome"></label><br>
                </div>
        
                <div class="InputsLogin">
                    <input type="text" name="email" id="email" placeholder="Email">
                    <label for="email"></label><br>
                </div>

                <div class="InputsLogin Senha">
                    <input type="password" name="senha" id="senha" placeholder="Senha">
                    <i class="bi bi-eye-slash" id="olho" onclick="mostrarSenha()"></i>
                </div>   

                <div class="InputsLogin ConfirmaSenha">
                    <input type="password" name="ConfirmaSenha" id="ConfirmaSenha" placeholder="Confirmar senha">
                    <i class="bi bi-eye-slash" id="olho2" onclick="mostrarSenha2()"></i>
                </div>

                <div class="box">
                        <select name="" id="" >
                            <option value="" >Cabreuva</option>
                            <option value="">Campo Limpo Paulista</option>
                            <option value="">Itupeva</option>
                            <option value="">Jarinu</option>
                            <option value="">Jundiai</option>
                            <option value="">Limeira</option>
                            <option value="">Varzea Paulista</option>
                        </select>
                </div>

                <div class="InputsLogin FotodePerfil">
                    <input type="file" name="foto_de_perfil" id="foto_de_perfil" placeholder="Foto de Perfil" required>
                    <label for="foto_de_perfil"></label><br>
                </div>

                <div class="BotaoCadastro"><input type="submit" value="Cadastrar"></div>
    
            </div>
        </div>
        </form>
    </main>
    <footer class="d-flex justify-content-center">
        <p>N</p>
        <p>Terms of Service</p>
        <p>Privacy Policy</p>
        <p>@2022yanliudesign</p>
    </footer>
    
    <script src="../js/FuncaoSenhaOlho.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>