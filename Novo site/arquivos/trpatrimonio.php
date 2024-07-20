<?php
		session_start();
		include_once('conecta.php');
		include_once('logado.php');
        $edpatr = $_GET['patrimonio'];
        //print_r($edpatr);
        $buscapatr = "SELECT * FROM Patrimonio WHERE Patrimonio = '$edpatr' ORDER BY Indice DESC";
        $listapatr = $banco->query($buscapatr);
        $numpatr =  mysqli_num_rows($listapatr);
        $resultado = mysqli_fetch_assoc($listapatr);
        $patrimonio = $resultado['Patrimonio'];
        $modelo = $resultado['Modelo'];
        $serial = $resultado['Nserie'];
        
        if (isset($_POST['GravaTR'])){
            //gravando!!
            $patrimonio = $_SESSION['patrimonio'];
            $modelo = $_SESSION['modelo'];
            $Cliente = $_POST['Lcliente'];
            $Data = $_POST['Data'];
			$Anotacao = $_POST['Anotacao'];
			$buscaidcli = "SELECT * FROM Clientes WHERE Cliente = '$Cliente' ";
			$encidcli = $banco->query($buscaidcli);
			$dadosidcli = mysqli_fetch_assoc($encidcli);
			$idcli = $dadosidcli['Idcliente'];

            $gravadados = mysqli_query ($banco, "INSERT INTO Localizacao (Patrimonio,Modelo,Datatrs,Cliente,Anotacao) 
				VALUES ('$patrimonio','$modelo','$Data','$idcli','$Anotacao')") ;
				header('Location: patrimonio.php');
        }
        $listacli = "";
        $buscacli = "SELECT * FROM Clientes ORDER BY Cliente";
        $achoucli = mysqli_query($banco,$buscacli);
        while ($lclie = mysqli_fetch_assoc($achoucli)) { 
            $cli = $lclie['Cliente'];
            $listacli .= "<option value='" . $cli . "'></option>";	
        }
        
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fastcomp - Transfere patrimonio</title>
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
            <li><a href="cadastro.php"><i class='bx bx-cabinet' ></i> Cadastro</a></li>
            <li><a href="configura.php"><i class='bx bx-cog' ></i> Configuração</a></li>
            <li><a href="saida.php"><i class='bx bx-log-out' ></i> Sair</a></li>
        </ul>
    </nav>
    <main class="conteudo">
    <?php
        if ( $numpatr == 1 ) {
            //echo "<p>Achei 1 patrimonio</p>";
            $_SESSION['patrimonio'] = $patrimonio;
            $_SESSION['modelo'] = $modelo;
            echo "<form action='trpatrimonio.php' method='post'>
                <table class='nwpatr'>
                    <tr>
                        <td>Patrimonio</td>
                        <td><h4>" .$patrimonio. "</h4></td>
                    </tr>
                    <tr>
                        <td>Modelo</td>
                        <td><h4>" .$modelo. "</h4></td>
                    </tr>
                    <tr>
                        <td>Serial</td>
                        <td><h4>" .$serial. "</h4></td>
                    </tr>
                    <tr>
                        <td>Cliente</td>
                        <td><input class='entra' type='text' name='Lcliente' list='lcli' value= '' required>
            			<datalist id='lcli'>";
                        echo $listacli;
                        echo "</datalist>
                        </td>
                    </tr>
                    <tr>
                        <td>Data</td>
                        <td> <input class='entra' type='date' name='Data' required> </td>
                    </tr>
                    <tr>
                        <td>Anotação</td>
                        <td><input type='text' name='Anotacao' placeholder='Anotação' required></td>
                    </tr>
                    <tr>
                        <td><button><a href='patrimonio.php'>Cancelar</a></button></td>
                        <td class='rodape'><input class='inputsubmit' type='submit' name='GravaTR' value='Gravar'></td>
                    </tr>
                </table>

            </form>";
            
        } else {
            echo "<p>Não achei o patrimonio</p>";
            //echo $listacli;
        }
    ?>
    </main>
</body>
</html>