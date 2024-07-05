<?php 
	session_start();
	$mensagem = $_SESSION['mensagem'];

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Modal</title>
	<style type="text/css">
		.modal {
  		position: fixed;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
		font-family: Arial, Helvetica, sans-serif;
		background: rgba(0,0,0,0.8);
		z-index: 99999;
		opacity:0;
		-webkit-transition: opacity 400ms ease-in;
		-moz-transition: opacity 400ms ease-in;
		transition: opacity 400ms ease-in;
		pointer-events: none;	
		}
		.modal:target {
  			opacity: 1;
  			pointer-events: auto;
		}
		.fechar {
  position: absolute;
  width: 30px;
  right: -15px;
  top: -20px;
  text-align: center;
  line-height: 30px;
  margin-top: 5px;
  background: #ff4545;
  border-radius: 50%;
  font-size: 16px;
  color: #8d0000;
}
div {
  width: 400px;
  position: relative;
  margin: 10% auto;
  padding: 15px 20px;
  background: #fff;
}
h2{
	color: cyan;
}
p {
	color: white;
}
	</style>

</head>
<body>
	<a href="#abrirModal">Open Modal</a>

	<div id="abrirModal" class="modal">
  		<a href="#fechar" title="Fechar" class="fechar">x</a>
  		<h2>Janela Modal</h2>
  		<p><?php echo "$mensagem";?></p>
  		<p>Esta é uma simples janela de modal.</p>
 		<p>Você pode fazer qualquer coisa aqui, página de Login, pop-ups, ou formulários</p	>
	</div>
</body>
</html>