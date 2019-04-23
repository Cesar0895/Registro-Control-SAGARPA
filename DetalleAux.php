<?php
session_start();
	
	$varsesion=$_SESSION['user'];
	//$contrasesion=$_SESSION['pass'];
	
    require 'conexion.php';
    $consulta="SELECT `RFC`, concat(`Nombre`,' ', `ApePaterno`,' ', `ApeMaterno`) as nombComple, `Adscripcion`, `Area`, `Subarea`, `Puesto`, `Telefono`, `Extension`, `Domicilio`, `Correo`, `GFC`, `Acceso_correo`, `Estatus`, `Usuario`, `Contra` FROM `persona` WHERE Usuario='$varsesion'";
    //'or '1'='1
    $resultado = $mysqli->query($consulta);
    $row = $resultado->fetch_array(MYSQLI_ASSOC);

		$puesto=$row['Puesto'];
		$nombr=$row['nombComple'];
	
		if ($varsesion==null || $varsesion='' ) {
			header('location:index.php');
			die();
		}
		
		if ($puesto!='encargado') {
			header('location:Resguardante/inicioRes.php');
			die();
		}
		

			$idAux = $_GET['IdAux'];        
            
			$sql = "SELECT auxiliares.IdAux, auxiliares.Folio, zona.Nombre, auxiliares.Presupuesto, dispositivos.Nomb_Dispositivo, auxiliares.Inventario, marca.Marca, modelo.Modelo, auxiliares.serie, dispositivos.Tipo, auxiliares.Adquisicion, auxiliares.Fecha_adquisicion, auxiliares.Fin_Garantia, auxiliares.DT, auxiliares.Observaciones, auxiliares.Direccion_ip, auxiliares.Mac_Eth, auxiliares.Mac_wifi, auxiliares.estatus, auxiliares.RFC, auxiliares.Valor FROM auxiliares inner join modelo on auxiliares.id_Modelo=modelo.id_Modelo inner join marca on auxiliares.id_Marca=marca.id_Marca inner join dispositivos on auxiliares.Id_dispositivo=dispositivos.Id_Dispositivo inner join zona on auxiliares.Id_zona=zona.id_Zona WHERE IdAux = '$idAux'";
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
				<h3 style="text-align:center">DETALLES DE AUXILIAR</h3>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-3">
						<h3>Folio: </h3>
					</div>
					<div class="col-5">
						<h4>
							<?php echo $row['Folio']; ?>
						</h4>
					</div>
				</div>

				<div class="row">
					<div class="col-3">
						<h4>Dispositivo: </h4>
					</div>
					<div class="col-5">
						<h5>
							<?php echo $row['Nomb_Dispositivo']; ?>
						</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<h4>Tipo: </h4>
					</div>
					<div class="col-5">
						<h5>
							<?php echo $row['Tipo']; ?>
						</h5>
					</div>
				</div>

				<hr color="blue" size=3>

				<div class="row">
					<div class="col-3">
						<p class="h5">Zona: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Nombre']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Presupuesto: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							$
							<?php echo $row['Presupuesto']; ?>.00
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">No. de inventario: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Inventario']; ?>
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
							<?php echo $row['serie']; ?>
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
						<p class="h5">Fecha de adquisicion: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Fecha_adquisicion']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Fin de garantia: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Fin_Garantia']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">DT: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['DT']; ?>
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
						<p class="h5">Direccion ip: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Direccion_ip']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Mac Ethernet: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Mac_Eth']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Mac wifi: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Mac_wifi']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Status: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['estatus']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">RFC del responsable: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['RFC']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Valor: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							$
							<?php echo $row['Valor']; ?>.00
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