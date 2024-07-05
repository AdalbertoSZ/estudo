<?php
		session_start();
		if((!isset($_SESSION['usuario']) == true) and (!isset($_SESSION['senha']) == true))
		{
			unset($_SESSION['usuario']);
       		unset($_SESSION['senha']);
       		echo "<script> location.href='../index.html';</script>";
       		//header('Location: http://fastcomp.scienceontheweb.net/teste/login.php');
       		//header('Location: login.php');
       		//print_r($senha);
       		//print_r('naosei');
		}
		$logado = $_SESSION['usuario'];

?>