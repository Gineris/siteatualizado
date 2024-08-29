<?php 
    
    session_start();
    if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha']))
    {
        // Acessa
        include_once('../php/Conexao.php');
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM cliente WHERE email = '$email' and senha = '$senha'";

        $result = $conn->query($sql);

        if(mysqli_num_rows($result) < 1)
        {
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            header('Location: ../../html/LoginUsuario.php');
        }
        else
        {
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header('Location: ../../html/PerfilCliente.php');
        }
    }
    else
    {
        // Não acessa
        header('Location: ../../html/home.php');
    }


    // modo que somente adm entre na parte de adm

    // if($_SESSION['tipo']==1 && $_SESSION['status']==1){
    //     $mensagem="";
    //     header('Location:../usuarios/adm/indexAdm.php');
    // } elseif($_SESSION['tipo']==0 && $_SESSION['status']==1){
    //     header('Location:../usuarios/comum/indexUsuario.php');
    // } else {
    //     $mensagem="Acesso não permitido!!!!!";
    //     $_SESSION['mensagem']=$mensagem;
    // }
    
    ?>