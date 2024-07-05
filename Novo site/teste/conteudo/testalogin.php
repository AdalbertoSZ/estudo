<?php
    session_start();
    //print_r($_REQUEST);
    if(isset($_POST['submit']) && !empty($_POST['usuario']) && !empty($_POST['senha']))
    	{
        // Acessa
        include('conecta.php');
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];

       //print_r('Email: ' . $usuario);
        //print_r('<br>');
       // print_r('Senha: ' . $senha);

        $buscausuario = "SELECT * FROM Usuarios WHERE usuario = '$usuario' and senha = '$senha'";

        $result = $banco->query($buscausuario);
       // print_r($buscausuario);
       // print_r('<br>');
       // print_r($result);
       

       	if(mysqli_num_rows($result) < 1)
      	{
            unset($_SESSION['usuario']);
       		unset($_SESSION['senha']);
       		echo "<script> location.href='../login.php';</script>";
            //header('Location: login.php');
      		//  	print_r('não existe');
        }
        else
      	{
            $_SESSION['usuario'] = $usuario;
          	$_SESSION['senha'] = $senha;
          	echo "<script> location.href='principal.php';</script>";
        	//header('Location: principal.php');
      		//print_r('existe');
       }
    }
    else
    {
        // Não acessa
        echo "<script> location.href='../login.php';</script>";
        //header('Location: login.php');
    }

?>