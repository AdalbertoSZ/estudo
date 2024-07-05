<?php
		session_start();
		include_once('conecta.php');
		include_once('logado.php');
		//SELECT * FROM Tabela LIMIT 10;
		$buscahistorico = "SELECT *, TIME_FORMAT(tempo, '%H:%i') as tempo, DATE_FORMAT(recarga,'%d-%m-%y') as recarga ,DATE_FORMAT(saida,'%d-%m-%y') as saida FROM Historico ORDER BY codigo DESC LIMIT 50";
    	$historico = $banco->query($buscahistorico);
    	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Fastcomp - Destinação</title>
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
		<div class="nlista" onmouseover="expmenu()" onmouseleave="retmenu()" >
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
			<form action="buscadestina.php" method="POST">
				<table class="tbcont">
					<tr>
						<td>Etiqueta.:</td>
						<td class="tbentra"><input type="text" name="etiqueta" class="inentra" value="C-" size="6"></td>
					</tr>
					<tr></tr>
				</table>
				<br>
				<div class="executa">	
					<button class="botao" name="pdata" value="pdata" ><a href="destdata.php"> Procura por Data</a> </button>
 		   			<input class="inputsubmit" type="submit" name="procura" value="Procura">
 		  		</div>
 			</form>				
 		</div>
	</div>
	<div class="historico" id="dvhist">
		<table class="tabela">
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