<?php
session_start();
	
	$varsesion=$_SESSION['user'];
	//$contrasesion=$_SESSION['pass'];
	
    require '../conexion.php';
    $consulta="SELECT `RFC`, concat(`Nombre`,' ', `ApePaterno`,' ', `ApeMaterno`) as nombComple,  `Area`, `Subarea`, `Puesto`, `Telefono`, `Extension`, `Domicilio`, `Correo`, `GFC`, `Acceso_correo`, `Estatus`, `Usuario`, `Contra` FROM `persona` WHERE Usuario='$varsesion'";
    //'or '1'='1
    $resultado = $mysqli->query($consulta);
    $row = $resultado->fetch_array(MYSQLI_ASSOC);

		
        $nombr=$row['nombComple'];
        $rfc=$row['RFC'];
	
		if ($varsesion==null || $varsesion='' ) {
			header('location:index.php');
			die();
        }
        
        $sql = "SELECT `Folio`, zona.Nombre, concat(per.Nombre,' ',per.ApePaterno,' ',per.ApeMaterno) as nombResp, Filtrado,`Identificacion`, concat(p.Nombre,' ',p.ApePaterno,' ',p.ApeMaterno) as nombUser,p.RFC,`Nodo`, `Fecha_Adquisicion`, `DT_adquisicion`, `DTB`, `Tipo_HW`, `Folio_Resduardo`, `Observaciones`, `Fin_Garantia`, `Candado`, `Valor`,equipos.Estatus, `Ubicacion`, `Fecha_Llenado`, `Oficio_Mexico`, `Contra_Admin`, `Id_CPU`, `id_Monitor`, `Id_mouse`, `Id_Teclado` FROM `equipos`INNER JOIN zona on equipos.Id_Zona=zona.id_Zona INNER JOIN persona per on equipos.RFC=per.RFC INNER JOIN persona p on equipos.RFC_Usuario=p.RFC where per.RFC='$rfc'
        ";
	$resultadoTabla = $mysqli->query($sql);
		
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

	<link rel="stylesheet" href="../css/estilo.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
	 crossorigin="anonymous">

	<title>Control de dispositivos</title>

</head>

<body>
	<div class="allNavbar">

		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a href="inicioRes.php" class="logo">
				<img src="../img/logoSader.jpg" width="180" height="80" class="d-inline-block align-top" alt="">
			</a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse"
			 aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarCollapse">
				<ul class="navbar-nav mr-auto mt-2 mt-lg-0">

					<li class="nav-item">
						<a class="nav-link mask flex-center rgba-red-strong" href="inicioRes.php">Inicio</a>
					</li>
					<li class="nav-item">
						<a class="nav-link mask flex-center rgba-red-strong" href="#">Equipo a cargo</a>
					</li>


				</ul>
				<ul class="nav navbar-nav">
					<li>

						<span class="fas fa-user nav-link"> Bienvenido (a):
							<?php echo $nombr; ?>
						</span>
					</li>
					<li>
						<a href="../cerrar_session.php">
							<span class="fas fa-sign-in-alt nav-link"></span> (Cerrar sesion)</a>
					</li>
				</ul>
			</div>
		</nav>

	</div>


	<main role="main" class="container principal">
		<br>
		<br>
		<div class="card">
			<div class="card-header bg-info">
				<div class="row ml-3">
					<h2 style="text-align:center">Equipos a cargo</h2>
				</div>
			</div>

			<div class="card-body">

				
				<br>

				<div class="row table-responsive mx-auto">
					<table class="table table-hover table-secondary">
						<thead>
							<tr>
								<th>Folio</th>
								<th>Zona</th>
								<th>Responsable</th>
								<th>Usuario</th>
								<th>Observaciones</th>
								<th>Ubicación</th>
								<th>Fin de Garantia</th>
                                <th>Estatus</th>
								<th></th>
								
							</tr>
						</thead>

						<tbody>
							<?php while($row = $resultadoTabla->fetch_array(MYSQLI_ASSOC)) { ?>
							<tr>
								<td>
									<?php echo $row['Folio']; ?>
								</td>
								<td>
									<?php echo $row['Nombre']; ?>
								</td>
								<td>
									<?php echo $row['nombResp']; ?>
								</td>
								<td>
									<?php echo $row['nombUser']; ?>
								</td>
								<td>
									<?php echo $row['Observaciones']; ?>
								</td>
								<td>
									<?php echo $row['Ubicacion']; ?>
								</td>
                                <td>
									<?php echo $row['Fin_Garantia']; ?>
								</td>
                                <td>
                                    <?php echo $row['Estatus']; ?>
                                </td>

								<td>
									<a href="DetallePersona.php?RFC=<?php echo $row['RFC']; ?>">
										<span class="fas fa-eye"></span>
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
</body>

</html>