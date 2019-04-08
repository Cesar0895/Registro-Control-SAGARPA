<?php
session_start();
	
	$varsesion=$_SESSION['user'];
	//$contrasesion=$_SESSION['pass'];
	
    require 'conexion.php';
    $consulta="SELECT `RFC`, concat(`Nombre`,' ', `ApePaterno`,' ', `ApeMaterno`) as nombComple, `Adscripcion`, `Area`, `Subarea`, `Puesto`, `Denominacion`, `Telefono`, `Extension`, `Domicilio`, `Correo`, `GFC`, `Acceso_correo`, `Estatus`, `Usuario`, `Contra` FROM `persona` WHERE Usuario='$varsesion'";
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
		

		$id_CPU = $_GET['Id_CPU'];        
            
			$sql = "SELECT `Id_CPU`, marca.Marca, modelo.Modelo, procesador.Procesador, memoria_ram.Memoria_RAM, disco_duro.Almacenamiento, velocidad.Velocidad, `Serie`, `Invetario`, `Adquisicion`, `UnidadOptica`, `Bosinas`, `P_USB`, `P_Serial`, `P_Paralelo`, `RedTipo`, `IP`, `MacEth`, `Mac_wifi`, `Dominio`, `Antivirus` FROM `cpu` INNER JOIN marca on cpu.Id_Marca=marca.id_Marca INNER JOIN modelo on cpu.Id_Modelo=modelo.id_Modelo INNER JOIN procesador on cpu.Id_Procesador=procesador.id_Procesador INNER JOIN memoria_ram on cpu.Id_MemoriaRam=memoria_ram.Id_Memoria INNER JOIN disco_duro on cpu.Id_DD=disco_duro.id_DD INNER JOIN velocidad on cpu.Id_Velocidad=velocidad.Id_velocidad WHERE Id_CPU = '$id_CPU'";
            $resultado = $mysqli->query($sql);
			$row = $resultado->fetch_array(MYSQLI_ASSOC);
			
		
		$serie=$row['Serie'];

		$sqlSoft="SELECT software.Nombre, software.Version, software.Licencia, software.Key_soft, software.Plataforma, software.Fabricante, software.Adquisicion, cpu.Serie FROM `cpu_soft` 
		INNER JOIN software ON cpu_soft.id_Software=software.id_Software 
		INNER JOIN cpu on cpu_soft.Id_CPU=cpu.Id_CPU  
		WHERE cpu.Serie='$serie' GROUP by software.Nombre" ;
		$resultadoSoft=$mysqli->query($sqlSoft);
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
				<h3 style="text-align:center">DETALLES DE CPU</h3>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-3">
						<h3>No. Inventario: </h3>
					</div>
					<div class="col-5">
						<h4>
							<?php echo $row['Invetario']; ?>
						</h4>
					</div>
				</div>

				<div class="row">
					<div class="col-3">
						<h4>Serie: </h4>
					</div>
					<div class="col-5">
						<h5>
							<?php echo $row['Serie']; ?>
						</h5>
					</div>
				</div>

				<hr color="blue" size=3>

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
							<?php echo $row['Modelo']; ?>.00
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Procesador: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Procesador']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">RAM: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Memoria_RAM']; ?> GB
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Disco duro: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Almacenamiento']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Velocidad: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Velocidad']; ?>
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
						<p class="h5">Unidad Optica: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['UnidadOptica']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Bosinas: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Bosinas']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Puertos USB: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['P_USB']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">puerto serial: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['P_Serial']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Pueto Paralelo: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['P_Paralelo']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Tipo de red: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['RedTipo']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">IP: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['IP']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Mac Ethernet: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['MacEth']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Mac Wifi: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Mac_wifi']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Dominio: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Dominio']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Antivirus: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Antivirus']; ?>
						</p>
					</div>
				</div>
				<br>
				<div class="col-5">
					<p class="h4">Software: </p>
				</div>
				<div class="row table-responsive mx-auto">
					<table class="table table-hover table-secondary">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Version</th>
								<th>Licencia</th>
								<th>No. Licencia</th>
								<th>Plataforma</th>
								<th>Fabricante</th>
								<th>Adquisicion</th>
							</tr>
						</thead>

						<tbody>
							<?php while($rowSoft = $resultadoSoft->fetch_array(MYSQLI_ASSOC)) { ?>
							<tr>
								<td>
									<?php echo $rowSoft['Nombre']; ?>
								</td>
								<td>
									<?php echo $rowSoft['Version']; ?>
								</td>
								<td>
									<?php echo $rowSoft['Licencia']; ?>
								</td>
								<td>
									<?php echo $rowSoft['Key_soft']; ?>
								</td>

								<td>
									<?php echo $rowSoft['Plataforma']; ?>
								</td>
								<td>
									<?php echo $rowSoft['Fabricante']; ?>
								</td>
								<td>
									<?php echo $rowSoft['Adquisicion']; ?>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
					<a href="AñadeSoft.php?Serie=<?php echo $row['Serie']; ?>" class="btn btn-primary">Añadir Software</a>
				</div>


				<br>
				<a href="vistaCPU.php" class="btn btn-primary">Regresar</a>
				

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