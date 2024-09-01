<?php

include_once('Conexao.php');

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$foto_de_perfil = $_FILES['foto_de_perfil'];


        //foto de perfil
        $fotoRecebida = explode(".", $foto_de_perfil['name']);
        //mudar o local para onde a foto vai 
        $pastaFotoDestino = "../../../frontend/public/imagens/";
        $tamanhoFotoDePerfil = 2097152;

        if ($foto_de_perfil['error'] == 0){
            $extensao = $fotoRecebida['1'];
            if(in_array($extensao, array('jpg', 'jpeg', 'gif', 'png'))) {
                if ($foto_de_perfil['size'] > $tamanhoArquivo) {
                    $mensagem = "Arquivo Enviado é muito Grande";
                    $_SESSION['mensagem'] = $mensagem;
                } else {
                    $novoNome = md5(time()). "." . $extensao;
                    echo $_FILES['foto_de_perfil']['tmp_name'];
                    echo "<br>";
                    echo $foto['tmp_name'];
                    $enviou = move_uploaded_file($_FILES['foto_de_perfil']['tmp_name'], $pastaFotoDestino . $novoNome);
                    if ($enviou) {
                        return ($novoNome);
                    } else {
                        return false;
                    }
                }
            } else {
                $mensagem = "Somente arquivos do tipo 'jpg', 'jpeg', 'gif', 'png' são permitidos!!!";
                $_SESSION['mensagem'] = $mensagem;
            }
        } else {
            $mensagem = "Um arquivo deve ser enviado!!!!";
            $_SESSION['mensagem'] = $mensagem;
        }


// $resultado = mysqli_query($conn, "INSERT INTO cliente(nome, email, senha, foto_perfil)
// VALUES ($nome,$email,$senha,$foto_perfil)");

$resultado = mysqli_query($conn, "INSERT INTO cliente(nome, email, senha, foto_de_perfil) 
VALUES ('$nome','$email','$senha','$foto_de_perfil')");

header('Location: ../../html/loginGeral.php');