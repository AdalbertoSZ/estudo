<?php
		session_start();
		include_once('conecta.php');
		include_once('logado.php');
		$datarec = $_POST['datarec'];
		//print_r($_POST);
		//print_r('Etiqueta: ' . $etiqueta);
      
    	$buscahistorico = "SELECT *,DATE_FORMAT(recarga,'%d-%m-%y') as recarga FROM Historico WHERE recarga = '$datarec' ORDER BY codigo DESC ";
    	$historico = $banco->query($buscahistorico);
    	if(mysqli_num_rows($historico) < 1){
    		$erro = 1;
	        $mensagem = 'Data não encontrada!';
    		//header('Location: recarga.php');
    	}
    	$DateTime = DateTime::createFromFormat('Y-m-d', $datarec);
		$newDate = $DateTime->format('d-m-Y');
    	//print_r($historico);
    	//$listarecarga = $historico;
    	//print_r($listarecarga);
    	//$encontrou = mysqli_fetch_assoc($listarecarga);
    	//$datarec = $historico['recarga'];
    	//$modelo = $resultado['modelo'];
    	//$buscahistorico = "SELECT * FROM Historico WHERE etiqueta = '$etiqueta' ORDER BY codigo DESC ";
    	//$buscahistorico = "SELECT *, TIME_FORMAT(tempo, '%H:%i') as tempo FROM Historico WHERE etiqueta = '$etiqueta' ORDER BY codigo DESC ";
    	//$buscahistorico = "SELECT *, TIME_FORMAT(tempo, '%H:%i') as tempo, DATE_FORMAT(recarga,'%d-%m-%y') as recarga ,DATE_FORMAT(saida,'%d-%m-%y') as saida FROM Historico WHERE recarga = '$datarec' ORDER BY codigo DESC ";
    	//$historico = $banco->query($buscahistorico);
    	//$_SESSION['etiqueta'] = $etiqueta;
    	//$_SESSION['modelo'] = $modelo;
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
			<!--<li class="list">
				<a href="#">
					<span class="icon"><ion-icon name="person-outline"></ion-icon></span>
					<span class="title">Profile</span>
				</a>				
			</li>-->
		</ul>
		
	</div>
	<div class="procura">
			<form action="destdata.php" method="POST">
				<p> <?php echo "Data da Recarga.: $newDate";?></p>
				
				<?php if ($erro==1) {echo "<h1>$mensagem</h1>";} else {echo "<p>&emsp;</p>";} ?><br>
				<button class="botao" name="voltar" value="Voltar" ><a href="destdata.php"> Voltar</a> </button>
 		      	<br><br>
 		    </form>
	</div>
	<div class="m-5">
		<table  class="tabela text-white">
			<thead style="border-bottom: 1px solid white;" >
				<tr >
					<th scope="col">ID</th>
					<th scope="col">Etiqueta</th>
					<th scope="col">Data Recarga</th>
					<th scope="col">P. Ini</th>
					<th scope="col">Qt. Pó</th>
					<th scope="col">Lixo</th>
					<th scope="col">P. Fin</th>
					<th scope="col">Tempo</th>					
					<th scope="col">Observação</th>
					<th scope="col">Técnico</th>
					<th scope="col">Num. OS</th>
					<th scope="col">Valor</th>
					<th scope="col">Data Saida</th>
					<th scope="col">Cliente Final</th>
					<th scope="col">Tipo</th>
					<th scope="col">...</th>
				</tr>
			</thead>
			<tbody>
				<?php
					while ($dadosrecarga = mysqli_fetch_assoc($historico)) {
						echo "<tr style='border-bottom: 1px solid white;'>";
						echo "<td>".$dadosrecarga['codigo']."</td>";
						echo "<td>".$dadosrecarga['etiqueta']."</td>";
						echo "<td>".$dadosrecarga['recarga']."</td>";
						echo "<td>".$dadosrecarga['pesoinicial']."</td>";
						echo "<td>".$dadosrecarga['po']."</td>";
						echo "<td>".$dadosrecarga['lixo']."</td>";
						echo "<td>".$dadosrecarga['pesofinal']."</td>";
						echo "<td>".$dadosrecarga['tempo']."</td>";						
						echo "<td>".$dadosrecarga['observacao']."</td>";
						echo "<td>".$dadosrecarga['tecnico']."</td>";
						echo "<td>".$dadosrecarga['os']."</td>";
						echo "<td>".$dadosrecarga['valor']."</td>";
						echo "<td>".$dadosrecarga['saida']."</td>";
						echo "<td>".$dadosrecarga['cliente']."</td>";
						echo "<td>".$dadosrecarga['tipo']."</td>";
						echo "<td>
                        <a class='btn btn-sm btn-primary' href='destinarecarga.php?edcodigo=$dadosrecarga[codigo]' title='Editar'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                            </svg></a> </td>";
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