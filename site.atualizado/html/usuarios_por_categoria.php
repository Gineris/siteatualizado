<?php
include_once('../backend/php/Conexao.php');

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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $area_atuação = $_POST['area_atuação'] ?? '';
    $nome_pesquisa = $_POST['nome_pesquisa'] ?? '';

    $query_pesquisar = "SELECT * FROM trabalhador WHERE id_categoria = $id_categoria";

    if ($area_atuação) {
        $query_pesquisar .= " AND id_area = " . intval($area_atuação);
    }
    
    if ($nome_pesquisa) {
        $query_pesquisar .= " AND nome LIKE '%" . mysqli_real_escape_string($conn, $nome_pesquisa) . "%'";
    }
    
    $resultado_pesquisar = mysqli_query($conn, $query_pesquisar);

    if (!$resultado_pesquisar) {
        die("Erro na consulta: " . mysqli_error($conn));
    }
} else {
    $resultado_pesquisar = $result;
}
?>

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
                <ion-icon name="person"></ion-icon>
                </a>
            </div>
        </nav>
    </header>
    <nav class="menuLateral">
            <div class="IconExpandir">
                <ion-icon name="menu-outline" id="btn-exp"></ion-icon>
            </div>

            <ul>
                <li class="itemMenu ativo">
                    <a href="#">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <span class="txtLink">Inicio</span>
                    </a>
                </li>
                <li class="itemMenu">
                    <a href="#">
                        <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                        <span class="txtLink">Perfil</span>
                    </a>
                </li>
                <li class="itemMenu">
                    <a href="#">
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

        <div class="search-container">
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
                <a href="Perfil.php?id_trabalhador=<?php echo $row['id_trabalhador']; ?>">
                    <?php 
                    echo '<div class="CardBox">'; 
                        echo '<div class="imagem">
                                <img src="../img/images100x100.png" alt="">
                        </div>';
                        echo '<div class="txtTrabalhador">';
                            echo '<h3>' . htmlspecialchars($row['nome']) . '</h3>';
                            echo '<p>' . htmlspecialchars($row['media_avaliacao']) . '</p>';
                        echo '</div>';
                    echo '</div>';
                    ?>
                </a>
            </div>
                <?php 

                // echo '<p>' . htmlspecialchars($row['nome']) . '</p>';
                // echo '<p>' . htmlspecialchars($row['id_area']) . '</p>';
                // echo '<p>' . htmlspecialchars($row['media_avaliacao']) . '</p>';
                // echo '<p>' . htmlspecialchars($row['id_categoria']) . '</p>';
                // echo '<p>' . htmlspecialchars($row['foto_perfil']) . '</p>';
                // Adicione mais campos conforme necessário
            }
        } else {
            echo '<p>Trabalhador não encontrado</p>';
        }
        ?>
    </div>

   
    <script src="../js/funcaoMenuLateral.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>