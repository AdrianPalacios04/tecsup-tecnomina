<?php
include("../conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Agenda</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style_nav.css" rel="stylesheet">
	<link href="css/dataTables.bootstrap.min.css" rel="stylesheet">
	<style>
		.content {
			margin-top: 40px;
		}
	</style>

</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
		<?php include('nav.php');?>
	</nav>
	<div class="container">
		<div class="content">
			<h3 style="margin-top: 55px">Listado del Personal</h3>
			<hr style="margin-bottom: -5px" />
			<?php
			if(isset($_GET['aksi']) == 'delete'){
				// escaping, additionally removing everything that could be (html/javascript-) code
				$nik = mysqli_real_escape_string($con,(strip_tags($_GET["nik"],ENT_QUOTES)));
				$cek = mysqli_query($con, "SELECT * FROM personal WHERE dni='$nik'");
				if(mysqli_num_rows($cek) == 0){
					echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontraron datos.</div>';
				}else{
					$delete = mysqli_query($con, "DELETE FROM personal WHERE dni='$nik'");
					$delete = mysqli_query($con, "DELETE FROM agenda WHERE dni='$nik'");
					if($delete){
						echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Datos eliminado correctamente.</div>';
					}else{
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error, no se pudo eliminar los datos.</div>';
					}
				}
			}
			?>

			<form class="form-inline" method="POST">
				<!--<div class="form-group">
					<div class="col-sm-4">
						<input type="text" name="filter" class="form-control" placeholder="Busqueda" required>
					</div>
				</div>-->
			</form>
			<br />
			<div class="table-responsive">
			<table class="table table-striped" id="tabla">
				<thead>
					<tr>
                    <th>No</th>
					<th>DNI</th>
					<th>Paterno</th>
                    <th>Materno</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
				</tr>
				</thead>
				<tbody>
					
				
				<?php
				// para mostrar los datos de la tabla
				$sql = mysqli_query($con, "SELECT * FROM personal");

				if(mysqli_num_rows($sql) == 0){
					echo '<tr><td colspan="8">No hay datos.</td></tr>';
				}else{
					$no = 0;
					while($row = mysqli_fetch_assoc($sql)){
						echo '
						<tr>
							<td>'.$no.'</td>
							<td>'.$row['dni'].'</td>
							<td><a href="profile.php?nik='.$row['dni'].'"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>'.$row['paterno'].'</a></td>
                            <td>'.$row['materno'].'</td>
                            <td>'.$row['nombre'].'</td>
							';
						echo '
							</td>
							<td>

								<a href="edit.php?nik='.$row['dni'].'" title="Editar datos" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
								<a href="table.php?aksi=delete&nik='.$row['dni'].'" title="Eliminar" onclick="return confirm(\'Esta seguro de borrar los datos de '.$row['dni'].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
							</td>
						</tr>
						';
						$no++;
					}
				}
				?>
				</tbody>
			</table>
			</div>
			
		</div>
	</div><center>
	<p>&copy; Sistemas Tecnomina <?php echo date("Y");?></p>
		</center>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#tabla').dataTable();
		})
	</script>
	<script type="text/javascript">
		$('#tabla').dataTable( {
  		//scrollY: 450,
  		//paging: true

		} );

	</script>
</body>
</html>
