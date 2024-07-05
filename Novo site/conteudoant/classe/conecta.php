<?php

$host = "fdb33.awardspace.net";
$usuario = "4064838_recarga";
$senha = "Pr0gr@m3r";
$bd = "4064838_recarga";

$banco = new mysqli($host, $usuario, $senha, $bd);

if ($banco -> connect_error)
	{echo"erro de conexão";}
else
	{"conexao bem sucedida";}



?>