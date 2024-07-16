<?php
		session_start();
		include_once('conecta.php');
		include_once('logado.php');
        
        
    	
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fastcomp Informatica</title>
    <link rel="stylesheet" href="estilo.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
    
    <nav>
        <img src="logop2.png" alt="fastcomp" class="logotipo">
        <ul class="menu">
            <li><a href="inicio.html"><i class='bx bx-home' ></i> Inicio</a></li>
            <li><a href="recarga.php"><i class='bx bx-wrench' ></i> Recarga</a></li>   
            <li><a href="patrimonio.php"><i class='bx bx-desktop' ></i> Patrimonio</a></li>
            <li><a href="relatorio.php"><i class='bx bx-printer'></i> Relatorios</a></li>
            <li><a href="cadastro.php"><i class='bx bx-cabinet' ></i> Cadastro</a></li>
            <li><a href="configura.php" class="ativo"><i class='bx bx-cog' ></i> Configuração</a></li>
            <li><a href="#"><i class='bx bx-log-out' ></i> Sair</a></li>
        </ul> 
    </nav>
    <header>
    <ul class="submenu lv5">
        <li><a href="#">Opção 1</a></li>
        <li><a href="#">Opção 2</a></li>
        <li><a href="#">Opção 3</a></li>
        
        </ul>
    </header>
    <main class="btaviso">
        <button name="designant" value="designant"><a href="../conteudo/inicio.html">Design antigo</a></button>
    </main>
    
</body>
</html>