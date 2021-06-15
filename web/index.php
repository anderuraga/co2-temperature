<?php

    require_once("db/conectar.php");
	
	// valores estidisticos para HOY
	$sql1 = "SELECT max(co2) 'maxco2', min(co2) 'minco2', avg(co2) 'avgco2', max(temp) 'maxtemp', min(temp) 'mintemp', avg(temp) 'avgtemp', date_format(fecha, '%Y-%m-%d'), CURRENT_DATE FROM tabla WHERE date_format(fecha, '%Y-%m-%d') = CURRENT_DATE GROUP BY date_format(fecha, '%Y-%m-%d');";
	// Ultimo registro
	$sql2 = "SELECT co2, temp FROM tabla ORDER BY id DESC LIMIT 1;";
	
	$stmt1 = $pdo->prepare($sql1);
	$stmt2 = $pdo->prepare($sql2);

	$stmt1->execute();
	$stmt2->execute();

	$row = $stmt1->fetch();
	$row2 = $stmt2->fetch();
		
?>


<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sensor Co2 & Temp</title>

    <link rel="stylesheet" href="resources/css/styles.css">

  </head>
  <body>
	
	<a href="vista/mostrar.php">Ver todos los valores</a>
		
	<div class="container">
		
		<!-- card Co2 -->
		  <div class="card">        
			<h3>Sensor XXXX<span>Aula xxx</h3>
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
		
		<!-- card Temperatura -->
		<div class="card">        
			<h3>Sensor XXXX<span>Aula 013</h3>
			<h1><?php echo $row2['temp']?>º</h1>
			<div class="tempback">
				<img src="resources/images/thermometer.svg" alt="termometro" class="thermometer">	
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
        
		
	</div>
    <!-- div.container -->
   
  </body>
</html>

<?php

	require_once("db/desconectar.php");
	
?>