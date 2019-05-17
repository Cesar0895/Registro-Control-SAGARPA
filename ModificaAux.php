<?php
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ERROR | E_PARSE);
require 'conexion.php';
		$idAux=$_GET['IdAux'];
		
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
		$obsevaciones = $_GET['Observaciones'];
		$direccion_ip = $_GET['Direccion_ip'];
		$mac_Eth = $_GET['Mac_Eth'];
		$mac_wifi = $_GET['Mac_wifi'];
		$estatus = $_GET['Estatus'];
		$documento = $_GET['Documento'];
		$RFC = $_GET['RFC'];
		$valor = $_GET['Valor'];

		
			

if ($idAux!=null && $id_Zona!=null) {
	
	//Consulta para actualizar los registros
    $sql2= "UPDATE auxiliares SET Id_zona='$id_Zona',Presupuesto='$presupuesto', Id_dispositivo='$id_Dispositivo',Inventario='$invetario',id_Marca='$id_Marca',id_modelo='$id_Modelo',serie='$serie',Adquisicion='$adquisicion',Fecha_adquisicion='$fecha_Adquisicion',Fin_Garantia='$fin_Garantia',DT='$DT', Observaciones='$obsevaciones',Direccion_ip='$direccion_ip',Mac_Eth='$mac_Eth',Mac_wifi='$mac_wifi',estatus='$estatus',Documento='$documento',RFC='$RFC',Valor='$valor' Where IdAux='$idAux'";
	$mysqli->query($sql2);
	
	//`Id_zona`=[value-2],`Presupuesto`=[value-3],`Id_dispositivo`=[value-4],`Inventario`=[value-5],`id_Marca`=[value-6],`id_modelo`=[value-7],`serie`=[value-8],`Adquisicion`=[value-9],`Fecha_adquisicion`=[value-10],`Fin_Garantia`=[value-11],`DT`=[value-12],`Observaciones`=[value-13],`Direccion_ip`=[value-14],`Mac_Eth`=[value-15],`Mac_wifi`=[value-16],`estatus`=[value-17],`Documento`=[value-18],`RFC`=[value-19],`Valor`=[value-20],`Folio`=[value-21]
    
    if ($idAux=1) {
		echo'<script type="text/javascript">
			alert("Registro Actualizado");
			window.location.href="Auxiliares.php"	;
			</script>';
		
	}
}

$idAux=$_GET['IdAux'];       
            
$sqlaux = "SELECT `IdAux`, auxiliares.Id_zona, zona.Nombre, `Presupuesto`, auxiliares.Id_dispositivo, concat(dispositivos.Nomb_Dispositivo,' | ', dispositivos.Tipo) as disp, `Inventario`, auxiliares.id_Marca, marca.Marca, modelo.id_Modelo, modelo.Modelo, `serie`, `Adquisicion`, `Fecha_adquisicion`, `Fin_Garantia`, `DT`, `Observaciones`, `Direccion_ip`, `Mac_Eth`, `Mac_wifi`, `estatus`, `Documento`, `RFC`, `Valor`, `Asignado` FROM `auxiliares` INNER JOIN zona on auxiliares.Id_zona=zona.id_Zona INNER JOIN dispositivos on auxiliares.Id_dispositivo=dispositivos.Id_Dispositivo INNER JOIN marca on auxiliares.id_Marca=marca.id_Marca INNER JOIN modelo on auxiliares.id_modelo=modelo.id_Modelo WHERE IdAux = '$idAux'";
$resultado = $mysqli->query($sqlaux);
$row = $resultado->fetch_array(MYSQLI_ASSOC);

$sql = "SELECT * FROM zona ORDER BY Nombre ASC";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
	$combobitzona="";
	while ($row2 = $result->fetch_array(MYSQLI_ASSOC)) 
	{
		$combobitzona .="<option value='".$row2['id_Zona']."'>".$row2['Nombre']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
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
	while ($row2 = $result->fetch_array(MYSQLI_ASSOC)) 
	{
		$combobitdisp .="<option value='".$row2['Id_Dispositivo']."'>".$row2['NombTipo']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
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
	while ($row2 = $result->fetch_array(MYSQLI_ASSOC)) 
	{
		$combobit .="<option value='".$row2['id_Modelo']."'>".$row2['Modelo']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
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
	while ($row2 = $resultmarca->fetch_array(MYSQLI_ASSOC)) 
	{
		$combobitmarca .="<option value='".$row2['id_Marca']."'>".$row2['Marca']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
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
	while ($row2 = $resultrfc->fetch_array(MYSQLI_ASSOC)) 
	{
		$combobitrfc .="<option value='".$row2['RFC']."'>".$row2['RFC']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
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

	<main role="main" class="container">
		<br>
		<div class="card">
			<div class="card-header bg-info">
				<div class="row">
					<h3 style="text-align:center">ACTUALIZAR REGISTRO</h3>
				</div>
			</div>
			<div class="card-body">
				<form>

					<div class="form-group">

						<div class="col-sm-10">
							<input type="hidden" class="form-control" id="idAux" name="IdAux" value="<?php echo $row['IdAux']; ?>">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Folio</label>
						<div class="col-sm-10">
							<input type="number" class="form-control" placeholder="Folio" value="<?php echo $row['IdAux']; ?>"
							 disabled>
						</div>
					</div>

					<div class="form-group">
						<label>Zona</label>
						<select class="form-control col-sm-10" id="id_zona" name="Id_zona">
							<option value="<?php echo $row['Id_zona']; ?>">
								<?php echo $row['Nombre']; ?>
							</option>
							<?php echo $combobitzona; ?>
						</select>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Presupuesto</label>
						<div class="col-sm-4">
							<input type="number" class="form-control" id="presupuesto" name="Presupuesto" placeholder="Presupuesto ($)" value="<?php echo $row['Presupuesto']; ?>"
							 required>
						</div>
					</div>

					<div class="form-group ">
						<label>Dispositivo</label>
						<select class="form-control col-sm-10" id="id_Dispositivo" name="Id_dispositivo">
							<option value="<?php echo $row['Id_dispositivo']; ?>">
								<?php echo $row['disp']; ?>
							</option>
							<?php echo $combobitdisp; ?>
						</select>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Inventario</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="inventario" name="Inventario" placeholder="Inventario" value="<?php echo $row['Inventario']; ?>"
							 required>
						</div>
					</div>

					<div class="form-group">
						<label>Marca</label>
						<select class="form-control col-sm-10" id="id_Marca" name="id_Marca">
							<option value="<?php echo $row['id_Marca']; ?>">
								<?php echo $row['Marca']; ?>
							</option>
							<?php echo $combobitmarca; ?>
						</select>
					</div>

					<div class="form-group">
						<label>Modelo</label>
						<select class="form-control col-sm-10" id="id_modelo" name="id_modelo">
							<option value=<?php echo $row['id_Modelo']; ?>>
								<?php echo $row['Modelo']; ?>
							</option>
							<?php echo $combobit; ?>
						</select>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Serie</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="serie" name="serie" placeholder="Serie" value="<?php echo $row['serie']; ?>"
							 required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Tipo de adquisición</label>
						<select class="form-control col-sm-10" id="adquisicion" name="Adquisicion">
							<option value="Compra" <?php if( $row[ 'Adquisicion']=='Compra' ) echo 'Selected'; ?>>Compra</option>
							<option value="Transferencia" <?php if( $row[ 'Adquisicion']=='Transferencia' ) echo 'Selected';
							 ?>>Transferencia</option>
							<option value="Comodato" <?php if( $row[ 'Adquisicion']=='Comodato' ) echo 'Selected'; ?>>Comodato</option>
							<option value="Arrendamiento" <?php if( $row[ 'Adquisicion']=='Arrendamiento' ) echo 'Selected';
							 ?>>Arrendamiento</option>
							<option value="Prestamo" <?php if( $row[ 'Adquisicion']=='Compra' ) echo 'Prestamo'; ?>>Prestamo</option>
							<option value="Otro" <?php if( $row[ 'Adquisicion']=='Otro' ) echo 'Selected'; ?>>Otro</option>
						</select>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Fecha de adquisicion</label>
						<div class="col-sm-10">
							<input type="date" class="form-control" id="Fecha_adquisicion" name="Fecha_adquisicion" value="<?php echo $row['Fecha_adquisicion']; ?>"
							 placeholder="Fecha de Adquisicion">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Fecha de la garantia</label>
						<div class="col-sm-10">
							<input type="date" class="form-control" id="Fin_Garantia" name="Fin_Garantia" value="<?php echo $row['Fin_Garantia']; ?>"
							 placeholder="Fin de la garantia">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Dictamen</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="DT" name="DT" value="<?php echo $row['DT']; ?>"
							 placeholder="DT">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Obsevaciones</label>
						<div class="col-sm-10">
							<textarea class="form-control" rows=5 id="Obsrvaciones" name="Observaciones" placeholder="Observaciones"><?php echo $row['Observaciones']; ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Direccion IP</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="Direccion_ip" name="Direccion_ip" value="<?php echo $row['Direccion_ip']; ?>"
							 placeholder="Direccion IP">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Mac Ethernet</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="Mac_Eth" name="Mac_Eth" value="<?php echo $row['Mac_Eth']; ?>"
							 placeholder="Mac Ethernet">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Mac Wifi</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="Mac_wifi" name="Mac_wifi" value="<?php echo $row['Mac_wifi']; ?>"
							 placeholder="Mac wifi">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Estatus</label>
						<select class="form-control col-sm-10" id="estatus" name="Estatus">
							<option value="Bueno" <?php if( $row[ 'estatus']=='Bueno' ) echo 'Selected'; ?>>Bueno</option>
							<option value="Regular" <?php if( $row[ 'estatus']=='Regular' ) echo 'Selected'; ?>>Regular</option>
							<option value="Malo" <?php if( $row[ 'estatus']=='Malo' ) echo 'Selected'; ?>>Malo</option>
							<option value="Otro" <?php if( $row[ 'estatus']=='Otro' ) echo 'Selected'; ?>>Otro</option>
						</select>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Documento</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="Documento" name="Documento" value="<?php echo $row['Documento']; ?>"
							 placeholder="Documento">
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
							<input type="number" class="form-control" id="Valor" name="Valor" placeholder="Valor ($)" value="<?php echo $row['Valor']; ?>"
							 required>
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