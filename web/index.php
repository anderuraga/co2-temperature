<?php
	$cons_usuario="root";
    $cons_contra="";
    $cons_base_datos="tutorial";
    $cons_equipo="localhost";
	
    // Create connection
    $conn = mysqli_connect($cons_equipo,$cons_usuario,$cons_contra,$cons_base_datos);
    
	$sql= "SELECT max(co2) 'maxco2', min(co2) 'minco2', avg(co2) 'avgco2', max(temp) 'maxtemp', min(temp) 'mintemp', avg(temp) 'avgtemp', date_format(fecha, '%Y-%m-%d'), CURRENT_DATE FROM tabla WHERE date_format(fecha, '%Y-%m-%d') = CURRENT_DATE GROUP BY date_format(fecha, '%Y-%m-%d');";
	$sql2= "SELECT co2, temp FROM tabla ORDER BY id DESC LIMIT 1;";
	
	$resultado = mysqli_query($conn, $sql);
	$resultado2 = mysqli_query($conn, $sql2);
	
	$row = mysqli_fetch_assoc($resultado);
	$row2 = mysqli_fetch_assoc($resultado2);
	
	//echo ($sql);
	
?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sensor Co2 & Temp</title>

    <link rel="stylesheet" href="css/styles.css">

  </head>
  <body>
	
	<a href="mostrar.php">Ver todos los valores</a>
		
	<div class="container">
		
		  <div class="card">        
			<h3>Sensor XXXX<span>Aula 013</h3>
			<h1><?php echo $row2['co2']?></h1>
			<div class="sky">
				<div class="co2">co2</div>
				<div class="cloud">
					<div class="circle-small"></div>
					<div class="circle-tall"></div>
					<div class="circle-medium"></div>
				</div>
			</div>
			<table>
				<tr>
					<td>MAX</td>
					<td>MIN</td>
					<td>MEDIA</td>                
				</tr>
				<tr>
					<td><?php echo $row['maxco2']?></td>
					<td><?php echo $row['minco2']?></td>
					<td><?php echo round ($row['avgco2'],2)?></td>               
				</tr>            
			</table>
		</div>
		<!-- card 1 -->
		
		<div class="card">        
			<h3>Sensor XXXX<span>Aula 013</h3>
			<h1><?php echo $row2['temp']?>º</h1>
			<div class="tempback">
				<img src="images/thermometer.svg" alt="termometro" class="thermometer">	
			</div>
			<table>
				<tr>
					<td>MAX</td>
					<td>MIN</td>
					<td>MEDIA</td>                
				</tr>
				<tr>
					<td><?php echo $row['maxtemp']?>º</td>
					<td><?php echo $row['mintemp']?>º</td>
					<td><?php echo round( $row['avgtemp'], 2)?>º</td>               
				</tr>            
			</table>
		</div>
        <!-- card 2 -->
		
	</div>
    <!-- div.container -->
		

</table>

    
   
  </body>
</html>
<?php

	mysqli_close($conn);
?>