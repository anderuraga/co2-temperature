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
  </head>
  
  
  <style>
  @import url(https://fonts.googleapis.com/css?family=Roboto:400,300);
html,
body {
    background-color: #F3F3F3;
    font-family: 'Roboto', sans-serif;
}

.card {
    margin: 0 auto;   
    padding: 30px;
    width: 290px;    
    border-radius: 15px;
    background-color: #fff;
    box-shadow: 1px 2px 10px rgb(0 0 0 / 20%);
    -webkit-animation: open 2s cubic-bezier(.39, 0, .38, 1);
}

@-webkit-keyframes open {
    from {
        padding: 0 30px;
        height: 0;
    }
    to {
        height: 470px;
    }
}

h1,
h2,
h3,
h4 {
    position: relative;
}

h1 {
    float: right;
    color: #666;
    font-weight: 300;
    font-size: 6.59375em;
    line-height: .2em;
    -webkit-animation: up 2s cubic-bezier(.39, 0, .38, 1) .2s;
}

h2 {
    font-weight: 300;
    font-size: 2.25em;
    -webkit-animation: up 2s cubic-bezier(.39, 0, .38, 1);
}

h3 {
    float: left;
    margin-right: 33px;
    color: #777;
    font-weight: 400;
    font-size: 1em;
    -webkit-animation: up 2s cubic-bezier(.39, 0, .38, 1) .1s;
}

.container {
	display: flex;	
	max-width: 1024px;
	margin: auto;
}

@media (max-width: 425px) {
	.container {
		flex-direction: column;
	}
	.card {
		margin-bottom: 2rem;
	}		
}

span {
    margin-left: 24px;
    color: #999;
    font-weight: 300;
}

span span {
    margin-left: 0;
}

.dot {
    font-size: .9em;
}

.co2{
	color: #433e3e;
    position: relative;
    top: 40px;
    font-size: 30px;
    z-index: 66;
    font-weight: 800;
    left: 30px;
	 -webkit-animation: up 2s cubic-bezier(.39, 0, .38, 1) .2s;
}

.sky {
    position: relative;
    margin-top: 108px;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background-color: #03A9F4;
    -webkit-animation: up 2s cubic-bezier(.39, 0, .38, 1) .2s;
}

.tempback {
    position: relative;
    margin-top: 108px;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background-color: #f49b03;
    -webkit-animation: up 2s cubic-bezier(.39, 0, .38, 1) .2s;
}

.thermometer {
	position: relative;
    height: 80px;
    top: 10px;
    left: 12px;
}

.sun {
    position: relative;
    top: -3px;
    width: 55px;
    height: 55px;
    border-radius: 50%;
    background-color: #FFEB3B;
    -webkit-animation: up 2s cubic-bezier(.39, 0, .38, 1) .5s;
}

.cloud {
    position: absolute;
    top: 60px;
    left: 30px;
    -webkit-animation: up 2s cubic-bezier(.39, 0, .38, 1) .7s;
}

.cloud:before,
.cloud:after {
    position: absolute;
    display: block;
    content: "";
}

.cloud:before {
    margin-left: -10px;
    width: 51px;
    height: 18px;
    background: #fff;
}

.cloud:after {
    position: absolute;
    top: -10px;
    left: -22px;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: #fff;
    box-shadow: 50px -6px 0 6px #fff, 25px -19px 0 10px #fff;
}

table {
    position: relative;
    top: 10px;
    width: 100%;
    text-align: center;
}

tr:nth-child(1) td:nth-child(1),
tr:nth-child(1) td:nth-child(2),
tr:nth-child(1) td:nth-child(3),
tr:nth-child(1) td:nth-child(4),
tr:nth-child(1) td:nth-child(5) {
    padding-bottom: 32px;
    -webkit-animation: up 2s cubic-bezier(.39, 0, .38, 1) .7s;
}

tr:nth-child(2) td:nth-child(1),
tr:nth-child(2) td:nth-child(2),
tr:nth-child(2) td:nth-child(3),
tr:nth-child(2) td:nth-child(4),
tr:nth-child(2) td:nth-child(5) {
    padding-bottom: 7px;
    -webkit-animation: up 2s cubic-bezier(.39, 0, .38, 1) .9s;
}

tr:nth-child(3) td:nth-child(1),
tr:nth-child(3) td:nth-child(2),
tr:nth-child(3) td:nth-child(3),
tr:nth-child(3) td:nth-child(4),
tr:nth-child(3) td:nth-child(5) {
    padding-bottom: 7px;
    -webkit-animation: up 2s cubic-bezier(.39, 0, .38, 1) .9s;
}

tr:nth-child(2),
tr:nth-child(3) {
    font-size: .9em;
}

tr:nth-child(3) {
    color: #999;
}

@-webkit-keyframes up {
    0% {
        opacity: 0;
        -webkit-transform: translateY(15px);
    }
    50% {
        opacity: 0;
        -webkit-transform: translateY(15px);
    }
    99% {
        -webkit-animation-play-state: paused;
    }
    100% {
        opacity: 1;
    }
}



  </style>
  
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
		
		
		<div class="card">        
			<h3>Sensor XXXX<span>Aula 013</h3>
			<h1><?php echo $row2['temp']?>º</h1>
			<div class="tempback">
				<img src="thermometer.svg" alt="termometro" class="thermometer">	
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
		
	


</table>

    
   
  </body>
</html>
<?php

	mysqli_close($conn);
?>