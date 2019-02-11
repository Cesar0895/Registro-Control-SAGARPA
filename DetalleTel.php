<?php
	
	require 'conexion.php';

		$extencion = $_GET['Extencion'];       
            
			$sql = "SELECT telefonia.Extencion, telefonia.Display, telefonia.RFC, telefonia.Inmueble, telefonia.Sitio, telefonia.Serie, marca.Marca, modelo.Modelo, telefonia.Mac,telefonia.NodoRed,telefonia.GpoCaptura,telefonia.Nivel_Cor,telefonia.Nivel_Aut,telefonia.Codigo_Aut, telefonia.Funcion, telefonia.DID, telefonia.CorreoVoz, telefonia.Puerto, telefonia.Dir_IP, telefonia.Mask, telefonia.Gateway, telefonia.VLAN, telefonia.Notas, telefonia.Adquisicion, telefonia.Eliminador, telefonia.F_Resguardo, telefonia.Fecha_Resguardo, telefonia.Observaciones, telefonia.Estatus FROM telefonia inner join modelo on telefonia.id_Modelo=modelo.id_Modelo inner join marca on telefonia.id_Marca=marca.id_Marca WHERE Extencion = '$extencion'";
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

	<main role="main" class="container">
		<br>
		<div class="card">
			<div class="card-header bg-info">
				<h3 style="text-align:center">DETALLES DE TELEFONIA</h3>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-3">
						<h3>Extención: </h3>
					</div>
					<div class="col-5">
						<h4>
							<?php echo $row['Extencion']; ?>
						</h4>
					</div>
				</div>

				<div class="row">
					<div class="col-3">
						<h4>Display: </h4>
					</div>
					<div class="col-5">
						<h5>
							<?php echo $row['Display']; ?>
						</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<h4>RFC del usuario: </h4>
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
						<p class="h5">Inmueble: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Inmueble']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Sitio: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							 <?php echo $row['Sitio']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Marca: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Marca']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Modelo: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Modelo']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Serie: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Serie']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Mac: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Mac']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Nodo de Red: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['NodoRed']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Gpo de captura: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['GpoCaptura']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Nivel_Cor: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Nivel_Cor']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Nivel_Aut: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Nivel_Aut']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Codigo_Aut: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Codigo_Aut']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Funcion: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Funcion']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">DID: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['DID']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Correo de voz: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['CorreoVoz']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Puerto: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Puerto']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Dirección IP: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Dir_IP']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Mask: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Mask']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Gateway: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Gateway']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">VLAN: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['VLAN']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Notas: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Notas']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Adquisicion: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Adquisicion']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Eliminador: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Eliminador']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">F_Resguardo: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['F_Resguardo']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Fecha de Resguardo: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Fecha_Resguardo']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Observaciones: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Observaciones']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Estatus: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Estatus']; ?>
						</p>
					</div>
				</div>
				


				<a href="personal.php" class="btn btn-primary">Regresar</a>
				<a href="ReporteAux.php?RFC=<?php echo $row['RFC']; ?>">
					Reporte
				</a>
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