<?php
		session_start();
		include_once('conecta.php');
		include_once('logado.php');
		//SELECT * FROM Tabela LIMIT 10;
		$buscapatrimonio = "SELECT *, DATE_FORMAT(Data,'%d-%m-%y') as Data  FROM Patrimonio ORDER BY Indice DESC LIMIT 50";
    	$lista = $banco->query($buscapatrimonio);
    	$_SESSION['Patrimonio'] = $patrimonio;
    	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Fastcomp - Patrimonio</title>
	<meta charset="UTF-8">
    <link rel="stylesheet" href="menup.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<div class="ttela" id="dvtela"></div>
	<div class="sbar fechada" id="sdbar" >
		<div class="logo" >
			<div class="logoc"><img src="logop2.png" id="ilogo"></div>	
		</div>
		<div class="nlista " onmouseover="expmenu()" onmouseleave="retmenu()" >
			<ul>
				<li>
					<a href="inicio.html" tabindex="-1">
					<i class='bx bx-home bx-sm' ></i>
					<span class="links-name" >Inicio</span>
					</a>
				</li>
				<li>
					<a href="recarga.php" tabindex="-1">
					<i class='bx bx-wrench bx-sm' ></i>
					<span class="links-name" >Recarga</span>
					</a>
				</li>
				<li>
					<a href="destina.php" tabindex="-1">
					<i class='bx bx-cart-alt bx-sm'></i>
					<span class="links-name" >Destinação</span>
					</a>
				</li>
				<li>
					<a href="patrimonio.php" tabindex="-1">
					<i class='bx bx-desktop bx-sm' ></i>
					<span class="links-name" >Patrimonio</span>
					</a>
				</li>
				<li>
					<a href="dashboard.php" tabindex="-1">
					<i class='bx bx-grid-alt bx-sm'></i>
					<span class="links-name" >Dashboard</span>
					</a>
				</li>
				<li>
					<a href="configura.php" tabindex="-1">
					<i class='bx bx-cog bx-sm' ></i>
					<span class="links-name" >Configurações</span>
					</a>
				</li>
				<li>
					<a href="saida.php" tabindex="-1">
					<i class='bx bx-log-out bx-sm' ></i>
					<span class="links-name" >Sair</span>
					</a>
				</li>
			</ul>
		</div>
		
		
	</div>
	<div class="cabecalho" id="dvcab">
			<div class="procura">
				<form action="procurapatrimonio.php" method="POST">
					<table class="tbcont">
						<tr>
							<td>Patrimônio.:</td>
							<td class="tbentra"><input type="text" name="patrimonio" class="inentra" size="6"></td>
						</tr>
						<tr></tr>
					</table>
					<br>
					<div class="executa">	
						<button class="botao" name="novopatr" value="novopatr"><a href="novopatrimonio.php"> Novo Patrimônio</a></button>
 		   				<input class="inputsubmit" type="submit" name="procura" value="Procura">
 		   			</div>
 		   		</form>
 			</div>
		</div>
	<div class="historico" id="dvhist">
			<table class="tabela">
				<thead >
					<tr style="border-bottom: 1px solid white">
						<th scope="col">ID</th>
						<th scope="col">Patrimonio</th>
						<th scope="col">Marca</th>
						<th scope="col">Modelo</th>
						<th scope="col">Serial</th>
						<th scope="col">Data</th>
						<th scope="col">Tipo</th>
						<th scope="col">Valor</th>
						<th scope="col">Observação</th>
						<th scope="col">Localização</th>
						<th scope="col">...</th>
					</tr>
				</thead>
				<tbody>
				<?php
					while ($inventario = mysqli_fetch_assoc($lista)) {
						echo "<tr style='border-bottom: 1px solid white;'>";
						echo "<td>".$inventario['Indice']."</td>";
						echo "<td>".$inventario['Patrimonio']."</td>";
						echo "<td>".$inventario['Marca']."</td>";
						echo "<td>".$inventario['Modelo']."</td>";
						echo "<td>".$inventario['Nserie']."</td>";
						echo "<td>".$inventario['Data']."</td>";
						echo "<td>".$inventario['Tipo']."</td>";
						echo "<td>".$inventario['Valor']."</td>";
						echo "<td>".$inventario['Observacao']."</td>";
						$buscacli = "SELECT * FROM Clientes WHERE Idcliente = $inventario[Idcliente] ";
						$ncli = $banco->query($buscacli);
						$nomecli = mysqli_fetch_assoc($ncli);
						echo "<td>".$nomecli['Cliente']."</td>";
						
						echo "<td>
                        <a class='btn btn-sm btn-primary' href='editapatrimonio.php?edcodigo=$inventario[Indice]' title='Editar'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                            </svg></a> </td>";
						echo "</tr>";
					}
				?>
			</tbody>
			</table>
		</div>	
	<script type="text/javascript">
		function expmenu(){
           
            var DVHIST = document.getElementById("dvhist");
            var DVCAB = document.getElementById("dvcab");
            var DVTELA = document.getElementById("dvtela");
            document.getElementById('sdbar').className = "sbar";
            var currWidth = DVTELA.clientWidth;
            DVHIST.style.left = ('210px');
            DVCAB.style.left = ('210px');
            DVCAB.style.width = (currWidth - 210) + 'px';
        }
        function retmenu(){
            var SDBAR = document.getElementById("sdbar");
            var DVHIST = document.getElementById("dvhist");
            var DVCAB = document.getElementById("dvcab");
            var DVTELA = document.getElementById("dvtela");
            document.getElementById('sdbar').className = "sbar fechada";
            var currWidth = DVTELA.clientWidth;
            DVHIST.style.left = ('90px');
            DVCAB.style.left = ('90px');
            DVCAB.style.width = (currWidth - 90 ) + 'px';
        }
	</script>
</body>
</html>