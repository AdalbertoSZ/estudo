<?php
    // isset -> serve para saber se uma variável está definida
    session_start();
    include_once('logado.php');
    include_once('conecta.php');
    if(isset($_POST['atualiza']))
    {
        $codigo = $_SESSION['edcodigo'];
        $etiqueta = $_SESSION['etiqueta'];
        $numos = $_POST['numos'];
        $valor = $_POST['valor'];
        $cliente = $_POST['cliente'];
        $saida = $_POST['saida'];
        $tipo = $_POST['tipo'];

        //$recarga = $_POST['data'];
        //$pesoinicial = $_POST['pesoinicial'];
        //$po = $_POST['po'];
        //$lixo = $_POST['lixo'];
        //$pesofinal = $_POST['pesofinal'];
        //$data = $_POST['data'];
        //$tempo = $_POST['tempo'];
        //if (isset($_POST['cilindro'])) {$cilindro =  1;} else {$cilindro = 0; }
        //if (isset($_POST['developer'])) {$developer = 1;} else {$developer = 0;}
        //if (isset($_POST['pcr'])) {$pcr = 1;} else {$pcr = 0;}
        //if (isset($_POST['ldos'])) {$ldos = 1;} else {$ldos = 0;}
        //if (isset($_POST['llimp'])) {$llimp = 1;} else {$llimp = 0;}
        //if (isset($_POST['chip'])) {$chip = 1;} else {$chip = 0;}
        //$observacao = $_POST['observacao'];
        //$tecnico = $_POST['tecnico'];

        //$up = mysql_query("UPDATE Historico SET os='$numos',valor='$valor',cliente='$cliente',saida='$saida' WHERE codigo=$codigo");
        $sqlInsert = "UPDATE Historico  SET os='$numos',valor='$valor',cliente='$cliente',saida='$saida',tipo='$tipo'  WHERE codigo=$codigo";
        $result = $banco->query($sqlInsert);
        //print_r($result);
    }
    header('Location: destina.php');
    //nome='$nome',senha='$senha',email='$email',telefone='$telefone',sexo='$sexo',data_nasc='$data_nasc',cidade='$cidade',estado='$estado',endereco='$endereco'
?>