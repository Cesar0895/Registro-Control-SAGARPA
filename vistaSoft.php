<?php
	error_reporting(E_ALL & ~E_NOTICE);
	error_reporting(E_ERROR | E_PARSE);
	require 'conexion.php';

	
	$id_soft = $_GET['id_Software'];
	$sql2 = "DELETE FROM software WHERE id_Software = '$id_soft'";
	$resultado = $mysqli->query($sql2);
		
	$where = "";
	
	if(!empty($_POST))
	{
		$valor = $_POST['campo'];
		
		if(!empty($valor)){
			$where = "WHERE Nombre LIKE '%$valor'";
		}
	}

	$sqlmostrar = "SELECT * FROM software $where";
	$resultadoTabla = $mysqli->query($sqlmostrar);

?>

<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
	 crossorigin="anonymous">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
	 crossorigin="anonymous">

	<link rel="stylesheet" href="./css/estilo.css">

	<title>Control de dispositivos</title>

</head>

<body>

	<div class="allNavbar">

		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a href="inicio.php" class="logo">
				<img src="./img/logoSader.jpg" width="180" height="80" class="d-inline-block align-top" alt="">
			</a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse"
			 aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarCollapse">
				<ul class="navbar-nav mr-auto mt-2 mt-lg-0">

					<li class="nav-item">
						<a class="nav-link" href="inicio.php">Inicio</a>
					</li>

					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Registro</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="registroEquipoComputo.php">Equipo de computo</a>
							<a class="dropdown-item" href="registroAuxiliares.php">Auxiliares</a>
							<a class="dropdown-item" href="#">Telefonia</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Separated link</a>
						</div>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="personal.php">Personal</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Registro Complementos</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="Marcas.php ">Marcas</a>
							<a class="dropdown-item" href="Modelos.php">Modelos</a>

							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="Dispositivos.php">Dispositivos</a>
							<a class="dropdown-item" href="Soft.php">Software</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="DiscoDuro.php">Disco duro</a>
							<a class="dropdown-item" href="RAM.php">Memoria RAM</a>
							<a class="dropdown-item" href="Procesador.php">Procesador</a>
							<a class="dropdown-item" href="Velocidad.php">Velocidad</a>
							<a class="dropdown-item" href="Zonas.php">Zonas</a>
						</div>
					</li>
				</ul>
				<ul class="nav navbar-nav">
					<li>
						<a href="#">
							<span class="fas fa-user nav-link"></span> Sign Up</a>
					</li>
					<li>
						<a href="#">
							<span class="fas fa-sign-in-alt nav-link"></span> Salir</a>
					</li>
				</ul>
			</div>
		</nav>

	</div>
	<br>
	<main role="main" class="container">
		<div class="card">
			<div class="card-header bg-info">
				<h3 style="text-align:center">SOFTWARE</h3>
			</div>
			<div class="card-body">

				<a href="Soft.php" class="btn btn-primary float-right">Nuevo Registro</a>

				<div class="row">


					<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
						<b>Nombre: </b>
						<input type="text" id="campo" name="campo" />
						<input type="submit" id="enviar" name="enviar" value="Buscar" class="btn btn-info" />
					</form>
				</div>


				<br>

				<div class="row table-responsive">
					<table class="table table-hover table-secondary">
						<thead>
							<tr>

								<th>Nombre</th>
								<th>Version</th>
								<th>Licencia</th>
								<th>Key</th>
								<th>Plataforma</th>
								<th>Fabricante</th>
								<th>Adquisición</th>
								<th>ProducKey</th>
								<th>Asignada</th>
								<th></th>
								<th></th>

							</tr>
						</thead>

						<tbody>
							<?php while($row = $resultadoTabla->fetch_array(MYSQLI_ASSOC)) { ?>
							<tr>

								<td>
									<?php echo $row['Nombre']; ?>
								</td>
								<td>
									<?php echo $row['Version']; ?>
								</td>
								<td>
									<?php echo $row['Licencia']; ?>
								</td>
								<td>
									<?php echo $row['Key_soft']; ?>
								</td>
								<td>
									<?php echo $row['Plataforma']; ?>
								</td>
								<td>
									<?php echo $row['Fabricante']; ?>
								</td>
								<td>
									<?php echo $row['Adquisicion']; ?>
								</td>
								<td>
									<?php echo $row['ProducKey']; ?>
								</td>
								<td>
									<?php if ($row['Asignado']=='SI' && $row['Licencia']=='OEM') { 
										echo 'X';
									}else{
										echo '-';
									}?>

								</td>
								<td>
									<a href="ModificaSoft.php?id_Software=<?php echo $row['id_Software']; ?>">
										<span class="far fa-edit"> edita</span>
									</a>
								</td>
								<td>
									<a href="vistaSoft.php" data-href="vistaSoft.php?id_Software=<?php echo $row['id_Software']; ?>"
									 data-toggle="modal" data-target="#confirm-delete">
										<span class="far fa-trash-alt"></span>
									</a>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>



	</main>
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
	 crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
	 crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
	 crossorigin="anonymous"></script>

	<!-- Modal -->
	<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title" id="myModalLabel">Eliminar Registro</h4>
				</div>

				<div class="modal-body">
					¿Desea eliminar este registro?
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<a class="btn btn-danger btn-ok">Delete</a>
				</div>
			</div>
		</div>
	</div>

	<script>
		$('#confirm-delete').on('show.bs.modal', function(e) {
			$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

			$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
		});
	</script>
</body>

</html>