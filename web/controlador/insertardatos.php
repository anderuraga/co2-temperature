<?php
	require_once("../db/conectar.php");

   
	echo "Connected successfully";
	
	$chipid = $_POST ['chipid'];
	$co2= $_POST ['co2'];
	$temp= $_POST ['temp'];

	$stmt = $pdo->prepare("INSERT INTO `tabla` ( `chipId`, `co2`, `temp`) VALUES (?,?,?); ");
	
    $stmt->bindParam(1, $chipid);
	$stmt->bindParam(2, $co2);
	$stmt->bindParam(3, $temp);

	$stmt->execute();

	$stmt->closeCursor();
	$stmt = null;

	require_once("../db/desconectar.php");

?>