<?php
		session_start();
		include_once('conecta.php');
		include_once('logado.php');
		$ativo = $_SESSION['Patrimonio'];
	
    	$buscaativo = "SELECT * FROM Patrimonio WHERE Patrimonio = '$ativo' ";
    	$encontrou = $banco->query($buscaativo);
    	if(mysqli_num_rows($encontrou) < 1){
    		echo "<script> alert('Erro...: Patrimonio não Cadastrado!');</script>";
    		echo "<script> location.href='novopatrimonio.php';</script>";
    		//header('Location: recarga.php');
    	}

    	$resultado = mysqli_fetch_assoc($encontrou);
    	$lista = $banco->query($buscaativo);
    	$Modelo = $resultado['Modelo'];

    	$_SESSION['Patrimonio'] = $ativo;
    	$_SESSION['Modelo'] = $Modelo;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Fastcomp - Transfere Patrimonio</title>
	<meta charset="UTF-8">
    <link rel="stylesheet" href="menup.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<div class="ttela" id="dvtela"></div>
	<div class="sbar" id="sdbar" >
		<div class="logo" >
			<div class="logoc"><img src="logop2.png" id="ilogo"></div>	
		</div>
		<div class="nlista" >
			<ul>
				<li>
					<a href="inicio.html" tabindex="-1">
					<i class='bx bx-home bx-sm' ></i>
					<span class="links-name" >Inicio</span>
					</a>
				</li>
				<li>
					<a href="recarga.php" tabindex="-1">
					<i class='bx bx-wrench bx-sm' ></i>
					<span class="links-name" >Recarga</span>
					</a>
				</li>
				<li>
					<a href="destina.php" tabindex="-1">
					<i class='bx bx-cart-alt bx-sm'></i>
					<span class="links-name" >Destinação</span>
					</a>
				</li>
				<li>
					<a href="patrimonio.php" tabindex="-1">
					<i class='bx bx-desktop bx-sm' ></i>
					<span class="links-name" >Patrimonio</span>
					</a>
				</li>
				<li>
					<a href="dashboard.php" tabindex="-1">
					<i class='bx bx-grid-alt bx-sm'></i>
					<span class="links-name" >Dashboard</span>
					</a>
				</li>
				<li>
					<a href="configura.php" tabindex="-1">
					<i class='bx bx-cog bx-sm' ></i>
					<span class="links-name" >Configurações</span>
					</a>
				</li>
				<li>
					<a href="saida.php" tabindex="-1">
					<i class='bx bx-log-out bx-sm' ></i>
					<span class="links-name" >Sair</span>
					</a>
				</li>
			</ul>
		</div>
		
		
	</div>
	<div class="cabecalho" id="dvcab" >
		<div class="procura">
			<form action="salvatranspatr.php" method="POST">
				<table class="tbcont">
					<tr>
						<td>Patrimonio.:</td>
						<td><?php echo "$ativo";?></td>
					</tr>
					<tr>
						<td>Modelo.:</td>
						<td><?php echo "$Modelo";?></td>
					</tr>
					<tr>
            			<td>Cliente.:</td>
            			<td>
            		
            			<input class="entra" type="text" name="Lcliente" list="lcli" value= "<?php echo $tipo ?>" required>
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
			 			<td>Data da transferência.:</td>
        				<td><input class="entra" type="date" name="Datatrs" placeholder="Data" required></td>
			 		</tr>
			 		<tr>
			 			<td>Anotação.:</td>
        				<td><input class="entra" type="text" name="Anotacao" placeholder="Anotação" required></td>
			 		</tr>
				</table>
				<br>
				<div class="executa">	
 		   			<button class="botao" name="voltar" value="Voltar" ><a href="patrimonio.php"> Voltar</a> </button>
 		      		<input class="inputsubmit" type="submit" name="transfere" value="Salva">
 		   		</div>
 		   	</form>
 		</div>
	</div>
	
		
</body>
</html>