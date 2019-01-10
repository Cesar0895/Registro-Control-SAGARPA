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

		<nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light">
			<a href="inicio.php" class="logo">
				<img src="./img/logoSagarpa.png" width="180" height="80" class="d-inline-block align-top" alt="">
			</a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse"
			 aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarCollapse">
				<ul class="nav nav-tabs">

					<li class="nav-item">
						<a class="nav-link" href="inicio.php">Inicio</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Registro</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="registroEquipoComputo.html ">Equipo de computo</a>
							<a class="dropdown-item" href="registroAuxiliares.html">Auxiliares</a>
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
							<a class="dropdown-item" href="marcas.php ">Marcas</a>
							<a class="dropdown-item" href="modelos.php">Modelos</a>
							<a class="dropdown-item" href="#">Disco duro</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Separated link</a>
						</div>
					</li>
				</ul>
			</div>
		</nav>

	</div>
	<br>
	<br>
	<br>
	<br>
	<br>

	<div class="container">
		<div class="card">
			<form>
				<div class="form-group">
				<h5 class="card-title">Dispositivos</h5>
					<input type="text" class="form-control" id="dispositivo" name="Dispositivo" placeholder="Nombre de dispositivo" require>
					<input type="text" class="form-control" id="tipo" name="Tipo" placeholder="Tipo" require>

				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<a href="inicio.php" class="btn btn-default">Regresar</a>
						<button type="submit" class="btn btn-primary">Guardar</button>
					</div>
				</div>
			</form>
			<a href="vistaDispositivos.php" class="btn btn-success">Ver lista de dispositivos registrados</a>

		</div>

		<?php
        error_reporting(E_ALL & ~E_NOTICE);
        error_reporting(E_ERROR | E_PARSE);
        require 'conexion.php';

		$disp = $_GET['Dispositivo'];
		$tipo = $_GET['Tipo'];
        if ($disp!=null && $tipo!=null) {
            $sqldisp= "INSERT INTO dispositivos (Nomb_Dispositivo, Tipo) VALUES ('$disp','$tipo')";
            $mysqli->query($sqldisp);

            if ($disp=1 && $tipo=1) {
                header("location:vistaDispositivos.php");
            }
        }
        

        ?>




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