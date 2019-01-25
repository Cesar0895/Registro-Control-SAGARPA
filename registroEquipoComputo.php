<?php
        error_reporting(E_ALL & ~E_NOTICE);
		error_reporting(E_ERROR | E_PARSE);
		require 'conexion.php';
		
		$serie = $_GET['Serie'];
		$id_Marca = $_GET['id_Marca'];
		$id_Modelo = $_GET['id_Modelo'];
		$inventario = $_GET['Inventario'];
		$descripcion = $_GET['Descripcion'];
		$adqui = $_GET['Adquisicion'];

		$serieTec = $_GET['SerieTec'];
		$id_MarcaTec = $_GET['id_MarcaTec'];
		$id_ModeloTec = $_GET['id_ModeloTec'];
		$inventarioTec = $_GET['InventarioTec'];
		$descripcionTec = $_GET['DescripcionTec'];
		$adquiTec = $_GET['AdquisicionTec'];

		$serieMou = $_GET['SerieMou'];
		$id_MarcaMou = $_GET['id_MarcaMou'];
		$id_ModeloMou = $_GET['id_ModeloMou'];
		$inventarioMou = $_GET['InventarioMou'];
		$descripcionMou = $_GET['DescripcionMou'];
		$adquiMou= $_GET['AdquisicionMou'];


        if ($serie!=null) {
            $sqlmonitor= "INSERT INTO monitor (Serie, id_Marca, id_Modelo, Inventario, Descripcion, Adquisicion) VALUES ('$serie','$id_Marca','$id_Modelo', '$inventario', '$descripcion', '$adqui')";
            $mysqli->query($sqlmonitor);

            if ($serie=1) {
                echo'<script type="text/javascript">
						alert("Registro guardado");
						window.location.href="registroEquipoComputo.php";
						</script>';
            }
		}
		if ($serieTec!=null) {
            $sqlteclado= "INSERT INTO teclado (Serie, Id_Marca, IdModelo, Inventario, Descripcion, Adquisicion) VALUES ('$serieTec','$id_MarcaTec','$id_ModeloTec', '$inventarioTec', '$descripcionTec', '$adquiTec')";
            $mysqli->query($sqlteclado);

            if ($serieTec=1) {
                echo'<script type="text/javascript">
						alert("Registro guardado");
						window.location.href="registroEquipoComputo.php";
						</script>';
            }
		}
		
		if ($serieMou!=null) {
            $sqlmouse= "INSERT INTO mouse (Serie, id_Marca, id_Modelo, Inventario, Descripcion, Adquisicion) VALUES ('$serieMou','$id_MarcaMou','$id_ModeloMou', '$inventarioMou', '$descripcionMou', '$adquiMou')";
            $mysqli->query($sqlmouse);

            if ($serieMou=1) {
                echo'<script type="text/javascript">
						alert("Registro guardado");
						window.location.href="registroEquipoComputo.php";
						</script>';
            }
        }
?>

<?php
require 'conexion.php';

$sql = "SELECT * FROM modelo";
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

$sql = "SELECT * FROM marca";
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

$where = "";

	if(!empty($_POST))
	{
		$valor = $_POST['campo'];
	
		if(!empty($valor)){
			$where = "WHERE RFC LIKE '$valor%'";
		}
	}

	$sqlpersona = "SELECT Nombre FROM persona $where";
	$resultadonombre = $mysqli->query($sqlpersona);
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

	<title>Registro de equipo de computo </title>


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
							<a class="dropdown-item" href="registroEquipoComputo.php ">Equipo de computo</a>
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


	<main role="main" class="container">
		<script type="text/javascript">
			function mostrar() {
				document.getElementById('oculto').style.display = 'block';
			}
		</script>


		<div class="row">
			<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
				<label>Nombre del responsable</label>
				<input type="text" class="form-control" id="campo" name="campo" autofocus />
				<button type="submit" id="enviar" name="enviar" class="btn btn-info" value="Mostrar" onClick="mostrar()"> Verificar </button>



				<div class="form-group" id="oculto" style='display:none;'>
					<?php while($row = $resultadonombre->fetch_array(MYSQLI_ASSOC)) { ?>
					<input type="text" class="form-control" id="nombre" name="Nombre" placeholder="nombre del responsable" value="<?php echo $row['Nombre']; ?>"
					 disabled>
					<?php } ?>
				</div>

			</form>
		</div>
		<div class="card">
			<div class="card-header">
				<h4>Registro de quipos de computo.</h4>
			</div>

			<div class="card-body">
				<div btn-group-vertical>
					<!-- Button trigger modal -->
					<a type="button" class="list-group-item list-group-item-action list-group-item-success" data-toggle="modal" data-target="#datosGenerales">
						Generales
					</a>


					<a type="button" class="list-group-item list-group-item-action list-group-item-success" data-toggle="modal" data-target="#datosCPU">
						Datos CPU
					</a>

					<a type="button" class="list-group-item list-group-item-action list-group-item-success" data-toggle="modal" data-target="#datosMonitor">
						Datos Monitor
					</a>

					<a type="button" class="list-group-item list-group-item-action list-group-item-success" data-toggle="modal" data-target="#datosTeclado">
						Datos Teclado
					</a>

					<a type="button" class="list-group-item list-group-item-action list-group-item-success" data-toggle="modal" data-target="#datosMouse">
						Datos Mouse
					</a>

					<a type="button" class="list-group-item list-group-item-action list-group-item-success" data-toggle="modal" data-target="#datosResponsable">
						Responsable
					</a>

					<!-- Modal Datos Generales -->
					<div class="modal fade" id="datosGenerales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Datos Generales</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form>
										<div class="form-group">
											<label>GPO</label>
											<input type="text" class="form-control" id="grupo" placeholder="Introduce el nombre del grupo">
										</div>

										<div class="form-group">
											<label for="selectZona">Zona</label>
											<select class="form-control" id="selectZona">
												<option>Delegación Estatal</option>
												<option>Subdelegación Administrativa</option>
												<option>Subdelegación Agropecuaria</option>
												<option>Subdelegación de Planeación</option>
												<option>Subdelegación de Pesca</option>
												<option>DDR 095 Santiago Ixcuintla</option>
												<option>DDR 096 Compostela</option>
												<option>DDR 097 Ahuacatlán</option>
												<option>DDR 098 Acaponeta</option>
												<option>DDR 099 Tepic</option>
											</select>
										</div>

										<div class="form-group">
											<label>Folio resguardo</label>
											<input type="text" class="form-control" id="folioRes" placeholder="Introduce el folio de resguardo">
										</div>

										<div class="form-group">
											<label>Presupuesto</label>
											<input type="number" class="form-control" id="presupuesto" placeholder="Introduce el presupuesto">
										</div>
									</form>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="button" class="btn btn-primary">Save changes</button>
								</div>
							</div>
						</div>
					</div>

					<!-- Modal Datos CPU-->
					<div class="modal fade" id="datosCPU" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Datos CPU</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">

									<form>

										<div class="form-group">
											<label>No_Serie</label>
											<input type="number" class="form-control" id="serie" placeholder="Introduce el no. de serie">
										</div>

										<div class="form-group">
											<label>No. de inventario</label>
											<input type="number" class="form-control" id="inventario" placeholder="Introduce el no. de inventario">
										</div>

										<div class="form-group">
											<label>Marca</label>
											<input type="text" class="form-control" id="marca" placeholder="Introduce la marca">
										</div>

										<div class="form-group">
											<label>Modelo</label>
											<input type="text" class="form-control" id="Modelo" placeholder="Introduce el modelo">
										</div>

										<div class="form-group">
											<label>Procesador </label>
											<input type="text" class="form-control" id="text" placeholder="Introduce el tipo de procesador">
										</div>

										<div class="form-group">
											<label>Memoria</label>
											<input type="text" class="form-control" id="Memoria" placeholder="Introduce el tipo de Memoria">
										</div>

										<div class="form-group">
											<label>Disco duro</label>
											<input type="text" class="form-control" id="presupuesto" placeholder="Introduce la cantidad de alacenamiento del disco duro">
										</div>

										<div class="form-group">
											<label>Velocidad</label>
											<input type="text" class="form-control" id="velocidad" placeholder="Introduce velocidad del CPU">
										</div>
										<div class="form-group">
											<label>Tipo de adquisición</label>
											<select class="form-control" id="adquisicion" name="Adquisicion">
												<option value="Compra">Compra</option>
												<option value="Transferencia">Transferencia</option>
												<option value="Comodato">Comodato</option>
												<option value="Arrendamiento">Arrendamiento</option>
												<option value="Prestamo">Prestamo</option>
												<option value="Otro">Otro</option>
											</select>

										</div>
									</form>


								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="button" class="btn btn-primary">Save changes</button>
								</div>
							</div>
						</div>
					</div>

					<!-- Modal Datos Monitor-->
					<div class="modal fade" id="datosMonitor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Datos Monitor</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form>
										<div class="form-group">
											<label>No. de inventario</label>
											<input type="number" class="form-control" id="inventario" name="Inventario" placeholder="Introduce el no. de inventario"
											 require>
										</div>

										<div class="form-group">
											<label>Marca</label>
											<select class="form-control" id="marca" name="id_Marca">
												<?php echo $combobitmarca; ?>
											</select>
										</div>

										<div class="form-group">
											<label>Modelo</label>

											<select class="form-control" id="modelo" name="id_Modelo">
												<?php echo $combobit; ?>
											</select>

										</div>

										<div class="form-group">
											<label>No_Serie</label>
											<input type="number" class="form-control" id="serie" name="Serie" placeholder="Introduce el no. de serie">
										</div>

										<div class="form-group">
											<label>Descripcion </label>
											<input type="text" class="form-control" id="descripcion" name="Descripcion" placeholder="Introduce la descripcion" require>
										</div>

										<div class="form-group">
											<label>Tipo de adquisición</label>
											<select class="form-control" id="adquisicion" name="Adquisicion">
												<option value="Compra">Compra</option>
												<option value="Transferencia">Transferencia</option>
												<option value="Comodato">Comodato</option>
												<option value="Arrendamiento">Arrendamiento</option>
												<option value="Prestamo">Prestamo</option>
												<option value="Otro">Otro</option>
											</select>

										</div>
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Guardar</button>
									</form>
								</div>

								<a href="vistaMonitor.php" class="btn btn-success">Ver lista de Monitores registrados</a>
							</div>
						</div>
					</div>

					<!-- Modal Datos Teclado-->
					<div class="modal fade" id="datosTeclado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Datos Teclado</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form>
										<div class="form-group">
											<label>No. de inventario</label>
											<input type="number" class="form-control" id="inventario" name="InventarioTec" placeholder="Introduce el no. de inventario"
											 require>
										</div>

										<div class="form-group">
											<label>Marca</label>
											<select class="form-control" id="marca" name="id_MarcaTec">
												<?php echo $combobitmarca; ?>
											</select>
										</div>

										<div class="form-group">
											<label>Modelo</label>

											<select class="form-control" id="modelo" name="id_ModeloTec">
												<?php echo $combobit; ?>
											</select>

										</div>

										<div class="form-group">
											<label>No_Serie</label>
											<input type="number" class="form-control" id="serie" name="SerieTec" placeholder="Introduce el no. de serie">
										</div>

										<div class="form-group">
											<label>Descripcion </label>
											<input type="text" class="form-control" id="descripcion" name="DescripcionTec" placeholder="Introduce la descripcion" require>
										</div>

										<div class="form-group">
											<label>Tipo de adquisición</label>
											<select class="form-control" id="adquisicion" name="Adquisicion">
												<option value="Compra">Compra</option>
												<option value="Transferencia">Transferencia</option>
												<option value="Comodato">Comodato</option>
												<option value="Arrendamiento">Arrendamiento</option>
												<option value="Prestamo">Prestamo</option>
												<option value="Otro">Otro</option>
											</select>

										</div>
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Guardar</button>
									</form>
								</div>

								<a href="vistaMonitor.php" class="btn btn-success">Ver lista de Teclados registrados</a>
							</div>
						</div>
					</div>

					<!-- Modal Datos Mouse-->
					<div class="modal fade" id="datosMouse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Datos Mouse</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form>
										<div class="form-group">
											<label>No. de inventario</label>
											<input type="number" class="form-control" id="inventario" name="InventarioMou" placeholder="Introduce el no. de inventario"
											 require>
										</div>

										<div class="form-group">
											<label>Marca</label>
											<select class="form-control" id="marca" name="id_MarcaMou">
												<?php echo $combobitmarca; ?>
											</select>
										</div>

										<div class="form-group">
											<label>Modelo</label>

											<select class="form-control" id="modelo" name="id_ModeloMou">
												<?php echo $combobit; ?>
											</select>

										</div>

										<div class="form-group">
											<label>No_Serie</label>
											<input type="number" class="form-control" id="serie" name="SerieMou" placeholder="Introduce el no. de serie">
										</div>

										<div class="form-group">
											<label>Descripcion </label>
											<input type="text" class="form-control" id="descripcion" name="DescripcionMou" placeholder="Introduce la descripcion" require>
										</div>

										<div class="form-group">
											<label>Tipo de adquisición</label>
											<select class="form-control" id="adquisicion" name="Adquisicion">
												<option value="Compra">Compra</option>
												<option value="Transferencia">Transferencia</option>
												<option value="Comodato">Comodato</option>
												<option value="Arrendamiento">Arrendamiento</option>
												<option value="Prestamo">Prestamo</option>
												<option value="Otro">Otro</option>
											</select>

										</div>
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Guardar</button>
									</form>
								</div>

								<a href="vistaMonitor.php" class="btn btn-success">Ver lista de Mouse registrados</a>
							</div>
						</div>
					</div>

					<!-- Modal Datos Responsable-->
					<div class="modal fade" id="datosResponsable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Datos del responsable</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<form>
										<div class="form-group">
											<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
												<label>Nombre del responsable</label>
												<input type="text" class="form-control" id="campo" name="campo" />
												<button type="submit" id="enviar" name="enviar" class="btn btn-info"> Verificar </button>
											</form>
										</div>
										<div class="form-group">
											<?php while($row = $resultadonombre->fetch_array(MYSQLI_ASSOC)) { ?>
											<input type="text" class="form-control" id="nombre" name="Nombre" placeholder="nombre del responsable" value="<?php echo $row['Nombre']; ?>"
											 disabled>
											<?php } ?>
										</div>

									</form>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="button" class="btn btn-primary">Save changes</button>
								</div>
							</div>
						</div>


					</div>




				</div>
			</div>
		</div>


	</main>
	<!-- /.container -->
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