<?php
include("classe/conecta.php");
//$erro[] = "Login não efetuado";	
if(isset($_POST['email']) && strlen($_POST['email']) > 0){

	if (!isset($_SESSION))
		session_start();

	$_SESSION['email'] = $banco->escape_string($_POST['email']);
	$_SESSION['senha'] = $_POST['senha'];

	$sql_code = "SELECT senha, codigo FROM Usuario WHERE correio = '$_SESSION[email]'";
	$sql_query = $banco->query($sql_code) or die ($banco->error);
	$dado = $sql_query->fetch_assoc();
	$total = $sql_query->num_rows;

	if ($total == 0) {
		$erro[] = "Esse email não existe";
	}else{
		if ($dado['senha'] == $_SESSION['senha']){
			$_SESSION['usuario'] = $dado['codigo'];
		}else{
			$erro[] = "Senha incorreta.";
		}

	}
	if (count($erro) == 0 || !isset($erro)) {
		echo "<script> location.href='conteudo/principal.php';</script>";
	}

}

?>

<html>
<head>
	<title>Fastcomp - Login</title>
	<link rel="stylesheet" type="text/css" href="css/fastcomp.css">
	<meta charset="utf-8">
</head>

<body class="lbody">	
	<form method="POST" action="">
		<div class="ldiv">
			<h1>Login</h1>
			<?php if (!empty($erro))
				foreach ($erro as $msg) {
		 		echo "<p>$msg</p>";
				 } 
			?>
			<input class="linput" placeholder="Usuario" type="text" id="email" name="email" value="<?php echo$_SESSION['email']; ?>"> 
			<br><br>
			<input class="linput" placeholder="Senha" type="password" id="senha" name="senha">
			<br><br>
			<input class="lbuton" type="submit" value="Entrar">
		</div>
	</form>
</body>
</html>