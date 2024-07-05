<?php
    // isset -> serve para saber se uma variável está definida
    session_start();
    include_once('logado.php');
    include_once('conecta.php');
    if(isset($_POST['atualiza']))
    {
        //$codigo = $_GET['codigo'];
        $edcodigo = $_SESSION['edcodigo'];
        $Patrimonio = $_POST['Patrimonio'];
        $Marca = $_POST['Marca'];
        $Modelo = $_POST['Modelo'];
        $Nserie = $_POST['Nserie'];
        $Data = $_POST['Data'];
        $Tipo = $_POST['Tipo'];
        $Observacao = $_POST['Observacao'];
        $Valor = $_POST['Valor'];
        $Cliente = $_POST['Lcliente'];
        $buscaidcli = "SELECT * FROM Clientes WHERE Cliente = '$Cliente' ";
        $encidcli = $banco->query($buscaidcli);
        $dadosidcli = mysqli_fetch_assoc($encidcli);
        $idcli = $dadosidcli['Idcliente'];
          
        $sqlInsert = "UPDATE Patrimonio 
        SET Patrimonio='$Patrimonio',Marca='$Marca',Modelo='$Modelo',Nserie='$Nserie',Data='$Data',Tipo='$Tipo',Observacao='$Observacao',Valor='$Valor',Idcliente='$idcli'

        WHERE Indice=$edcodigo";

        $result = $banco->query($sqlInsert);
        //print_r($result);
        
        
    }
    header('Location: patrimonio.php');
    //nome='$nome',senha='$senha',email='$email',telefone='$telefone',sexo='$sexo',data_nasc='$data_nasc',cidade='$cidade',estado='$estado',endereco='$endereco'
?>