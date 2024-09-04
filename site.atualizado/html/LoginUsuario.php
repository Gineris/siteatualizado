<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JundTask - Login</title>
    <link rel="stylesheet" href="../css/styleLoginGeral.css">
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
        <form method="POST" action="./verificaLoginUsuario.php" onsubmit="return verificaSenha()">
            <div class="row me-0">
                <div class="col">
                    <div class="tituloLogin">
                        <img src="../img/logo@2x.png" alt="Logo JundTask">
                        <h1>Login Usuario</h1>
                    </div>
            
                    <div class="InputsLogin">
                        <input type="text" name="email" id="email" placeholder="Email" required>
                        <label for="email"></label><br>
                    </div>

                    <div class="InputsLogin Senha">
                        <input type="password" name="senha" id="senha" placeholder="Senha" required>
                        <i class="bi bi-eye-slash" id="olho" onclick="mostrarSenha()"></i>
                        <label for="senha"></label><br>
                    </div>

                    <div class="InputsLogin ConfirmaSenha">
                        <input type="password" name="ConfirmaSenha" id="ConfirmaSenha" placeholder="Confirmar senha" required>
                        <i class="bi bi-eye-slash" id="olho2" onclick="mostrarSenha2()"></i>
                    </div>
            
                    <div class="BotaoLogin">
                        <input type="submit" name="submit" value="Login">
                    </div>
                    
                </div>
            </div>
        </form>
    </main>
    <footer class="d-flex justify-content-center">
        <p>Terms of Service</p>
        <p>Privacy Policy</p>
        <p>@2022yanliudesign</p>
    </footer>
    <script src="../js/FuncaoSenhaOlho.js"></script>
    <script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Função para mostrar/ocultar senha
        function mostrarSenha() {
            var senhaInput = document.getElementById('senha');
            var olhoIcon = document.getElementById('olho');
            if (senhaInput.type === 'password') {
                senhaInput.type = 'text';
                olhoIcon.classList.remove('bi-eye-slash');
                olhoIcon.classList.add('bi-eye');
            } else {
                senhaInput.type = 'password';
                olhoIcon.classList.remove('bi-eye');
                olhoIcon.classList.add('bi-eye-slash');
            }
        }

        function mostrarSenha2() {
            var confirmaSenhaInput = document.getElementById('ConfirmaSenha');
            var olhoIcon2 = document.getElementById('olho2');
            if (confirmaSenhaInput.type === 'password') {
                confirmaSenhaInput.type = 'text';
                olhoIcon2.classList.remove('bi-eye-slash');
                olhoIcon2.classList.add('bi-eye');
            } else {
                confirmaSenhaInput.type = 'password';
                olhoIcon2.classList.remove('bi-eye');
                olhoIcon2.classList.add('bi-eye-slash');
            }
        }
    </script>
</body>
</html>
