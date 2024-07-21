<?php
		session_start();
		include_once('conecta.php');
		include_once('logado.php');
        if (isset($_POST['gravacli'])) {
            $nvcliente = $_POST['nvcliente'];
            $nvdatacad = $_POST['datacad'];
            $nvdialeitura = $_POST['dialeitura'];
            $gravadados = mysqli_query ($banco, "INSERT INTO Clientes (Cliente,Datacad,Dialeitura) 
		 		VALUES ('$nvcliente','$nvdatacad','$nvdialeitura')") ;
		 		header('Location: cadastro.php?opcao=clientes');
        }
        if (isset($_POST['alteracli'])) {
            $edcliente = $_POST['edcliente'];
            $eddatacad = $_POST['datacad'];
            $eddialeitura = $_POST['dialeitura'];
            $idcli = $_SESSION['idcliente'];
            $sqlInsert = "UPDATE Clientes SET  Cliente='$edcliente' , Datacad='$eddatacad' , Dialeitura='$eddialeitura' WHERE Indice='$idcli'";

                $result = $banco->query($sqlInsert);
            header('Location: cadastro.php?opcao=clientes');
        }
        if (isset($_POST['cliente'])){
            $cliente = $_POST['cliente'];
            $cliente = '%' . $cliente . '%';
            $winclion = 'ligado';
        } else {
            $cliente = '%';
        }
        $buscacli = "SELECT * , DATE_FORMAT(Datacad,'%d-%m-%Y') as Datacad FROM Clientes WHERE Cliente LIKE '$cliente' ORDER BY Cliente  ";
        $listacli = $banco->query($buscacli);
        $numcli =  mysqli_num_rows($listacli);
        if (isset($_GET['opcao'])){
            $winclion = 'ligado';
            //print_r($winclion);
        }
        if (isset($_GET['edcodigo'])){
            $codcli = $_GET['edcodigo'];
            $buscaedcli = "SELECT * FROM Clientes WHERE Indice = '$codcli'";
            $encedcli = $banco->query($buscaedcli);
            $dadosedcli = mysqli_fetch_assoc($encedcli);
            $winedcli = 'ligado';
            // print_r($codcli);
            // print_r($numcli);
            // print_r($dadosedcli);
        }   
        
            $buscaidcli = "SELECT * FROM Clientes WHERE Cliente = '$Cliente' ";
		 	$encidcli = $banco->query($buscaidcli);
		 	$dadosidcli = mysqli_fetch_assoc($encidcli);
    	
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
            <li><a href="#"><i class='bx bx-printer'></i> Relatorios</a></li>
            <li><a href="cadastro.php" class="ativo"><i class='bx bx-cabinet' ></i> Cadastro</a></li>
            <li><a href="configura.php"><i class='bx bx-cog' ></i> Configuração</a></li>
            <li><a href="saida.php"><i class='bx bx-log-out' ></i> Sair</a></li>
        </ul> 
    </nav>
    <header>
    <ul class="submenu lv4">
        <li><a href="cadastro.php?opcao=clientes">Clientes</a></li>
        <li><a href="#">Usuários</a></li>
        <li><a href="#">Leituras

        </a></li>
        
        </ul>
    </header>
    <main class='conteudo'>
        <?php if ($winclion == 'ligado') {
            echo "<h1>" . $numcli . " Clientes cadastrados</h1>";
            echo "<table class='tbbotao'>
            <tr><td><button class='btnvrec' onclick='filtra()'>Filtra</button></td>
                <td><button class='btnvrec' onclick='nvcli()'>Novo Cliente</button></td>
            </tr>
        </table>
        
        <table class='tbrec'>
            <thead>
                <tr>
                    <th scope='col' class='c1'>ID</th>
                    <th scope='col'>Cliente Final</th>
                    <th scope='col'>Data de cadastro</th>
                    <th scope='col'>Dia leitura</th>
                    <th scope='col' class='cf'>...</th>
                </tr>
            </thead>
            <tbody>";
            while ($dadoscli = mysqli_fetch_assoc($listacli)) {
                echo "<tr>";
                echo "<td class='c2'>".$dadoscli['Indice']."</td>";
                echo "<td>".$dadoscli['Cliente']."</td>";
                echo "<td>".$dadoscli['Datacad']."</td>";
                echo "<td>".$dadoscli['Dialeitura']."</td>";
                echo "<td class='c2f'>
                <a class='btn btn-sm btn-primary' href='cadastro.php?edcodigo=$dadoscli[Indice]' title='Editar'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                        <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                    </svg></a> </td>";
                echo "</tr>";
            }
            echo "</tbody>
        </table>";
        }
        ?>        
        <?php if ($winedcli == 'ligado') {
            $_SESSION['idcliente'] = $codcli;
            echo "<div class='dvedcli' id='dvedcli'>
                    <form action='cadastro.php' method='post'>
                        <p>Cliente.: <input class='entra' type='text' name='edcliente' placeholder='Cliente' size='30' value='" . $dadosedcli['Cliente'] . "' required></p>
                        <p>Data de cadastro.: <input class='entra' type='date' name='datacad' value='" . $dadosedcli['Datacad'] . "' required></p>
                        <p>Dia de leitura.: <input class='entra' type='text' name='dialeitura' size='3' value='" . $dadosedcli['Dialeitura'] . "' required></p>
                        <div class='dvbotao'>
                            <button class='botao' name='cancela' value='cancela' onclick='lfiltro()'><a href='#'>Cancelar</a></button>
                            <input class='inputsubmit' type='submit' name='alteracli' value='Alterar'>
                        </div>
                    </form>
                </div>";
        }
        ?>
    </main>
    <div class="dvnvcli" id="dvnvcli">
        <form action="cadastro.php" method="post">
            <p>Cliente.: <input class="entra" type="text" name="nvcliente" placeholder="Cliente" size="30" id="cliente" required></p>
            <p>Data de cadastro.: <input class="entra" type="date" name="datacad" id="datacli" required></p>
            <p>Dia de leitura.: <input class="entra" type="text" name="dialeitura" placeholder="Dia" size="3" required></p>
            <div class="dvbotao">
                <button class="botao" name="cancela" value="cancela" onclick="fxnvcli()"><a href="#">Cancelar</a></button>
                <input class="inputsubmit" type="submit" name="gravacli" value="Gravar">
            </div>
        </form>

    </div>
    
    <div class="filtro" id="dvfiltro" >
        
        <form action="cadastro.php" method="post" id="ffiltra">
            <p>Cliente.: <input class="entra" type="text" name="cliente" placeholder="Cliente" size="30" id="cliente"></p>
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
            $dvfiltro.style.visibility= "visible";
        }
        function dfiltro() {
            var $dvfiltro = document.getElementById("dvfiltro");
            $dvfiltro.style.visibility= ("hidden");
        }
        function lfiltro() {
            var $dvfiltro = document.getElementById("dvfiltro");
            var $cliente = document.getElementById("cliente");
            const $ffiltra = document.getElementById("ffiltra");
            $cliente.value = "";
            $dvfiltro.style.visibility= ("hidden");
            $ffiltra.submit();
        }
        function nvcli() {
            var $dvnvcli = document.getElementById("dvnvcli");
            $dvnvcli.style.visibility= "visible";
        }
        function fxnvcli() {
            var $dvnvcli = document.getElementById("dvnvcli");
            $dvnvcli.style.visibility= "hidden";
        }
    </script>
    
</body>
</html>