<?php
		session_start();
		include_once('logado.php');
		include_once('conecta.php');
		$Patrimonio = $_SESSION['Patrimonio'];
		$Modelo = $_SESSION['Modelo'];
		if (isset($_POST['transfere']))
		{

			
			$Cliente = $_POST['Lcliente'];
			$buscaidcli = "SELECT * FROM Clientes WHERE Cliente = '$Cliente' ";
			$encidcli = $banco->query($buscaidcli);
			$dadosidcli = mysqli_fetch_assoc($encidcli);
			$idcli = $dadosidcli['Idcliente'];




			$Anotacao = $_POST['Anotacao'];
			$Datatrs = $_POST['Datatrs'];
			$gravadados = mysqli_query ($banco, "INSERT INTO Localizacao (Patrimonio,Modelo,Datatrs,Cliente,Anotacao) 
				VALUES ('$Patrimonio','$Modelo','$Datatrs','$idcli','$Anotacao')") ;
			$sqlInsert = "UPDATE Patrimonio SET Idcliente='$idcli' WHERE Patrimonio=$Patrimonio";
       		$result = $banco->query($sqlInsert);
				//print_r($_POST);

			header('Location: patrimonio.php');

			//echo "<script> location.href='recarga.php';</script>";			

		}
		
?>