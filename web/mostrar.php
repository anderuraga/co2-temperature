<?php
	$cons_usuario="root";
    $cons_contra="";
    $cons_base_datos="tutorial";
    $cons_equipo="localhost";
	
    // Create connection
    $conn = mysqli_connect($cons_equipo,$cons_usuario,$cons_contra,$cons_base_datos);
    
	$sql= "SELECT * FROM tabla ORDER BY id DESC;";
    
	
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

    <title>Hello, world!</title>
  </head>
  <body class="container">
  
  
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
	
	$resultado = mysqli_query($conn, $sql);
	
	
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
	
	
	<script>
		$(document).ready(function() {
			$('#myTable').DataTable( {
				pageLength: 15,
				dom: 'Bfrtip',
				buttons: [
					'copy', 'csv', 'excel', 'pdf', 'print'
				],
				language: {
					"processing": "Procesando...",
					"lengthMenu": "Mostrar _MENU_ registros",
					"zeroRecords": "No se encontraron resultados",
					"emptyTable": "Ningún dato disponible en esta tabla",
					"infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
					"infoFiltered": "(filtrado de un total de _MAX_ registros)",
					"search": "Buscar:",
					"infoThousands": ",",
					"loadingRecords": "Cargando...",
					"paginate": {
						"first": "Primero",
						"last": "Último",
						"next": "Siguiente",
						"previous": "Anterior"
					},
					"aria": {
						"sortAscending": ": Activar para ordenar la columna de manera ascendente",
						"sortDescending": ": Activar para ordenar la columna de manera descendente"
					},
					"buttons": {
						"copy": "Copiar",
						"colvis": "Visibilidad",
						"collection": "Colección",
						"colvisRestore": "Restaurar visibilidad",
						"copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
						"copySuccess": {
							"1": "Copiada 1 fila al portapapeles",
							"_": "Copiadas %d fila al portapapeles"
						},
						"copyTitle": "Copiar al portapapeles",
						"csv": "CSV",
						"excel": "Excel",
						"pageLength": {
							"-1": "Mostrar todas las filas",
							"1": "Mostrar 1 fila",
							"_": "Mostrar %d filas"
						},
						"pdf": "PDF",
						"print": "Imprimir"
					},
					"autoFill": {
						"cancel": "Cancelar",
						"fill": "Rellene todas las celdas con <i>%d<\/i>",
						"fillHorizontal": "Rellenar celdas horizontalmente",
						"fillVertical": "Rellenar celdas verticalmentemente"
					},
					"decimal": ",",
					"searchBuilder": {
						"add": "Añadir condición",
						"button": {
							"0": "Constructor de búsqueda",
							"_": "Constructor de búsqueda (%d)"
						},
						"clearAll": "Borrar todo",
						"condition": "Condición",
						"conditions": {
							"date": {
								"after": "Despues",
								"before": "Antes",
								"between": "Entre",
								"empty": "Vacío",
								"equals": "Igual a",
								"notBetween": "No entre",
								"notEmpty": "No Vacio",
								"not": "Diferente de"
							},
							"number": {
								"between": "Entre",
								"empty": "Vacio",
								"equals": "Igual a",
								"gt": "Mayor a",
								"gte": "Mayor o igual a",
								"lt": "Menor que",
								"lte": "Menor o igual que",
								"notBetween": "No entre",
								"notEmpty": "No vacío",
								"not": "Diferente de"
							},
							"string": {
								"contains": "Contiene",
								"empty": "Vacío",
								"endsWith": "Termina en",
								"equals": "Igual a",
								"notEmpty": "No Vacio",
								"startsWith": "Empieza con",
								"not": "Diferente de"
							},
							"array": {
								"not": "Diferente de",
								"equals": "Igual",
								"empty": "Vacío",
								"contains": "Contiene",
								"notEmpty": "No Vacío",
								"without": "Sin"
							}
						},
						"data": "Data",
						"deleteTitle": "Eliminar regla de filtrado",
						"leftTitle": "Criterios anulados",
						"logicAnd": "Y",
						"logicOr": "O",
						"rightTitle": "Criterios de sangría",
						"title": {
							"0": "Constructor de búsqueda",
							"_": "Constructor de búsqueda (%d)"
						},
						"value": "Valor"
					},
					"searchPanes": {
						"clearMessage": "Borrar todo",
						"collapse": {
							"0": "Paneles de búsqueda",
							"_": "Paneles de búsqueda (%d)"
						},
						"count": "{total}",
						"countFiltered": "{shown} ({total})",
						"emptyPanes": "Sin paneles de búsqueda",
						"loadMessage": "Cargando paneles de búsqueda",
						"title": "Filtros Activos - %d"
					},
					"select": {
						"1": "%d fila seleccionada",
						"_": "%d filas seleccionadas",
						"cells": {
							"1": "1 celda seleccionada",
							"_": "$d celdas seleccionadas"
						},
						"columns": {
							"1": "1 columna seleccionada",
							"_": "%d columnas seleccionadas"
						}
					},
					"thousands": ".",
					"datetime": {
						"previous": "Anterior",
						"next": "Proximo",
						"hours": "Horas",
						"minutes": "Minutos",
						"seconds": "Segundos",
						"unknown": "-",
						"amPm": [
							"am",
							"pm"
						]
					},
					"editor": {
						"close": "Cerrar",
						"create": {
							"button": "Nuevo",
							"title": "Crear Nuevo Registro",
							"submit": "Crear"
						},
						"edit": {
							"button": "Editar",
							"title": "Editar Registro",
							"submit": "Actualizar"
						},
						"remove": {
							"button": "Eliminar",
							"title": "Eliminar Registro",
							"submit": "Eliminar",
							"confirm": {
								"_": "¿Está seguro que desea eliminar %d filas?",
								"1": "¿Está seguro que desea eliminar 1 fila?"
							}
						},
						"error": {
							"system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
						},
						"multi": {
							"title": "Múltiples Valores",
							"info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
							"restore": "Deshacer Cambios",
							"noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
						}
					},
					"info": "Mostrando de _START_ a _END_ de _TOTAL_ entradas"
				}
			} );
		} );
	</script>
   
  </body>
</html>
<?php

	mysqli_close($conn);
?>