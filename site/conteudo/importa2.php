<?php 
	include_once('conecta.php');
	$arquivo = fopen('teste.csv', 'r');
	$lista = 0;
	while (!feof($arquivo)) {
		$linha = fgets($arquivo,1024);
		$dados = explode(';', $linha);

		$etiqueta = $dados[0];
		$buscatoner = "SELECT * FROM Toner WHERE etiqueta = '$etiqueta' ";
    	$encontrou = $banco->query($buscatoner);
    	if(mysqli_num_rows($encontrou) < 1){
    		$ativo = 1;
    		$sqlInsert = "INSERT INTO Toner (etiqueta,modelo,ativo) VALUES ('$etiqueta','$dados[2]','$ativo')";
    		$result = $banco->query($sqlInsert);
    	}
		$oldDate = strtotime($dados[1]);
		$recarga = date('Y-m-d',$oldDate);
		if ($dados[8] == '') $cil = 0; else $cil = 1;
		if ($dados[9] == '') $rmag = 0; else $rmag = 1;
		if ($dados[10] == '') $pcr = 0; else $pcr = 1;
		if ($dados[11] == '') $ldos = 0; else $ldos = 1;
		if ($dados[12] == '') $llimp = 0; else $llimp = 1;
		if ($dados[13] == '') $chip = 0; else $chip = 1;
		$tecnico =  strtolower($dados[15]);
		$tecnico = ucfirst($tecnico);
		if ($dados[16] =='') {		
			if ( !empty($linha)){				
			$sqlInsert = "INSERT INTO Historico (etiqueta,recarga,pesoinicial,pesofinal, po, lixo, tempo, cilindro, developer, pcr, ldos, llimp, chip, observacao, tecnico ) VALUES ('$dados[0]','$recarga','$dados[3]','$dados[4]','$dados[5]','$dados[6]','$dados[7]', '$cil', '$rmag', '$pcr', '$ldos', '$llimp', '$chip', '$dados[14]', '$tecnico' )";
        	$result = $banco->query($sqlInsert);}
		} else {
			$oldDate = strtotime($dados[16]);
			$dataos = date('Y-m-d',$oldDate);
			$tipo =  strtolower($dados[20]);
			$tipo = ucfirst($tipo);
			$sqlInsert = "INSERT INTO Historico (etiqueta,recarga,pesoinicial,pesofinal, po, lixo, tempo, cilindro, developer, pcr, ldos, llimp, chip, observacao, tecnico, saida, os, cliente, valor, tipo ) VALUES ('$dados[0]','$recarga','$dados[3]','$dados[4]','$dados[5]','$dados[6]','$dados[7]', '$cil', '$rmag', '$pcr', '$ldos', '$llimp', '$chip', '$dados[14]', '$dados[15]', '$dataos', '$dados[17]', '$dados[18]', '$dados[19]', '$tipo' )";
        	$result = $banco->query($sqlInsert);
		} 
		//$recarga = $dados[1];
		//WriteLine('Data antiga ' . $oldDate. $recarga);
		
		
		//if ( !empty($linha)){
				
			//$sqlInsert = "INSERT INTO Importa (etiqueta,recarga,modelo,pesoi,pesof, po, lixo, tempo, cil, rmag, pcr, ldos, llimp, chip, observacao, tecnico, dataos, numos, cliente, valor, tipo ) VALUES ('$dados[0]','$recarga','$dados[2]','$dados[3]','$dados[4]','$dados[5]','$dados[6]','$dados[7]', '$cil', '$rmag', '$pcr', '$ldos', '$llimp', '$chip', '$dados[14]', '$dados[15]', '$dataos', '$dados[17]', '$dados[18]', '$dados[19]', '$dados[20]' )";
			//$sqlInsert = "UPDATE Historico  SET os='$numos',valor='$valor',cliente='$cliente',saida='$saida'  WHERE codigo=$codigo";
        	//$result = $banco->query($sqlInsert);
			//$gravadados = mysqli_query ($banco, "INSERT INTO Importa (etiqueta,recarga) VALUES ('$etiqueta','$recarga')") ;
		//}
		$lista++;
		print_r($lista);
	}
fclose($arquivo);


if($dados[0] != 'Nome' && !empty($linha))






	//mysql_query('INSERT INTO Importa (etiqueta, recarga, modelo, peso1, pesof, po, lixo, tempo, cil, rmag, pcr, ldos, llimp, chip, observacao, tecnico, dataos, numos, cliente, valor, tipo) VALUES ("'.$dados[0].'", "'.$dados[1].'", "'.$dados[2].'", "'.$dados[3].'", "'.$dados[4].'", "'.$dados[5].'", "'.$dados[6].'", "'.$dados[7].'", "'.$dados[8].'", "'.$dados[9].'", "'.$dados[10].'", "'.$dados[11].'", "'.$dados[12].'", "'.$dados[13].'", "'.$dados[14].'", "'.$dados[15].'", "'.$dados[16].'", "'.$dados[17].'", "'.$dados[18].'", "'.$dados[19].'", "'.$dados[20].'")');

?>
<!DOCTYPE html>
<html>
<head>
	<title>Importa csv</title>
</head>
<body>
	<h3>Importando</h3>

</body>
</html>