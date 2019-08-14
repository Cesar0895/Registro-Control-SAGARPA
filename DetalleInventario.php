<?php
session_start();
	
$varsesion=$_SESSION['user'];
//$contrasesion=$_SESSION['pass'];

require 'conexion.php';
$consulta="SELECT `RFC`, concat(`Nombre`,' ', `ApePaterno`,' ', `ApeMaterno`) as nombComple,  `Area`, `Subarea`, `Puesto`, `Telefono`, `Extension`, `Domicilio`, `Correo`, `GFC`, `Acceso_correo`, `Estatus`, `Usuario`, `Contra` FROM `persona` WHERE Usuario='$varsesion' or Correo='$varsesion'";
//'or '1'='1
$resultado = $mysqli->query($consulta);
$row = $resultado->fetch_array(MYSQLI_ASSOC);

	$RFC=$row['RFC'];
	$nombr=$row['nombComple'];

	if ($varsesion==null || $varsesion='' ) {
		header('location:index.php');
		die();
	}
	
	if ($RFC!='CUAJ800423F77' && $RFC!='BUVG860908DU8') {
		header('location:Resguardante/inicioRes.php');
		die();
	}
		
		
		

			$folio = $_GET['Folio'];        
            
			$sql = "SELECT `Folio`, zona.Nombre, concat(persona.Nombre,' ',persona.ApePaterno,' ',persona.ApeMaterno) as nombResp, persona.RFC, Filtrado,`Identificacion`, concat(p.Nombre,' ',p.ApePaterno,' ',p.ApeMaterno) as nombUser,p.RFC as RFCUser, `Nodo`, `Fecha_Adquisicion`, `DT_adquisicion`, `DTB`, `Tipo_HW`, `Folio_Resduardo`, `Observaciones`, `Fin_Garantia`, `Candado`, `Valor`,equipos.Estatus, `Ubicacion`, `Fecha_Llenado`, `Oficio_Mexico`, `Contra_Admin`, 
			cpu.Serie as serieCPU, marCPU.Marca as marcaCPU, modCPU.Modelo as modCPU, cpu.Invetario as InvCPU, 

			monitor.id_Monitor,monitor.Serie as serieMon, marMoni.Marca as marcaMoni, monitor.Modelo as modMoni, monitor.Inventario as InvMoni,

			mouse.Id_mouse, mouse.Serie as serieMou, marMou.Marca as marcaMou, mouse.Modelo as modMou, mouse.Inventario as InvMou,

			teclado.Id_Teclado, teclado.Serie as serieTec, marTec.Marca as marcaTec, teclado.Modelo as modTec, teclado.Inventario as InvTec
			FROM `equipos`
			LEFT JOIN zona on equipos.Id_Zona=zona.id_Zona 
			LEFT JOIN persona on equipos.RFC=persona.RFC 
			LEFT JOIN persona p on equipos.RFC_Usuario=p.RFC  
			LEFT JOIN (cpu 
						LEFT JOIN marca marCPU on cpu.Id_Marca=marCPU.id_Marca
						LEFT JOIN modelo modCPU on cpu.Id_Modelo=modCPU.id_Modelo) 
						on equipos.Id_CPU=cpu.Id_CPU 
			LEFT JOIN (monitor 
						LEFT JOIN marca marMoni on monitor.id_Marca=marMoni.id_Marca)
						on equipos.id_Monitor=monitor.id_Monitor
			LEFT JOIN (mouse 
						LEFT JOIN marca marMou on mouse.Id_Marca=marMou.id_Marca) 
						ON equipos.Id_mouse=mouse.Id_mouse 
			LEFT JOIN (teclado 
						LEFT JOIN marca marTec on teclado.Id_Marca=marTec.id_Marca) 
						on equipos.Id_Teclado=teclado.Id_Teclado WHERE Folio = '$folio'";
            $resultado = $mysqli->query($sql);
			$row = $resultado->fetch_array(MYSQLI_ASSOC);

			$serieMou= $row['Id_mouse'];
			$serieMon= $row['id_Monitor'];
			$serieTec= $row['Id_Teclado'];
	
			
			$sqlmou = "SELECT m.Id_mouse, m.Serie, m.Inventario, m.Descripcion, m.Adquisicion, marca.Marca, Modelo FROM mouse m Left JOIN marca ON m.Id_Marca=marca.id_Marca  where m.Id_mouse= '$serieMou'";
			$resultadoTabla = $mysqli->query($sqlmou);

			$sqlmon = "SELECT monitor.id_Monitor, monitor.Serie, marca.Marca, monitor.Modelo, monitor.Inventario, monitor.Descripcion, monitor.Adquisicion FROM monitor 
			left join marca on monitor.id_Marca=marca.id_Marca where monitor.id_Monitor='$serieMon'";
			$resultadoMon = $mysqli->query($sqlmon);

			$sqltec = "SELECT t.Id_Teclado, t.Serie, t.Inventario, t.Descripcion, t.Adquisicion, marca.Marca, t.Modelo FROM teclado t left JOIN marca ON t.Id_Marca=marca.id_Marca  where Id_Teclado='$serieTec'";
			$resultadoTec = $mysqli->query($sqltec);
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
				<h3 style="text-align:center">DETALLES DE EQUIPO DE COMPUTO</h3>
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
						<h4>Zona: </h4>
					</div>
					<div class="col-5">
						<h5>
							<?php echo $row['Nombre']; ?>
						</h5>
					</div>
				</div>

				<hr color="blue" size=3>

				<div class="row">
					<div class="col-3">
						<p class="h5">Responsable: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['nombResp']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">RFC: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['RFC']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Usuario: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['nombUser']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">RFC: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['RFCUser']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Fecha de Filtrado: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Filtrado']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Identificación: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Identificacion']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Nodo: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Nodo']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Dictamen de adquisición: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['DT_adquisicion']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Dictamen de baja: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['DTB']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Tipo de hardware: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Tipo_HW']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Folio de Resguardo: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Folio_Resduardo']; ?>
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
						<p class="h5">Fin de Fin_Garantia: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Fin_Garantia']; ?>
						</p>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<p class="h5">Candado: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Candado']; ?>
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
				<div class="row">
					<div class="col-3">
						<p class="h5">Ubicación: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['Ubicacion']; ?>
						</p>
					</div>
				</div>

				<hr color="blue" size=3>

				<h3>CPU</h3>
				<div class="row">
					<div class="col-3">
						<p class="h5">Serie: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['serieCPU']; ?>
						</p>
					</div>
				</div>

				<div class="row">
					<div class="col-3">
						<p class="h5">Marca: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['marcaCPU']; ?>
						</p>
					</div>
				</div>

				<div class="row">
					<div class="col-3">
						<p class="h5">Modelo: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['modCPU']; ?>
						</p>
					</div>
				</div>

				<div class="row">
					<div class="col-3">
						<p class="h5">No. Inventario: </p>
					</div>
					<div class="col-5">
						<p class="h6">
							<?php echo $row['InvCPU']; ?>
						</p>
					</div>
				</div>

				<hr color="blue" size=3>

				<h3>Monitor</h3>
				<div class="row table-responsive">
					<table class="table table-hover table-secondary">
						<thead>
							<tr>

								<th>Serie</th>
								<th>Marca</th>
								<th>Modelo</th>
								<th>No. de inventario</th>
								<th>Descripcion</th>
								<th>Adquisicion</th>
								<th></th>
								<th></th>

							</tr>
						</thead>

						<tbody>
							<?php while($rowMon = $resultadoMon->fetch_array(MYSQLI_ASSOC)) { ?>
							<tr>

								<td>
									<?php echo $rowMon['Serie']; ?>
								</td>
								<td>
									<?php echo $rowMon['Marca']; ?>
								</td>
								<td>
									<?php echo $rowMon['Modelo']; ?>
								</td>
								<td>
									<?php echo $rowMon['Inventario']; ?>
								</td>
								<td>
									<?php echo $rowMon['Descripcion']; ?>
								</td>
								<td>
									<?php echo $rowMon['Adquisicion']; ?>
								</td>

							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>

				<hr color="blue" size=3>

				<h3>Mouse</h3>
				<div class="row table-responsive">
					<table class="table table-hover table-secondary">
						<thead>
							<tr>

								<th>Serie</th>
								<th>Marca</th>
								<th>Modelo</th>
								<th>No. de inventario</th>
								<th>Descripcion</th>
								<th>Adquisicion</th>


							</tr>
						</thead>

						<tbody>
							<?php while($rowMou = $resultadoTabla->fetch_array(MYSQLI_ASSOC)) { ?>
							<tr>

								<td>
									<?php echo $rowMou['Serie']; ?>
								</td>
								<td>
									<?php echo $rowMou['Marca']; ?>
								</td>
								<td>
									<?php echo $rowMou['Modelo']; ?>
								</td>
								<td>
									<?php echo $rowMou['Inventario']; ?>
								</td>
								<td>
									<?php echo $rowMou['Descripcion']; ?>
								</td>
								<td>
									<?php echo $rowMou['Adquisicion']; ?>
								</td>


							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>

				<hr color="blue" size=3>

				<h3>Teclado</h3>
				<div class="row table-responsive">
					<table class="table table-hover table-secondary">
						<thead>
							<tr>

								<th>Serie</th>
								<th>Marca</th>
								<th>Modelo</th>
								<th>No. de inventario</th>
								<th>Descripcion</th>
								<th>Adquisicion</th>


							</tr>
						</thead>

						<tbody>
							<?php while($rowTec = $resultadoTec->fetch_array(MYSQLI_ASSOC)) { ?>
							<tr>

								<td>
									<?php echo $rowTec['Serie']; ?>
								</td>
								<td>
									<?php echo $rowTec['Marca']; ?>
								</td>
								<td>
									<?php echo $rowTec['Modelo']; ?>
								</td>
								<td>
									<?php echo $rowTec['Inventario']; ?>
								</td>
								<td>
									<?php echo $rowTec['Descripcion']; ?>
								</td>
								<td>
									<?php echo $rowTec['Adquisicion']; ?>
								</td>


							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>

				<br>
				<br>

				<a href="personal.php" class="btn btn-primary">Regresar</a>
				<a href="ModificaInventario.php?Folio=<?php echo $row['Folio']; ?>" class="btn btn-seccundary">Modificar</a>
				<a href="Cedula.php?Folio=<?php echo $row['Folio']; ?>">
					Cedula
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