
<?php include_once('../backend/php/Conexao.php');?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Perfil do Trabalhador</title>
</head>
<body>

<h1>Perfil do Trabalhador</h1>
<p id="curtidas">Carregando curtidas...</p>
<button id="curtirBtn">Curtir</button>

<script>
    const id_trabalhador = 1; // Substitua com o ID real do trabalhador
    const id_cliente = 1; // Substitua com o ID real do usuário

    function carregarCurtidas() {
        fetch(`?trabalhador_id=${trabalhadorId}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('curtidas').innerText = data;
            });
    }

    document.getElementById('curtirBtn').addEventListener('click', () => {
        fetch(window.location.href, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `usuario_id=${usuarioId}&trabalhador_id=${trabalhadorId}`
        }).then(response => response.text())
          .then(() => carregarCurtidas());
    });

    carregarCurtidas();
</script>

</body>
</html>