<?php
	error_reporting(E_ALL & ~E_NOTICE);
	error_reporting(E_ERROR | E_PARSE);
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
	$id_Subarea = $_GET['IdSubarea'];

	$sql2 = "DELETE FROM subareas WHERE IdSubarea = '$id_Subarea'";
	$resultado = $mysqli->query($sql2);
	
	$where = "";

	if(!empty($_POST))
	{
		$valor = $_POST['campo'];
	
		if(!empty($valor)){
			$where = "WHERE Nombre LIKE '%$valor' or Sigla LIKE '%$valor'";
		}
	}

	$sqlmostrar = "SELECT subareas.IdSubarea, zona.Nombre,zona.Sigla,subareas.NombreSubarea FROM `subareas` INNER JOIN zona on subareas.Id_Zona=zona.id_Zona $where ORDER BY NombreSubarea ASC";
	$resultadoTabla = $mysqli->query($sqlmostrar);

	$sql = "SELECT * FROM zona ORDER BY Nombre ASC";
		$result = $mysqli->query($sql);
		if ($result->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
		{
			$combobitzona="";
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) 
			{
				$combobitzona .="<option>".$row['Nombre']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
			}
		}
		else
		{
			echo "No hubo resultados";
		}

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

						<a href="DetallePersona.php?RFC=<?php echo $row['RFC']; ?>">
						<span class="fas fa-user nav-link" href=""> Bienvenido (a): <?php echo $nombr; ?> </span>
						</a>
					</li>
					<li>
						<a href="cerrar_session.php">
							<span class="fas fa-sign-in-alt nav-link"></span> (Cerrar sesion)</a>

					</li>
				</ul>
			</div>
		</nav>

	</div>
	<br>
	<main role="main" class="container">
		<div class="card">
			<div class="card-header bg-info">
				<h3 style="text-align:center">SUBAREAS</h3>
				<h4 style="text-align:center">AREA: <?php echo $valor?> </h4>
				

			</div>
			<div class="card-body">



				<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
					<b>Filtrar por Area: </b>
					<select id="campo" name="campo">
						<option value="0">Elige una opción</option>
						<?php echo $combobitzona; ?>
					</select>
					<input type="submit" id="enviar" name="enviar" value="Buscar" class="btn btn-info" />
				</form>


				<a href="Areas.php" class="btn btn-primary float-right">Nuevo Registro</a>


				<br>

				<div class="row table-responsive">
					<table class="table table-hover table-secondary">
						<thead>
							<tr>

								<th>Subáreas</th>
								<th></th>
								<th></th>

							</tr>
						</thead>

						<tbody>
							<?php while($row = $resultadoTabla->fetch_array(MYSQLI_ASSOC)) { ?>
							<tr>

								<td>
									<?php echo $row['NombreSubarea']; ?>
								</td>
								<td>
									<a href="vistaSubareas.php" data-href="vistaSubareas.php?IdSubarea=<?php echo $row['IdSubarea']; ?>"
									 data-toggle="modal" data-target="#confirm-delete">
										<span class="far fa-trash-alt"></span>
									</a>
								</td>
								<td>
									<a href="ModificaSubarea.php?IdSubarea=<?php echo $row['IdSubarea']; ?>">
										<span class="far fa-edit"></span>
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
					<h4 class="modal-title" id="myModalLabel">Eliminar Zona</h4>
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