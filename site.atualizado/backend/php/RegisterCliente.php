<?php

include_once('Conexao.php');

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$foto_de_perfil = $_FILES['foto_de_perfil'];


// $resultado = mysqli_query($conn, "INSERT INTO cliente(nome, email, senha, foto_perfil)
// VALUES ($nome,$email,$senha,$foto_perfil)");

$resultado = mysqli_query($conn, "INSERT INTO cliente(nome, email, senha, foto_de_perfil) 
VALUES ('$nome','$email','$senha','$foto_de_perfil')");

header('Location: ../../html/loginGeral.php');