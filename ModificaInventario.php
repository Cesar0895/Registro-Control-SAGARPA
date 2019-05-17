<?php	
			
			error_reporting(E_ALL & ~E_NOTICE);
			error_reporting(E_ERROR | E_PARSE);
			require 'conexion.php';

			$Folio = $_GET['folio'];
			$idZona=$_GET['idZona'];
			$RFC=$_GET['RFC'];
			$Filtrado=$_GET['filtrado'];
			$Identificacion=$_GET['identificacion'];
			$RFCusuario=$_GET['RFCusuario'];
			$Nodo=$_GET['nodo'];
			$FechaAdqui=$_GET['fechaAdqui'];
			$DTadqui=$_GET['DTadqui'];
			$DTB=$_GET['DTB'];
			$tipo_HW=$_GET['Tipo_HW'];
			$FolioResguardo=$_GET['folioResguardo'];
			$Observaciones=$_GET['observaciones'];
			$FinGarantia=$_GET['finGarantia'];
			$Candado=$_GET['candado'];
			$Valor=$_GET['valor'];
			$Estatus=$_GET['estatus'];
			$Ubicacion=$_GET['Ubicacion'];
			$FechaLlenado=$_GET['fechaLlenado'];
			$OficioMexico=$_GET['oficioMexico'];
			$ContraAdmin=$_GET['contraAdmin'];
			$id_CPU=$_GET['id_CPU'];
			$id_Monitor=$_GET['id_Monitor'];
			$id_Mouse=$_GET['id_Mouse'];
			$id_Teclado=$_GET['id_Teclado'];
			
        

            if ($Folio!=null) {
				//echo "UPDATE `equipos` SET Id_Zona='$idZona',RFC='$RFC', Filtrado='$Filtrado',Observaciones='$Observaciones',Fin_Garantia='$FinGarantia',Candado='$Candado',Estatus='$Estatus', Valor='$Valor'  WHERE Folio='$Folio'";


				$sql2= "UPDATE `equipos` SET Id_Zona='$idZona',RFC='$RFC',RFC_Usuario='$RFCusuario', Filtrado='$Filtrado',Identificacion='$Identificacion',Nodo='$Nodo',Fecha_Adquisicion='$FechaAdqui',DT_adquisicion='$DTadqui',DTB='$DTB',Tipo_HW='$tipo_HW',Folio_Resduardo='$FolioResguardo',Observaciones='$Observaciones',Fin_Garantia='$FinGarantia',Candado='$Candado',Estatus='$Estatus', Ubicacion='$Ubicacion', Valor='$Valor', Oficio_Mexico='$OficioMexico',Contra_Admin='$ContraAdmin' WHERE Folio='$Folio'";

				//,`Nodo`='$Nodo',`Fecha_Adquisicion`='$FechaAdqui',	`DT_adquisicion`='$DTadqui',`DTB`=$DTB,`Tipo_HW`='$tipo_HW',`Folio_Resduardo`='$FolioResguardo',`Observaciones`='$Observaciones',`Fin_Garantia`='$FinGarantia',`Candado`='$Candado',`Valor`='$Valor',`Estatus`='$Estatus',`Ubicacion`='$Ubicacion',`Fecha_Llenado`='$FechaLlenado',`Oficio_Mexico`='$OficioMexico',`Contra_Admin`='$ContraAdmin'
				
                $mysqli->query($sql2);
				
				if ($Folio=1) {
					echo'<script type="text/javascript">
					alert("Registro actualizado!");
					window.location.href="vistaEquipoComputo.php"	;
					</script>';
                
				}
				
				
			}
			
?>
<?php
require 'conexion.php';
$folio = $_GET['Folio'];        
            
$sql = "SELECT `Folio`, zona.Nombre, zona.id_Zona, concat(persona.Nombre,' ',persona.ApePaterno,' ',persona.ApeMaterno) as nombResp, persona.RFC, Filtrado,`Identificacion`, concat(p.Nombre,' ',p.ApePaterno,' ',p.ApeMaterno) as nombUser,p.RFC as RFCUser, `Nodo`, `Fecha_Adquisicion`, `DT_adquisicion`, `DTB`, `Tipo_HW`, `Folio_Resduardo`, `Observaciones`, `Fin_Garantia`, `Candado`, `Valor`,equipos.Estatus, `Ubicacion`, `Fecha_Llenado`, `Oficio_Mexico`, `Contra_Admin`, 
cpu.Serie as serieCPU, 
monitor.Serie as serieMon, 
mouse.Serie as serieMou, 
teclado.Serie as serieTec
FROM `equipos`
INNER JOIN zona on equipos.Id_Zona=zona.id_Zona 
INNER JOIN persona on equipos.RFC=persona.RFC 
INNER JOIN persona p on equipos.RFC_Usuario=p.RFC 
INNER JOIN cpu on equipos.Id_CPU=cpu.Id_CPU 
INNER JOIN monitor on equipos.id_Monitor=monitor.id_Monitor
INNER JOIN mouse ON equipos.Id_mouse=mouse.Id_mouse 
INNER JOIN teclado on equipos.Id_Teclado=teclado.Id_Teclado WHERE Folio = '$folio'";
            $resultado = $mysqli->query($sql);
			$row2 = $resultado->fetch_array(MYSQLI_ASSOC);
			
			

		$sql = "SELECT RFC, concat(Nombre,' ',ApePaterno,' ',ApeMaterno) as NombCompleto FROM `persona`";
		$resultrfc = $mysqli->query($sql);
		if ($resultrfc->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
		{
			$combobitrfc="";
			while ($row = $resultrfc->fetch_array(MYSQLI_ASSOC)) 
			{
				$combobitrfc .="<option value='".$row['RFC']."'>".$row['NombCompleto']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
			}
		}
		else
		{
			echo "No hubo resultados";
		}

		$sql = "SELECT RFC, concat(Nombre,' ',ApePaterno,' ',ApeMaterno) as NombCompleto FROM `persona`";
		$resultrfcUser = $mysqli->query($sql);
		if ($resultrfcUser->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
		{
			$combobitrfcUser="";
			while ($row = $resultrfcUser->fetch_array(MYSQLI_ASSOC)) 
			{
				$combobitrfcUser .="<option value='".$row['RFC']."'>".$row['NombCompleto']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
			}
		}
		else
		{
			echo "No hubo resultados";
		}

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

		$sql = "SELECT * FROM `monitor` ORDER BY `id_Monitor` DESC";
		$resultmont = $mysqli->query($sql);
		if ($resultmont->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
		{
			$combobitmont="";
			while ($row = $resultmont->fetch_array(MYSQLI_ASSOC)) 
			{
				$combobitmont .="<option value='".$row['id_Monitor']."'>".$row['Serie']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
			}
		}
		else
		{
			echo "No hubo resultados";
		}

		$sql = "SELECT * FROM `teclado` ORDER BY `Id_Teclado` DESC";
		$resulttec = $mysqli->query($sql);
		if ($resulttec->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
		{
			$combobittec="";
			while ($row = $resulttec->fetch_array(MYSQLI_ASSOC)) 
			{
				$combobittec .="<option value='".$row['Id_Teclado']."'>".$row['Serie']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
			}
		}
		else
		{
			echo "No hubo resultados";
		}

		$sql = "SELECT * FROM `mouse` ORDER BY `Id_mouse` DESC";
		$resultmouse = $mysqli->query($sql);
		if ($resultmouse->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
		{
			$combobitmouse="";
			while ($row = $resultmouse->fetch_array(MYSQLI_ASSOC)) 
			{
				$combobitmouse .="<option value='".$row['Id_mouse']."'>".$row['Serie']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
			}
		}
		else
		{
			echo "No hubo resultados";
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
				<h3 style="text-align:center">ACTUALIZAR REGISTRO</h3>
			</div>
			<div class="card-body">
				<form>
					<h4 style="color:red">Selecciona un responsable y usuario </h4>
					<div class="form-inline">
						<div class="form-group mb-2	">
							<label>Responsable: </label>
							<select class="form-control" id="rfc" name="RFC">
								<option value="<?php echo $row2['RFC'];?>">
									<?php echo $row2['nombResp'];?>
								</option>
								<?php echo $combobitrfc; ?>
							</select>
						</div>
						<i class="fas fa-arrow-right mx-5" style="width:50px"></i>
						<div class="form-group mx-sm-3 mb-2">
							<label>Usuario: </label>
							<select class="form-control" id="RFCusuario" name="RFCusuario">
								<option value="<?php echo $row2['RFCUser'];?>">
									<?php echo $row2['nombUser'];?>
								</option>
								<?php echo $combobitrfcUser; ?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label>Folio</label>
						<input type="number" class="form-control" id="grupo" name='folio' value="<?php echo $row2['Folio']; ?>">
					</div>

					<div class="form-group">
						<label>Zona</label>
						<select class="form-control col-sm-10" id="id_zona" name="idZona">
							<option value="<?php echo $row2['id_Zona'];?>">
								<?php echo $row2['Nombre'];?>
							</option>
							<?php echo $combobitzona; ?>
						</select>
					</div>

					<h4>Datos Generales</h4>



					<div class="form-group">
						<label>Fecha de filtrado</label>
						<input type="date" class="form-control" id="filtrado" name="filtrado" value="<?php echo $row2['Filtrado'];?>">
					</div>

					<div class="form-group">
						<label>Identificación</label>
						<input type="text" class="form-control" id="identificacion" name="identificacion" placeholder="Introduce la identificacion"
						 value="<?php echo $row2['Identificacion']; ?>">
					</div>

					<div class="form-group">
						<label>Nodo</label>
						<input type="text" class="form-control" id="nodo" name="nodo" placeholder="Introduce el nodo" value="<?php echo $row2['Nodo']; ?>">
					</div>

					<div class="form-group">
						<label>Fecha de adquisición</label>
						<input type="date" class="form-control" id="fechaAdqui" name="fechaAdqui" placeholder="Introduce la fecha de aquisición"
						 value="<?php echo $row2['Fecha_Adquisicion'];?>">
					</div>

					<div class="form-group">
						<label>Dictamen de Adquisición</label>
						<input type="text" class="form-control" id="DTadqui" name="DTadqui" placeholder="Introduce el Dictamen de aquisición" value="<?php echo $row2['DT_adquisicion']; ?>">
					</div>

					<div class="form-group">
						<label>Dictamen de Baja</label>
						<input type="text" class="form-control" id="DTB" name="DTB" placeholder="Introduce el diactamen de baja" value="<?php echo $row2['DTB']; ?>">
					</div>

					<div class="form-group">
						<label>Tipo de hardware</label>
						<input type="text" class="form-control" id="Tipo_HW" name="Tipo_HW" placeholder="introduce el tipo de hw " value="<?php echo $row2['Tipo_HW']; ?>">
					</div>

					<div class="form-group">
						<label>Folio resguardo</label>
						<input type="text" class="form-control" id="folioResguardo" name="folioResguardo" placeholder="Introduce el Folio de Resguarda"
						 value="<?php echo $row2['Folio_Resduardo']; ?>">
					</div>
					<div class="form-group">
						<label>Obsevaciones</label>
						<div class="col-sm-10">
							<textarea class="form-control" rows=5 id="Obsrvaciones" name="observaciones" placeholder="Observaciones"><?php echo $row2['Observaciones']; ?></textarea>
						</div>
					</div>

					<div class="form-group">
						<label>Fin de garantia</label>
						<input type="date" class="form-control" id="finGarantia" name="finGarantia" placeholder="Introduce el fin de la garantia"
						 value="<?php echo $row2['Fin_Garantia']; ?>">
					</div>

					<div class="form-group">
						<label for="candado" class="col-sm-2 controllabel">Candado</label>
						<div class="col-sm-3">
							<select class="form-control" id="candado" name="candado">
								<option value="SI" <?php if( $row2[ 'Candado']=='SI' ) echo 'Selected'; ?>>SI</option>
								<option value="NO" <?php if( $row2[ 'Candado']=='NO' ) echo 'Selected'; ?>>NO</option>
							</select>
						</div>
					</div>


					<div class="form-group">
						<label>Valor</label> $
						<input type="number" class="form-control" id="valor" name="valor" placeholder="introduce el valor del equipo" value="<?php echo $row2['Valor']; ?>">
					</div>

					<div class="form-group">
						<label for="estatus" class="col-sm-2 controllabel">Status</label>
						<div class="col-sm-10">
							<select class="form-control" id="estatus" name="estatus">
								<option value="Bueno" <?php if( $row2[ 'Estatus']=='Bueno' ) echo 'Selected'; ?>>Bueno</option>
								<option value="Regular" <?php if( $row2[ 'Estatus']=='Regular' ) echo 'Selected'; ?>>Regular</option>
								<option value="Malo" <?php if( $row2[ 'Estatus']=='Malo' ) echo 'Selected'; ?>>Malo</option>
								<option value="Otro" <?php if( $row2[ 'Estatus']=='Otro' ) echo 'Selected'; ?>>Otro</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label>Ubicación</label>
						<input type="text" class="form-control" id="ubicacion" name="Ubicacion" placeholder="Introduce la ubicación del equipo "
						 value="<?php echo $row2['Ubicacion']; ?>">
					</div>

					<div class="form-group">
						<label>Fecha de llenado: </label>

						<input type="date" class="form-control" id="fechaLlenado" name="fechaLlenado" value="<?php echo $row2['Fecha_Llenado']; ?>"
						 disabled>
					</div>

					<div class="form-group">
						<label>Oficio Mexico</label>
						<input type="text" class="form-control" id="oficioMexico" name="oficioMexico" value="<?php echo $row2['Oficio_Mexico']; ?>">
					</div>

					<div class="form-group">
						<label>Contraseña Administrador</label>
						<input type="text" class="form-control" id="contraAdmin" name="contraAdmin" value="<?php echo $row2['Contra_Admin']; ?>">
					</div>


					<div class="form-group">
						<label>Numero de serie del CPU</label>
						<input type="text" class="form-control" id="contraAdmin" name="contraAdmin" value="<?php echo $row2['serieCPU']; ?>"
						 disabled>
					</div>

					<div class="form-group">
						<label>Numero de serie del monitor</label>
						<input type="text" class="form-control" id="contraAdmin" name="contraAdmin" value="<?php echo $row2['serieMon']; ?>"
						 disabled>
					</div>

					<div class="form-group">
						<label>Numero de serie del mouse</label>
						<input type="text" class="form-control" id="contraAdmin" name="contraAdmin" value="<?php echo $row2['serieMou']; ?>"
						 disabled>
					</div>

					<div class="form-group">
						<label>Numero de serie del Teclado</label>
						<input type="text" class="form-control" id="contraAdmin" name="contraAdmin" value="<?php echo $row2['serieTec'];?>"
						 disabled>
					</div>


					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Guardar</button>
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