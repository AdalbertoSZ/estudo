<?php
		session_start();
		include_once('logado.php');
		include_once('conecta.php');
		$buscatoner = "SELECT * FROM Toner ORDER BY codigo DESC LIMIT 50 ";
		$historico = $banco->query($buscatoner);
		if(isset($_POST['gravar']))
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
	<title>Fastcomp - Recarga</title>
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
				<form action="novaetiqueta.php" method="POST">
					<table class="tbcont">
						<tr>
							<td>Etiqueta.:</td>
							<td class="tbentra"><input class="inentra" type="text" name="etiqueta" class="inentra" value="C-" size="6" required></td>
						</tr>
						<tr>
							<td>Modelo.:</td>
							<td class="tbentra"><input class="inentra" type="text" name="modelo" class="inentra" size="8" required></td>
						</tr>
					</table>
					<?php if ($erro==1) {echo "<h1>$mensagem</h1>";} else {echo "<br>";} ?>
					<br>
					<div class="executa">	
						<button class="botao2" name="voltar" value="novaetiqueta"><a href="recarga.php">Voltar</a></button>
						<input class="inputsubmita" type="submit" name="gravar" value="Gravar">
 		   			</div>
 		   		</form>
 			</div>
		</div>
	<div class="historico2" id="dvhist2">
		<div class="centro2">
			<table class="tabela">
				<thead >
					<tr style="border-bottom: 1px solid white">
						<th scope="col">ID</th>
						<th scope="col">Etiqueta</th>
						<th scope="col">Modelo</th>
						<th scope="col">Ativo</th>
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
	</div>	
	<script type="text/javascript">
		function expmenu(){
           
            var DVHIST2 = document.getElementById("dvhist2");
            var DVCAB = document.getElementById("dvcab");
            var DVTELA = document.getElementById("dvtela");
            document.getElementById('sdbar').className = "sbar";
            var currWidth = DVTELA.clientWidth;
            DVHIST2.style.left = ('210px');
            DVCAB.style.left = ('210px');
            DVCAB.style.width = (currWidth - 210) + 'px';
            DVHIST2.style.width = (currWidth - 210 ) + 'px';
        }
        function retmenu(){
            var SDBAR = document.getElementById("sdbar");
            var DVHIST2 = document.getElementById("dvhist2");
            var DVCAB = document.getElementById("dvcab");
            var DVTELA = document.getElementById("dvtela");
            document.getElementById('sdbar').className = "sbar fechada";
            var currWidth = DVTELA.clientWidth;
            DVHIST2.style.left = ('90px');
            DVCAB.style.left = ('90px');
            DVCAB.style.width = (currWidth - 90 ) + 'px';
            DVHIST2.style.width = (currWidth - 90 ) + 'px';
        }
	</script>	
</body>
</html>