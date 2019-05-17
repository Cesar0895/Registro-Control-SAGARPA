<?php
	
	require 'conexion.php';

	        $RFC = $_GET['RFC'];        
            
			$sql = "SELECT RFC, concat(ApePaterno,' ', ApeMaterno,' ', Nombre) as NombreComp, Adscripcion, Area, Subarea, Puesto, Telefono, Extension, Domicilio, Correo, GFC, Acceso_correo, Estatus, Usuario, Contra 
			FROM persona WHERE RFC = '$RFC'";
            $resultado = $mysqli->query($sql);
            $row = $resultado->fetch_array(MYSQLI_ASSOC);
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
						<a class="nav-link mask flex-center rgba-red-strong" href="inicio.php">Inicio</a>
					</li>

					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Registro</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="registroEquipoComputo.php">Equipo de computo</a>
							<a class="dropdown-item" href="Auxiliares.php">Auxiliares</a>
							<a class="dropdown-item" href="Telefonia.php">Telefonia</a>

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
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="Zonas.php">Zonas</a>
							<a class="dropdown-item" href="Areas.php">Áreas</a>
							<a class="dropdown-item" href="Subareas.php">Subáreas</a>
						</div>
					</li>

					<li class="nav-item">
						<a class="nav-link mask flex-center rgba-red-strong" href="Reportes.php">Reportes</a>
					</li>
				</ul>
				<ul class="nav navbar-nav">
					<li>

						<span class="fas fa-user nav-link"> Bienvenido (a):
							<?php echo $nombr; ?>
						</span>
					</li>
					<li>
						<a href="cerrar_session.php">
							<span class="fas fa-sign-in-alt nav-link"></span> (Cerrar sesion)</a>

					</li>
				</ul>
			</div>
		</nav>

	</div>

	<main role="main" class="container">
		<br>
		<div class="card">
			<div class="card-header bg-info">
				<h3 style="text-align:center">DETALLES</h3>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-3">
						<h3>Nombre: </h3>
					</div>
					<div class="col-5">
						<h4>
							<?php echo $row['NombreComp']; ?>
						</h4>
					</div>
				</div>

				<div class="row">
					<div class="col-3">
						<h4>RFC: </h4>
					</div>
					<div class="col-5">
						<h5>
							<?php echo $row['RFC']; ?>
						</h5>
					</div>
				</div>

				<hr color="blue" size=3>

				<div class="row">
					<div class="col-3">
						<p class="h5">Adscripción: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Adscripcion']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Area: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Area']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Subarea: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Subarea']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Puesto: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Puesto']; ?>
						</p>
					</div>
				</div>

				<div class="row">
					<div class="col-3">
						<p class="h5">Telefono: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Telefono']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Extension: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Extension']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Domicilio: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Domicilio']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Correo: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Correo']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">GFC: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['GFC']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Acceso del correo: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Acceso_correo']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Status: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Estatus']; ?>
						</p>
					</div>
				</div>

				<a href="personal.php" class="btn btn-primary">Regresar</a>
				
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
</body>

</html>