<?php
		session_start();
		//print_r($_SESSION);
		if((!isset($_SESSION['usuario']) == true) and (!isset($_SESSION['senha']) == true))
		{
			unset($_SESSION['usuario']);
       		unset($_SESSION['senha']);
       		echo "<script> location.href='../login.php';</script>";
       		//header('Location: http://fastcomp.scienceontheweb.net/teste/login.php');
       		//header('Location: login.php');
       		//print_r($senha);
       		//print_r('naosei');
		}
		$logado = $_SESSION['usuario'];

?>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="stilo.css">
    <title>Fastcomp - Principal</title>
       <style>
        body{
            background: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
            color: white;
            text-align: right;
        }
        .table-bg{
            background: rgba(0, 0, 0, 0.3);
            border-radius: 15px 15px 0 0;
        }

        .box-search{
            display: flex;
            justify-content: center;
            gap: .1%;
        }
    </style>
</head>
<body>
	 <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SISTEMA FASTCOMP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="d-flex">
            <a href="saida.php" class="btn btn-danger me-5">Sair</a>
        </div>
    </nav>
       <br>
    <?php
        echo "Bem vindo <u>$logado</u>";
    ?>
    <br>
    <div class="navigation">
        <ul>
            <li class="list active">
                <a href="#">
                    <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                    <span class="title">Inicio</span>
                </a>                
            </li>
            <li class="list">
                <a href="#">
                    <span class="icon"><ion-icon name="hourglass-outline"></ion-icon></span>
                    <span class="title">Recarga</span>
                </a>                
            </li>
            <li class="list">
                <a href="#">
                    <span class="icon"><ion-icon name="desktop-outline"></ion-icon></span>
                    <span class="title">Destinação</span>
                </a>                
            </li>
            <li class="list">
                <a href="#">
                    <span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
                    <span class="title">Configurações</span>
                </a>                
            </li>
            <li class="list">
                <a href="#">
                    <span class="icon"><ion-icon name="help-outline"></ion-icon></span>
                    <span class="title">Help</span>
                </a>                
            </li>
            <li class="list">
                <a href="#">
                    <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                    <span class="title">Senha</span>
                </a>                
            </li>
            <li class="list">
                <a href="#">
                    <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                    <span class="title">Sair</span>
                </a>                
            </li>
            <!--<li class="list">
                <a href="#">
                    <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                    <span class="title">Profile</span>
                </a>                
            </li>-->
        </ul>
        
    </div>
<script  type = "module"  src = "https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js" > </ script > 
< script  nomodule  src = "https://unpkg .com/ionicons@5.5.2/dist/ionicons/ionicons.js" > </script >
<script>
    //add active class in selected list item
    let list = document.querySelectorAll('.list');
    for (let i = 0; i <list.length; i++) {
        list[i].onclick = function(){
            let j = 0;
            while(j < list.length){
                list[j++].className = 'list';
            }
            list[i].className = 'list active';
        }
    }
</script>
	
</body>
</html>