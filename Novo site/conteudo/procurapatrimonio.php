<?php
		session_start();
		include_once('conecta.php');
		include_once('logado.php');
		$ativo = $_POST['patrimonio'];
	
    	$buscaativo = "SELECT * FROM Patrimonio WHERE Patrimonio = '$ativo' ";
    	$encontrou = $banco->query($buscaativo);
    	if(mysqli_num_rows($encontrou) < 1){
    		echo "<script> alert('Erro...: Patrimonio não Cadastrado!');</script>";
    		echo "<script> location.href='novopatrimonio.php';</script>";
    		//header('Location: recarga.php');
    	}

    	$resultado = mysqli_fetch_assoc($encontrou);
    	$lista = $banco->query($buscaativo);
    	$Modelo = $resultado['Modelo'];
    	$Serial = $resultado['Nserie'];

    	$buscalocal = "SELECT * FROM Localizacao WHERE Patrimonio = '$ativo' ";
    	$llocal = $banco->query($buscalocal);
    	//$llocal = mysqli_fetch_assoc($achou);


    	$_SESSION['Patrimonio'] = $ativo;
    	$_SESSION['Modelo'] = $Modelo;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Fastcomp - Procura Patrimonio</title>
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
		<div class="nlista" onmouseover="expmenu()" onmouseleave="retmenu()">
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
			<form action="transpatrimonio.php" method="POST">
				<table class="tbcont">
					<tr>
						<td>Patrimonio.:</td>
						<td><?php echo "$ativo";?></td>
					</tr>
					<tr>
						<td>Modelo.:</td>
						<td><?php echo "$Modelo";?></td>
					</tr>
					<tr>
						<td>Serial.:</td>
						<td><?php echo "$Serial";?></td>
					</tr>
				</table>
				<br>
				<div class="executa">
					<button class="botao" name="voltar" value="Voltar" ><a href="patrimonio.php"> Voltar</a> </button>
 		      		<input class="inputsubmit" type="submit" name="transpatr" value="Transferência">
 		   		</div>
 		   	</form>
 		</div>
	</div>
		<div class="historico" id="dvhist">
			<div class="mostra">
			<table class="tabela" style="white-space: nowrap">
				<thead >
					<tr style="border-bottom: 1px solid white">
						
						
						<th scope="col">Data Transferencia</th>
						
						<th scope="col">Cliente</th>
						<th scope="col">Anotação</th>
						
						<th scope="col">...</th>
					</tr>
				</thead>
				<tbody>
				<?php
					while ($destino = mysqli_fetch_assoc($llocal)) {
						echo "<tr style='border-bottom: 1px solid white;'>";
						
						
						echo "<td>".$destino['Datatrs']."</td>";
						$buscacli = "SELECT * FROM Clientes WHERE Idcliente = $destino[Cliente] ";
						$ncli = $banco->query($buscacli);
						$nomecli = mysqli_fetch_assoc($ncli);
						echo "<td>".$nomecli['Cliente']."</td>";
						echo "<td>".$destino['Anotacao']."</td>";
						
						echo "<td>
                        <a class='btn btn-sm btn-primary' href='editapass.php?edcodigo=$destino[Indice]' title='Editar'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                                <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                            </svg></a> </td>";
						echo "</tr>";
					}
				?>
			</tbody>
			</table>
			</div>
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