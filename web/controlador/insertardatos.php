<?php
	$cons_usuario="root";
    $cons_contra="";
    $cons_base_datos="tutorial";
    $cons_equipo="localhost";
	
    // Create connection
    $conn = mysqli_connect($cons_equipo,$cons_usuario,$cons_contra,$cons_base_datos);
    // Check connection
	if (!$conn) {
		  die("Connection failed: " . mysqli_connect_error());
	}
	echo "Connected successfully";
	
	$chipid = $_POST ['chipid'];
	$co2= $_POST ['co2'];
	$temp= $_POST ['temp'];

	
	$sql= "INSERT INTO `tutorial`.`tabla` ( `chipId`, `co2`, `temp`) VALUES ( '$chipid',  '$co2' , '$temp' );";
    if (mysqli_query($conn, $sql)) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	mysqli_close($conn);
?>