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
$RFC = $_GET['RFC'];
$nombre = isset($_GET['Nombre']) ? $_GET['Nombre'] : null ;
$apePaterno = isset($_GET['ApePaterno']) ? $_GET['ApePaterno'] : null ;
$apeMaterno = isset($_GET['ApeMaterno']) ? $_GET['ApeMaterno'] : null ;
$area = isset($_GET['Area']) ? $_GET['Area'] : null ;
$subarea = isset($_GET['Subarea']) ? $_GET['Subarea'] : null ;
$puesto = isset($_GET['Puesto']) ? $_GET['Puesto'] : null ;
$telefono = isset($_GET['telefono']) ? $_GET['telefono'] : null ;
$extension = isset($_GET['extension']) ? $_GET['extension'] : null ;
$domicilio = isset($_GET['domicilio']) ? $_GET['domicilio'] : null ;
$correo = isset($_GET['correo']) ? $_GET['correo'] : null ;
$GFC = isset($_GET['GFC']) ? $_GET['GFC'] : null ;
$accesoCorreo = isset($_GET['accesoCorreo']) ? $_GET['accesoCorreo'] : null ;
$estatus = isset($_GET['estatus']) ? $_GET['estatus'] : null ;
$Puesto_nivel = isset($_GET['puesto_nivel']) ? $_GET['puesto_nivel'] : null ;
$CURP = isset($_GET['CURP']) ? $_GET['CURP'] : null ;
$Dminio = isset($_GET['Dominio']) ? $_GET['Dominio'] : null ;

if ($nombre!=null) {
    $sql2= "update persona set  Nombre='".$nombre."', ApePaterno='".$apePaterno."',ApeMaterno='".$apeMaterno."',  Area='$area',Subarea='$subarea', Puesto='$puesto', Telefono='$telefono', Extension='$extension', Domicilio='$domicilio', Correo='$correo', GFC='$GFC', Acceso_correo='$accesoCorreo', Estatus='$estatus', `Puesto_nivel`='$Puesto_nivel',`CURP`='$CURP', Dominio='$Dminio'
    Where RFC='".$RFC."'";
    $mysqli->query($sql2);
    
    if ($RFC=1) {
		echo'<script type="text/javascript">
			alert("Registro actualizado!");
			window.location.href="personal.php"	;
			</script>';
     
    }
}
?>
<?php
	require 'conexion.php';

			
	
	        $RFC = $_GET['RFC'];        
            
			$sql = "SELECT `RFC`, persona.`Nombre`, `ApePaterno`, `ApeMaterno`,  zona.id_Zona , zona.Nombre as nomArea, `Subarea`, `Puesto`, `Telefono`, `Extension`, `Domicilio`, `Correo`, `GFC`, `Acceso_correo`, `Estatus`, `Usuario`, `Contra`, Puesto_nivel, CURP, Dominio  FROM `persona`
			INNER JOIN zona on zona.id_Zona=persona.Area WHERE RFC = '$RFC'";
            $resultado = $mysqli->query($sql);
			$row = $resultado->fetch_array(MYSQLI_ASSOC);
			

			$query="SELECT id_Zona, Nombre, Sigla FROM ZONA ORDER BY `zona`.`Nombre` ASC";
			$result=$mysqli->query($query);

			
		
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

	<script language="javascript" src="js/jquery-3.4.0.min.js"></script>
	<script language="javascript">
		$(document).ready(function() {
			$("#Area").change(function() {

				$("#Area option:selected").each(function() {
					id_area = $(this).val();
					$.post("includes/getSubareas.php", {
						id_area: id_area
					}, function(data) {
						$("#Subarea").html(data);
					});
				});
			})
		});
	</script>

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
		<br>
		<div class="card">
			<div class="card-header bg-info">
				<h3 style="text-align:center">ACTUALIZAR REGISTRO</h3>
			</div>
			<div class="card-body">
				<form>
					<div class="form-group">
						<input type="hidden" class="form-control" id="RFC" name="RFC" placeholder="RFC" value="<?php echo $row['RFC']; ?>"
						 required>
					</div>


					<div class="form-group">
						<label for="nombre" class="col-sm-2 controllabel">Nombre</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="nombre" name="Nombre" placeholder="Nombre" value="<?php echo $row['Nombre']; ?>"
							 required>
						</div>
					</div>

					<div class="form-group">
						<label for="apePaterno" class="col-sm-2 controllabel">Apellido Paterno</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="apePaterno" name="ApePaterno" placeholder="Apellido Paterno" value="<?php echo $row['ApePaterno']; ?>"
							 required>
						</div>
					</div>

					<div class="form-group">
						<label for="apeMaterno" class="col-sm-2 controllabel">Apellido Materno</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="apeMaterno" name="ApeMaterno" placeholder="Apellido Materno" value="<?php echo $row['ApeMaterno']; ?>"
							 required>
						</div>
					</div>
					<div class="form-group">
						<label for="apeMaterno" class="col-sm-2 controllabel">CURP</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="CURP" name="CURP" placeholder="CURP" value="<?php echo $row['CURP']; ?>"
							 required>
						</div>
					</div>


					<div class="form-group">
						<label for="area" class="col-sm-2 controllabel">Area</label>
						<select class="form-control col-sm-10" id="Area" name="Area">
							<option value="<?php echo $row['id_Zona']; ?>">
								<?php echo $row['nomArea']; ?>
							</option>
							<?php while($rowA=$result->fetch_assoc()){ ?>
							<option value="<?php echo $rowA['id_Zona']; ?>">
								<?php echo $rowA['Nombre']; ?>
							</option>
							<?php } ?>
						</select>
					</div>


					<div class="form-group">
						<label for="subarea" class="col-sm-2 controllabel">Subarea</label>
						<select class="form-control col-sm-10" id="Subarea" name="Subarea">
							<option >
								<?php echo $row['Subarea']; ?>
							</option>
						</select>
					</div>


					<div class="form-group">
						<label for="puestp" class="col-sm-2 controllabel">Puesto</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="puesto" name="Puesto" placeholder="Puesto" value="<?php echo $row['Puesto']; ?>"
							 required>
						</div>
					</div>
					<div class="form-group">
						<label for="puestp" class="col-sm-2 controllabel">Puesto_Nivel</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="puesto_nivel" name="puesto_nivel" placeholder="Puesto" value="<?php echo $row['Puesto_nivel']; ?>"
							 required>
						</div>
					</div>

					<div class="form-group">
						<label for="telefono" class="col-sm-2 controllabel">Telefono</label>
						<div class="col-sm-10">
							<input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Telefono" value="<?php echo $row['Telefono']; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="extencion" class="col-sm-2 controllabel">Extención</label>
						<div class="col-sm-10">
							<input type="tel" class="form-control" id="extencion" name="extension" placeholder="Extencion" value="<?php echo $row['Extension']; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="Domicilo" class="col-sm-2 controllabel">Domicilio</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="domicilio" name="domicilio" placeholder="Domicilio" value="<?php echo $row['Domicilio']; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="correo" class="col-sm-2 controllabel">Correo</label>
						<div class="col-sm-10">
							<input type="email" class="form-control" id="correo" name="correo" placeholder="Correo" value="<?php echo $row['Correo']; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="correo" class="col-sm-2 controllabel">Dominio</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="Dominio" name="Dominio" value="<?php echo $row['Dominio']; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="GFC" class="col-sm-2 controllabel">GFC</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="GFC" name="GFC" placeholder="GFC" value="<?php echo $row['GFC']; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="accesoCorreo" class="col-sm-2 controllabel">Acceso del correo</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="accesoCorreo" name="accesoCorreo" placeholder="Acceso del correo" value="<?php echo $row['Acceso_correo']; ?>">
						</div>
					</div>

					<div class="form-group">
						<label for="estatus" class="col-sm-2 controllabel">Status</label>
						<div class="col-sm-10">
							<select class="form-control" id="estatus" name="estatus">
								<option value="ACTIVO" <?php if( $row[ 'Estatus']=='ACTIVO' ) echo 'Selected'; ?>>ACTIVO</option>
								<option value="BAJA" <?php if( $row[ 'Estatus']=='BAJA' ) echo 'Selected'; ?>>BAJA</option>
								<option value="OTRO" <?php if( $row[ 'Estatus']=='OTRO' ) echo 'Selected'; ?>>OTRO</option>
							</select>
						</div>
					</div>


					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<a href="index.php" class="btn btndefault">Regresar</a>
							<button type="submit" class="btn btnprimary">Actualizar</button>
						</div>
					</div>

				</form>
			</div>
		</div>


	</main>
	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
	 crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
	 crossorigin="anonymous"></script>
</body>

</html>