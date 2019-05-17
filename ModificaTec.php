<?php	
			
			error_reporting(E_ALL & ~E_NOTICE);
			error_reporting(E_ERROR | E_PARSE);
			require 'conexion.php';

			$idTec=$_GET['Id_Teclado'];
			$serieTec = $_GET['SerieTec'];
			$id_MarcaTec = $_GET['id_MarcaTec'];
			$id_ModeloTec = $_GET['id_ModeloTec'];
			$inventarioTec = $_GET['InventarioTec'];
			$descripcionTec = $_GET['DescripcionTec'];
			$adquiTec = $_GET['AdquisicionTec'];            
        

            if ($serieTec!=null) {
				$sql2= "UPDATE teclado SET Serie='$serieTec',Id_Marca='$id_MarcaTec',IdModelo='$id_ModeloTec', Descripcion='$descripcionTec', Inventario='$inventarioTec', Adquisicion='$adquiTec' WHERE Id_Teclado='$idTec'";
				
                $mysqli->query($sql2);
    
				if ($idTec=1) {
					echo'<script type="text/javascript">
			alert("Registro actualizado!");
			window.location.href="vistaTeclado.php"	;
			</script>';
                
                }
			}
			
?>
<?php
require 'conexion.php';

			$idTec=$_GET['Id_Teclado'];       
            
			$sql = "SELECT t.Id_Teclado, t.Serie, t.Inventario, t.Descripcion, t.Adquisicion, marca.Marca, marca.id_Marca, modelo.Modelo, modelo.id_Modelo FROM teclado t 
			INNER JOIN marca ON t.Id_Marca=marca.id_Marca 
			INNER JOIN modelo on t.IdModelo=modelo.id_Modelo where Id_Teclado='$idTec'";
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
						<input type="hidden" class="form-control" id="Id_Teclado" name="Id_Teclado" placeholder="id" value="<?php echo $row2['Id_Teclado']; ?>"
						 required>
					</div>


					<div class="form-group row">
						<label class="col-sm-2 col-form-label ml-4">Serie:</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="SerieTec" name="SerieTec" value="<?php echo $row2['Serie']; ?>"
							 require>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label ml-4">No. Inventario:</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="InventarioTec" name="InventarioTec" value="<?php echo $row2['Inventario']; ?>"
							 require>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label ml-4">Marca:</label>
						<div class="col-sm-4">
							<select class="form-control" id="id_MarcaTec" name="id_MarcaTec">
								<option value='<?php echo $row2[' id_Marca ']?>'>
									<?php echo $row2['Marca']?>
								</option>
								<?php echo $combobitmarca; ?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label ml-4">Modelo:</label>
						<div class="col-sm-4">
							<select class="form-control" id="id_ModeloTec" name="id_ModeloTec">
								<option value='<?php echo $row2[' id_Modelo ']?>'>
									<?php echo $row2['Modelo']?>
								</option>
								<?php echo $combobit; ?>
							</select>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label ml-4">Descripción:</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="DescripcionTec" name="DescripcionTec" value="<?php echo $row2['Descripcion']; ?>"
							 require>
						</div>
					</div>

					<div class="form-group row">
						<label class="col-sm-2 col-form-label ml-4">Adquisicion:</label>
						<div class="col-sm-4">
							<select class="form-control" id="AdquisicionTec" name="AdquisicionTec">
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