<?php

include_once('Conexão.php');

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
// $foto_perfil = $_POST['foto_perfil'];


// $resultado = mysqli_query($conn, "INSERT INTO cliente(nome, email, senha, foto_perfil)
// VALUES ($nome,$email,$senha,$foto_perfil)");

$resultado = mysqli_query($conn, "INSERT INTO cliente(nome, email, senha) 
VALUES ('$nome','$email','$senha')");