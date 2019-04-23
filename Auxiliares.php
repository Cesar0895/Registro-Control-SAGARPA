<?php
session_start();
	
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ERROR | E_PARSE);
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
		
		if ($puesto!='encargado' && $puesto!='jefe') {
			header('location:Resguardante/inicioRes.php');
			die();
		}
		

	$idAux = $_GET['IdAux'];
	
	$sql2 = "DELETE FROM auxiliares WHERE IdAux = '$idAux'";
	$resultado = $mysqli->query($sql2);
	
	$where = "";
	
	if(!empty($_POST))
	{
		$valor = $_POST['campo'];
	
		if(!empty($valor)){
			$where = "WHERE Folio LIKE '$valor%' or Nomb_Dispositivo like '$valor%'";
		}
	}
	$sql = "SELECT auxiliares.IdAux, auxiliares.Folio, zona.Nombre, auxiliares.Presupuesto, dispositivos.Nomb_Dispositivo, auxiliares.Inventario, marca.Marca, modelo.Modelo, auxiliares.serie, dispositivos.Tipo, auxiliares.Adquisicion, auxiliares.Fecha_adquisicion, auxiliares.Fin_Garantia, auxiliares.DT, auxiliares.Observaciones, auxiliares.Direccion_ip, auxiliares.Mac_Eth, auxiliares.Mac_wifi, auxiliares.estatus,auxiliares.Documento, auxiliares.RFC, auxiliares.Valor FROM auxiliares inner join modelo on auxiliares.id_Modelo=modelo.id_Modelo inner join marca on auxiliares.id_Marca=marca.id_Marca inner join dispositivos on auxiliares.Id_dispositivo=dispositivos.Id_Dispositivo inner join zona on auxiliares.Id_zona=zona.id_Zona $where";
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
				<div class="row ml-3">
					<h2 style="text-align:center">Auxiliares</h2>
				</div>
			</div>
			<div class="card-body">

				<div class="row ml-3">

					<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
						<b>Buscador: </b>
						<input title="Escribe el folio del dispositivo" type="text" id="campo" name="campo" />
						<input type="submit" id="enviar" name="enviar" value="Buscar" class="btn btn-info" />
					</form>
				</div>


				<br>

				<div class="row table-responsive mx-auto">
					<table class="table table-hover table-secondary">
						<thead>
							<tr>
								<th>Folio</th>
								<th>Zona</th>
								<th>Presupuesto</th>
								<th>Nombre del dispositivo</th>
								<th>No. de inventario</th>
								<th>Marca</th>
								<th>Modelo</th>
								<th>Serie</th>
								<th>Tipo de dispositivo</th>
								<th>Adquisicion</th>
								<th>Fecha de adquisicion</th>
								<th>Fin de garantia</th>
								<th>Dictamen</th>
								<th>Observaciones</th>
								<th>Direccion IP</th>
								<th>Mac Ethernet</th>
								<th>Mac Wifi</th>
								<th>Estatus</th>
								<th>Documento</th>
								<th>RFC</th>
								<th>Valor</th>

								<th></th>
								<th></th>
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
									$
									<?php echo $row['Presupuesto']; ?>.00
								</td>
								<td>
									<?php echo $row['Nomb_Dispositivo']; ?>
								</td>
								<td>
									<?php echo $row['Inventario']; ?>
								</td>
								<td>
									<?php echo $row['Marca']; ?>
								</td>
								<td>
									<?php echo $row['Modelo']; ?>
								</td>
								<td>
									<?php echo $row['serie']; ?>
								</td>
								<td>
									<?php echo $row['Tipo']; ?>
								</td>
								<td>
									<?php echo $row['Adquisicion']; ?>
								</td>
								<td>
									<?php echo $row['Fecha_adquisicion']; ?>
								</td>
								<td>
									<?php echo $row['Fin_Garantia']; ?>
								</td>
								<td>
									<?php echo $row['DT']; ?>
								</td>
								<td>
									<?php echo $row['Observaciones']; ?>
								</td>
								<td>
									<?php echo $row['Direccion_ip']; ?>
								</td>
								<td>
									<?php echo $row['Mac_Eth']; ?>
								</td>
								<td>
									<?php echo $row['Mac_wifi']; ?>
								</td>
								<td>
									<?php echo $row['estatus']; ?>
								</td>
								<td>
									<?php echo $row['Documento']; ?>
								</td>
								<td>
									<?php echo $row['RFC']; ?>
								</td>
								<td>
									$<?php echo $row['Valor']; ?>.00
								</td>

								<td>
									<a href="DetalleAux.php?IdAux=<?php echo $row['IdAux']; ?>">
										<span class="fas fa-eye"></span>
									</a>
								</td>

								<td>
									<a href="ModificaAux.php?IdAux=<?php echo $row['IdAux']; ?>">
										<span class="far fa-edit"></span>
									</a>
								</td>
								<td>
									<a href="Auxiliares.php" data-href="Auxiliares.php?IdAux=<?php echo $row['IdAux']; ?>"
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