<?php
    // isset -> serve para saber se uma variável está definida
    session_start();
    include_once('logado.php');
    include_once('conecta.php');
    if(isset($_POST['atualiza']))
    {
        $codigo = $_SESSION['edcodigo'];
        $etiqueta = $_SESSION['etiqueta'];
        $recarga = $_POST['data'];
        $pesoinicial = $_POST['pesoinicial'];
        $po = $_POST['po'];
        $lixo = $_POST['lixo'];
        $pesofinal = $_POST['pesofinal'];
        //$data = $_POST['data'];
        $tempo = $_POST['tempo'];
        if (isset($_POST['cilindro'])) {$cilindro =  1;} else {$cilindro = 0; }
        if (isset($_POST['developer'])) {$developer = 1;} else {$developer = 0;}
        if (isset($_POST['pcr'])) {$pcr = 1;} else {$pcr = 0;}
        if (isset($_POST['ldos'])) {$ldos = 1;} else {$ldos = 0;}
        if (isset($_POST['llimp'])) {$llimp = 1;} else {$llimp = 0;}
        if (isset($_POST['chip'])) {$chip = 1;} else {$chip = 0;}
        $observacao = $_POST['observacao'];
        $tecnico = $_POST['tecnico'];

      //  (etiqueta,recarga,pesoinicial,po,lixo,pesofinal,tempo,cilindro,developer,pcr,ldos,llimp,chip,observacao,tecnico)
       // $nome = $_POST['nome'];
       // $email = $_POST['email'];
       // $senha = $_POST['senha'];
       // $telefone = $_POST['telefone'];
       // $sexo = $_POST['genero'];
       // $data_nasc = $_POST['data_nascimento'];
      //  $cidade = $_POST['cidade'];
       // $estado = $_POST['estado'];
      //  $endereco = $_POST['endereco'];
        
        $sqlInsert = "UPDATE Historico 
        SET etiqueta='$etiqueta',recarga='$recarga',pesoinicial='$pesoinicial',po='$po',lixo='$lixo',pesofinal='$pesofinal',tempo='$tempo',cilindro='$cilindro',developer='$developer',pcr='$pcr',ldos='$ldos',llimp='$llimp',chip='$chip',observacao='$observacao',tecnico='$tecnico'
      
        WHERE codigo=$codigo";
        $result = $banco->query($sqlInsert);
        //print_r($result);
    }
    header('Location: recarga.php');
    //nome='$nome',senha='$senha',email='$email',telefone='$telefone',sexo='$sexo',data_nasc='$data_nasc',cidade='$cidade',estado='$estado',endereco='$endereco'
?>