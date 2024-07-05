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
		//if ($dadosrecarga['cilindro'] == 1) {$rcil = 'checked';} else {$rcil = 'disable';}
		//if ($dadosrecarga['developer'] == 1) {$rdev = 'checked';} else {$rdev = 'disable';}
		//if ($dadosrecarga['pcr'] == 1) {$rpcr = 'checked';} else {$rpcr = 'disable';}
		//if ($dadosrecarga['ldos'] == 1) {$rldos = 'checked';} else {$rldos = 'disable';}
		//if ($dadosrecarga['llimp'] == 1) {$rlimp = 'checked';} else {$rlimp = 'disable';}
		//if ($dadosrecarga['chip'] == 1) {$rchip = 'checked';} else {$rchip = 'disable';}
		$observacao = $dadosrecarga['observacao'];
		$tecnico = $dadosrecarga['tecnico'];
		$numos = $dadosrecarga['os'];
		$valor = $dadosrecarga['valor'];
		$datasaida = $dadosrecarga['saida'];
		$cliente = $dadosrecarga['cliente'];
		$tipo = $dadosrecarga['tipo'];
		$_SESSION['edcodigo'] = $edcodigo;
		$_SESSION['etiqueta'] = $etiqueta;

?>
<!DOCTYPE html>
<html>
<head>
	<title>Fastcomp - Nova Recarga</title>
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
			<form action="salvadestina.php" method="POST">
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
       					<td>Numero da OS.:</td>
        				<td><input class="entra" type="text" name="numos" placeholder="Numero da OS" value= "<?php echo $numos ?>" required></td>
        			</tr>
			    	<tr>
			        	<td>Valor.:</td>
			       		<td><input class="entra" type="number" step=".01" name="valor"  placeholder="Valor" value= "<?php echo $valor ?>" required></td>
			        </tr>
			   		<tr>
			        	<td>Cliente.:</td>
			        	<td><input class="entra" type="text" name="cliente"  placeholder="Cliente final" value= "<?php echo $cliente ?>" required></td>
			    	</tr>
			     	
					<tr>
						<td>Data da saída.:</td>
			            <td><input class="entra" type="date" name="saida" value="<?php echo $datasaida ?>" required></td>
			        </tr>
			        <tr>
			        	<td>Tipo de recarga</td>
			        	<td><input class="entra" type="text" name="tipo" list="listatipo" value= "<?php echo $tipo ?>" required>
			            	<datalist id="listatipo">
			            		<option value="Comodato">Comodato</option>
			            		<option value="Garantia">Garantia</option>
			            		<option value="Venda">Venda</option>
			            	</datalist></td>
			        </tr>
                	<br><br>
				</table>
				<br><br>
				<div class="executa">
 		   			<button class="botao" value="Voltar" ><a href="destina.php"> Voltar</a> </button>
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