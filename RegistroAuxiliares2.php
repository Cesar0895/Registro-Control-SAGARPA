<?php
		error_reporting(E_ALL & ~E_NOTICE);
		error_reporting(E_ERROR | E_PARSE);
        include 'conexion.php';
        
	
		$id_Zona = $_GET['Id_zona'];
		$presupuesto = $_GET['Presupuesto'];
		$id_Dispositivo = $_GET['Id_dispositivo'];
		$invetario = $_GET['Inventario'];
		$id_Marca = $_GET['id_Marca'];
		$id_Modelo = $_GET['id_modelo'];
		$serie = $_GET['serie'];
		$adquisicion = $_GET['Adquisicion'];
		$fecha_Adquisicion = $_GET['Fecha_adquisicion'];
		$fin_Garantia = $_GET['Fin_Garantia'];
		$DT = $_GET['DT'];
		$observaciones = $_GET['Observaciones'];
		$direccion_ip = $_GET['Direccion_ip'];
		$mac_Eth = $_GET['Mac_Eth'];
		$mac_wifi = $_GET['Mac_wifi'];
		$estatus = $_GET['estatus'];
		$documento = $_GET['Documento'];
		$RFC = $_GET['RFC'];
		$valor = $_GET['Valor'];
		
            if ($id_Zona!=null) {
                $sql= "INSERT INTO auxiliares(Id_zona, Presupuesto, Id_dispositivo, Inventario, id_Marca, id_modelo, serie, Adquisicion, Fecha_adquisicion, Fin_Garantia, DT, Observaciones, Direccion_ip, Mac_Eth, Mac_wifi, estatus, Documento, RFC, Valor)
                VALUES ('".$id_Zona."','".$presupuesto."','".$id_Dispositivo."','".$invetario."','$id_Marca','$id_Modelo','$serie','$adquisicion','$fecha_Adquisicion','$fin_Garantia','$DT','$observaciones','$direccion_ip','$mac_Eth','$mac_wifi','$estatus','$documento','$RFC','$valor')";
				$resultado = $mysqli->query($sql);
				
			
    
                if ($folio=1) {
					echo'<script type="text/javascript">
						alert("Tarea Guardada");
						window.location.href="Auxiliares.php"	;
						</script>';
                    
                }
			}

			$sql = "SELECT * FROM zona ORDER BY Nombre ASC";
			$result = $mysqli->query($sql);
			if ($result->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
			{
				$combobitzona="";
				while ($row = $result->fetch_array(MYSQLI_ASSOC)) 
				{
					$combobitzona .="<option value='".$row['id_Zona']."'>".$row['Nombre']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
				}
			}
			else
			{
				echo "No hubo resultados";
			}

			$sql = "SELECT Id_Dispositivo, concat(Nomb_Dispositivo,' | ', Tipo) As NombTipo FROM dispositivos ORDER BY NombTipo ASC";
			$result = $mysqli->query($sql);
			if ($result->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
			{
				$combobitdisp="";
				while ($row = $result->fetch_array(MYSQLI_ASSOC)) 
				{
					$combobitdisp .="<option value='".$row['Id_Dispositivo']."'>".$row['NombTipo']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
				}
			}
			else
			{
				echo "No hubo resultados";
			}
			
			
			$sql = "SELECT * FROM modelo ORDER BY Modelo ASC";
			$result = $mysqli->query($sql);
			if ($result->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
			{
				$combobit="";
				while ($row = $result->fetch_array(MYSQLI_ASSOC)) 
				{
					$combobit .="<option value='".$row['id_Modelo']."'>".$row['Modelo']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
				}
			}
			else
			{
				echo "No hubo resultados";
			}
			
			$sql = "SELECT * FROM marca ORDER BY Marca ASC";
			$resultmarca = $mysqli->query($sql);
			if ($resultmarca->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
			{
				$combobitmarca="";
				while ($row = $resultmarca->fetch_array(MYSQLI_ASSOC)) 
				{
					$combobitmarca .="<option value='".$row['id_Marca']."'>".$row['Marca']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
				}
			}
			else
			{
				echo "No hubo resultados";
			}

			$sql = "SELECT * FROM persona ORDER BY RFC ASC";
			$resultrfc = $mysqli->query($sql);
			if ($resultrfc->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
			{
				$combobitrfc="";
				while ($row = $resultrfc->fetch_array(MYSQLI_ASSOC)) 
				{
					$combobitrfc .="<option value='".$row['RFC']."'>".$row['RFC']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
				}
			}
			else
			{
				echo "No hubo resultados";
			}

			$sql = "SELECT Folio FROM `equipos` ORDER BY `Folio` ASC";
			$resultFolio = $mysqli->query($sql);
			if ($resultFolio->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
			{
				$combobitFolio="";
				while ($row = $resultFolio->fetch_array(MYSQLI_ASSOC)) 
				{
					$combobitFolio .="<option value='".$row['Folio']."'>".$row['Folio']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
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

	<main role="main" class="container">
		<br>
		<div class="card">
			<div class="card-header bg-info">
				<div class="row">
					<h3 style="text-align:center">NUEVO REGISTRO</h3>
				</div>
			</div>
			<div class="card-body">
				<form class="form-horizontal">


					<div class="form-group">
						<label>Zona</label>
						<select class="form-control col-sm-10" id="id_zona" name="Id_zona">
							<?php echo $combobitzona; ?>
						</select>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Presupuesto</label>
						<div class="col-sm-4">
							<input type="number" class="form-control" id="presupuesto" name="Presupuesto" placeholder="Presupuesto ($)" required>
						</div>
					</div>

					<div class="form-group ">
						<label>Dispositivo</label>
						<select class="form-control col-sm-10" id="id_Dispositivo" name="Id_dispositivo">
							<?php echo $combobitdisp; ?>
						</select>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Inventario</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="inventario" name="Inventario" placeholder="Inventario" required>
						</div>
					</div>

					<div class="form-group">
						<label>Marca</label>
						<select class="form-control col-sm-10" id="id_Marca" name="id_Marca">
							<?php echo $combobitmarca; ?>
						</select>
					</div>

					<div class="form-group">
						<label>Modelo</label>
						<select class="form-control col-sm-10" id="id_modelo" name="id_modelo">
							<?php echo $combobit; ?>
						</select>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Serie</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="serie" name="serie" placeholder="Serie" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Tipo de adquisición</label>
						<select class="form-control col-sm-10" id="adquisicion" name="Adquisicion">
							<option value="Compra">Compra</option>
							<option value="Transferencia">Transferencia</option>
							<option value="Comodato">Comodato</option>
							<option value="Arrendamiento">Arrendamiento</option>
							<option value="Prestamo">Prestamo</option>
							<option value="Otro">Otro</option>
						</select>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Fecha de adquisicion</label>
						<div class="col-sm-10">
							<input type="date" class="form-control" id="Fecha_adquisicion" name="Fecha_adquisicion" placeholder="Fecha de Adquisicion">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Fecha de la garantia</label>
						<div class="col-sm-10">
							<input type="date" class="form-control" id="Fin_Garantia" name="Fin_Garantia" placeholder="Fin de la garantia">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">DT</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="DT" name="DT" placeholder="DT">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Obsevaciones</label>
						<div class="col-sm-10">
							<textarea class="form-control" rows=5 id="Obsrvaciones" name="Observaciones" placeholder="Observaciones"></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Direccion IP</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="Direccion_ip" name="Direccion_ip" placeholder="Direccion IP">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Mac Ethernet</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="Mac_Eth" name="Mac_Eth" placeholder="Mac Ethernet">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Mac Wifi</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="Mac_wifi" name="Mac_wifi" placeholder="Mac wifi">
						</div>
					</div>

					<div class="form-group">
						<label for="estatus" class="col-sm-2 controllabel">Status</label>
						<div class="col-sm-10">
							<select class="form-control" id="estatus" name="estatus">
								<option value="BUENO">BUENO</option>
								<option value="REG	ULAR">REGULAR</option>
								<option value="MALO">MALO</option>
								<option value="OTRO">OTRO</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Documento</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="Documento" name="Documento" placeholder="Documento">
						</div>
					</div>

					<div class="form-group">
						<label>RFC del Responsable</label>
						<select class="form-control col-sm-10" id="RFC" name="RFC">
							<?php echo $combobitrfc; ?>
						</select>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Valor</label>
						<div class="col-sm-4">
							<input type="number" class="form-control" id="Valor" name="Valor" placeholder="Valor ($)" required>
						</div>
					</div>


					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<a href="index.php" class="btn btndefault">Regresar</a>
							<button type="submit" class="btn btnprimary">Guardar</button>
						</div>
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