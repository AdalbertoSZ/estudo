<?php
		session_start();
		include('logado.php');
?>
<!DOCTYPE html>
<html>
<head> 
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="estilo.css">
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
				<a href="#">
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
			<form action="procura.php" method="POST">
				<!--<p>Etiqueta........: <input type="text" name="etiqueta" size="6" placeholder="etiqueta" value="C-"> </p>
 		      	<br><br>-->
 		      			<table border="1">
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
        	<td><input type="number" name="pesoinicial" placeholder="Peso Inicial"  ></td>
        </tr>
    	<tr>
        	<td>Quantidade de Pó.:</td>
       		<td><input type="number" name="po"  placeholder="Po Acrescentado" ></td>
        </tr>
   		<tr>
        	<td>Lixo.:</td>
        	<td><input type="number" name="lixo"  placeholder="Lixo" ></td>
    	</tr>
     	<tr>
        	<td>Peso Final.:</td>
        	<td><input type="number" name="pesofinal"  placeholder="Peso Final" ></td>
        </tr>
		<tr>
			<td>
			<p>Peças substituidas:</p>
                <input type="radio" id="cilindro" name="cilindro" value="1" required >
                <label for="feminino">Cilindro</label>
                <br>
                <input type="radio" id="developer" name="developer" value="1" required>
                <label for="masculino">Developer</label>
                <br>
                <input type="radio" id="pcr" name="pcr" value="1" required>
                <label for="outro">PCR</label>
                <br>
                <input type="radio" id="ldos" name="ldos" value="1" required>
                <label for="outro">Lamina Dosadora</label>
                <br>
                <input type="radio" id="llimp" name="llimp" value="1" required>
                <label for="outro">Lamina de Limpeza</label>
                <br>
                <input type="radio" id="chip" name="chip" value="1" required>
                <label for="outro">Chip</label>
            </td>
           
            </tr>
            <tr>
            	<td>Observação.:</td>
            	<td><input type="text" name="Observacao" placeholder="Observação" size="30"></td>
            </tr>
            <tr>
            	<td>Tecnico.:</td>
            	<td><input type="text" name="tecnico" size="15" ></td>
            </tr>
                <br><br>
			</table>
 		      	<input class="inputSubmit" type="submit" name="procura" value="Procura">
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