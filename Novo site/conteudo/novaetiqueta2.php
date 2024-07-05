<?php
		session_start();
		include_once('logado.php');
		include_once('conecta.php');
		$buscatoner = "SELECT * FROM Toner ORDER BY codigo DESC ";
		$historico = $banco->query($buscatoner);
		if(isset($_POST['novaetiqueta']))
	    {
	        
	        $etiqueta = $_POST['etiqueta'];
	        $modelo = $_POST['modelo'];
	        $buscaetiqueta = "SELECT * FROM Toner WHERE etiqueta = '$etiqueta' ";
	        $result = $banco->query($buscaetiqueta);
	        if(mysqli_num_rows($result) > 0)
	        {
	        	$erro = 1;
	            $mensagem = 'Etiqueta já cadastrada!';
	            //echo "<script> alert('Erro...: Etiqueta já cadastrada!');</script>";
	            //echo "<script> location.href='novaetiqueta.php';</script>";

	            //header('Location: recarga.php');
	        }
	        else
	        {
	            if ($etiqueta == "C-") {
	            	$erro=1;
	            	$mensagem = 'Preencha a Etiqueta!';
	                //echo "<script> alert('Erro...: Preencha o numero da Etiqueta!');</script>";
	                //echo "<script> location.href='novaetiqueta.php';</script>";
	            }
	            else{
	                $ativo = 1;
	                $gravadados = mysqli_query ($banco, "INSERT INTO Toner(etiqueta,modelo,ativo) VALUES ('$etiqueta','$modelo','$ativo')") ;
	                $_SESSION['etiqueta'] = $etiqueta;
	                $_SESSION['modelo'] = $modelo;
	                echo "<script> location.href='novarecarga.php';</script>";}
	        }
	        //header('Location: novarecarga.php');
	    
	        
	        //print_r($result);
	    }




?>
<!DOCTYPE html>
<html>
<head> 
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="estilo.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<title>Fastcomp - Nova Etiqueta</title>
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
			<form action="novaetiqueta.php" method="POST">
								
				<p>Etiqueta..........: <input type="text" name="etiqueta" size="6" placeholder="etiqueta" value="C-" required> </p>
 		      	
 		      	<p>Modelo...........: <input type="text" name="modelo" size="6" placeholder="modelo" required> </p>
 		      	<?php if ($erro==1) {echo "<h1>$mensagem</h1>";} else {echo "<br>";} ?><br>
 		      	<button class="botao" name="voltar" value="Voltar" ><a href="recarga.php"> Voltar</a> </button>
 		      	<input class="inputSubmit" type="submit" name="novaetiqueta" value="Nova Etiqueta">
 		      	
 		      	<p></p>
 		    </form>
	</div>
	<div class="m-5">
		<table  class="tabela2 text-white">
			<thead style="border-bottom: 1px solid white;" >
				<tr >
					<th scope="col">ID</th>
					<th scope="col">Etiqueta</th>
					<th scope="col">Modelo</th>
					<th scope="col">Ativo</th>
					<!--<th scope="col">...</th>-->
				</tr>
			</thead>
			<tbody>
				<?php
					while ($dadosrecarga = mysqli_fetch_assoc($historico)) {
						echo "<tr style='border-bottom: 1px solid white;'>";
						echo "<td>".$dadosrecarga['codigo']."</td>";
						echo "<td>".$dadosrecarga['etiqueta']."</td>";
						echo "<td>".$dadosrecarga['modelo']."</td>";
						echo "<td>".$dadosrecarga['ativo']."</td>";
						//echo "<td>
                        //<a class='btn btn-sm btn-primary' href='edita.php?edcodigo=$dadosrecarga[codigo]' title='Editar'>
                           // <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                           //     <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                           // </svg></a> </td>";
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