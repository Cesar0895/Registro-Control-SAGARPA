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
	        $id_CPU = $_GET['Id_CPU'];        
            
			$sql = "SELECT `Id_CPU`, cpu.Id_Marca, marca.Marca, cpu.Id_Modelo,modelo.Modelo, cpu.Id_Procesador,procesador.Procesador, cpu.Id_MemoriaRam,memoria_ram.Memoria_RAM, cpu.Id_DD, disco_duro.Almacenamiento, cpu.Id_Velocidad, velocidad.Velocidad ,`Serie`, `Invetario`, `Adquisicion`, `UnidadOptica`, `Bosinas`, `P_USB`, `P_Serial`, `P_Paralelo`, `RedTipo`, `IP`, `MacEth`, `Mac_wifi`, `Dominio`, `Antivirus` FROM `cpu` 
			INNER JOIN marca on cpu.Id_Marca=marca.id_Marca
			INNER JOIN modelo on cpu.Id_Modelo=modelo.id_Modelo
			INNER JOIN procesador on cpu.Id_Procesador=procesador.id_Procesador
			INNER JOIN memoria_ram on cpu.Id_MemoriaRam=memoria_ram.Id_Memoria
			INNER JOIN disco_duro on cpu.Id_DD=disco_duro.id_DD
			INNER JOIN velocidad on cpu.Id_Velocidad=velocidad.Id_velocidad WHERE Id_CPU = '$id_CPU'";
            $resultado = $mysqli->query($sql);
			$row2 = $resultado->fetch_array(MYSQLI_ASSOC);
			
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

			$sql = "SELECT * FROM procesador ORDER BY Procesador ASC";
			$resultpro = $mysqli->query($sql);
			if ($resultpro->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
			{
				$combobitpro="";
				while ($row = $resultpro->fetch_array(MYSQLI_ASSOC)) 
				{
					$combobitpro .="<option value='".$row['id_Procesador']."'>".$row['Procesador']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
				}
			}
			else
			{
				echo "No hubo resultados";
			}

			$sql = "SELECT `Id_Memoria`, concat(`Memoria_RAM`,' GB') as ram FROM `memoria_ram`";
			$resultram = $mysqli->query($sql);
			if ($resultram->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
			{
				$combobitram="";
				while ($row = $resultram->fetch_array(MYSQLI_ASSOC)) 
				{
					$combobitram .="<option value='".$row['Id_Memoria']."'>".$row['ram']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
				}
			}
			else
			{
				echo "No hubo resultados";
			}

			$sql = "SELECT * FROM `disco_duro` ORDER BY `Almacenamiento` DESC";
			$resultDD = $mysqli->query($sql);
			if ($resultDD->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
			{
				$combobitDD="";
				while ($row = $resultDD->fetch_array(MYSQLI_ASSOC)) 
				{
					$combobitDD .="<option value='".$row['id_DD']."'>".$row['Almacenamiento']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
				}
			}
			else
			{
				echo "No hubo resultados";
			}

			$sql = "SELECT * FROM `velocidad` ORDER BY `Velocidad` ASC";
			$resultvel = $mysqli->query($sql);
			if ($resultvel->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
			{
				$combobitvel="";
				while ($row = $resultvel->fetch_array(MYSQLI_ASSOC)) 
				{
					$combobitvel .="<option value='".$row['Id_velocidad']."'>".$row['Velocidad']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
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
				<h3 style="text-align:center">ACTUALIZAR REGISTRO</h3>
			</div>
			<div class="card-body">
				<form>
					<div class="form-group">
						<input type="hidden" class="form-control" id="id_CPU" name="Id_CPU" placeholder="id" value="<?php echo $row2['Id_CPU']; ?>"
						 required>
					</div>


					<div class="form-group row">
						<label class="col-sm-2 col-form-label ml-4">Serie:</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="Serie" name="Seriepc" value="<?php echo $row2['Serie']; ?>"
							 require>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label ml-4">No. Inventario:</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="inventario" name="inventariopc" value="<?php echo $row2['Invetario']; ?>"
							 require>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label ml-4">Marca:</label>
						<div class="col-sm-4">
							<select class="form-control" id="marca" name="id_Marcapc">
								<option value='<?php echo $row2[' Id_Marca ']?>'>
									<?php echo $row2['Marca']?>
								</option>
								<?php echo $combobitmarca; ?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label ml-4">Modelo:</label>
						<div class="col-sm-4">
							<select class="form-control" id="marca" name="id_Modelopc">
								<option value='<?php echo $row2[' Id_Modelo ']?>'>
									<?php echo $row2['Modelo']?>
								</option>
								<?php echo $combobit; ?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label ml-4">Procesador:</label>
						<div class="col-sm-4">
							<select class="form-control" id="procesador" name="id_procesador">
								<option value='<?php echo $row2[' Id_Procesador ']?>'>
									<?php echo $row2['Procesador']?>
								</option>
								<?php echo $combobitpro; ?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label ml-4">Memoria RAM:</label>
						<div class="col-sm-4">
							<select class="form-control" id="procesador" name="idMemoriaRam">
								<option value='<?php echo $row2[' Id_MemoriaRam ']?>'>
									<?php echo $row2['Memoria_RAM']?>
								</option>
								<?php echo $combobitram; ?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label ml-4">Disco Duro:</label>
						<div class="col-sm-4">
							<select class="form-control" id="DD" name="id_DD">
								<option value='<?php echo $row2[' Id_DD ']?>'>
									<?php echo $row2['Almacenamiento']?>
								</option>
								<?php echo $combobitDD; ?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label ml-4">Velocidad:</label>
						<div class="col-sm-4">
							<select class="form-control" id="Velocidad" name="id_velocidad">
								<option value='<?php echo $row2[' Id_Velocidad ']?>'>
									<?php echo $row2['Velocidad']?>
								</option>
								<?php echo $combobitvel; ?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label ml-4">Adquisicion:</label>
						<div class="col-sm-4">
							<select class="form-control" id="Adqui" name="adquipc">
								<option value="Compra" <?php if( $row2[ 'Adquisicion']=='Compra' ) echo 'Selected'; ?>>Compra</option>
								<option value="Transferencia" <?php if( $row2[ 'Adquisicion']=='Transferencia' ) echo 'Selected';
								 ?>>Transferencia</option>
								<option value="Comodato" <?php if( $row2[ 'Adquisicion']=='Comodato' ) echo 'Selected'; ?>>Comodato</option>
								<option value="Arrendamiento" <?php if( $row2[ 'Adquisicion']=='Arrendamiento' ) echo 'Selected';
								 ?>>Arrendamiento</option>
								<option value="Prestamo" <?php if( $row2[ 'Adquisicion']=='Prestamo' ) echo 'Selected'; ?>>Prestamo</option>
								<option value="Otro" <?php if( $row2[ 'Adquisicion']=='Otro' ) echo 'Selected'; ?>>Otro</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label ml-4">Unidad Optica:</label>
						<div class="col-sm-4">
							<select class="form-control" id="unidadOptic" name="unidadOptica">
								<option value="SI" <?php if( $row2[ 'UnidadOptica']=='SI' ) echo 'Selected'; ?>>SI</option>
								<option value="NO" <?php if( $row2[ 'UnidadOptica']=='NO' ) echo 'Selected'; ?>>NO</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label ml-4">Bosinas:</label>
						<div class="col-sm-4">
							<select class="form-control" id="Bosinas" name="bocinas">
								<option value="SI" <?php if( $row2[ 'Bosinas']=='SI' ) echo 'Selected'; ?>>SI</option>
								<option value="NO" <?php if( $row2[ 'Bosinas']=='NO' ) echo 'Selected'; ?>>NO</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label ml-4">Puerto Serial:</label>
						<div class="col-sm-4">
							<select class="form-control" id="p_Serial" name="P_serial">
								<option value="SI" <?php if( $row2[ 'P_Serial']=='SI' ) echo 'Selected'; ?>>SI</option>
								<option value="NO" <?php if( $row2[ 'P_Serial']=='NO' ) echo 'Selected'; ?>>NO</option>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label ml-4">Puertos Paralelos:</label>
						<div class="col-sm-4">
							<select class="form-control" id="p_paralelos" name="P_paralelo">
								<option value="SI" <?php if( $row2[ 'P_Paralelo']=='SI' ) echo 'Selected'; ?>>SI</option>
								<option value="NO" <?php if( $row2[ 'P_Paralelo']=='NO' ) echo 'Selected'; ?>>NO</option>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label ml-4">Puertos USB:</label>
						<div class="col-sm-1">
							<select class="form-control" id="p_usb" name="P_usb">
								<option value='<?php echo $row2[' P_USB ']?>'>
									<?php echo $row2['P_USB']?>
								</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
								<option value="13">13</option>
								<option value="14">14</option>
								<option value="15">15</option>
								<option value="16">16</option>
								<option value="17">17</option>
								<option value="18">18</option>
								<option value="19">19</option>
								<option value="20">20</option>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label ml-4">Tipo de Red:</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="red_tipo" name="red_tipo" value="<?php echo $row2['RedTipo']; ?>"
							 require>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label ml-4">IP:</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="ip" name="ip" value="<?php echo $row2['IP']; ?>"
							 require>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label ml-4">MAC ETHERNET:</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="MacEth" name="MacEth" value="<?php echo $row2['MacEth']; ?>"
							 require>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label ml-4">MAC WIFI:</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="MacWifi" name="MacWifi" value="<?php echo $row2['Mac_wifi']; ?>"
							 require>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label ml-4">Dominio:</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="Dominio" name="Dominio" value="<?php echo $row2['Dominio']; ?>"
							 require>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label ml-4">Antivirus:</label>
						<div class="col-sm-4">
							<select class="form-control" id="Antivirus" name="Antivirus">
								<option value="SI" <?php if( $row2[ 'Antivirus']=='SI' ) echo 'Selected'; ?>>SI</option>
								<option value="NO" <?php if( $row2[ 'Antivirus']=='NO' ) echo 'Selected'; ?>>NO</option>
							</select>
						</div>
					</div>




					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<a href="index.php" class="btn btn-default">Regresar</a>
							<button type="submit" class="btn btn-primary">Actualizar</button>
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