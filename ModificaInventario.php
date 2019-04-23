<?php	
			
			error_reporting(E_ALL & ~E_NOTICE);
			error_reporting(E_ERROR | E_PARSE);
			require 'conexion.php';

			$id_CPU=$_GET['Id_CPU'];
			$id_Marcapc = $_GET['id_Marcapc'];
			$id_Modelopc = $_GET['id_Modelopc'];
			$id_procesador = $_GET['id_procesador'];
			$idMemoriaRam = $_GET['idMemoriaRam'];		
			$id_DD = $_GET['id_DD'];
			$id_velocidad = $_GET['id_velocidad'];
			$seriepc = $_GET['Seriepc'];
			$inventariopc = $_GET['inventariopc'];
			$adquipc = $_GET['adquipc'];
			$unidadOptica = $_GET['unidadOptica'];
			$bocinas = $_GET['bocinas'];
			$P_usb = $_GET['P_usb'];
			$P_serial = $_GET['P_serial'];
			$P_paralelo = $_GET['P_paralelo'];
			$Red_tipo = $_GET['red_tipo'];
			$ip = $_GET['ip'];
			$MacEth = $_GET['MacEth'];
			$MacWifi = $_GET['MacWifi'];
			$Dominio = $_GET['Dominio'];
			$Antivirus = $_GET['Antivirus'];            
        

            if ($seriepc!=null) {
				$sql2= "UPDATE `cpu` SET `Id_Marca`='$id_Marcapc', `Id_Modelo`='$id_Modelopc', `Serie`='$seriepc',`Invetario`='$inventariopc',`Id_Procesador`='$id_procesador', `Id_MemoriaRam`='$idMemoriaRam',`Id_DD`='$id_DD',`Id_Velocidad`='$id_velocidad',`Adquisicion`='$adquipc',UnidadOptica='$unidadOptica',Bosinas='$bocinas', `P_Serial`='$P_serial',`P_Paralelo`='$P_paralelo',P_USB=$P_usb,RedTipo='$Red_tipo',IP='$ip',MacEth='$MacEth',Mac_wifi='$MacWifi',Dominio='$Dominio',Antivirus='$Antivirus' WHERE Id_CPU='$id_CPU'";
				
				///SET `Id_Marca`='$id_Marcapc',`Id_Modelo`='$id_Modelopc',`Id_Procesador`='$id_procesador',`Id_MemoriaRam`='$idMemoriaRam',`Id_DD`='$id_DD',`Id_Velocidad`='$id_velocidad',`Serie`='$seriepc',`Invetario`='$inventariopc',`Adquisicion`='$adquipc',`UnidadOptica`='$unidadOptica',`Bosinas`='$bocinas',`P_USB`='$P_usb',`P_Serial`='$P_serial',`P_Paralelo`='$P_paralelo',`RedTipo`='$Red_tipo',`IP`='$ip',`MacEth`='$MacEth',`Mac_wifi`=$MacWifi,`Dominio`='$Dominio',`Antivirus`='$Antivirus' WHERE Id_CPU='$id_CPU'
                $mysqli->query($sql2);
    
				if ($id_CPU=1) {
					echo'<script type="text/javascript">
			alert("Registro actualizado!");
			window.location.href="vistaCPU.php"	;
			</script>';
                
                }
			}
			
?>
<?php
require 'conexion.php';
$folio = $_GET['Folio'];        
            
$sql = "SELECT `Folio`, zona.Nombre, concat(persona.Nombre,' ',persona.ApePaterno,' ',persona.ApeMaterno) as nombResp, persona.RFC, Filtrado,`Identificacion`, concat(p.Nombre,' ',p.ApePaterno,' ',p.ApeMaterno) as nombUser,p.RFC as RFCUser, `Nodo`, `Fecha_Adquisicion`, `DT_adquisicion`, `DTB`, `Tipo_HW`, `Folio_Resduardo`, `Observaciones`, `Fin_Garantia`, `Candado`, `Valor`,equipos.Estatus, `Ubicacion`, `Fecha_Llenado`, `Oficio_Mexico`, `Contra_Admin`, 
cpu.Serie as serieCPU, marCPU.Marca as marcaCPU, modCPU.Modelo as modCPU, cpu.Invetario as InvCPU, 
monitor.Serie as serieMon, marMoni.Marca as marcaMoni, modMoni.Modelo as modMoni, monitor.Inventario as InvMoni,
mouse.Serie as serieMou, marMou.Marca as marcaMou, modMou.Modelo as modMou, mouse.Inventario as InvMou,
teclado.Serie as serieTec, marTec.Marca as marcaTec, modTec.Modelo as modTec, teclado.Inventario as InvTec
FROM `equipos`
INNER JOIN zona on equipos.Id_Zona=zona.id_Zona 
INNER JOIN persona on equipos.RFC=persona.RFC 
INNER JOIN persona p on equipos.RFC_Usuario=p.RFC 
INNER JOIN (cpu 
			INNER JOIN marca marCPU on cpu.Id_Marca=marCPU.id_Marca
			INNER JOIN modelo modCPU on cpu.Id_Modelo=modCPU.id_Modelo) 
			on equipos.Id_CPU=cpu.Id_CPU 
INNER JOIN (monitor 
			INNER JOIN marca marMoni on monitor.id_Marca=marMoni.id_Marca 
			INNER JOIN modelo modMoni on monitor.id_Modelo=modMoni.id_Modelo)
			on equipos.id_Monitor=monitor.id_Monitor
INNER JOIN (mouse 
			INNER JOIN marca marMou on mouse.Id_Marca=marMou.id_Marca 
			INNER JOIN modelo modMou on mouse.Id_Modelo=modMou.id_Modelo) 
			ON equipos.Id_mouse=mouse.Id_mouse 
INNER JOIN (teclado 
			INNER JOIN marca marTec on teclado.Id_Marca=marTec.id_Marca 
			INNER JOIN modelo modTec on teclado.IdModelo=modTec.id_Modelo) 
			on equipos.Id_Teclado=teclado.Id_Teclado WHERE Folio = '$folio'";
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
				<h3 style="text-align:center">ACTUALIZAR REGISTRO</h3>
			</div>
			<div class="card-body">
				<form>
					<h4 style="color:red">Primer selecciona un responsable y usuario </h4>
					<div class="form-inline">
						<div class="form-group mb-2	">
							<label>Responsable: </label>
							<select class="form-control" id="rfc" name="RFC">
								<option value="<?php echo $row['RFC'];?>">
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
						<input type="number" class="form-control" id="grupo" name='folio' value="<?php echo $row2[Folio]; ?>"
						 disabled>
					</div>

					<div class="form-group">
						<label>Zona</label>
						<select class="form-control col-sm-10" id="id_zona" name="idZona">
							<option value="<?php echo $row2['Nombre'];?>">
								<?php echo $row2['Nombre'];?>
							</option>
							<?php echo $combobitzona; ?>
						</select>
					</div>

					<h4>Datos Generales</h4>



					<div class="form-group">
						<label>Fecha de filtrado</label>
						<input type="date" class="form-control" id="filtrado" name="filtrado" placeholder="Introduce la fecha de filtrado" value="<?php echo $row2['Filtrado'];?>">
					</div>

					<div class="form-group">
						<label>Identificación</label>
						<input type="text" class="form-control" id="identificacion" name="identificacion" placeholder="Introduce la identificacion" value="<?php echo $row2['Identificacion']; ?>">
					</div>

					<div class="form-group">
						<label>Nodo</label>
						<input type="text" class="form-control" id="nodo" name="nodo" placeholder="Introduce el nodo" value="<?php echo $row2['Nodo']; ?>">
					</div>

					<div class="form-group">
						<label>Fecha de adquisición</label>
						<input type="date" class="form-control" id="fechaAdqui" name="fechaAdqui" placeholder="Introduce la fecha de aquisición" value="<?php echo $row2['Fecha_Adquisicion'];?>">
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
						<input type="date" class="form-control" id="finGarantia" name="finGarantia" placeholder="Introduce el fin de la garantia" value="<?php echo $row2['Fin_Garantia']; ?>">
					</div>

					<div class="form-group">
						<label for="estatus" class="col-sm-2 controllabel">Candado</label>
						<div class="col-sm-3">
							<select class="form-control" id="candado" name="candado">
								<option value="SI" <?php if( $row[ 'candado']=='SI' ) echo 'Selected'; ?>>SI</option>
								<option value="NO" <?php if( $row[ 'candado']=='NO' ) echo 'Selected'; ?>>NO</option>
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
							<select class="form-control" id="estatus" name="Estatus">
								<option value="Bueno" <?php if( $row[ 'Estatus']=='Bueno' ) echo 'Selected'; ?>>Bueno</option>
								<option value="Regular" <?php if( $row[ 'Estatus']=='Regular' ) echo 'Selected'; ?>>Regular</option>
								<option value="Malo" <?php if( $row[ 'Estatus']=='Otro' ) echo 'Selected'; ?>>Malo</option>
								<option value="Otro" <?php if( $row[ 'Estatus']=='Otro' ) echo 'Selected'; ?>>Otro</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label>Ubicación</label>
						<input type="text" class="form-control" id="ubicacion" name="Ubicacion" placeholder="Introduce la ubicación del equipo " value="<?php echo $row2['Ubicacion']; ?>">
					</div>

					<div class="form-group">
						<label>Fecha de llenado: </label>

						<input type="date" class="form-control" id="fechaLlenado" name="fechaLlenado" value="<?php echo $row2['Fecha_Llenado']; ?>" disabled>
					</div>

					<div class="form-group">
						<label>Oficio Mexico</label>
						<input type="text" class="form-control" id="oficioMexico" name="oficioMexico" value="<?php echo $row2['Oficio_Mexico']; ?>">
					</div>

					<div class="form-group">
						<label>Contraseña Administrador</label>
						<input type="text" class="form-control" id="contraAdmin" name="contraAdmin" placeholder="Introduce la contraseña de administrador" value="<?php echo $row2['Contra_Admin']; ?>">
					</div>

					<div class="form-group">
						<label>Numero de serie del CPU</label>
						<select class="form-control col-sm-10" id="id_CPU" name="id_CPU">
							<?php echo $combobitpc ?>
						</select>
					</div>

					<div class="form-group">
						<label>Numero de serie del monitor</label>
						<select class="form-control col-sm-10" id="id_Monitor" name="id_Monitor">
							<?php echo $combobitmont ?>
						</select>
					</div>

					<div class="form-group">
						<label>Numero de serie del mouse</label>
						<select class="form-control col-sm-10" id="id_Mouse" name="id_Mouse">
							<?php echo $combobitmouse ?>
						</select>
					</div>

					<div class="form-group">
						<label>Numero de serie del Teclado</label>
						<select class="form-control col-sm-10" id="id_Teclado" name="id_Teclado">
							<?php echo $combobittec ?>
						</select>
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