<?php
        error_reporting(E_ALL & ~E_NOTICE);
        error_reporting(E_ERROR | E_PARSE);
        require 'conexion.php';

		$nombre = $_GET['Nombre'];
		$version = $_GET['Version'];
		$licencia = $_GET['Licencia'];
		$key = $_GET['llave'];
		$plataforma = $_GET['Plataforma'];
		$fabricante = $_GET['Fabricante'];
		$adqui = $_GET['Adquisicion'];

        if ($nombre!=null) {
            $sqlsoft= "INSERT INTO software (Nombre, Version, Licencia, Key_soft, Plataforma, Fabricante, Adquisicion) VALUES ('$nombre','$version','$licencia', '$key', '$plataforma', '$fabricante', '$adqui')";
            $mysqli->query($sqlsoft);

            if ($nombre=1) {
				echo'<script type="text/javascript">
			alert("Registro guardado!");
			window.location.href="vistaSoft.php"	;
			</script>';
               
            }
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

	<div class="container">
		<div class="card">
			<form>
				<h4 class="card-title">Software</h4>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label ml-4">Nombre:</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="nombre" name="Nombre" placeholder="Nombre de software" require>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label ml-4">Version:</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="version" name="Version" placeholder="Version" require>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label ml-4">Licencia</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="licencia" name="Licencia" placeholder="Licencia" require>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label ml-4">Key</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="key" name="llave" placeholder="Key" require>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label ml-4">Plataforma</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="plataforma" name="Plataforma" placeholder="Plataforma (Ejemplo: Windows 8...)"
						 require>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label ml-4">Fabricante</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="fabricante" name="Fabricante" placeholder="Nombre del fabricante" require>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label ml-4">Adquisición</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="adquisicion" name="Adquisicion" placeholder="datos de adquisición" require>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<a href="inicio.php" class="btn btn-default">Regresar</a>
						<button type="submit" class="btn btn-primary">Guardar</button>
					</div>
				</div>

			</form>
			<a href="vistaSoft.php" class="btn btn-success">Ver lista de software registrados</a>

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