<?php

	require_once("../db/conectar.php");


	$fecha1 = $_GET['f1'];
	$fecha2 = $_GET['f2'];

	$filtro = "Ultimos 500 registros";
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
  
	<h3><?php echo($filtro)?></h3>
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
	
	<!-- Row -->

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
			
			
			while($row = mysqli_fetch_assoc($resultado)) {
				echo " <tr>";
					echo "<td>".$row['chipId']."</td>";
					echo "<td>".$row['co2']."</td>";
					echo "<td>".$row['temp']."</td>";
					echo "<td>".$row['fecha']."</td>";
				echo " </tr>";	
			}
			
		?>

		</tbody>
	</table>

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
		
	<script src="../resources/js/main.js"></script>
   
  </body>
</html>
<?php

	require_once("../db/desconectar.php");
?>