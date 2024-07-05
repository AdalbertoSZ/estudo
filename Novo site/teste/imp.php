<?php
print("ola");
$impressora = "10.1.1.171";
$comunidade = "public";
$oid1 = ".1.3.6.1.2.1.25.3.2.1.3.1";
print($impressora);
print($comunidade);
print($oid1);
//$resultado = snmpget($impressora, $comunidade, $oid1);
//$resultado = snmpget("10.1.1.171", "public" , ".1.3.6.1.2.1.25.3.2.1.3.1");
$a = snmpwalk("62.72.62.130", "public"); 
print($resultado);
print($a);
?>