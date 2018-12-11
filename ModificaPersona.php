<?php
	require 'conexion.php';
			$RFC = $_GET['RFC'];
			$nombre = isset($_GET['Nombre']) ? $_GET['Nombre'] : null ;
            $apePaterno = isset($_GET['ApePaterno']) ? $_GET['ApePaterno'] : null ;
            $apeMaterno = isset($_GET['ApeMaterno']) ? $_GET['ApeMaterno'] : null ;
            $adscripcion = isset($_GET['Adscripcion']) ? $_GET['Adscripcion'] : null ;
            $area = isset($_GET['Area']) ? $_GET['Area'] : null ;
            $subarea = isset($_GET['Subarea']) ? $_GET['Subarea'] : null ;
            $puesto = isset($_GET['Puesto']) ? $_GET['Puesto'] : null ;
            $denominacion = isset($_GET['Denominacion']) ? $_GET['Denominacion'] : null ;
            $telefono = isset($_GET['telefono']) ? $_GET['telefono'] : null ;
            $extencion = isset($_GET['extension']) ? $_GET['extension'] : null ;
            $domicilio = isset($_GET['domicilio']) ? $_GET['domicilio'] : null ;
            $correo = isset($_GET['correo']) ? $_GET['correo'] : null ;
            $GFC = isset($_GET['GFC']) ? $_GET['GFC'] : null ;
            $accesoCorreo = isset($_GET['accesoCorreo']) ? $_GET['accesoCorreo'] : null ;
            $estatus = isset($_GET['estatus']) ? $_GET['estatus'] : null ;

	
            
        

            if ($nombre!=null) {
                $sql2= "update persona set  Nombre='".$nombre."', ApePaterno='".$apePaterno."',ApeMaterno='".$apeMaterno."', Adscripcion='".$adscripcion."', Area='$area',Subarea='$subarea', Puesto='$puesto', Denominacion='$denominacion', Telefono='$telefono', Extension='$extencion', Domicilio='$domicilio', Correo='$correo', GFC='$GFC', Acceso_correo='$accesoCorreo', Estatus='$estatus'
                Where RFC='".$RFC."'";
                $mysqli->query($sql2);
    
                if ($RFC=1) {
                    header("location:personal.php");
                }
			}
?>
<?php
	require 'conexion.php';

			
	
	        $RFC = $_GET['RFC'];        
            
			$sql = "SELECT * FROM persona WHERE RFC = '$RFC'";
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
					<li class="nav-item">
						<a class="nav-link " href="complementos.php">Registros complementos</a>
					</li>
				</ul>
			</div>
		</nav>

	</div>

	<main role="main" class="container">
		<br>
		<br>
		<br>
		<br>
		<div class="row">
			<h3 style="text-align:center">ACTUALIZAR REGISTRO</h3>
		</div>
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
				<label for="adscripcion" class="col-sm-2 controllabel">Adscripción</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="adscripcion" name="Adscripcion" placeholder="Adscripción" value="<?php echo $row['Adscripcion']; ?>"
					 required>
				</div>
			</div>

			<div class="form-group">
				<label for="area" class="col-sm-2 controllabel">Area</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="area" name="Area" placeholder="Area" value="<?php echo $row['Area']; ?>"
					 required>
				</div>
			</div>

			<div class="form-group">
				<label for="subarea" class="col-sm-2 controllabel">Subarea</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="subarea" name="Subarea" placeholder="Subarea" value="<?php echo $row['Subarea']; ?>"
					 required>
				</div>
			</div>

			<div class="form-group">
				<label for="puestp" class="col-sm-2 controllabel">Puesto</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="puesto" name="Puesto" placeholder="Puesto" value="<?php echo $row['Puesto']; ?>"
					 required>
				</div>
			</div>

			<div class="form-group">
				<label for="denominacion" class="col-sm-2 controllabel">Denominación</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="denominacion" name="Denominacion" placeholder="Denominación" value="<?php echo $row['Denominacion']; ?>"
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
					<input type="tel" class="form-control" id="esxtencion" name="extencion" placeholder="Extencion" value="<?php echo $row['Extension']; ?>">
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