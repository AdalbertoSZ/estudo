<?php

?>
<!DOCTYPE html>
<html>
<head> 
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="stilo.css">
	<title>side bar</title>
</head>
<body>
	<div class="navigation">
		<ul>
			<li class="list active">
				<a href="#">
					<span class="icon"><ion-icon name="home-outline"></ion-icon></span>
					<span class="title">Inicio</span>
				</a>				
			</li>
			<li class="list">
				<a href="#">
					<span class="icon"><ion-icon name="hourglass-outline"></ion-icon></span>
					<span class="title">Recarga</span>
				</a>				
			</li>
			<li class="list">
				<a href="#">
					<span class="icon"><ion-icon name="desktop-outline"></ion-icon></span>
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
				<a href="#">
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