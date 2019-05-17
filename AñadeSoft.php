<?php
        error_reporting(E_ALL & ~E_NOTICE);
        error_reporting(E_ERROR | E_PARSE);
        require 'conexion.php';

		$whereSoft = "";
	
		if(!empty($_POST))
		{
			$valor2 = $_POST['campo'];
		
			if(!empty($valor2)){
				$whereSoft = "and (Licencia like '$valor2%' or Nombre like '$valor2%')";
			}
		}

		$sqlmostrarsoft = "SELECT * FROM `software` WHERE ((Licencia='OEM' and Asignado='No') or Licencia='Corporativa') $whereSoft";
		$resultadoTablasoft = $mysqli->query($sqlmostrarsoft);


		$sql = "SELECT * FROM `cpu` ORDER BY `Id_CPU` DESC";
		$resultpc = $mysqli->query($sql);
		if ($resultpc->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
		{
			$combobitpc="";
			while ($row = $resultpc->fetch_array(MYSQLI_ASSOC)) 
			{
				$combobitpc .="<option value='".$row['Id_CPU']."'>".$row['Serie']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
			}
		}
		else
		{
			echo "No hubo resultados";
		}
		
		/*
		$Serie=$_GET['Serie'];

		$sqlcpu = "SELECT CPU.Serie,software.Nombre
		FROM `cpu_soft`
		INNER JOIN CPU ON cpu_soft.Id_CPU = CPU.Id_CPU
		INNER JOIN software ON cpu_soft.id_Software = software.id_Software
		WHERE CPU.Serie = '$Serie'";
		$resultpc = $mysqli->query($sqlcpu);
		$row = $resultpc->fetch_array(MYSQLI_ASSOC);
			

		*/
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
	<br>

	<div class="container">
		<div class="card">
			<h4>Añadir Software</h4>
			<div class="row ml-3">

				<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
					<b>Buscador: </b>
					<input title="Escribe el folio del dispositivo" type="text" id="campo" name="campo" />
					<input type="submit" id="enviar" name="enviar" value="Buscar" class="btn btn-info" />
				</form>
			</div>
			<form action="Proceso_Soft.php" method="post">

				<div class="form-group">
					<label>Numero de serie del CPU</label>
					<select class="form-control col-sm-10" id="id_CPU" name="Id_cpu">
						<?php echo $combobitpc ?>
					</select>
				</div>

				<div class="row table-responsive mx-auto">
					<table class="table table-hover table-secondary">
						<thead>
							<tr>

								<th></th>

								<th>Nombre</th>
								<th>Version</th>
								<th>Licencia</th>
								<th>Key</th>
								<th>Plataforma</th>
								<th>Fabricante</th>
								<th>Adquisición</th>
								<th>ProducKey</th>



							</tr>
						</thead>

						<tbody>
							<?php while($row = $resultadoTablasoft->fetch_array(MYSQLI_ASSOC)) { ?>
							<tr>

								<td>
									<input type="checkbox" id="<?php echo $row['id_Software']; ?>" name="Id_sof[]"
									 value="<?php echo $row['id_Software']; ?>" />
								</td>

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

							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
				<button type="submit" class="btn btn-primary">Guardar</button>
			</form>



		</div>


	</div>
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