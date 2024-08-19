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
        <div class="row me-0 ">
            <div class="col ">
                <div class="tituloLogin">
                    <img src="../img/logo@2x.png" alt="Logo JundTask">
                    <h1>Cadastro de Profissionais</h1>
                </div>
        
                <div class="InputsLogin"><input type="text" name="Nome" id="" placeholder="Nome completo"></div>
                <div class="InputsLogin"><input type="text" name="Email" id="" placeholder="Email"></div>

                <div class="InputsLogin SenhaGeral">
                    <input type="password" name="SenhaCliente" id="senha" placeholder="Senha">
                    <i class="bi bi-eye-slash" id="olho" onclick="mostrarSenha()"></i>
                </div>   

                <div class="InputsLogin SenhaGeral1">
                    <input type="password" name="SenhaCliente" id="senha2" placeholder="Confirmar senha">
                    <!-- <ion-icon name="eye-off-outline"></ion-icon> -->
                    <i class="bi bi-eye-slash" id="olho2" onclick="mostrarSenha2()"></i>  
                </div>

                <div class="InputsLogin">
                    <input type="text" name="AreaAtuacao" id="" placeholder="Area de atuação">
                </div>
                
                <div class="InputsLogin">
                    <input type="text" name="CategoriaDeServicos" id="" placeholder="Categoria de servicos">
                </div>

                
        
                <div class="BotaoLogin "><input type="submit" value="Login"></div>
    
            </div>
        </div>
    </main>
    <footer class="d-flex justify-content-center ">
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

