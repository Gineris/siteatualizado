<?php

include_once('Conexao.php');

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$foto_perfil = $_FILES['foto_de_perfil'];
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