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
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="estilo.css">
	<title>Fastcomp - Edita recarga</title>
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
		<form action="salvadestina.php" method="POST">

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
       		<td>Numero da OS.:</td>
        	<td><input type="text" name="numos" placeholder="Numero da OS" value= "<?php echo $numos ?>" required></td>
        </tr>
    	<tr>
        	<td>Valor.:</td>
       		<td><input type="number" step=".01" name="valor"  placeholder="Valor" value= "<?php echo $valor ?>" required></td>
        </tr>
   		<tr>
        	<td>Cliente.:</td>
        	<td><input type="text" name="cliente"  placeholder="Cliente final" value= "<?php echo $cliente ?>" required></td>
    	</tr>
     	
		<tr>
			<td>Data da saída.:</td>
            <td><input type="date" name="saida" value="<?php echo $datasaida ?>" required></td>
        </tr>
        <tr>
        	<td>Tipo de recarga</td>
        	<td><input type="text" name="tipo" list="listatipo" value= "<?php echo $tipo ?>" required>
            		<datalist id="listatipo">
            			<option value="Comodato">Comodato</option>
            			<option value="Garantia">Garantia</option>
            			<option value="Venda">Venda</option>
            		</datalist></td>
        </tr>
        <br><br>
	</table>
			<br><br>
 		   	<button class="botao" value="Voltar" ><a href="destina.php"> Voltar</a> </button>
 		   	<input class="inputSubmit" type="submit" name="atualiza" value="Atualiza">
 		   	<br><br>
 		</form>
	</div>

<script  type = "module"  src = "https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js" > </ script > 
< script  nomodule  src = "https://unpkg .com/ionicons@5.5.2/dist/ionicons/ionicons.js" > </script >
<script>
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
</script>
</body>
</html>