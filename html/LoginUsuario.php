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
        <form method="POST" action="./validaCliente.php" onsubmit="return verificaSenha()">
            <div class="row me-0">
                <div class="col">
                    <div class="tituloLogin">
                        <img src="../img/logo@2x.png" alt="Logo JundTask">
                        <h1>Login Usuario</h1>
                    </div>


                    <div class="login-container">
        <form id="formLogin" method="POST">
            <div id="mensagemErro" class="alert alert-danger" style="display: none;">
                <span class="close" onclick="this.parentElement.style.display='none'">&times;</span>
            </div>

            <div id="mensagemSucesso" class="alert alert-success" style="display: none;">
                <span class="close" onclick="this.parentElement.style.display='none'">&times;</span>
            </div>

            <div class="InputsLogin">
                <input type="text" name="email" id="email" placeholder="Email" required>
            </div>

            <div class="InputsLogin Senha">
                <input type="password" name="senha" id="senha" placeholder="Senha" required>
                <i class="bi bi-eye-slash" id="olho" onclick="mostrarSenha()"></i>
            </div>

            <div class="BotaoLogin">
                <input type="submit" value="Login">
            </div>
        </form>

        <script>
            document.getElementById('formLogin').addEventListener('submit', function(event) {
                event.preventDefault();

                var formData = new FormData(this);

                fetch('../html/LoginUsuario.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    var mensagemSucesso = document.getElementById('mensagemSucesso');
                    var mensagemErro = document.getElementById('mensagemErro');

                    if (data.sucesso) {
                        mensagemSucesso.innerText = 'Login realizado com sucesso!';
                        mensagemSucesso.style.display = 'block'; // Garante que a mensagem de sucesso seja exibida
                        mensagemErro.style.display = 'none'; // Oculta a mensagem de erro

                        // Redireciona para a página apropriada
                        window.location.href = data.redirect;
                    } else {
                        mensagemErro.innerText = data.mensagem;
                        mensagemErro.style.display = 'block'; // Garante que a mensagem de erro seja exibida
                        mensagemSucesso.style.display = 'none'; // Oculta a mensagem de sucesso
                    }
                })
                .catch(error => {
                    console.error('Erro ao enviar o formulário:', error);
                    var mensagemErro = document.getElementById('mensagemErro');
                    mensagemErro.innerText = 'Erro ao enviar o formulário. Tente novamente.';
                    mensagemErro.style.display = 'block'; // Garante que a mensagem de erro seja exibida
                });
            });

            function mostrarSenha() {
                var senhaInput = document.getElementById('senha');
                senhaInput.type = senhaInput.type === 'password' ? 'text' : 'password';
                var olhoIcon = document.getElementById('olho');
                olhoIcon.classList.toggle('bi-eye');
                olhoIcon.classList.toggle('bi-eye-slash');
            }
        </script>
</body>
</html>
