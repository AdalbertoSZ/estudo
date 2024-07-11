<?php
		session_start();
		include_once('conecta.php');
		include_once('logado.php');
        $etiqueta = $_POST['etiqueta'];
        if (empty($etiqueta))  {
            $betq = '%';
        } else {
            $betq = $etiqueta;
            $betq .= '%';
        }
        $buscatoner = "SELECT * FROM Itoner WHERE etiqueta like '$betq' ";
    	$encontrou = $banco->query($buscatoner);
        $numetq =  mysqli_num_rows($encontrou);
        //print_r($numetq);
		//print_r($etiqueta);
        $buscarecarga = "SELECT * FROM IHistorico WHERE etiqueta like '$betq' ";
        $contrecarga = $banco->query($buscarecarga);
        $numrec =  mysqli_num_rows($contrecarga);
        //print_r($numrec);
        
		//SELECT * FROM Tabela LIMIT 10;
		$buscahistorico = "SELECT *, TIME_FORMAT(tempo, '%H:%i') as tempo, DATE_FORMAT(recarga,'%d-%m-%y') as recarga ,DATE_FORMAT(saida,'%d-%m-%y') as saida FROM IHistorico WHERE etiqueta like '$betq' ORDER BY codigo   DESC LIMIT 50";
    	$historico = $banco->query($buscahistorico);
        
    	
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fastcomp - Recarga</title>
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
            <li><a href="#"><i class='bx bx-printer'></i> Relatorios</a></li>
            <li><a href="configura.php"><i class='bx bx-cog' ></i> Configuração</a></li>
            <li><a href="#"><i class='bx bx-log-out' ></i> Sair</a></li>
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
        <?php  
            if ( $numetq == 1 ) {
                $resultado = mysqli_fetch_assoc($encontrou);
    	        $modelo = $resultado['modelo'];
                echo "<h1> Etiqueta <span class='destaque'>" .$etiqueta. "</span> Modelo <span class='destaque'>" .$modelo. "</span></h1>";
                $_SESSION['etiqueta'] = $etiqueta;
    	        $_SESSION['modelo'] = $modelo;
                // echo "<input type='submit' name='nvrecarga' value='Nova Recarga'></form>";
                echo "<button class='btnvrec' type='submit' name='nvrecarga' value='nvrecarga'><a href='nrecarga.php'>Nova Recarga</a></button>";
            } else {
                echo "<h1>Existe <span class='destaque'>" .$numetq. "</span> Etiquetas e <span class='destaque'>" .$numrec. "</span> Recargas cadastradas</h1>"; }
        ?>
        <table class="tbrec">
            <thead >
                <tr>
                    <th scope="col" class="c1">ID</th>
                    <th scope="col">Etiqueta</th>
                    <th scope="col">Data Recarga</th>
                    <th scope="col">P. Ini</th>
                    <th scope="col">Qt. Pó</th>
                    <th scope="col">Lixo</th>
                    <th scope="col">P. Fin</th>
                    <th scope="col">Tempo</th>
                    <th scope="col">Cil.</th>
                    <th scope="col">R. Mag</th>
                    <th scope="col">PCR</th>
                    <th scope="col">L. Dos.</th>
                    <th scope="col">L. Limp.</th>
                    <th scope="col">Chip</th>
                    <th scope="col">Observação</th>
                    <th scope="col">Técnico</th>
                    <th scope="col">Data Saida</th>
                    <th scope="col">Cliente Final</th>
                    <th scope="col">Tipo</th>
                    <th scope="col" class="cf">...</th>
                </tr>
            </thead>
            <tbody>
                <?php
					while ($dadosrecarga = mysqli_fetch_assoc($historico)) {
						echo "<tr>";
						echo "<td class='c2'>".$dadosrecarga['codigo']."</td>";
						echo "<td>".$dadosrecarga['etiqueta']."</td>";
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
						echo "<td>".$dadosrecarga['tipo']."</td>";
						echo "<td class='c2f'>
                        <a class='btn btn-sm btn-primary' href='edita.php?edcodigo=$dadosrecarga[codigo]' title='Editar'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                            </svg></a> </td>";
						echo "</tr>";
					}
				?>         
        </tbody>
        </table>
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