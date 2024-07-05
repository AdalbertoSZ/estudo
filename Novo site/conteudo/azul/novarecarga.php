<?php
		session_start();
		include_once('logado.php');
		include_once('conecta.php');
		$etiqueta = $_SESSION['etiqueta'];
		$modelo = $_SESSION['modelo'];
		if (isset($_POST['gravar']))
		{
			//print_r($_POST);
			//print_r($rcil);
			$pesoinicial = $_POST['pesoinicial'];
			$po = $_POST['po'];
			$lixo = $_POST['lixo'];
			$pesofinal = $_POST['pesofinal'];
			$data = $_POST['data'];
			$tempo = $_POST['tempo'];
			$observacao = $_POST['observacao'];
			$tecnico = $_POST['tecnico'];
			if (isset($_POST['cilindro'])) {$rcil = 'checked'; $cilindro =  1;}
			else {$rcil = 'disable'; $cilindro = 0;	}
			if (isset($_POST['developer'])) {$rdev = 'checked'; $developer = 1;}
			else {$rdev = 'disable'; $developer = 0;}
			if (isset($_POST['pcr'])) {$rpcr = 'checked'; $pcr = 1;}
			else {$rpcr = 'disable'; $pcr = 0;}
			if (isset($_POST['ldos'])) {$rldos = 'checked'; $ldos = 1;}
			else {$rldos = 'disable'; $ldos = 0;}
			if (isset($_POST['llimp'])) {$rlimp = 'checked'; $llimp = 1;}
			else {$rlimp = 'disable'; $llimp = 0;}
			if (isset($_POST['chip'])) {$rchip = 'checked'; $chip = 1;}
			else {$rchip = 'disable'; $chip = 0;}
			$gravadados = mysqli_query ($banco, "INSERT INTO Historico(etiqueta,recarga,pesoinicial,po,lixo,pesofinal,tempo,cilindro,developer,pcr,ldos,llimp,chip,observacao,tecnico) 
				VALUES ('$etiqueta','$data','$pesoinicial','$po','$lixo','$pesofinal','$tempo','$cilindro','$developer','$pcr','$ldos','$llimp','$chip','$observacao','$tecnico')") ;
			header('Location: recarga.php');
			//echo "<script> location.href='recarga.php';</script>";			

		}
		
?>
<!DOCTYPE html>
<html>
<head> 
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="estilo.css">
	<title>Fastcomp - Nova Recarga</title>
</head>
<body>
	<div class="navigation">
		<ul>
			<li class="list active">
				<a href="principal.php">
					<span class="icon"><ion-icon name="home-outline"></ion-icon></span>
					<span class="title">Inicio</span>
				</a>				
			</li>
			<li class="list">
				<a href="recarga.php">
					<span class="icon"><ion-icon name="construct-outline"></ion-icon></span>
					<span class="title">Recarga</span>
				</a>				
			</li>
			<li class="list">
				<a href="destina.php">
					<span class="icon"><ion-icon name="file-tray-full-outline"></ion-icon></span>
					<span class="title">Destinação</span>
				</a>				
			</li>
			<li class="list">
				<a href="#">
					<span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
					<span class="title">Configurações</span>
				</a>				
			</li>
			<li class="list">
				<a href="#">
					<span class="icon"><ion-icon name="help-outline"></ion-icon></span>
					<span class="title">Help</span>
				</a>				
			</li>
			<li class="list">
				<a href="#">
					<span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
					<span class="title">Senha</span>
				</a>				
			</li>
			<li class="list">
				<a href="saida.php">
					<span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
					<span class="title">Sair</span>
				</a>				
			</li>
		</ul>
		
	</div>
	<div class="procura">
		<form action="novarecarga.php" method="POST">

		<table border="0">
   		<tr>
        	<td>Etiqueta.:</td>
        	<td><?php echo "$etiqueta";?></td>
        </tr>
        <tr>
        	<td>Modelo.:</td>
        	<td><?php echo "$modelo";?></td>
        </tr>
   		<tr>
       		<td>Peso Inicial.:</td>
        	<td><input type="number" name="pesoinicial" placeholder="Peso Inicial" value= "<?php echo $pesoinicial ?>" required></td>
        </tr>
    	<tr>
        	<td>Quantidade de Pó.:</td>
       		<td><input type="number" name="po"  placeholder="Po Acrescentado" value= "<?php echo $po ?>" required></td>
        </tr>
   		<tr>
        	<td>Lixo.:</td>
        	<td><input type="number" name="lixo"  placeholder="Lixo" value= "<?php echo $lixo ?>" required></td>
    	</tr>
     	<tr>
        	<td>Peso Final.:</td>
        	<td><input type="number" name="pesofinal"  placeholder="Peso Final" value= "<?php echo $pesofinal ?>" required></td>
        </tr>
		<tr>
			<td>
			<p>Peças substituidas:</p>
                <input type="checkbox" id="cilindro" name="cilindro" <?php echo $rcil ?>>
                <label for="cilindro">Cilindro</label>
                <br>
                <input type="checkbox" id="developer" name="developer" <?php echo $rdev ?>>
                <label for="developer">Rolo Magnetico</label>
                <br>
                <input type="checkbox" id="pcr" name="pcr" <?php echo $rpcr ?>>
                <label for="pcr">PCR</label>
                <br>
                <input type="checkbox" id="ldos" name="ldos" <?php echo $rldos ?>>
                <label for="ldos">Lamina Dosadora</label>
                <br>
                <input type="checkbox" id="llimp" name="llimp" <?php echo $rlimp ?>>
                <label for="llimp">Lamina de Limpeza</label>
                <br>
                <input type="checkbox" id="chip" name="chip" <?php echo $rchip ?> >
                <label for="chip">Chip</label>
            </td>
            <td>
            	<p>Tempo gasto.:&emsp;&emsp;&emsp;<input type="time" name="tempo" value="00:00"></p>
            	<p>Data da recarga.:&ensp;<input type="date" name="data"></p>

            </td>
           
            </tr>
            <tr>
            	<td>Observação.:</td>
            	<td><input type="text" name="observacao" placeholder="Observação" size="30" value= "<?php echo $observacao ?>" ></td>
            </tr>
            <tr>
            	<td>Tecnico.:</td>
            	<td>
            		<!--<select name="tecnico"><option>Selecione</option>
            		<?php $buscatecnico = "SELECT * FROM Tecnicos ";
            			$achoutecnico = mysqli_query($banco,$buscatecnico);
            			while ($ltecnico = mysqli_fetch_assoc($achoutecnico)) { ?>
            				<option value="<?php echo $ltecnico['idtecnico']; ?>" ><?php echo $ltecnico['tecnico']; ?> 
            				</option> <?php 	
            			}
            		 ?>
            		
            	</select>  -->
            	<input type="text" name="tecnico" list="listatecnicos" value= "<?php echo $tecnico ?>" required>
            		<datalist id="listatecnicos">
            			<?php $buscatecnico = "SELECT * FROM Tecnicos ";
            			$achoutecnico = mysqli_query($banco,$buscatecnico);
            			while ($ltecnico = mysqli_fetch_assoc($achoutecnico)) { ?>
            				<option value="<?php echo $ltecnico['tecnico']; ?>" ><?php echo $ltecnico['tecnico']; ?> 
            				</option> <?php 	
            			}
            		 ?>
            			
            		</datalist>
            	</td>
            </tr>
                <br><br>
			</table>
			<br><br>
 		   	<button class="botao" value="Voltar" ><a href="recarga.php"> Voltar</a> </button>
 		   	<input class="inputSubmit" type="submit" name="gravar" value="Gravar">
 		   	<br><br>
 		</form>
	</div>

<script  type = "module"  src = "https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js" > </ script > 
< script  nomodule  src = "https://unpkg .com/ionicons@5.5.2/dist/ionicons/ionicons.js" > </script >
<!--<script>
	//add active class in selected list item
	let list = document.querySelectorAll('.list');
	for (let i = 0; i <list.length; i++) {
		list[i].onclick = function(){
			let j = 0;
			while(j < list.length){
				list[j++].className = 'list';
			}
			list[i].className = 'list active';
		}
	}
</script>-->
</body>
</html>