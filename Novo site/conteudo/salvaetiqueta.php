<?php
    // isset -> serve para saber se uma variável está definida
    session_start();
    include_once('logado.php');
    include_once('conecta.php');
    if(isset($_POST['novaetiqueta']))
    {
        
        $etiqueta = $_POST['etiqueta'];
        $modelo = $_POST['modelo'];
        $buscaetiqueta = "SELECT * FROM Toner WHERE etiqueta = '$etiqueta' ";
        $result = $banco->query($buscaetiqueta);
        if(mysqli_num_rows($result) > 0)
        {
            echo "<script> alert('Erro...: Etiqueta já cadastrada!');</script>";
            echo "<script> location.href='novaetiqueta.php';</script>";

            //header('Location: recarga.php');
        }
        else
        {
            if ($etiqueta == "C-") {
                echo "<script> alert('Erro...: Preencha o numero da Etiqueta!');</script>";
                echo "<script> location.href='novaetiqueta.php';</script>";
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
    //header('Location: recarga.php');
    //nome='$nome',senha='$senha',email='$email',telefone='$telefone',sexo='$sexo',data_nasc='$data_nasc',cidade='$cidade',estado='$estado',endereco='$endereco'
?>