<?php
session_start();
include_once('../../backend/Conexao.php');

$id_cliente = $_SESSION['id_cliente'] ?? null;

if (!$id_cliente) {
    die("Usuário não autenticado.");
}

// Supondo que o id_categoria esteja sendo passado para esta página a partir de categorias.php
$id_categoria = $_SESSION['id_categoria'] ?? null;

if (!$id_categoria) {
    die("Categoria não selecionada.");
}

// Busca as cidades disponíveis para a categoria selecionada
$query_cidades = "SELECT id_area, cidade FROM area_atuação WHERE id_categoria = '" . mysqli_real_escape_string($conn, $id_categoria) . "'";
$resultado_cidades = mysqli_query($conn, $query_cidades);

if (!$resultado_cidades) {
    die("Erro na consulta das cidades: " . mysqli_error($conn));
}

// Processa a busca de trabalhadores
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_pesquisa = $_POST['nome_pesquisa'] ?? '';
    $cidade = $_POST['cidade'] ?? '';

    // Consulta para buscar trabalhadores da categoria selecionada e cidade
    $query = "SELECT * FROM trabalhador WHERE id_categoria = '" . mysqli_real_escape_string($conn, $id_categoria) . "'";

    if (!empty($nome_pesquisa)) {
        $query .= " AND nome LIKE '%" . mysqli_real_escape_string($conn, $nome_pesquisa) . "%'";
    }
    
    if (!empty($cidade)) {
        $query .= " AND id_area = '" . mysqli_real_escape_string($conn, $cidade) . "'";
    }

    $resultado_pesquisar = mysqli_query($conn, $query);

    if (!$resultado_pesquisar) {
        die("Erro na consulta: " . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JundTask - Pesquisar</title>
    <link rel="stylesheet" href="../../css/stylebusca.css">
    <link rel="stylesheet" href="../../bootstrap-5.3.3-dist/css/bootstrap-grid.min.css">
    <link rel="shortcut icon" href="../../img/logo@2x.png" type="image/x-icon">
</head>
<body>
<header>
    <nav class="BarraNav">
        <img src="../../img/LogoJundtaskCompleta.png" alt="Logo JundTask">
        <div class="perfil">
            <a href="#">
                <img class="FotoPerfilNav" src="../../uploads/<?php echo !empty($row['foto_perfil']) ? htmlspecialchars($row['foto_perfil']) : '../../img/FotoPerfilGeral.png'; ?>" alt="">
            </a>
        </div>
    </nav>
</header>

<nav class="menuLateral">
    <ul style="padding-left: 0rem;">
        <li class="itemMenu ativo">
            <a href="homeClienteLogado.php">
                <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                <span class="txtLink">Inicio</span>
            </a>
        </li>
        <li class="itemMenu">
            <a href="EditarPerfilCliente.php">
                <span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
                <span class="txtLink">Configurações</span>
            </a>
        </li>
        <li class="itemMenu">
            <a href="Categorias.php">
                <span class="icon"><ion-icon name="search-outline"></ion-icon></span>
                <span class="txtLink">Pesquisar</span>
            </a>
        </li>
        <li class="itemMenu">
            <a href="favorito.php">
                <span class="icon"><ion-icon name="heart-outline"></ion-icon></span>
                <span class="txtLink">Favoritos</span>
            </a>
        </li>
        <li class="itemMenu">
            <a href="LogoutCliente.php">
                <span class="icon"><ion-icon name="exit-outline"></ion-icon></span>
                <span class="txtLink">Sair</span>
            </a>
        </li>
    </ul>
</nav>

<div class="search-container">
    <form action="" method="POST" class="search-form">
        <div class="pesquisarTrabalhos">
            <input type="text" name="nome_pesquisa" placeholder="O que você está buscando?..." value="<?php echo htmlspecialchars($nome_pesquisa ?? ''); ?>">
        </div>

        <div class="pesquisarTrabalhos">
            <select name="cidade">
                <option value="">Selecione uma cidade</option>
                <?php
                // Preenche o select com as cidades da categoria selecionada
                while ($row_cidade = mysqli_fetch_assoc($resultado_cidades)) {
                    echo '<option value="' . $row_cidade['id_area'] . '">' . htmlspecialchars($row_cidade['cidades']) . '</option>';
                }
                ?>
            </select>
        </div>

        <button class="search-button">BUSCAR</button>
    </form>
</div>

<div class="usuario">
    <?php
    // Verifica se há resultados e exibe os dados ou uma mensagem de erro
    if (!empty($resultado_pesquisar) && mysqli_num_rows($resultado_pesquisar) > 0) {
        while ($row = mysqli_fetch_assoc($resultado_pesquisar)) {
            ?>
            <div class="CampoEscolhaTrabalhador">
                <a href="./Perfil.php?id_trabalhador=<?php echo $row['id_trabalhador']; ?>">
                    <div class="CardBox"> 
                        <div class="imagem">
                            <img src="../../uploads/<?php echo htmlspecialchars($row['foto_perfil']); ?>" alt="">
                        </div>
                        <div class="txtTrabalhador">
                            <h3><?php echo htmlspecialchars($row['nome']); ?></h3>
                            <p><?php echo htmlspecialchars($row['media_avaliacao']); ?></p>
                        </div>
                    </div>
                </a>
            </div>
            <?php 
        }
    } else {
        echo '<div class="tituloDEnaoEncontrado">';
        echo '<p>Trabalhador não encontrado</p>';
        echo '</div>';
    }
    ?>
</div>

<script src="../../js/funcaoMenuLateral.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="../../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php 
if (isset($stmt)) {
    $stmt->close();
}
$conn->close(); 
?>
