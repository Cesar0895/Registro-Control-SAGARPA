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
		$T_Red = $_GET['T_red'];
		$ip = $_GET['ip'];
		$MacEth = $_GET['MacEth'];
		$MacWifi = $_GET['MacWifi'];
		$Dominio = $_GET['Dominio'];
		$Antivirus = $_GET['Antivirus'];
		$CA = $_GET['CA'];
		$PS2 = $_GET['PS2'];

		$Folio = $_GET['folio'];
		$idZona=$_GET['idZona'];
		$RFC = $_GET['RFC'];
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
		$Ubicacion=$_GET['ubicacion'];
		$FechaLlenado=$_GET['fechaLlenado'];
		$OficioMexico=$_GET['oficioMexico'];
		$ContraAdmin=$_GET['contraAdmin'];
		$id_CPU=$_GET['id_CPU'];
		$id_Monitor=$_GET['id_Monitor'];
		$id_Mouse=$_GET['id_Mouse'];
		$id_Teclado=$_GET['id_Teclado'];

		$id_pc=$_GET['id_pc'];
		$Id_soft=$_GET['Id_sof'];

		//$Id_cpu=$_GET['Id_cpu'];
		//$Id_aux=$_GET['Id_Aux'];		


		if ($seriepc!=null) {
            $sqlpc= "INSERT INTO cpu (Id_Marca, `Id_Modelo`, `Id_Procesador`, `Id_MemoriaRam`, `Id_DD`, `Id_Velocidad`, `Serie`, `Invetario`, `Adquisicion`, `UnidadOptica`, `Bosinas`, `P_USB`, `P_Serial`, `P_Paralelo`, `RedTipo`, `IP`, `MacEth`, `Mac_wifi`, `Dominio`, `Antivirus`,CA, PS2,T_Red) VALUES ('$id_Marcapc','$id_Modelopc','$id_procesador','$idMemoriaRam','$id_DD','$id_velocidad','$seriepc','$inventariopc','$adquipc','$unidadOptica','$bocinas','$P_usb','$P_serial','$P_paralelo','$Red_tipo','$ip','$MacEth','$MacWifi','$Dominio','$Antivirus','$CA','$PS2','$T_Red')";
            $mysqli->query($sqlpc);

            
		}

		if ($id_pc!=null) {
			$sqlpc_Soft= "INSERT INTO `cpu_soft`(`id_Software`, `Id_CPU`) VALUES ('$Id_soft','$id_pc')";

			$sqlAsigna="UPDATE `software` SET Asignado='SI' WHERE id_Software='$Id_soft'";
			
			$mysqli->query($sqlAsigna);
			$mysqli->query($sqlpc_Soft);

			

            if ($id_pc=1) {
                echo'<script type="text/javascript">
						alert("Registro guardado");
						window.location.href="registroEquipoComputo.php";
						</script>';
			}else{
			echo'<script type="text/javascript">
						alert("Registro NO guardado");
						window.location.href="registroEquipoComputo.php";
						</script>';
			}
            
		}

		$whereSoft = "";
	
		if(!empty($_POST))
		{
			$valor2 = $_POST['campo'];
		
			if(!empty($valor2)){
				$whereSoft = "and (Licencia like '$valor2%' or Nombre like '$valor2%')";
			}
		}

		$sqlmostrarsoft = "SELECT * FROM `software` WHERE ((Licencia='OEM' and Asignado='No') or Licencia='Corporativa') $whereSoft";
		$resultadoTablasoft = $mysqli->query($sqlmostrarsoft);

	
		//$sqlpc_Aux="INSERT INTO `cpu_aux`(`Id_Aux`, `Id_CPU`) VALUES '. $sql_valores.'";
		//$insertar=$mysqli->query($sqlpc_Aux);

/*
		if ($pc!=null && $Auxiliares>0) {
			foreach($Auxiliares as $Auxiliar){
				$valor = "'".$Auxiliar."','$pc'";
				$Auxiliares_aux[] = $valor;
			}
			$valores = implode('),( ', $Auxiliares_aux);
			$sql_valores = "(" .$valores. ")";
	
			echo 'INSERT INTO `cpu_aux`(`Id_Aux`, `Id_CPU`) VALUES ' . $sql_valores;
			$sqlpc_Aux= "INSERT INTO `cpu_aux`(`Id_Aux`, `Id_CPU`) VALUES '. $sql_valores.'";

			$sqlAsignaAux="UPDATE `auxiliares` SET Asignado='SI' WHERE IdAux='$Id_aux'";
			
			$mysqli->query($sqlAsignaAux);
			$mysqli->query($sqlpc_Aux);
  
		}	*/

		$where = "";
	
		if(!empty($_POST))
		{
			$valor = $_POST['campo'];
		
			if(!empty($valor)){
				$where = "and (IdAux LIKE '$valor%' or Nomb_Dispositivo like '$valor%')";
			}
		}

		$sql = "SELECT auxiliares.IdAux, zona.Sigla, auxiliares.Presupuesto, dispositivos.Nomb_Dispositivo, auxiliares.Inventario, marca.Marca, modelo.Modelo, auxiliares.serie, dispositivos.Tipo, auxiliares.Adquisicion, auxiliares.Fecha_adquisicion, auxiliares.Fin_Garantia, auxiliares.DT, auxiliares.Observaciones, auxiliares.Direccion_ip, auxiliares.Mac_Eth, auxiliares.Mac_wifi, auxiliares.estatus,auxiliares.Documento, auxiliares.RFC, auxiliares.Valor, auxiliares.Asignado FROM auxiliares inner join modelo on auxiliares.id_Modelo=modelo.id_Modelo inner join marca on auxiliares.id_Marca=marca.id_Marca inner join dispositivos on auxiliares.Id_dispositivo=dispositivos.Id_Dispositivo inner join zona on auxiliares.Id_zona=zona.id_Zona where Asignado='NO' $where  ORDER BY `auxiliares`.`IdAux` ASC" ;
		$resultadoTabla = $mysqli->query($sql);

		if ($Folio!=null) {
			$sqlgral= "INSERT INTO `equipos`(`Folio`, `Id_Zona`, `RFC`,`Filtrado`, `Identificacion`, `RFC_Usuario`,`Nodo`, `Fecha_Adquisicion`, `DT_adquisicion`, `DTB`, `Tipo_HW`, `Folio_Resduardo`, `Observaciones`, `Fin_Garantia`, `Candado`, `Valor`, `Estatus`, `Ubicacion`, `Fecha_Llenado`, `Oficio_Mexico`, `Contra_Admin`, `Id_CPU`, `id_Monitor`, `Id_mouse`, `Id_Teclado`)";
			if ($RFCusuario=="0") {
				$sqlgral .= "VALUES ('$Folio','$idZona','$RFC','$Filtrado','$Identificacion',NULL,'$Nodo','$FechaAdqui','$DTadqui','$DTB','$tipo_HW','$FolioResguardo','$Observaciones','$FinGarantia','$Candado','$Valor','$Estatus','$Ubicacion','$FechaLlenado','$OficioMexico','$ContraAdmin','$id_CPU','$id_Monitor','$id_Mouse','$id_Teclado')";
			} else {
				$sqlgral .= "VALUES ('$Folio','$idZona','$RFC','$Filtrado','$Identificacion','$RFCusuario','$Nodo','$FechaAdqui','$DTadqui','$DTB','$tipo_HW','$FolioResguardo','$Observaciones','$FinGarantia','$Candado','$Valor','$Estatus','$Ubicacion','$FechaLlenado','$OficioMexico','$ContraAdmin','$id_CPU','$id_Monitor','$id_Mouse','$id_Teclado')";
			}
			
			
			$mysqli->query($sqlgral);
			
			
            if ($Folio=1) {
                echo'<script type="text/javascript">
						alert("Registro guardado");
						window.location.href="VistaEquipoComputo.php";
						</script>';
            }
		}

        if ($serie!=null) {
            $sqlmonitor= "INSERT INTO monitor (Serie, id_Marca, Modelo, Inventario, Descripcion, Adquisicion) VALUES ('$serie','$id_Marca','$id_Modelo', '$inventario', '$descripcion', '$adqui')";
            $mysqli->query($sqlmonitor);

            if ($serie=1) {
                echo'<script type="text/javascript">
						alert("Registro guardado");
						window.location.href="registroEquipoComputo.php";
						</script>';
            }
		}

		

		if ($serieTec!=null) {
            $sqlteclado= "INSERT INTO teclado (Serie, Id_Marca, Modelo, Inventario, Descripcion, Adquisicion) VALUES ('$serieTec','$id_MarcaTec','$id_ModeloTec', '$inventarioTec', '$descripcionTec', '$adquiTec')";
            $mysqli->query($sqlteclado);

            if ($serieTec=1) {
                echo'<script type="text/javascript">
						alert("Registro guardado");
						window.location.href="registroEquipoComputo.php";
						</script>';
            }
		}

		
		if ($serieMou!=null) {
            $sqlmouse= "INSERT INTO mouse (Serie, id_Marca, Modelo, Inventario, Descripcion, Adquisicion) VALUES ('$serieMou','$id_MarcaMou','$id_ModeloMou', '$inventarioMou', '$descripcionMou', '$adquiMou')";
            $mysqli->query($sqlmouse);

            if ($serieMou=1) {
                echo'<script type="text/javascript">
						alert("Registro guardado");
						window.location.href="registroEquipoComputo.php";
						</script>';
			}
			
		}

		$sqlPC = "SELECT * FROM `cpu` ORDER BY `Id_CPU` DESC";
		$resultpc2 = $mysqli->query($sql);
		

		
		
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

$sql = "SELECT * FROM modelo";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
    $combobitSinID="";
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) 
    {
        $combobitSinID .="<option value='".$row['Modelo']."'>".$row['Modelo']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
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

$sql = "SELECT * FROM `software` WHERE (Licencia='OEM' and Asignado='NO') or (Licencia='Corporativa') ORDER BY `Nombre` ASC";
$resultsoft = $mysqli->query($sql);
if ($resultsoft->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
    $combobitsoft="";
    while ($row = $resultsoft->fetch_array(MYSQLI_ASSOC)) 
    {
        $combobitsoft .="<option value='".$row['id_Software']."'>".$row['Nombre']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
    }
}
else
{
    echo "No hubo resultados";
}

$sql = "SELECT * FROM `auxiliares` WHERE Asignado='NO' ORDER BY `auxiliares`.`IdAux` ASC";
$resultAux = $mysqli->query($sql);
if ($resultAux->num_rows > 0) //si la variable tiene al menos 1 fila entonces seguimos con el codigo
{
    $combobitAux="";
    while ($row = $resultAux->fetch_array(MYSQLI_ASSOC)) 
    {
        $combobitAux .="<option value='".$row['IdAux']."'>".$row['serie']."</option>"; //concatenamos el los options para luego ser insertado en el HTML
    }
}
else
{
    $combobitAux ="<option>No hay Auxiliares disponibles</option>";
}

$sql = "SELECT RFC, concat(ApePaterno,' ',ApeMaterno,' ',Nombre) as NombCompleto FROM `persona` ORDER BY `NombCompleto` ASC";
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

$sql = "SELECT RFC, concat(ApePaterno,' ',ApeMaterno,' ',Nombre) as NombCompleto FROM `persona` ORDER BY `NombCompleto` ASC";
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
	<br>


	<main role="main" class="container">
		<script type="text/javascript">
			function mostrar() {
				document.getElementById('oculto').style.display = 'block';
			}
		</script>

		<div class="row">
			<div class="col-sm-4">
				<div class="card">
					<div class="card-header bg-info">
						<h4>Registro de equipo</h4>
					</div>
					<div class="card-body"></div>
					<div btn-group-vertical>


						<label>Introduzca los datos de los sigientes dispositivos</label>
						<!-- Button trigger modal -->
						<a type="button" style="width:300px;" class="list-group-item list-group-item-action list-group-item-success" data-toggle="modal"
						 data-target="#datosCPU">
							Datos CPU
						</a>


						<a type="button" style="width:300px;" class="list-group-item list-group-item-action list-group-item-success" data-toggle="modal"
						 data-target="#datosMonitor">
							Datos Monitor
						</a>

						<a type="button" style="width:300px;" class="list-group-item list-group-item-action list-group-item-success" data-toggle="modal"
						 data-target="#datosTeclado">
							Datos Teclado
						</a>

						<a type="button" style="width:300px;" class="list-group-item list-group-item-action list-group-item-success" data-toggle="modal"
						 data-target="#datosMouse">
							Datos Mouse
						</a>

						<br>
						<br>
						<a type="button" style="width:300px;" class="list-group-item list-group-item-action list-group-item-primary" href="AñadeSoft.php">
							Añadir Software
						</a>

						<a type="button" style="width:300px;" class="list-group-item list-group-item-action list-group-item-primary" href="AñadeAux.php">
							Añadir Auxiliar
						</a>

					</div>

				</div>
			</div>
			<div class="col-sm-8">
				<div class="card">
					<div class="card-header bg-info">
						<h4>Datos generales de Inventario</h4>
					</div>

					<div class="card-body">
						<a href="vistaEquipoComputo.php" class="btn btn-success">Ver lista de Equipos registrados</a>
						<form>
							<h4 style="color:red">selecciona un responsable y usuario </h4>
							<div class="form-inline">
								<div class="form-group mb-2	">
									<label>Responsable: </label>
									<select class="form-control" id="rfc" name="RFC">
									<option value="0">Selecciones un Responsable</option>
										<?php echo $combobitrfc; ?>
									</select>
								</div>
								<i class="fas fa-arrow-right mx-5" style="width:50px"></i>
								<div class="form-group mx-sm-3 mb-2">
									<label>Usuario: </label>
									<select class="form-control" id="RFCusuario" name="RFCusuario">
										<option value="0">Selecciones un usuario</option>
										<?php echo $combobitrfcUser; ?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label>Folio</label>
								<input type="number" class="form-control" id="grupo" name='folio' placeholder="Introduce el numero de folio">
							</div>

							<div class="form-group">
								<label>Zona</label>
								<select class="form-control col-sm-10" id="id_zona" name="idZona">
									<?php echo $combobitzona; ?>
								</select>
							</div>

							<h4>Datos Generales</h4>



							<div class="form-group">
								<label>Fecha de filtrado</label>
								<input type="date" class="form-control" id="filtrado" name="filtrado" placeholder="Introduce la fecha de filtrado">
							</div>

							<div class="form-group">
								<label>Identificación</label>
								<input type="text" class="form-control" id="identificacion" name="identificacion" placeholder="Introduce la identificacion">
							</div>

							<div class="form-group">
								<label>Nodo</label>
								<input type="text" class="form-control" id="nodo" name="nodo" placeholder="Introduce el nodo">
							</div>

							<div class="form-group">
								<label>Fecha de adquisición</label>
								<input type="date" class="form-control" id="fechaAdqui" name="fechaAdqui" placeholder="Introduce la fecha de aquisición">
							</div>

							<div class="form-group">
								<label>Dictamen de Adquisición</label>
								<input type="text" class="form-control" id="DTadqui" name="DTadqui" placeholder="Introduce el Dictamen de aquisición">
							</div>

							<div class="form-group">
								<label>Dictamen de Baja</label>
								<input type="text" class="form-control" id="DTB" name="DTB" placeholder="Introduce el diactamen de baja">
							</div>

							<div class="form-group">
								<label>Tipo de hardware</label>
								<input type="text" class="form-control" id="Tipo_HW" name="Tipo_HW" placeholder="introduce el tipo de hw ">
							</div>

							<div class="form-group">
								<label>Folio resguardo</label>
								<input type="text" class="form-control" id="folioResguardo" name="folioResguardo" placeholder="Introduce el Folio de Resguarda">
							</div>
							<div class="form-group">
								<label>Obsevaciones</label>
								<div class="col-sm-10">
									<textarea class="form-control" rows=5 id="Obsrvaciones" name="observaciones" placeholder="Observaciones"></textarea>
								</div>
							</div>

							<div class="form-group">
								<label>Fin de garantia</label>
								<input type="date" class="form-control" id="finGarantia" name="finGarantia" placeholder="Introduce el fin de la garantia">
							</div>

							<fieldset class="form-group">
								<div class="row">
									<legend class="col-form-label col-sm-3 pt-0">Candado</legend>
									<div class="col-sm-9">
										<div class="form-check">
											<input class="form-check-input" type="radio" name="candado" id="candado" value="SI" checked>
											<label class="form-check-label" for="gridRadios1">
												SI
											</label>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="radio" name="candado" id="candado" value="NO">
											<label class="form-check-label" for="gridRadios2">
												NO
											</label>
										</div>

									</div>
								</div>
							</fieldset>

							<div class="form-group">
								<label>Valor</label>
								$
								<input type="number" class="form-control" id="valor" name="valor" placeholder="introduce el valor del equipo">
							</div>

							<div class="form-group">
								<label>Estatus</label>
								<select class="form-control" id="estatus" name="estatus">
									<option value="Bueno">Bueno</option>
									<option value="Regular">Regular</option>
									<option value="Malo">Malo</option>
									<option value="Otro">Otro</option>
								</select>

							</div>

							<div class="form-group">
								<label>Ubicación</label>
								<input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Introduce la ubicación del equipo ">
							</div>

							<div class="form-group">
								<label>Fecha de llenado: </label>

								<input type="date" class="form-control" id="fechaLlenado" name="fechaLlenado" value="<?php echo date("Y-m-d"); ?>">
							</div>

							<div class="form-group">
								<label>Oficio Mexico</label>
								<input type="text" class="form-control" id="oficioMexico" name="oficioMexico" placeholder="">
							</div>

							<div class="form-group">
								<label>Contraseña Administrador</label>
								<input type="text" class="form-control" id="contraAdmin" name="contraAdmin" placeholder="Introduce la contraseña de administrador">
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



							<button type="submit" class="btn btn-primary">Guardar</button>
						</form>



						<!-- Modal Datos CPU-->
						<div class="modal fade" id="datosCPU" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
						 aria-hidden="true">
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

											<a href="vistaCPU.php" class="btn btn-success">Ver lista de CPU registrados</a>

											<br>
											<br>

											<div class="form-group">
												<label>No_Serie</label>
												<input type="text" class="form-control" id="serie" name="Seriepc" placeholder="Introduce el no. de serie">
											</div>

											<div class="form-group">
												<label>No. de inventario</label>
												<input type="number" class="form-control" id="inventariopc" name="inventariopc" placeholder="Introduce el no. de inventario">
											</div>

											<div class="form-group">
												<label>Marca</label>
												<select class="form-control" id="marca" name="id_Marcapc">
													<?php echo $combobitmarca; ?>
												</select>
											</div>

											<div class="form-group">
												<label>Modelo</label>

												<select class="form-control" id="modelo" name="id_Modelopc">
													<?php echo $combobit; ?>
												</select>
											</div>

											<div class="form-group">
												<label>Procesador</label>
												<select class="form-control" id="id_procesador" name="id_procesador">
													<?php echo $combobitpro; ?>
												</select>
											</div>
											<div class="form-group">
												<label>MemoriaRam</label>
												<select class="form-control" id="idMemoriaRam" name="idMemoriaRam">
													<?php echo $combobitram; ?>
												</select>
											</div>
											<div class="form-group">
												<label>Disco Duro</label>
												<select class="form-control" id="id_DD" name="id_DD">
													<?php echo $combobitDD; ?>
												</select>
											</div>
											<div class="form-group">
												<label>Velocidad</label>
												<select class="form-control" id="id_velocidad" name="id_velocidad">
													<?php echo $combobitvel; ?>
												</select>
											</div>

											<div class="form-group">
												<label>Tipo de adquisición</label>
												<select class="form-control" id="adquipc" name="adquipc">
													<option value="Compra">Compra</option>
													<option value="Transferencia">Transferencia</option>
													<option value="Comodato">Comodato</option>
													<option value="Arrendamiento">Arrendamiento</option>
													<option value="Prestamo">Prestamo</option>
													<option value="Otro">Otro</option>
												</select>
											</div>


											<fieldset class="form-group">
												<div class="row">
													<legend class="col-form-label col-sm-4 pt-0">Unidad Optica</legend>
													<div class="col-sm-8">
														<select  class="form-control" name="unidadOptica" id="unidadOptica">
															<option value="0">Seleccione una opcion</option>
															<option value="DVD">DVD</option>
															<option value="DVD-RW">DVD-RW</option>
															<option value="DVD-RW">CD-RW</option>
														</select>

													</div>
												</div>
											</fieldset>
											<fieldset class="form-group">
												<div class="row">
													<legend class="col-form-label col-sm-3 pt-0">Bocinas</legend>
													<div class="col-sm-9">
														<div class="form-check">
															<input class="form-check-input" type="radio" name="bocinas" id="bocinas" value="SI" checked>
															<label class="form-check-label" for="gridRadios1">
																SI
															</label>
														</div>

														<div class="form-check">
															<input class="form-check-input" type="radio" name="bocinas" id="bocinas" value="NO">
															<label class="form-check-label" for="gridRadios2">
																NO
															</label>
														</div>


													</div>
												</div>
											</fieldset>
											<fieldset class="form-group">
												<div class="row">
													<legend class="col-form-label col-sm-3 pt-0">Puerto serial</legend>
													<div class="col-sm-9">
														<div class="form-check">
															<input class="form-check-input" type="radio" name="P_serial" id="P_serial" value="SI" checked>
															<label class="form-check-label" for="gridRadios1">
																SI
															</label>
														</div>
														<div class="form-check">
															<input class="form-check-input" type="radio" name="P_serial" id="P_serial" value="NO">
															<label class="form-check-label" for="gridRadios2">
																NO
															</label>
														</div>

													</div>
												</div>
											</fieldset>
											<fieldset class="form-group">
												<div class="row">
													<legend class="col-form-label col-sm-3 pt-0">Puertos Paralelos</legend>
													<div class="col-sm-9">
														<div class="form-check">
															<input class="form-check-input" type="radio" name="P_paralelo" id="P_paralelo" value="SI" checked>
															<label class="form-check-label" for="gridRadios1">
																SI
															</label>
														</div>
														<div class="form-check">
															<input class="form-check-input" type="radio" name="P_paralelo" id="P_paralelo" value="NO">
															<label class="form-check-label" for="gridRadios2">
																NO
															</label>
														</div>

													</div>
												</div>
											</fieldset>

											<div class="form-group">
												<label>Puertos USB</label>
												<select class="custom-select mr-sm-2" id="P_usb" name="P_usb">

													<option>1</option>
													<option>2</option>
													<option>3</option>
													<option>4</option>
													<option>5</option>
													<option>6</option>
													<option>7</option>
													<option>8</option>
													<option>9</option>
													<option>10</option>
													<option>11</option>
													<option>12</option>
													<option>13</option>
													<option>14</option>
													<option>15</option>
													<option>16</option>
													<option>17</option>
													<option>18</option>
													<option>19</option>
													<option>20</option>
												</select>
											</div>
											<div class="form-group">
												<label>Tarjeta de red</label>
												<input type="text" class="form-control" id="T_Red" name="T_Red" placeholder="Introduce el tipo de tarjeta red">
											</div>
											<div class="form-group">
												<label>Tipo de red</label>
												<input type="text" class="form-control" id="red_tipo" name="red_tipo" placeholder="Introduce el tipo de red">
											</div>
											<div class="form-group">
												<label>IP</label>
												<input type="text" class="form-control" id="ip" name="ip" placeholder="Introduce la ip">
											</div>
											<div class="form-group">
												<label>Mac Ethernet</label>
												<input type="text" class="form-control" id="MacEth" name="MacEth" placeholder="Introduce la mac ethernet">
											</div>
											<div class="form-group">
												<label>Mac Wifi</label>
												<input type="text" class="form-control" id="MacWifi" name="MacWifi" placeholder="Introduce la mac wifi">
											</div>
											<div class="form-group">
												<label>Dominio</label>
												<input type="text" class="form-control" id="Dominio" name="Dominio" placeholder="Introduce el dominio">
											</div>

											<fieldset class="form-group">
												<div class="row">
													<legend class="col-form-label col-sm-3 pt-0">Antivirus</legend>
													
														<input type="text" class="form-control" id="Antivirus" name="Antivirus" placeholder="Nombre y version de antivirus">

												</div>
											</fieldset>
											<div class="form-group">
												<label>ADAPTADOR CA</label>
												<input type="text" class="form-control" id="CA" name="CA" placeholder="Introduce el ADAPTADOR CA">
											</div>
											<div class="form-group">
												<label>PS2</label>
												<select class="custom-select mr-sm-2" id="PS2" name="PS2">

													<option>1</option>
													<option>2</option>
													<option>3</option>
													<option>4</option>
													<option>5</option>
													<option>6</option>

												</select>
											</div>

											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

											<button type="submit" class="btn btn-primary">Guardar</button>


										</form>
									</div>



								</div>
							</div>
						</div>

						<!-- Modal Datos Software de CPU-->
						<div class="modal fade" id="DatosSoft" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
						 aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Añadir Software al equipo</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form>

											<div class="form-group">
												<label>Numero de serie del CPU</label>
												<select class="form-control col-sm-10" id="id_CPU" name="id_pc">
													<?php echo $combobitpc ?>
												</select>
											</div>
											<div class="form-group">
												<label>Software</label>
												<select class="form-control col-sm-10" id="Id_soft" name="Id_sof">
													<?php echo $combobitsoft; ?>
												</select>
											</div>

											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

											<button type="submit" class="btn btn-primary">Guardar</button>
										</form>
									</div>
								</div>
							</div>
						</div>

						<!-- Modal Datos Auxiliares de CPU-->
						<div class="modal fade" id="DatosAux" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
						 aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Añadir Software al equipo</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<form>

											<div class="form-group">
												<label>Numero de serie del CPU</label>
												<select class="form-control col-sm-10" id="id_CPU" name="Id_cpu">
													<?php echo $combobitpc ?>
												</select>
											</div>
											<div class="form-group">
												<label>Auxiliar</label>
												<select class="form-control col-sm-10" id="Id_Aux" name="Id_Aux">
													<?php echo $combobitAux; ?>
												</select>
											</div>

											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

											<button type="submit" class="btn btn-primary">Guardar</button>
										</form>
									</div>
								</div>
							</div>
						</div>

						<!-- Modal Datos Monitor-->
						<div class="modal fade" id="datosMonitor" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
						 aria-hidden="true">
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
													<?php echo $combobitSinID; ?>
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
						<div class="modal fade" id="datosTeclado" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
						 aria-hidden="true">
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
													<?php echo $combobitSinID; ?>
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
												<select class="form-control" id="adquisicion" name="AdquisicionTec">
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

									<a href="vistaTeclado.php" class="btn btn-success">Ver lista de Teclados registrados</a>
								</div>
							</div>
						</div>

						<!-- Modal Datos Mouse-->
						<div class="modal fade" id="datosMouse" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
						 aria-hidden="true">
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
													<?php echo $combobitSinID; ?>
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
												<select class="form-control" id="adquisicion" name="AdquisicionMou">
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

									<a href="vistaMouse.php" class="btn btn-success">Ver lista de Mouse registrados</a>
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

<script>
	//$('#DatosSoft').modal('show');//se abre la ventana de nuevo
	//$('#DatosSoft').modal({backdrop: 'static', keyboard: false})
</script>

</html>