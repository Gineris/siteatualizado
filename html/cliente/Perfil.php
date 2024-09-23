<?php
session_start(); // Inicia a sessão
include_once('../../backend/Conexao.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['id_cliente'])) {
    echo 'Usuário não está logado.';
    exit;
}

// ID do cliente logado
$id_cliente = $_SESSION['id_cliente'];

$sql_cli = "SELECT * FROM cliente WHERE id_cliente = '$id_cliente'";
$result_cli = $conn->query($sql_cli);
$resultado_cli = mysqli_query($conn, $sql_cli);
$row_cli = mysqli_fetch_assoc($resultado_cli);

// ID do trabalhador a ser visualizado
$id_trabalhador = isset($_GET['id_trabalhador']) ? $_GET['id_trabalhador'] : null;

// Verifica se o ID do trabalhador foi passado
if ($id_trabalhador === null) {
    echo 'ID do trabalhador não fornecido.';
    exit;
}

// Inicializa as variáveis isFavorito e hasLiked
$isFavorito = false;
$hasLiked = false;

// Consulta para obter os dados do trabalhador
$sql = "SELECT * FROM trabalhador WHERE id_trabalhador = '$id_trabalhador'";
$resultado_pesquisar = mysqli_query($conn, $sql);

// Verifica se o trabalhador foi encontrado
if ($row = mysqli_fetch_assoc($resultado_pesquisar)) {
    // Consulta para verificar se o trabalhador é favorito
    $sqlFavorito = "SELECT * FROM favoritos WHERE id_trabalhador = '$id_trabalhador' AND id_cliente = '$id_cliente'";
    $resultFavorito = mysqli_query($conn, $sqlFavorito);

    if (mysqli_num_rows($resultFavorito) > 0) {
        $isFavorito = true; // Define como true se o trabalhador for favorito
    }

    // Consulta para contar as curtidas
    $sqlCurtidas = "SELECT COUNT(*) as total_curtidas FROM curtidas WHERE id_trabalhador = '$id_trabalhador'";
    $resultCurtidas = mysqli_query($conn, $sqlCurtidas);
    $rowCurtidas = mysqli_fetch_assoc($resultCurtidas);
    $totalCurtidas = $rowCurtidas['total_curtidas'];

    // Verifica se o trabalhador foi curtido pelo cliente
    $sqlLike = "SELECT * FROM curtidas WHERE id_trabalhador = '$id_trabalhador' AND id_cliente = '$id_cliente'";
    $resultLike = mysqli_query($conn, $sqlLike);
    
    if (mysqli_num_rows($resultLike) > 0) {
        $hasLiked = true; // Define como true se o trabalhador foi curtido
    }
} else {
    echo 'Trabalhador não encontrado.';
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JundTask - Perfil</title>
    <link rel="stylesheet" href="../../css/stylePerfilcliente.css">
    <link rel="stylesheet" href="../../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="../../img/logo@2x.png" type="image/x-icon">
</head>
<body>
    <header>
        <nav class="BarraNav">
            <img src="../../img/LogoJundtaskCompleta.png" alt="Logo JundTask">
            <h1>Perfil</h1>
            <div class="perfil">
                <img class="FotoPerfilNav" src="../../uploads/<?php echo !empty($row_cli['foto_perfil']) ? $row_cli['foto_perfil'] : '../../img/FotoPerfilGeral.png' ?>" alt="">
            </div>
        </nav>
    </header>

    <main>
        <div class="FotoFundo">
            <img src="../../uploads/<?php echo !empty($row['foto_banner']) ? $row['foto_banner'] : '../img/TesteBackPerfil.png' ?>" alt="Banner">
            <div class="BlocoPerfilPrincipal">
                <div class="FotoPerfil">
                    <img src="../../uploads/<?php echo !empty($row['foto_perfil']) ? $row['foto_perfil'] : '../img/images100x100.png' ?>" alt="Perfil">
                </div>
                <div class="NomeTrabalhador">
                    <p><?php echo htmlspecialchars($row['nome']); ?></p>
                </div>
                <div class="Avaliacao">
                    <ion-icon name="star"></ion-icon>   
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                </div>
                <div class="tel">
                    <p>Tel: <?php echo htmlspecialchars($row['contato']); ?></p>
                </div>
                <div class="curtir">
                    <button id="likeBtn" class="curtir-button">
                        <i class="bi bi-heart<?php echo $hasLiked ? '-fill' : ''; ?>"></i> 
                        <?php echo $hasLiked ? 'Descurtir' : 'Curtir'; ?>
                    </button>
                    <span id="likeCount"><?php echo $totalCurtidas; ?> Likes</span>
                </div>
                <div class="favorito">
                    <button id="favoritarBtn" data-id="<?php echo $id_trabalhador; ?>">
                        <?php echo $isFavorito ? 'Remover dos Favoritos' : 'Adicionar aos Favoritos'; ?>
                    </button>
                </div>
            </div>
            <div class="txt">
                <p><?php echo htmlspecialchars($row['descricao']); ?></p>
            </div>
        </div>

        <h1>Comentários e Avaliações</h1>
        <div id="reviews">
            <!-- Comentários e avaliações serão carregados aqui -->
        </div>

        <form id="comentario" method="POST" action="post_comentario.php">
            <textarea name="comentario" id="comentario" placeholder="Escreva seu comentário" required></textarea>
            <input type="hidden" name="id_trabalhador_sessao" value="<?php echo $id_trabalhador; ?>">
            <input type="submit" form="comentario" value="Enviar comentário"/><br>
        </form>
    </main>

    <footer class="d-flex justify-content-center">
        <p>Terms of Service</p>
        <p>Privacy Policy</p>
        <p>@2022yanliudesign</p>
    </footer>

    <script src="../../js/funcaoMenuLateral.js"></script>
    <script src="../../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const likeBtn = document.getElementById('likeBtn');
        const likeCount = document.getElementById('likeCount');
        let hasLiked = <?php echo json_encode($hasLiked); ?>; // Verifica se já curtiu
        let count = <?php echo $totalCurtidas; ?>; // Contagem inicial

        likeBtn.addEventListener('click', function() {
            const trabalhadorId = <?php echo $id_trabalhador; ?>;

            if (!hasLiked) {
                // Curtir
                count++;
                likeCount.textContent = count + " Likes";
                likeBtn.innerHTML = '<i class="bi bi-heart-fill"></i> Descurtir';
                hasLiked = true;

                // Enviar a informação de curtir para o servidor
                fetch('curtir.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id: trabalhadorId, action: 'curtir' })
                });
            } else {
                // Descurtir
                count--;
                likeCount.textContent = count + " Likes";
                likeBtn.innerHTML = '<i class="bi bi-heart"></i> Curtir';
                hasLiked = false;

                // Enviar a informação de descurtir para o servidor
                fetch('curtir.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id: trabalhadorId, action: 'descurtir' })
                });
            }
        });

        document.getElementById('favoritarBtn').addEventListener('click', function() {
            const idTrabalhador = this.getAttribute('data-id');
            const action = this.textContent.includes('Adicionar') ? 'adicionar' : 'remover';

            fetch('favoritar_action.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: idTrabalhador, action: action })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Atualiza a interface
                    this.textContent = action === 'adicionar' ? 'Remover dos Favoritos' : 'Adicionar aos Favoritos';
                } else {
                    alert(data.message); // Mostra mensagem de erro
                }
            });
        });
    </script>
</body>
</html>
