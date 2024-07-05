<?php
		session_start();
		include_once('logado.php');
		include_once('conecta.php');
		$etiqueta = $_SESSION['etiqueta'];
		$modelo = $_SESSION['modelo'];
		// print_r($etiqueta);
		// print_r($modelo);
		// print_r($_POST);
		if (isset($_POST['gravar']))
		
		{
			//print_r($_POST);
			//print_r($rcil);
			$pesoinicial = $_POST['pesoi'];
			$po = $_POST['po'];
			$lixo = $_POST['lixo'];
			$pesofinal = $_POST['pesof'];
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
			$gravadados = mysqli_query ($banco, "INSERT INTO IHistorico(etiqueta,recarga,pesoinicial,po,lixo,pesofinal,tempo,cilindro,developer,pcr,ldos,llimp,chip,observacao,tecnico) 
				VALUES ('$etiqueta','$data','$pesoinicial','$po','$lixo','$pesofinal','$tempo','$cilindro','$developer','$pcr','$ldos','$llimp','$chip','$observacao','$tecnico')") ;
			header('Location: recarga.php');
			//echo "<script> location.href='recarga.php';</script>";			

		}
		
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fastcomp - Nova recarga</title>
    <link rel="stylesheet" href="estilo.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
    
    <nav>
        <img src="logop2.png" alt="fastcomp" class="logotipo">
        <ul class="menu">
            <li><a href="inicio.html"><i class='bx bx-home' ></i> Inicio</a></li>
            <li><a href="recarga.php" class="ativo"><i class='bx bx-wrench' ></i> Recarga</a></li>   
            <li><a href="patrimonio.php"><i class='bx bx-desktop' ></i> Patrimonio</a></li>
            <li><a href="#"><i class='bx bx-printer'></i> Relatorios</a></li>
            <li><a href="#"><i class='bx bx-cog' ></i> Configuração</a></li>
            <li><a href="#"><i class='bx bx-log-out' ></i> Sair</a></li>
        </ul>
    </nav>
    <!-- <header>
        <ul class="submenu lv1">
            <li onclick="filtra()"><a href="#">Filtra</a></li>
            <li><a href="#">Cadastra</a></li>
            <li><a href="#">Destina</a></li>
            </ul>
    </header> -->
    <main>
        
        <form action="nrecarga.php" method="post">
            
            <table class="nvetq">
                <tr>
                    <td><p>Etiqueta.: <?php echo $etiqueta; ?></p></td>
                    <td><p>Modelo.: <?php echo $modelo; ?></p></td>
                    
                </tr>
                <tr>
                    <td>Peso inicial.:</td>
                    <td><input type="number" id="Pesoi" name="pesoi" placeholder="Peso inicial" required></td>
                </tr>
                <tr>
                    <td>Pó inserido.:</td>
                    <td><input type="number" id="Po" name="po" placeholder="Pó inserido"  required></td>
                </tr>
                <tr>
                    <td>Pó descartado.:</td>
                    <td><input type="number" id="Lixo" name="lixo" placeholder="Pó descartado" required></td>
                </tr>
                <tr>
                    <td>Peso final.:</td>
                    <td><input type="number" id="Pesof" name="pesof" placeholder="Peso final" required></td>
                </tr>
                <tr>
                    <td>
                        <p>Peças substituidas:</p>
            			<input type="checkbox" id="cilindro" name="cilindro" >
               			<label for="cilindro">Cilindro</label>
               			<br>
                		<input type="checkbox" id="developer" name="developer" >
                		<label for="developer">Rolo Magnetico</label>
                		<br>
                		<input type="checkbox" id="pcr" name="pcr" >
                		<label for="pcr">PCR</label>
                		<br>
                		<input type="checkbox" id="ldos" name="ldos" >
                		<label for="ldos">Lamina Dosadora</label>
                		<br>
                		<input type="checkbox" id="llimp" name="llimp" >
                		<label for="llimp">Lamina de Limpeza</label>
                		<br>
                		<input type="checkbox" id="chip" name="chip"  >
                		<label for="chip">Chip</label>
                    </td>
                    <td>
            			Tempo gasto.: &ensp; <br><input class="entra" type="time" name="tempo" value="00:00">
            			<br>
                        <br>
            			Data da recarga.:&ensp;<br><input class="entra" type="date" name="data" id="Dtr">
            		</td>
                </tr>
                <tr>
                    <td>Observação.:</td>
                    <td><input class="entra" type="text" name="observacao" placeholder="Observação" size="30" value= "" ></td>
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
            			<input class="entra" type="text" name="tecnico" list="listatecnicos" value= "<?php echo $tecnico ?>" required>
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
                <tr>
                    <td><button><a href="recarga.php">Cancelar</a></button></td>
                    <td><input class="inputsubmit" type="submit" name="gravar" value="Gravar"></td>
                </tr>
            </table>
        </form>
        
    </main>
    <script type="text/javascript" >
		let Dtr = document.getElementById('Dtr')
        let peso = document.getElementById('Pesoi')
        peso.focus()
        var dta = new Date()
        var $dia = dta.getDate()
        if ($dia <= 9)
        {
            $diat = '0' + $dia.toString()
        } else 
        {
            $diat = $dia.toString()
        }
        var $mes = dta.getMonth()
        if ($mes < 9)
        {
            $mes += 1
            $mest = '0' + $mes.toString()
        }
        var $ano = dta.getFullYear()
        let dataatual = $ano.toString() + '-' + $mest + '-' + $diat
        Dtr.value = dataatual
	</script>
</body>
</html>