<?php
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ERROR | E_PARSE);
require 'conexion.php';
$extencion = $_GET['Extencion'];
$display = $_GET['Display'];
$RFC = $_GET['RFC'];
$inmueble = $_GET['Inmueble'];
$sitio = $_GET['Sitio'];
$serie = $_GET['Serie'];
$marca = $_GET['Marca'];
$modelo = $_GET['Modelo'];
$mac = $_GET['Mac'];
$nodoRed = $_GET['NodoRed'];
$gpoCaptura = $_GET['GpoCaptura'];
$nivel_cor = $_GET['Nivel_Cor'];
$nivel_Aut = $_GET['Nivel_Aut'];
$codigo_Aut = $_GET['Codigo_Aut'];
$funcion = $_GET['Funcion'];
$DID = $_GET['DID'];
$correoVoz = $_GET['CorreoVoz'];
$puerto = $_GET['Puerto'];
$dir_ip = $_GET['Dir_IP'];
$mask = $_GET['Mask'];
$gateway = $_GET['Gateway'];
$vlan = $_GET['VLAN'];
$notas = $_GET['Notas'];
$adquisicion = $_GET['Adquisicion'];
$eliminador = $_GET['Eliminador'];
$f_resguardo = $_GET['F_Resguardo'];
$fecha_resguardo = $_GET['Fecha_Resguardo'];
$observaciones = $_GET['Observaciones'];
$estatus = $_GET['Estatus'];

			

if ($display!=null && $RFC!=null) {
    $sql2= "UPDATE telefonia set  Display='$display', RFC='$RFC', Inmueble='$inmueble', Sitio='$sitio',Serie='$serie', id_Marca='$marca', id_Modelo='$modelo', Mac='$mac', NodoRed='$nodoRed', GpoCaptura='$gpoCaptura', Nivel_Cor='$nivel_cor', Nivel_Aut='$nivel_Aut', Codigo_Aut='$codigo_Aut', Funcion='$funcion', DID='$DID', CorreoVoz='$correoVoz', Puerto='$puerto', Dir_IP='$dir_ip', Mask='$mask', Gateway='$gateway', VLAN='$vlan', Notas='$notas', Adquisicion='$adquisicion', Eliminador='$eliminador', F_Resguardo='$f_resguardo', Fecha_Resguardo='$fecha_resguardo', Observaciones='$observaciones', Estatus='$estatus'
    Where Extencion='".$extencion."'";
    $mysqli->query($sql2);
    
    if ($extencion=1) {
		echo'<script type="text/javascript">
			alert("Registro Actualizado");
			window.location.href="Telefonia.php"	;
			</script>';
		
	}
}

		$extencion = $_GET['Extencion'];        
            
			$sqltel = "SELECT * FROM telefonia WHERE Extencion = '$extencion'";
            $resultado = $mysqli->query($sqltel);
			$row = $resultado->fetch_array(MYSQLI_ASSOC);
		
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

			$sql = "SELECT * FROM marca ORDER BY Marca ASC";
			$resultmarca = $mysqli->query($sql);
			$row3 = $resultmarca->fetch_array(MYSQLI_ASSOC);
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

			$sql = "SELECT * FROM modelo";
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
				<form>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Extencion</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="extencion" name="Extencion" value="<?php echo $row['Extencion']; ?>"
							 required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 controllabel">Display</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="display" name="Display" value="<?php echo $row['Display']; ?>"
							 placeholder="Display" required>
						</div>
					</div>

					<div class="form-group">
						<label>RFC</label>
						<select class="form-control col-sm-10" id="rfc" name="RFC">
							<option>
								<?php echo $row['RFC'];?>
							</option>
							<option>
								<?php echo $combobitrfc; ?>
							</option>

						</select>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Inmueble</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="inmueble" value="<?php echo $row['Inmueble']; ?>"
							 name="Inmueble" placeholder="Inmueble" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Sitio</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="sitio" name="Sitio" value="<?php echo $row['Sitio']; ?>"
							 placeholder="Sitio" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Serie</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="Serie" name="Serie" value="<?php echo $row['Serie']; ?>"
							 placeholder="Serie" required>
						</div>
					</div>

					<div class="form-group">
						<label>Marca</label>
						<select class="form-control col-sm-10" id="marca" name="Marca">
							<option>
								<?php echo $row['id_Marca']; ?>
							</option>
							<option>
								<?php echo $combobitmarca; ?>
							</option>

						</select>
					</div>

					<div class="form-group">
						<label>Modelo</label>
						<select class="form-control col-sm-10" id="modelo" name="Modelo">
							<option>
								<?php echo $row['id_Modelo']; ?>
							</option>
							<option>
								<?php echo $combobit; ?>
							</option>
						</select>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Mac</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="mac" name="Mac" value="<?php echo $row['Mac']; ?>"
							 placeholder="Mac" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Nodo De Red</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="nodoRed" name="NodoRed" value="<?php echo $row['NodoRed']; ?>"
							 placeholder="Nodo Red">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Grupo de captura</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="gpoCaptura" value="<?php echo $row['GpoCaptura']; ?>"
							 name="GpoCaptura" placeholder="Grupo de captura">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Nivel_Cor</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="nivel_cor" value="<?php echo $row['Nivel_Cor']; ?>"
							 name="Nivel_Cor" placeholder="Nivel_Cor">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Nivel_Aut</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="nivel_Aut" value="<?php echo $row['Nivel_Aut']; ?>"
							 name="Nivel_Aut" placeholder="Nivel_Aut">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Codigo_Aut</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="Codigo_Aut" value="<?php echo $row['Codigo_Aut']; ?>"
							 name="Codigo_Aut" placeholder="Codigo_Aut">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Función</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="funcion" value="<?php echo $row['Funcion']; ?>"
							 name="Funcion" placeholder="Función">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">DID</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="did" name="DID" value="<?php echo $row['DID']; ?>"
							 placeholder="DID">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Correo de correoVoz</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="correoVoz" name="CorreoVoz" value="<?php echo $row['CorreoVoz']; ?>"
							 placeholder="Correo de Voz">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Puerto</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="puerto" name="Puerto" value="<?php echo $row['Puerto']; ?>"
							 placeholder="Puerto">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Dirección IP</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="dir_ip" name="Dir_IP" value="<?php echo $row['Dir_IP']; ?>"
							 placeholder="Direccion IP">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Mask</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="mask" name="Mask" value="<?php echo $row['Mask']; ?>"
							 placeholder="Mask">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 controllabel">Gateway</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="gateway" name="Gateway" value="<?php echo $row['Gateway']; ?>"
							 placeholder="Gateway">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 controllabel">VLAN</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="vlan" name="VLAN" value="<?php echo $row['VLAN']; ?>"
							 placeholder="VLAN">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 controllabel">Notas</label>
						<div class="col-sm-10">
							<textarea class="form-control" rows=5 id="notas" name="Notas" placeholder="Notas"><?php echo $row['Notas']; ?></textarea>
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
						<label class="col-sm-2 controllabel">Eliminador</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="eliminador" value="<?php echo $row['Eliminador']; ?>"
							 name="Eliminador" placeholder="Eliminador">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 controllabel">F_Resguardo</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="f_resguardo" value="<?php echo $row['F_Resguardo']; ?>"
							 name="F_Resguardo" placeholder="F_Resguardo">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 controllabel">Fecha de resguardo</label>
						<div class="col-sm-10">
							<input type="date" class="form-control" id="fechaResguardo" name="Fecha_Resguardo" value="<?php echo $row['Fecha_Resguardo']; ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 controllabel">Obsevaciones</label>
						<div class="col-sm-10">
							<textarea class="form-control" rows=5 id="Obsrvaciones" name="Observaciones" placeholder="Observaciones"><?php echo $row['Observaciones']; ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 controllabel">Estatus</label>
						<select class="form-control col-sm-10" id="estatus" name="Estatus">
							<option value="Compra" <?php if( $row[ 'Estatus']=='Bueno' ) echo 'Selected'; ?>>Bueno</option>
							<option value="Regular" <?php if( $row[ 'Estatus']=='Regular' ) echo 'Selected'; ?>>Regular</option>
							<option value="Malo" <?php if( $row[ 'Estatus']=='Malo' ) echo 'Selected'; ?>>Malo</option>
							<option value="Otro" <?php if( $row[ 'Estatus']=='Otro' ) echo 'Selected'; ?>>Otro</option>
						</select>
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