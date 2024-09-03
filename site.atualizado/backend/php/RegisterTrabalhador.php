<?php

include_once('Conexao.php');

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$foto_perfil = $_FILES['foto_de_perfil'];


$categorias = $_POST[''
    // ['id' => 1, 'nome' => 'Serviços Domésticos', 'imagem' => 'servico-de-limpeza.png'],
    // ['id' => 2, 'nome' => 'Reparos e manutenção', 'imagem' => 'manutencao.png'],
    // ['id' => 3, 'nome' => 'Serviços Tecnológicos', 'imagem' => 'servicos-digitais.png'],
    // ['id' => 4, 'nome' => 'Restaurante', 'imagem' => 'restaurante.png'],
    // ['id' => 5, 'nome' => 'Confeitaria', 'imagem' => 'bolo.png'],
    // ['id' => 6, 'nome' => 'Serviços para Eventos e Festa', 'imagem' => 'festa-de-aniversario.png'],
    // ['id' => 7, 'nome' => 'Saúde e Beleza', 'imagem' => 'secador-de-cabelo.png'],
    // ['id' => 8, 'nome' => 'Assessoria Judicial', 'imagem' => 'judicial.png'],
    // ['id' => 9, 'nome' => 'Educação e Aulas particulares', 'imagem' => 'educacao.png'],
    // ['id' => 10, 'nome' => 'Serviços Automotivos', 'imagem' => 'servico-automotivo.png'],
    // ['id' => 11, 'nome' => 'Artesanato', 'imagem' => 'artesanato.png'],
];



// $desc = $_POST['desc'];


// $categoria = $_POST['categoria'];

// $contato = $_POST['contato'];
// $data_nasc = $_POST['data_nasc'];
// $area_atuacao = $_POST['area_atuacao'];
// $media_avaliacao = $_POST['media_avaliacao'];


// $resultado = mysqli_query($conn, "INSERT INTO trabalhador(nome, email, senha, foto_perfil, desc, id_categoria, contato, data_nasc, area_atuacao, media_avaliacao) 
// VALUES ($nome,$email,$senha,$foto_perfil,$id_categoria,$contato,$data_nasc,$area_atuacao,$media_avaliacao)");

$resultado = mysqli_query($conn, "INSERT INTO trabalhador(nome, email, senha) 
VALUES ('$nome','$email','$senha')");



header('Location: ../../html/loginGeral.php');