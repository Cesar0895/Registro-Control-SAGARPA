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

			$id_soft=$_GET['id_Software'];
			$nombre = $_GET['Nombre'];
			$version = $_GET['Version'];
			$licencia = $_GET['Licencia'];
			$key = $_GET['llave'];
			$plataforma = $_GET['Plataforma'];
			$fabricante = $_GET['Fabricante'];
			$adqui = $_GET['Adquisicion']; 
			$prodKey = $_GET['ProducKey'];            
        

            if ($nombre!=null) {
                $sql2= "update software set  Nombre='".$nombre."', Version='".$version."',Licencia='".$licencia."', Key_soft='".$key."', Plataforma='".$plataforma."',Fabricante='".$fabricante."', Adquisicion='".$adqui."',ProducKey='".$prodKey."'
                Where id_Software='".$id_soft."'";
                $mysqli->query($sql2);
    
				if ($id_soft=1) {
					echo'<script type="text/javascript">
			alert("Registro actualizado!");
			window.location.href="vistaSoft.php"	;
			</script>';
                
                }
			}
?>
<?php
	require 'conexion.php';

			
	
	        $id_soft = $_GET['id_Software'];        
            
			$sql = "SELECT * FROM software WHERE id_Software = '$id_soft'";
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

	<main role="main" class="container">
		<div class="card">
			<div class="card-header bg-info">
				<h3 style="text-align:center">ACTUALIZAR REGISTRO</h3>
			</div>
			<div class="card-body">
				<br>
				<div class="row">
					<h3 style="text-align:center">ACTUALIZAR REGISTRO</h3>
				</div>
				<form>
					<div class="form-group">
						<input type="hidden" class="form-control" id="id_soft" name="id_Software" placeholder="id" value="<?php echo $row['id_Software']; ?>"
						 required>
					</div>


					<div class="form-group row">
						<label class="col-sm-2 col-form-label ml-4">Nombre:</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="nombre" name="Nombre" placeholder="Nombre de software" value="<?php echo $row['Nombre']; ?>"
							 require>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label ml-4">Version:</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="version" name="Version" placeholder="Version" value="<?php echo $row['Version']; ?>"
							 require>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label ml-4">Licencia</label>
						<div class="col-sm-4">
							<select class="form-control" name="Licencia" id="Licencia">
								<option value="Corporativa" <?php if( $row[ 'Licencia']=='Corporativa' ) echo 'Selected'; ?>>Corporativa</option>
								<option value="OEM" <?php if( $row[ 'Licencia']=='OEM' ) echo 'Selected'; ?>>OEM</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label ml-4">Key</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="key" name="llave" placeholder="Key" value="<?php echo $row['Key_soft']; ?>"
							 require>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label ml-4">Plataforma</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="plataforma" name="Plataforma" placeholder="Plataforma (Ejemplo: Windows 8...)"
							 value="<?php echo $row['Plataforma']; ?>" require>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label ml-4">Fabricante</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="fabricante" name="Fabricante" placeholder="Nombre del fabricante" value="<?php echo $row['Fabricante']; ?>"
							 require>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label ml-4">Adquisición</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="adquisicion" name="Adquisicion" placeholder="datos de adquisición" value="<?php echo $row['Adquisicion']; ?>"
							 require>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label ml-4">Clave del software</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="ProducKey" name="ProducKey" value="<?php echo $row['ProducKey']; ?>">
						</div>
					</div>


					<div class="col-sm-offset-2 col-sm-10">
						<a href="index.php" class="btn btn-default">Regresar</a>
						<button type="submit" class="btn btn-primary">Actualizar</button>
					</div>


				</form>
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