<?php
		session_start();
		include_once('conecta.php');
		include_once('logado.php');
		$Patrimonio = $_SESSION['Patrimonio'];
		$Modelo = $_SESSION['Modelo'];
		if (isset($_POST['gravapatr']))
		{
		 	$Patrimonio = $_POST['Patrimonio'];
		 	$Marca = $_POST['Marca'];
		 	$Modelo = $_POST['Modelo'];
		 	$Nserie = $_POST['Nserie'];
		 	$Data = $_POST['Data'];
		 	$Tipo = $_POST['Tipo'];
		 	$Observacao = $_POST['Observacao'];
		 	$Valor = $_POST['Valor'];
		 	$Cliente = $_POST['Lcliente'];
            $Depto = $_POST['Depto'];
		 	//$buscaetiqueta = "SELECT * FROM Toner WHERE etiqueta = '$etiqueta' ";
	         //$result = $banco->query($buscaetiqueta);
	         //if(mysqli_num_rows($result) > 0)
		 	$buscaidcli = "SELECT * FROM Clientes WHERE Cliente = '$Cliente' ";
		 	$encidcli = $banco->query($buscaidcli);
		 	$dadosidcli = mysqli_fetch_assoc($encidcli);
		 	$idcli = $dadosidcli['Indice'];
		 	$buscapatr = "SELECT * FROM Patrimonio WHERE Patrimonio = '$Patrimonio' ";
		 	$result = $banco->query($buscapatr);
		 	if(mysqli_num_rows($result) > 0)
		 	{
		 		echo "<script> alert('Erro...: Patrimonio já cadastrado!');</script>";
		 	}
		 	else
		 	{
				
					
		 		$gravadados = mysqli_query ($banco, "INSERT INTO Patrimonio (Patrimonio,Marca,Modelo,Nserie,Data,Tipo,Observacao,Valor,Idcliente,Depto) 
		 		VALUES ('$Patrimonio','$Marca','$Modelo','$Nserie','$Data','$Tipo','$Observacao','$Valor','$idcli','$Depto')") ;
		 		header('Location: patrimonio.php');
		 		//echo "<script> location.href='recarga.php';</script>";			
		 	}
		}
		
?> 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fastcomp - Novo patrimonio</title>
    <link rel="stylesheet" href="estilo.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
    
    <nav>
        <img src="logop2.png" alt="fastcomp" class="logotipo">
        <ul class="menu">
            <li><a href="inicio.html"><i class='bx bx-home' ></i> Inicio</a></li>
            <li><a href="recarga.php"><i class='bx bx-wrench' ></i> Recarga</a></li>   
            <li><a href="patrimonio.php"><i class='bx bx-desktop' ></i> Patrimonio</a></li>
            <li><a href="relatorio.php"><i class='bx bx-printer'></i> Relatorios</a></li>
            <li><a href="cadastro.php"><i class='bx bx-cabinet' ></i> Cadastro</a></li>
            <li><a href="configura.php"><i class='bx bx-cog' ></i> Configuração</a></li>
            <li><a href="saida.php"><i class='bx bx-log-out' ></i> Sair</a></li>
        </ul>
    </nav>
    <main>
        
        <form action="nvpatrimonio.php" method="post">
            
            <table class="nwpatr">
                <tr>
                    <td>Patrimonio.:</td>
                    <td><input type="text" name="Patrimonio" placeholder="Patrimonio" size="8" required></td>
                </tr>
                <tr>
                    <td>Marca.:</td>
                    <td><input type="text" name="Marca" placeholder="Marca" size="12" required></td>
                </tr>
                <tr>
                    <td>Modelo.:</td>
                    <td><input type="text" name="Modelo" placeholder="Modelo" size="20" required></td>
                </tr>
                <tr>
                    <td>Serial.:</td>
                    <td><input type="text" name="Nserie" placeholder="Numero de série" size="16" required></td>
                </tr>
                <tr>
                    <td>Data da compra.:</td>
                    <td><input class="entra" type="date" name="Data" id="Dtr"></td>
                </tr>
                <tr>
                    <td>Tipo.:</td>
                    <td><input class="entra" type="text" name="Tipo" list="listatipo" size="20" value= "<?php echo $tipo ?>" required>
            			<datalist id="listatipo">
            				<?php $buscatipo = "SELECT * FROM Tipoimp ORDER BY Tipo";
            				$achoutipo = mysqli_query($banco,$buscatipo);
            				while ($ltipo = mysqli_fetch_assoc($achoutipo)) { ?>
            				<option value="<?php echo $ltipo['Tipo']; ?>" ><?php echo $ltipo['Tipo']; ?> 
            				</option> 
                        <?php } ?>
            			</datalist></td>
                </tr>
                <tr>
                    <td>Observação.:</td>
                    <td><input class="entra" type="text" name="Observacao" placeholder="Observação" size="30" value= "" ></td>
                </tr>
                <tr>
                    <td>Valor.:</td>
                    <td><input type="text" name="Valor" placeholder="Valor" size="10" required></td>
                </tr>
                <tr>
                    <td>Localização.:</td>
                    <td>
                    <input class="entra" type="text" name="Lcliente" list="lcli" value= "<?php echo $tipo ?>" size="30" required>
            			<datalist id="lcli">
            				<?php $buscacli = "SELECT * FROM Clientes ORDER BY Cliente";
            				$achoucli = mysqli_query($banco,$buscacli);
            				while ($lclie = mysqli_fetch_assoc($achoucli)) { ?>
            				<option value="<?php echo $lclie['Cliente']; ?>" ><?php echo $lclie['Cliente']; ?> 
            				</option> <?php 	
            				}
            		 		?>
            			
            			</datalist>
                    </td>
                </tr>
                <tr>
                    <td>Departamento.:</td>
                    <td><input type="text" name="Depto" placeholder="Departamento" size="20"></td>
                </tr>
                <tr>
                    <td><button><a href="patrimonio.php">Cancelar</a></button></td>
                    <td class="rodape"><input class="inputsubmit" type="submit" name="gravapatr" value="Gravar"></td>
                </tr>
            </table>
        </form>
        
    </main>
    
</body>
</html>