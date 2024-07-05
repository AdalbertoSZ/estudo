<?php
		session_start();
		include('conecta.php');
		include('logado.php');
		$etiqueta = $_POST['etiqueta'];
		//print_r('Etiqueta: ' . $etiqueta);

       //print_r('Email: ' . $usuario);
        //print_r('<br>');
       // print_r('Senha: ' . $senha);
 
    	$buscatoner = "SELECT * FROM Toner WHERE etiqueta = '$etiqueta' ";
    	$encontrou = $banco->query($buscatoner);
    	if(mysqli_num_rows($encontrou) < 1){
    		header('Location: recarga.php');
    	}

    	$resultado = mysqli_fetch_assoc($encontrou);
    	$modelo = $resultado['modelo'];
    	$buscahistorico = "SELECT * FROM Historico WHERE etiqueta = '$etiqueta' ";
    	$historico = $banco->query($buscahistorico);
    	$_SESSION['etiqueta'] = $etiqueta;
    	$_SESSION['modelo'] = $modelo;
        //$resultado = $banco->query($buscatoner);
        //print_r($buscatoner);
        //print_r('<br>');
        //print_r($historico);
       
?>
<!DOCTYPE html>
<html>
<head> 
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="estilo.css">
	 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
	<title>Fastcomp - Recarga</title>
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
				<a href="#">
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
			<!--<li class="list">
				<a href="#">
					<span class="icon"><ion-icon name="person-outline"></ion-icon></span>
					<span class="title">Profile</span>
				</a>				
			</li>-->
		</ul>
		
	</div>
	<div class="procura">
			<form action="novarecarga.php" method="POST">
				<p> <?php echo "Etiqueta........: $etiqueta";?></p>
				<p> <?php echo "Modelo.........: $modelo";?></p>
				<br><br>
				<button class="botao" name="voltar" value="Voltar" ><a href="recarga.php"> Voltar</a> </button>
 		      	<input class="inputSubmit" type="submit" name="novarecarga" value="Nova Recarga">
 		      	<br><br>
 		    </form>
	</div>
	<div class="m-5">
		<table  class="tabela text-white">
			<thead style="border-bottom: 1px solid white;" >
				<tr >
					<th scope="col">ID</th>
					<th scope="col">Data Recarga</th>
					<th scope="col">P. Inic</th>
					<th scope="col">Qt. Pó</th>
					<th scope="col">Lixeira</th>
					<th scope="col">Peso Fin.</th>
					<th scope="col">Tempo</th>
					<th scope="col">Cil.</th>
					<th scope="col">Dev.</th>
					<th scope="col">PCR</th>
					<th scope="col">L. Dos.</th>
					<th scope="col">L. Limp.</th>
					<th scope="col">Chip</th>
					<th scope="col">Observação</th>
					<th scope="col">Técnico</th>
					<th scope="col">Data Saida</th>
					<th scope="col">Cliente Final</th>
				</tr>
			</thead>
			<tbody>
				<?php
					while ($dadosrecarga = mysqli_fetch_assoc($historico)) {
						echo "<tr style='border-bottom: 1px solid white;'>";
						echo "<td>".$dadosrecarga['codigo']."</td>";
						echo "<td>".$dadosrecarga['recarga']."</td>";
						echo "<td>".$dadosrecarga['pesoinicial']."</td>";
						echo "<td>".$dadosrecarga['po']."</td>";
						echo "<td>".$dadosrecarga['lixo']."</td>";
						echo "<td>".$dadosrecarga['pesofinal']."</td>";
						echo "<td>".$dadosrecarga['tempo']."</td>";
						echo "<td>".$dadosrecarga['cilindro']."</td>";
						echo "<td>".$dadosrecarga['developer']."</td>";
						echo "<td>".$dadosrecarga['pcr']."</td>";
						echo "<td>".$dadosrecarga['ldos']."</td>";
						echo "<td>".$dadosrecarga['llimp']."</td>";
						echo "<td>".$dadosrecarga['chip']."</td>";
						echo "<td>".$dadosrecarga['observacao']."</td>";
						echo "<td>".$dadosrecarga['tecnico']."</td>";
						echo "<td>".$dadosrecarga['saida']."</td>";
						echo "<td>".$dadosrecarga['cliente']."</td>";
						echo "</tr>";
					}
				?>
			</tbody>
		</table>
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