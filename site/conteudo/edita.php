<?php
		session_start();
		include_once('logado.php');
		include_once('conecta.php');
		$etiqueta = $_SESSION['etiqueta'];
		$modelo = $_SESSION['modelo'];
		$edcodigo = $_GET['edcodigo'];
		$buscarecarga = "SELECT * FROM Historico WHERE codigo = '$edcodigo' ";
		$encontrou = $banco->query($buscarecarga);
		//print_r($edcodigo);
		//print_r($encontrou);
		if(mysqli_num_rows($encontrou) < 1){
			header('Location: recarga.php');
    	}
    	$dadosrecarga = mysqli_fetch_assoc($encontrou);
    	$etiqueta = $dadosrecarga['etiqueta'];
    	//print_r($etiqueta);
    	$buscamodelo = "SELECT * FROM Toner WHERE etiqueta = '$etiqueta' ";
		$encmodelo = $banco->query($buscamodelo);
		$dadoetiqueta = mysqli_fetch_assoc($encmodelo);
		$modelo = $dadoetiqueta['modelo'];
    	$recarga = $dadosrecarga['recarga'];
		$pesoinicial = $dadosrecarga['pesoinicial'];
		$po = $dadosrecarga['po'];
		$lixo = $dadosrecarga['lixo'];
		$pesofinal = $dadosrecarga['pesofinal'];
		$tempo = $dadosrecarga['tempo'];
		if ($dadosrecarga['cilindro'] == 1) {$rcil = 'checked';} else {$rcil = 'disable';}
		if ($dadosrecarga['developer'] == 1) {$rdev = 'checked';} else {$rdev = 'disable';}
		if ($dadosrecarga['pcr'] == 1) {$rpcr = 'checked';} else {$rpcr = 'disable';}
		if ($dadosrecarga['ldos'] == 1) {$rldos = 'checked';} else {$rldos = 'disable';}
		if ($dadosrecarga['llimp'] == 1) {$rlimp = 'checked';} else {$rlimp = 'disable';}
		if ($dadosrecarga['chip'] == 1) {$rchip = 'checked';} else {$rchip = 'disable';}
		$observacao = $dadosrecarga['observacao'];
		$tecnico = $dadosrecarga['tecnico'];
		$_SESSION['edcodigo'] = $edcodigo;
		$_SESSION['etiqueta'] = $etiqueta;

?>
<!DOCTYPE html>
<html>
<head>
	<title>Fastcomp - Edita Recarga</title>
	<meta charset="UTF-8">
    <link rel="stylesheet" href="menup.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<div class="ttela" id="dvtela"></div>
	<div class="sbar fechada" id="sdbar" >
		<div class="logo" >
			<div class="logoc"><img src="logop2.png" id="ilogo"></div>	
		</div>
		<div class="nlista" onmouseover="expmenu()" onmouseleave="retmenu()" >
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
			<form action="salvarecarga.php" method="POST">
				<table class="nwrec">
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
        				<td><input class="entra" type="number" name="pesoinicial" placeholder="Peso Inicial" value= "<?php echo $pesoinicial ?>" size="8" required></td>
       				</tr>
    				<tr>
        				<td>Quantidade de Pó.:</td>
       					<td><input class="entra" type="number" name="po"  placeholder="Po Acrescentado" value= "<?php echo $po ?>" required></td>
        			</tr>
   					<tr>
        				<td>Lixo.:</td>
        				<td><input class="entra" type="number" name="lixo"  placeholder="Lixo" value= "<?php echo $lixo ?>" required></td>
    				</tr>
     				<tr>
        				<td>Peso Final.:</td>
        				<td><input class="entra" type="number" name="pesofinal"  placeholder="Peso Final" value= "<?php echo $pesofinal ?>" required></td>
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
            			<p>Tempo gasto.:&emsp;&emsp;&emsp;<input class="entra" type="time" name="tempo" value="<?php echo $tempo ?>" ></p>
            			<p>&emsp;</p>
            			<p>Data da recarga.:&ensp;<input class="entra" type="date" name="data" value="<?php echo $recarga ?>"></p>
            			</td>
                    </tr>
            		<tr>
            			<td>Observação.:</td>
            			<td><input class="entra" type="text" name="observacao" placeholder="Observação" size="30" value= "<?php echo $observacao ?>" ></td>
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
                	<br><br>
				</table>
				<br><br>
				<div class="executa">
 		   			<button class="botao" value="Voltar" ><a href="recarga.php"> Voltar</a> </button>
 		   			<input class="inputsubmit" type="submit" name="atualiza" value="Atualiza">
 		   		</div>
 		   		<br><br>
 		</form>
		</div>
		</div>
	
		
	<script type="text/javascript">
		function expmenu(){
            var DVCAB = document.getElementById("dvcab");
            var DVTELA = document.getElementById("dvtela");
            document.getElementById('sdbar').className = "sbar";
            var currWidth = DVTELA.clientWidth;
            DVCAB.style.left = ('210px');
            DVCAB.style.width = (currWidth - 210) + 'px';
        }
        function retmenu(){
            var DVCAB = document.getElementById("dvcab");
            var DVTELA = document.getElementById("dvtela");
            document.getElementById('sdbar').className = "sbar fechada";
            var currWidth = DVTELA.clientWidth;
            DVCAB.style.left = ('90px');
            DVCAB.style.width = (currWidth - 90 ) + 'px';
        }
	</script>	
</body>
</html>