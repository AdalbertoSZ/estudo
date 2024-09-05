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
    <title>Fastcomp - Modelo</title>
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
            <li><a href="relatorio.php"><i class='bx bx-printer'></i> Relatorios</a></li>
            <li><a href="cadastro.php"><i class='bx bx-cabinet' ></i> Cadastro</a></li>
            <li><a href="configura.php"><i class='bx bx-cog' ></i> Configuração</a></li>
            <li><a href="saida.php"><i class='bx bx-log-out' ></i> Sair</a></li>
      </ul>
    </nav>
    <header>
    <ul class="submenu lv1">
        <li onclick="filtra()"><a href="#">Filtra</a></li>
        <li><a href="#">Cadastra</a></li>
        <li><a href="#">Destina</a></li>
        
        </ul>
    </header>
    <main class="conteudo"> 
        
    </main>
    <div class="filtro" id="dvfiltro" >
        
                <form action="recarga.php" method="post" id="ffiltra">
                    <p>Etiqueta.: <input type="text" name="etiqueta" class="inetq" value="C-" size="6" id="etq"></p>
                    <div class="dvbotao">
                        <button class="botao" name="cancela" value="cancela" onclick="dfiltro()"><a href="#">Cancelar</a></button>
                        <button class="botao" name="limpaf" value="limpaf" onclick="lfiltro()"><a href="#">Limpa filtro</a></button>
                            <input class="inputsubmit" type="submit" name="filtra" value="Filtra">
                    </div>
                </form>
                
            
    </div>
    <script type="text/javascript">
        function filtra() {
            var $dvfiltro = document.getElementById("dvfiltro");
            var $etq = document.getElementById("etq");
            //$dvfiltro.style.opacity = 1;
            $dvfiltro.style.visibility= "visible";
            $etq.value = "C-"
        }
        function dfiltro() {
            var $dvfiltro = document.getElementById("dvfiltro");
            //$dvfiltro.style.opacity = 0;
            $dvfiltro.style.visibility= ("hidden");
        }
        function lfiltro() {
            var $dvfiltro = document.getElementById("dvfiltro");
            var $etq = document.getElementById("etq");
            const $ffiltra = document.getElementById("ffiltra");
            $etq.value = "C-";
            //$dvfiltro.style.opacity = 0;
            $dvfiltro.style.visibility= ("hidden");
            $ffiltra.submit();
        }
            
    </script>

</body>
</html>