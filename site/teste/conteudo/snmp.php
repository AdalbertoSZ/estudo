<!DOCTYPE html>
<html>
<head>
	<title>teste snmp</title>
</head>
<body>
	<?php
  $session = new SNMP(SNMP::VERSION_1, "10.1.1.59", "public");
  $fulltree = $session->walk(".");
  print_r($fulltree);
  $session->close();
?>

</body>
</html>