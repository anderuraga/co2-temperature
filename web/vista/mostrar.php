<?php

	require_once("../db/conectar.php");


	$fecha1 = $_GET['f1'];
	$fecha2 = $_GET['f2'];

	$filtro = "Últimos Registros";
	if ( !is_null($fecha1) )
	{
		$filtro = "Registros desde ".$fecha1." hasta ".$fecha2;
		$sql= "SELECT * FROM tabla WHERE fecha BETWEEN CAST('".$fecha1."' AS DATE) AND CAST('".$fecha2."' AS DATE) ORDER BY id DESC;";

	}else {
		$fecha1 = date("Y-m-d");
		$fecha2 = date("Y-m-d");
		$sql= "SELECT * FROM tabla ORDER BY id DESC LIMIT 500;";
	}

	// echo($sql);
	$resultado = mysqli_query($conn, $sql);


			
	
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<link href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">

    <title>Co2 & Temperatura</title>
  </head>
  <body class="container">
	<a href="../index.php" class="btn btn-outline-primary mb-4 mt-4">Volver</a>
  
	<h3><span class="bg-secondary text-light p-1"><?php echo($resultado->num_rows)?></span> <?php echo($filtro)?></h3>
	

	<!-- filtro fechas -->
		<form method="get" action="mostrar.php" class="form-inline mb-4 bg-light p-2" >
			<div class="row">
				<div class="col">				
					<input type="date" name="f1" value="<?php echo($fecha1)?>" class="form-control" value="2015-06-17" id="dateFrom" />				
				</div>

				<div class="col">					
					<input type="date" name="f2" value="<?php echo($fecha2)?>" class="form-control" value="2015-06-19" id="dateTo" />				
				</div>

				<div class="col">				
					<button class="btn btn-primary" type="submit" >Buscar por Fechas</button>				
				</div>
				<div class="col">				
					<a href="mostrar.php" class="btn btn-success" >Ultimos Registros</a>				
				</div>
			</div>
		</form>



	
	<div class="row">
		<!-- tabla -->
		<div class="col bg-light p-2 mr-2">
			<table id="myTable" class="table table-striped table-hover">
			<caption>Datos Co2 - Aula X</caption>
			<thead>
				<tr>
				<th>#</th>
				<th>co2</th>
				<th>temp</th>
				<th>fecha</th>
				</tr>
			</thead>
				<tbody>
				
				<?php
					
					// variables para los graficos
					$dataCount = $resultado->num_rows;
					$labelsTemp = [];
					$dataTemp = [];
					$cont = 0;

					$tempMax = -100;
					$tempMin = 100;
					$tempMedia = 0;

					$co2Max = -100;
					$co2Min = 100;
					$co2Media = 0;
					
					while($row = mysqli_fetch_assoc($resultado)) {

						// maximos, minimos y media
						$tempMedia += $row['temp'];
						$tempMin = ( $tempMin < $row['temp'] ) ? $tempMin : $row['temp'];
						$tempMax = ( $tempMax > $row['temp'] ) ? $tempMax : $row['temp'];

						$co2Media += $row['co2'];
						$co2Min = ( $co2Min < $row['co2'] ) ? $co2Min : $row['co2'];
						$co2Max = ( $co2Max > $row['co2'] ) ? $co2Max : $row['co2'];


						// rellenar datos para graficos
						$labelsTemp[$cont] = $row['fecha'];
					    $dataTemp[$cont] = $row['temp'];


						// pintar TABLA HTML
						echo " <tr>";
							echo "<td>".$row['chipId']."</td>";
							echo "<td>".$row['co2']."</td>";
							echo "<td>".$row['temp']."</td>";
							echo "<td>".$row['fecha']."</td>";
						echo " </tr>";	

						$cont++;
					}


					$tempMedia = round( ($tempMedia/$cont) ,2);
					
				?>

				</tbody>
			</table>
		</div>

		
		<div class="col bg-light p-2">

			<!-- tablas resumen -->		
				<table class="table">
					<thead>
						<tr>				
							<th scope="col">T. Max</th>
							<th scope="col">T. Min</th>
							<th scope="col">T. Media</th>
						</tr>
					</thead>
					<tbody>
						<tr>					
							<td><?php echo($tempMax)?></td>
							<td><?php echo($tempMin)?></td>
							<td><?php echo($tempMedia)?></td>
						</tr>			
					</tbody>
				</table>

				<table class="table">
					<thead>
						<tr>				
							<th scope="col">Co2 Max</th>
							<th scope="col">Co2. Min</th>
							<th scope="col">Co2. Media</th>
						</tr>
					</thead>
					<tbody>
						<tr>					
							<td><?php echo($co2Max)?></td>
							<td><?php echo($co2Min)?></td>
							<td><?php echo($co2Media)?></td>
						</tr>			
					</tbody>
				</table>

			<!-- grafico -->
			<canvas id="myChart" width="400" height="300"></canvas>		
		</div>	

	</div>
	<!-- /row -->

	

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
	<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>

	
	<script src="https://raw.githubusercontent.com/chartjs/Chart.js/master/docs/scripts/utils.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.js"></script>
	
	<script src="../resources/js/main.js"></script>
  
	<script>

			const DATA_COUNT = <?php echo $dataCount?>;
			const NUMBER_CFG = {count: DATA_COUNT, min: 0, max: 40};

			const labels = <?php echo json_encode($labelsTemp)?>;
			const data = {
			labels: labels,
			datasets: [				
				{
				label: 'Temperatura',
				data: <?php echo json_encode($dataTemp)?>,
				borderColor: 'rgba(255, 99, 132)',
				backgroundColor: 'rgba(255, 99, 132, 0.2)',
				}
			]
			};

			var ctx = document.getElementById('myChart').getContext('2d');
			var myChart = new Chart(ctx, {
				type: 'line',
				options: {
					responsive: true,
					plugins: {
					legend: {
						position: 'top',
					},
					title: {
						display: true,
						text: '<?php echo $dataCount?> Temperaturas pintadas'
					}
					}
				},
				data: data
			});
			</script>

  </body>
</html>
<?php

	require_once("../db/desconectar.php");
?>