<?php
session_start();
include_once ('../backend/Conexao.php');
$id_trabalhador_sessao= $_SESSION['id_trabalhador'];
$id_trabalhador = $_SESSION['id_trabalhador'];

$sql = "SELECT * FROM trabalhador WHERE id_trabalhador = '$id_trabalhador'";
$result = $conn->query($sql);

$resultado_pesquisar = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($resultado_pesquisar);


$id_categoria = $_GET['id_categoria'];


// Verifique se o id_categoria é um número válido
if (!is_numeric($id_categoria)) {
    die("ID da categoria inválido.");
}

// Consulta para buscar trabalhadores pela categoria
$query = "SELECT * FROM trabalhador WHERE id_categoria = $id_categoria";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Erro na consulta: " . mysqli_error($conn));
}

// Processa o formulário se for enviado
$area_atuação = '';
$nome_pesquisa = '';

$id_categoria = $_GET['id_categoria'];

if (!is_numeric($id_categoria)) {
    die("ID da categoria inválido.");
}

// Pegar a cidade selecionada via GET, se existir
$id_area = isset($_GET['id_area']) ? $_GET['id_area'] : '';

// Capturar o valor da pesquisa pelo nome
$nome_pesquisa = isset($_POST['nome_pesquisa']) ? trim($_POST['nome_pesquisa']) : '';

// Consulta para obter todas as cidades da área de atuação
$query_cidades = "SELECT DISTINCT id_area, cidade FROM area_atuação";
$result_cidades = mysqli_query($conn, $query_cidades);

if (!$result_cidades) {
    die("Erro ao obter as cidades: " . mysqli_error($conn));
}

// Construir a consulta SQL para filtrar por cidade, categoria e nome (se houver)
$query = "
    SELECT t.*, COUNT(c.id_trabalhador) AS total_curtidas 
    FROM trabalhador t 
    LEFT JOIN curtidas c ON t.id_trabalhador = c.id_trabalhador 
    INNER JOIN area_atuação a ON t.id_area = a.id_area
    WHERE t.id_categoria = $id_categoria
";

// Se uma cidade for selecionada, adicionar condição na consulta
if (!empty($id_area)) {
    $query .= " AND t.id_area = $id_area";
}

// Se um nome foi pesquisado, adicionar a condição de busca pelo nome
if (!empty($nome_pesquisa)) {
    $nome_pesquisa = mysqli_real_escape_string($conn, $nome_pesquisa);
    $query .= " AND t.nome LIKE '%$nome_pesquisa%'";
}

$query .= " GROUP BY t.id_trabalhador ORDER BY total_curtidas DESC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Erro na consulta: " . mysqli_error($conn));
}
?>

<style>
    nav.menuLateral{
        width: 50px;
        height: 370px;
    }
</style>
 

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JundTask - Pesquisar</title>
    <link rel="stylesheet" href="../css/stylebusca.css">
    <link rel="stylesheet" href="../bootstrap-5.3.3-dist/css/bootstrap-grid.min.css">
    <link rel="shortcut icon" href="../img/logo@2x.png" type="image/x-icon">
</head>
<body>
<header>
        <nav class="BarraNav">
            <img src="../img/LogoJundtaskCompleta.png" alt="Logo JundTask">
            
            <div class="perfil">
                <a href="#">
                <img class="FotoPerfilNav" src="../uploads/<?php echo !empty($row['foto_perfil']) ? $row['foto_perfil'] : '../img/FotoPerfilGeral.png' ?>" alt="">
                </a>
            </div>
        </nav>
    </header>
    <nav class="menuLateral">
            <div class="IconExpandir">
                <ion-icon name="menu-outline" id="btn-exp"></ion-icon>
            </div>

            <ul>
                <li class="itemMenu ">
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
                <li class="itemMenu ativo">
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
                <li class="itemMenu">
                    <a href="./EditarPerfil.php">
                        <span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
                        <span class="txtLink">Configurações</span>
                    </a>
                </li>
                <li class="itemMenu">
                    <a href="./Logout.php">
                        <span class="icon"><ion-icon name="exit-outline"></ion-icon></span>
                        <span class="txtLink">Sair</span>
                    </a>
                </li>
                
            </ul>

        </nav>
        <div class="sistemabusca">
            <div class="search-container">
                <form action="" method="POST" class="search-form">
                    <div class="pesquisarTrabalhos">
                        <input type="text" name="nome_pesquisa" placeholder="O que você está buscando?..." value="<?php echo htmlspecialchars($nome_pesquisa); ?>">
                    </div>
                    <input class="search-button" type="submit" value="Pesquisar">
                </form>

                
            </div>
            <div class="city-buttons-container">
                    <?php while ($cidade = mysqli_fetch_assoc($result_cidades)) { ?>
                        <form action="usuarios_por_categoria.php" method="GET" style="display: inline;">
                            <input type="hidden" name="id_categoria" value="<?php echo $id_categoria; ?>">
                            <input type="hidden" name="id_area" value="<?php echo $cidade['id_area']; ?>">
                            <button type="submit" class="city-btn">
                                <?php echo htmlspecialchars($cidade['cidade']); ?>
                            </button>
                        </form>
                    <?php } ?>
                </div>

            <div class="listatrabalhadores">
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="CampoEscolhaTrabalhador">
                            <a href="./Perfil.php?id_trabalhador=<?php echo $row['id_trabalhador']; ?>">
                                <div class="CardBox">
                                    <div class="imagem">
                                        <img src="../uploads/<?php echo $row['foto_perfil']; ?>" alt="">
                                    </div>
                                    <div class="txtTrabalhador">
                                        <h3><?php echo htmlspecialchars($row['nome']); ?></h3>
                                        <p><?php echo htmlspecialchars($row['media_avaliacao']); ?></p>
                                        <p>Curtidas: <?php echo htmlspecialchars($row['total_curtidas']); ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php }
                } else {
                    echo '<div class="tituloDEnaoEncontrado"><p>Nenhum trabalhador encontrado.</p></div>';
                }
                ?>
            </div>
        </div>

        <!-- <div class="search-container">
    <form action="" method="POST" class="search-form">
        <select class="category-select" name="area_atuação" id="area_atuação">
            <option value="">Escolha a Cidade</option>
            <?php
                $result_cat = "SELECT * FROM area_atuação ORDER BY cidade";
                $resultado_cat = mysqli_query($conn, $result_cat);

                if (!$resultado_cat) {
                    die("Erro na consulta: " . mysqli_error($conn));
                }

                while ($row_cat = mysqli_fetch_assoc($resultado_cat)) {
                    $selected = ($row_cat['id'] == $area_atuação) ? 'selected' : '';
                    echo '<option value="'.$row_cat['id'].'" '.$selected.'>'.$row_cat['cidade'].'</option>';
                }
            ?>
        </select>

        <div class="pesquisarTrabalhos">
            <input type="text" name="nome_pesquisa" placeholder="O que você está buscando?..." value="<?php echo htmlspecialchars($nome_pesquisa); ?>">
        </div>

        <button class="search-button">BUSCAR</button>
    </form>
</div>
    <div class="usuario">
        <?php
        // Verifica se há resultados e exibe os dados ou uma mensagem de erro
        if (mysqli_num_rows($resultado_pesquisar) > 0) {
            while ($row = mysqli_fetch_assoc($resultado_pesquisar)) {?> 
            <div class="CampoEscolhaTrabalhador">
                <a href="./Perfil.php?id_trabalhador=<?php echo $row['id_trabalhador']; ?>">
                    <?php 
                    echo '<div class="CardBox">'; 
                        echo '<div class="imagem">';
                                echo '<img src="../uploads/'.$row['foto_perfil'].'" alt="">';
                        echo '</div>';
                        echo '<div class="txtTrabalhador">';
                            echo '<h3>' . htmlspecialchars($row['nome']) . '</h3>';
                            echo '<p>' . htmlspecialchars($row['media_avaliacao']) . '</p>';
                        echo '</div>';
                    echo '</div>';
                    ?>
                </a>
            </div>
                <?php 
            }
        } else {
            echo '<div class="tituloDEnaoEncontrado">';
            echo '<p>Trabalhador não encontrado</p>';
            echo '<div';
        }
        ?>
    </div> -->

   
    <script src="../js/funcaoMenuLateral.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>