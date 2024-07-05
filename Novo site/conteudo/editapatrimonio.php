<?php
		session_start();
		include_once('logado.php');
		include_once('conecta.php');
		$Patrimonio = $_SESSION['Patrimonio'];
		$Modelo = $_SESSION['Modelo'];
		$edcodigo = $_GET['edcodigo'];
		$buscaindice = "SELECT * FROM Patrimonio WHERE indice = '$edcodigo' ";
		$encontrou = $banco->query($buscaindice);
		if(mysqli_num_rows($encontrou) < 1){
			header('Location: patrimonio.php');
    	}
    	$dadospatrimonio = mysqli_fetch_assoc($encontrou);
    	$codigo = $dadospatrimonio['Indice'];
		$Patrimonio = $dadospatrimonio['Patrimonio'];
		$Marca = $dadospatrimonio['Marca'];
		$Modelo = $dadospatrimonio['Modelo'];
		$Nserie = $dadospatrimonio['Nserie'];
		$Data = $dadospatrimonio['Data'];
		$Tipo = $dadospatrimonio['Tipo'];
		$Observacao = $dadospatrimonio['Observacao'];
		$Valor = $dadospatrimonio['Valor'];
		$Idcliente = $dadospatrimonio['Idcliente'];
		$buscacli = "SELECT * FROM Clientes WHERE Indice = $Idcliente";
		$encontrou = $banco->query($buscacli);
        $dadoscli = mysqli_fetch_assoc($encontrou);
        $Cliente = $dadoscli['Cliente'];

		$_SESSION['edcodigo'] = $edcodigo;
						
?>
<!DOCTYPE html>
<html>
<head>
	<title>Fastcomp - Edita Patrimonio</title>
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
		<div class="nlista">
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
	<div class="cabecalho" id="dvcab">
		<div class="procura">
			<form action="salvapatrimonio.php" method="POST">
				<table class="nwrec">
   				
   					<tr>
       					<td>Patrimonio.:</td>
        				<td><input class="entra" type="text" name="Patrimonio" placeholder="Patrimonio" value= "<?php echo $Patrimonio ?>" required></td>
       				</tr>
    				<tr>
        				<td>Marca.:</td>
       					<td><input class="entra" type="text" name="Marca"  placeholder="Marca" value= "<?php echo $Marca ?>" required></td>
        			</tr>
   					<tr>
        				<td>Modelo.:</td>
        				<td><input class="entra" type="text" name="Modelo"  placeholder="Modelo" value= "<?php echo $Modelo ?>" required></td>
    				</tr>
     				<tr>
        				<td>Serial.:</td>
        				<td><input class="entra" type="text" name="Nserie"  placeholder="Serial" value= "<?php echo $Nserie ?>" required></td>
       				</tr>
       				<tr>
       					<td>Data de compra.:</td>
       					<td><input class="entra" type="date" name="Data" value="<?php echo $Data ?>"required></td>
       				</tr>


            		<tr>
            			<td>Tipo.:</td>
            			<td>
            		<!--<select name="tecnico"><option>Selecione</option>
            		<?php $buscatipo = "SELECT * FROM Tipoimp ";
            			$achoutipo = mysqli_query($banco,$buscatipo);
            			while ($ltipo = mysqli_fetch_assoc($achoutipo)) { ?>
            				<option value="<?php echo $ltipo['Indice']; ?>" ><?php echo $ltipo['Tipo']; ?> 
            				</option> <?php 	
            			}
            		 ?>
            		
            	</select>  -->
            			<input class="entra" type="text" name="Tipo" list="listatipo" value= "<?php echo $Tipo ?>" required>
            			<datalist id="listatipo">
            			<?php $buscatipo = "SELECT * FROM Tipoimp ORDER BY Tipo";
            			$achoutipo = mysqli_query($banco,$buscatipo);
            			while ($ltipo = mysqli_fetch_assoc($achoutipo)) { ?>
            				<option value="<?php echo $ltipo['Tipo']; ?>" ><?php echo $ltipo['Tipo']; ?> 
            				</option> <?php 	
            			}
            		 	?>
            			
            			</datalist>
            			</td>
            		</tr>
            		            		<tr>
            			<td>Observação.:</td>
            			<td><input class="entra" type="text" name="Observacao" placeholder="Observação" size="30" value= "<?php echo $Observacao ?>" ></td>
            		</tr>
            		<tr>
            			<td>Valor.:</td>
            			<td><input class="entra" type="text" name="Valor" placeholder="Valor" size="10" value= "<?php echo $Valor ?>" ></td>
            		</tr>
            		<tr>
            			<td>Localização.:</td>
            			<td>
            		
            			<input class="entra" type="text" name="Lcliente" list="lcli" value= "<?php echo $Cliente ?>" required>
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
                	<br><br>
				</table>
				<br><br>
				<div class="executa">
 		   			<button class="botao" value="Voltar" ><a href="patrimonio.php"> Voltar</a> </button>
 		   			<input class="inputsubmit" type="submit" name="atualiza" value="Atualiza">
 		   		</div>
 		   		<br><br>
 		</form>
		</div>
		</div>
	
		
	
</body>
</html>