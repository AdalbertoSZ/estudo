<?php
		session_start();
		include_once('conecta.php');
		include_once('logado.php');
		//$Patrimonio = $_SESSION['Patrimonio'];
		//$Modelo = $_SESSION['Modelo'];
        $edcodigo = $_GET['edcodigo'];
        $_SESSION['edcod'] = $edcodigo;
        //print_r($_SESSION);
        //print_r($edcodigo);
        // $buscarecarga = "SELECT * FROM Historico WHERE codigo = '$edcodigo' ";
		// $encontrou = $banco->query($buscarecarga);
        // print_r($_SESSION);
        // print_r($edcodigo);
        if (isset($_POST['atualiza']))
		{
		 	//$Patrimonio = $_POST['Patrimonio'];
		 	//$Marca = $_POST['Marca'];
		 	//$Modelo = $_POST['Modelo'];
		 	//$Nserie = $_POST['Nserie'];
		 	$Datatrs = $_POST['Datatrs'];
		 	//$Tipo = $_POST['Tipo'];
            $Cliente = $_POST['Cliente'];
            $Anotacao = $_POST['Anotacao'];
            $Depto = $_POST['Depto'];
            $Indice = $_SESSION['Indice'];
		 	
		 	$buscaidcli = "SELECT * FROM Clientes WHERE Cliente = '$Cliente' ";
		 	$encidcli = $banco->query($buscaidcli);
		 	$dadosidcli = mysqli_fetch_assoc($encidcli);
		 	$idcli = $dadosidcli['Indice'];
            //print_r($edcodigo);
				$sqlInsert = "UPDATE Localizacao SET  Datatrs='$Datatrs' , Cliente='$idcli' , Anotacao='$Anotacao' , Depto ='$Depto' WHERE Indice='$Indice'";
                $result = $banco->query($sqlInsert);
                //echo "<script type='text/javascript'>alert('$edcodigo');</script>";
		 		header('Location: patrimonio.php');
		}
        

        $buscalocal = "SELECT * FROM Localizacao WHERE Indice = '$edcodigo' ORDER BY Indice DESC";
        $encontrou = $banco->query($buscalocal);
        if(mysqli_num_rows($encontrou) < 1){
			header('Location: patrimonio.php');
    	}
        $_SESSION['Indice']=$edcodigo;
        $dadoslocal = mysqli_fetch_assoc($encontrou);
        //print_r($dadoslocal);
        $Patrimonio = $dadoslocal['Patrimonio'];
        $Modelo = $dadoslocal['Modelo'];
        $Datatrs = $dadoslocal['Datatrs'];
        $Cliente = $dadoslocal['Cliente'];
        $Anotacao = $dadoslocal['Anotacao'];
        $Depto = $dadoslocal['Depto'];
        //print_r($Cliente);
        //print_r($_POST);

        $buscaidcli = "SELECT * FROM Clientes WHERE Indice = '$Cliente' ";
        $encidcli = $banco->query($buscaidcli);
        $dadosidcli = mysqli_fetch_assoc($encidcli);
        //print_r($dadosidcli);
        $Cliente = $dadosidcli['Cliente'];
        //print_r($Cliente);
        //print_r($idcli);
        //print_r($edcodigo);
        //echo "<script type='text/javascript'>alert('$edcodigo');</script>";
		
		
?> 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fastcomp - Edita transferencia de patrimonio</title>
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
        
        <form action="edtrpatr.php" method="post">
            
            <table class="nwpatr">
                <tr>
                    <td>Patrimonio.:</td>
                    <td><h4> <?php echo $Patrimonio ?> </h4></td>
                </tr>
                <tr>
                    <td>Modelo.:</td>
                    <td><h4> <?php echo $Modelo ?> </h4></td>
                </tr>
                <tr>
                    <td>Data de transferência.:</td>
                    <td><input class="entra" type="date" name="Datatrs" value="<?php echo $Datatrs ?>" required></td>
                </tr>
                
                <tr>
                    <td>Localização.:</td>
                    <td>
                    <input class="entra" type="text" name="Cliente" list="lcli" value= "<?php echo $Cliente ?>"  size="30" required>
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
                    <td>Anotacao.:</td>
                    <td><input type="text" name="Anotacao" placeholder="Anotacao" size="30" value= "<?php echo $Anotacao ?> "  required></td>
                </tr>
                <tr>
                    <td>Departamento.:</td>
                    <td><input type="text" name="Depto" placeholder="Departamento" size="20" value= "<?php echo $Depto ?> "  ></td>
                </tr>
                <tr>
                    <td><button><a href="patrimonio.php">Cancelar</a></button></td>
                    <td class="rodape"><input class="inputsubmit" type="submit" name="atualiza" value="Atualiza"></td>
                </tr>
            </table>
        </form>
        
    </main>
    
</body>
</html>