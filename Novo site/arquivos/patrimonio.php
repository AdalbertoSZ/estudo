<?php
		session_start();
		include_once('conecta.php');
		include_once('logado.php');
		//SELECT * FROM Tabela LIMIT 10;
        $patrimonio = $_POST['patrimonio'];
        $Cliente = $_POST['Lcliente'];
        if (empty($patrimonio))  {
            $bpatr = '%';
        } else {
            $bpatr = $patrimonio;
            $bpatr .= '%';
        }
        if (empty($Cliente))  {
            $idcli = '%';
        } else {
            $buscaidcli = "SELECT * FROM Clientes WHERE Cliente = '$Cliente' ";
            $encidcli = $banco->query($buscaidcli);
            $dadosidcli = mysqli_fetch_assoc($encidcli);
            $idcli = $dadosidcli['Indice'];
        }

		$buscapatr = "SELECT *, DATE_FORMAT(Data,'%d-%m-%y') as Data  FROM Patrimonio WHERE Patrimonio like '$bpatr' AND Idcliente like '$idcli' ORDER BY Indice DESC";
    	$listapatr = $banco->query($buscapatr);
        $numpatr =  mysqli_num_rows($listapatr);
    	$_SESSION['Patrimonio'] = $patrimonio;

        $buscapatrimonio = "SELECT *, DATE_FORMAT(Data,'%d-%m-%y') as Data  FROM Patrimonio WHERE Patrimonio like '$bpatr' AND Idcliente like '$idcli' ORDER BY Indice DESC LIMIT 50";
        $lista = $banco->query($buscapatrimonio);
    	
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fastcomp - Patrimonio</title>
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
            <li><a href="patrimonio.php" class="ativo"><i class='bx bx-desktop' ></i> Patrimonio</a></li>
            <li><a href="relatorio.php
            "><i class='bx bx-printer'></i> Relatorios</a></li>
            <li><a href="cadastro.php"><i class='bx bx-cabinet' ></i> Cadastro</a></li>
            <li><a href="configura.php"><i class='bx bx-cog' ></i> Configuração</a></li>
            <li><a href="saida.php"><i class='bx bx-log-out' ></i> Sair</a></li>
      </ul>
      </nav>
      <header>
        <ul class="submenu lv2" >
            <li><a onclick="filtra()" href="#">Filtra</a></li>
            <li><a href="nvpatrimonio.php">Cadastra</a></li>
            <li><a href="trpatrimonio.php">Transfere</a></li>
          </ul>
      </header>
      <main class="conteudo"> 
      <?php  
            if ( $numpatr == 1 ) {
                $resultado = mysqli_fetch_assoc($listapatr);
                $patrimonio =$resultado['Patrimonio'];
    	        $modelo = $resultado['Modelo'];
                $serial = $resultado['Nserie'];
                echo "<h1>Patrimonio <span class='destaque'>" .$patrimonio. "</span> Modelo <span class='destaque'>" .$modelo. "</span> Serial <span class='destaque'>" .$serial. "</span></h1>";
                //$_SESSION['etiqueta'] = $etiqueta;
    	        $_SESSION['modelo'] = $modelo;
                // echo "<input type='submit' name='nvrecarga' value='Nova Recarga'></form>";
                echo "<button class='btnvrec' type='submit' name='trpatr' value='trpatr'><a href='trpatrimonio.php?patrimonio=$patrimonio'>Transferencia</a></button>";
                $buscalocal = "SELECT * , DATE_FORMAT(Datatrs,'%d-%m-%Y') as Datatrs FROM Localizacao WHERE Patrimonio = '$patrimonio' ORDER BY Indice DESC";
    	        $llocal = $banco->query($buscalocal);
                echo "<table class='tbrec'>";
                echo "<thead >
                        <tr>
                            <th scope='col' class='c1'>Data Transferencia</th>
                            <th scope='col'>Cliente</th>
                            <th scope='col'>Anotação</th>
                            <th scope='col'>Departamento</th>
                            <th scope='col' class='cf'>...</th>
                        </tr>
                    </thead>";
                echo "<tbody>";
            
                    while ($destino = mysqli_fetch_assoc($llocal)) {
                        echo "<tr>";
                        
                        
                        echo "<td class='c2'>".$destino['Datatrs']."</td>";
                        $buscacli = "SELECT * FROM Clientes WHERE Indice = $destino[Cliente] ";
                        $ncli = $banco->query($buscacli);
                        $nomecli = mysqli_fetch_assoc($ncli);
                        echo "<td>".$nomecli['Cliente']."</td>";
                        echo "<td>".$destino['Anotacao']."</td>";
                        echo "<td>".$destino['Depto']."</td>";
                        echo "<td class='c2f'>
                        <a class='btn btn-sm btn-primary' href='edtrpatr.php?edcodigo=$destino[Indice]' title='Editar'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                            </svg></a> </td>";
                        echo "</tr>";
                    }
                    
                echo "</tbody>";
                echo "</table>";

            } else {
                echo "<h1>Existe <span class='destaque'>" .$numpatr. "</span> Patrimonios cadastrados</h1>"; 
        echo "
        <table class='tbrec'>
            <thead >
                <tr>
                    <th scope='col' class='c1'>ID</th>
                    <th scope='col' >Patrimonio</th>
                    <th scope='col'>Marca</th>
                    <th scope='col'>Modelo</th>
                    <th scope='col'>Serial</th>
                    <th scope='col'>Data</th>
                    <th scope='col'>Tipo</th>
                    <th scope='col'>Valor</th>
                    <th scope='col'>Observação</th>
                    <th scope='col'>Localização</th>
                    <th scope='col'>Departamento</th>
                    <th scope='col' class='cf'>...</th>
                </tr>
            </thead>
            <tbody>";
					while ($inventario = mysqli_fetch_assoc($lista)) {
						echo "<tr>";
						echo "<td class='c2'>".$inventario['Indice']."</td>";
						echo "<td>".$inventario['Patrimonio']."</td>";
						echo "<td>".$inventario['Marca']."</td>";
						echo "<td>".$inventario['Modelo']."</td>";
						echo "<td>".$inventario['Nserie']."</td>";
						echo "<td>".$inventario['Data']."</td>";
						echo "<td>".$inventario['Tipo']."</td>";
						echo "<td>".$inventario['Valor']."</td>";
						echo "<td>".$inventario['Observacao']."</td>";
						$buscacli = "SELECT * FROM Clientes WHERE Indice = $inventario[Idcliente] ";
						$ncli = $banco->query($buscacli);
						$nomecli = mysqli_fetch_assoc($ncli);
						echo "<td>".$nomecli['Cliente']."</td>";
						echo "<td>".$inventario['Depto']."</td>";
						echo "<td class='c2f'>
                        <a class='btn btn-sm btn-primary' href='edpatrimonio.php?edcodigo=$inventario[Indice]' title='Editar'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                            </svg></a> </td>";
						echo "</tr>";
					}
				
			echo "</tbody>
        </table>";
        }
        ?>
    </main>
    <div class="filtro" id="dvfiltro" >
        
                <form action="patrimonio.php" method="post" id="ffiltra">
                    <p>Patrimonio.: <input type="text" name="patrimonio" class="inetq" value="" size="6" id="patr"></p>
                    <p>Localização.: <input class="inetq" type="text" name="Lcliente" list="lcli" value= "">
                        <datalist id="lcli">
            				<?php $buscacli = "SELECT * FROM Clientes ORDER BY Cliente";
            				$achoucli = mysqli_query($banco,$buscacli);
            				while ($lclie = mysqli_fetch_assoc($achoucli)) { ?>
            				<option value="<?php echo $lclie['Cliente']; ?>" ><?php echo $lclie['Cliente']; ?> 
            				</option> <?php 	
            				}
            		 		?>
            			
            			</datalist></p>
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
            var $patr = document.getElementById("patr");
            // $dvfiltro.style.opacity = 1;
            $dvfiltro.style.visibility= "visible";
            $patr.value = ""
        }
        function dfiltro() {
            var $dvfiltro = document.getElementById("dvfiltro");
            //$dvfiltro.style.opacity = 0;
            $dvfiltro.style.visibility= ("hidden");
        }
        function lfiltro() {
            var $dvfiltro = document.getElementById("dvfiltro");
            var $patr = document.getElementById("patr");
            var $lcli = document.getElementById("lcli");
            const $ffiltra = document.getElementById("ffiltra");
            $patr.value = "";
            $lcli.value = "";
            //$dvfiltro.style.opacity = 0;
            $dvfiltro.style.visibility= ("hidden");
            $ffiltra.submit();
        }
            
    </script>
</body>
</html>