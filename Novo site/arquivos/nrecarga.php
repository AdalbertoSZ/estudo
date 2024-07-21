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
        if (isset($_POST['alterar'])) {
            $codigo = $_SESSION['edcodigo'];
            $recarga = $_POST['data'];
            $pesoinicial = $_POST['pesoi'];
            $po = $_POST['po'];
            $lixo = $_POST['lixo'];
            $pesofinal = $_POST['pesof'];
            //$data = $_POST['data'];
            $tempo = $_POST['tempo'];
            if (isset($_POST['cilindro'])) {$cilindro =  1;} else {$cilindro = 0; }
            if (isset($_POST['developer'])) {$developer = 1;} else {$developer = 0;}
            if (isset($_POST['pcr'])) {$pcr = 1;} else {$pcr = 0;}
            if (isset($_POST['ldos'])) {$ldos = 1;} else {$ldos = 0;}
            if (isset($_POST['llimp'])) {$llimp = 1;} else {$llimp = 0;}
            if (isset($_POST['chip'])) {$chip = 1;} else {$chip = 0;}
            $observacao = $_POST['observacao'];
            $tecnico = $_POST['tecnico'];
            $sqlInsert = "UPDATE IHistorico 
            SET recarga='$recarga',pesoinicial='$pesoinicial',po='$po',lixo='$lixo',pesofinal='$pesofinal',tempo='$tempo',cilindro='$cilindro',developer='$developer',pcr='$pcr',ldos='$ldos',llimp='$llimp',chip='$chip',observacao='$observacao',tecnico='$tecnico' WHERE codigo=$codigo";
            $result = $banco->query($sqlInsert);
            header('Location: recarga.php');
        }
        if (isset($_GET['edcodigo'])) {
            $codrec = $_GET['edcodigo'];
            $buscarecarga = "SELECT * FROM IHistorico WHERE codigo = '$codrec' ";
            $encontrou = $banco->query($buscarecarga);
            if(mysqli_num_rows($encontrou) < 1){
                header('Location: recarga.php');
            }
            $_SESSION['edcodigo'] = $codrec;
            $tiposubmit = "alterar";
            $dadosrecarga = mysqli_fetch_assoc($encontrou);
            $etiqueta = $dadosrecarga['etiqueta'];
            $buscamodelo = "SELECT * FROM Itoner WHERE etiqueta = '$etiqueta' ";
            $encmod = $banco->query($buscamodelo);
            $dadosetq = mysqli_fetch_assoc($encmod);
            $modelo = $dadosetq['modelo'];
            if ($dadosrecarga['cilindro'] == 1) {$rcil = 'checked';} else {$rcil = 'disable';}
            if ($dadosrecarga['developer'] == 1) {$rdev = 'checked';} else {$rdev = 'disable';}
            if ($dadosrecarga['pcr'] == 1) {$rpcr = 'checked';} else {$rpcr = 'disable';}
            if ($dadosrecarga['ldos'] == 1) {$rldos = 'checked';} else {$rldos = 'disable';}
            if ($dadosrecarga['llimp'] == 1) {$rlimp = 'checked';} else {$rlimp = 'disable';}
            if ($dadosrecarga['chip'] == 1) {$rchip = 'checked';} else {$rchip = 'disable';}
            $tecnico = $dadosrecarga['tecnico'];
            //print_r($rcil);
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
            <li><a href="cadastro.php"><i class='bx bx-cabinet' ></i> Cadastro</a></li>
            <li><a href="configura.php"><i class='bx bx-cog' ></i> Configuração</a></li>
            <li><a href="saida.php"><i class='bx bx-log-out' ></i> Sair</a></li>
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
                    <td><input type="number" name="pesoi" placeholder="Peso inicial" value="<?php echo $dadosrecarga['pesoinicial']?>" autofocus required></td>
                </tr>
                <tr>
                    <td>Pó inserido.:</td>
                    <td><input type="number" name="po" placeholder="Pó inserido" value="<?php echo $dadosrecarga['po']?>" required></td>
                </tr>
                <tr>
                    <td>Pó descartado.:</td>
                    <td><input type="number" id="Lixo" name="lixo" placeholder="Pó descartado" value="<?php echo $dadosrecarga['lixo']?>" required></td>
                </tr>
                <tr>
                    <td>Peso final.:</td>
                    <td><input type="number" name="pesof" placeholder="Peso final" value="<?php echo $dadosrecarga['pesofinal']?>" required></td>
                </tr> 
                <tr>
                    <td>
                        <p>Peças substituidas:</p>
            			<input type="checkbox" id="cilindro" name="cilindro" <?php echo $rcil ?> >
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
                		<input type="checkbox" id="chip" name="chip" <?php echo $rchip ?>>
                		<label for="chip">Chip</label>
                    </td>
                    <td>
            			Tempo gasto.: &ensp; <br><input class="entra" type="time" name="tempo" value="<?php if ($tiposubmit=="alterar") {echo $dadosrecarga['tempo'];} else {echo "00:00";}?>">
            			<br>
                        <br>
            			Data da recarga.:&ensp;<br><input class="entra" type="date" name="data" id="Dtr" value="<?php echo $dadosrecarga['recarga']?>">
            		</td>
                </tr>
                <tr>
                    <td>Observação.:</td>
                    <td><input class="entra" type="text" name="observacao" placeholder="Observação" size="30" value= "<?php echo $dadosrecarga['observacao']?>" ></td>
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
                    <td><input id="envia" class="inputsubmit" type="submit" <?php if ($tiposubmit=="alterar") {
                        echo "name='alterar' value='Alterar'";
                    } else {echo "name='gravar' value='Gravar'";
                    }?> ></td>
                </tr>
            </table>
        </form>
        
    </main>
    <script type="text/javascript" >
		let Dtr = document.getElementById('Dtr')
        let $envia = document.getElementById('envia')
        // let peso = document.getElementById('Pesoi')
        // peso.focus()
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
        if($envia.value == 'Gravar') {
            Dtr.value = dataatual
        }
        
	</script>
</body>
</html>