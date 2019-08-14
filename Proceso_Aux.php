<?php
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
$pc=$_POST['Id_cpu'];

$Auxiliares = $_POST['Id_Aux'];

foreach($Auxiliares as $Auxiliar){
    $valor = "'".$Auxiliar."','$pc'";
    $Auxiliares_aux[] = $valor;
}
$valores = implode('),( ', $Auxiliares_aux);
$sql_valores = "(" .$valores. ")";

//echo 'INSERT INTO `cpu_aux`(`Id_Aux`, `Id_CPU`) VALUES ' . $sql_valores;

$sqlpc_Aux="INSERT INTO `cpu_aux`(`Id_Aux`, `Id_CPU`) VALUES ". $sql_valores.";";
$insertar=$mysqli->query($sqlpc_Aux);


foreach($Auxiliares as $Aux){
    $valor2 = "'".$Aux."'";
    $Auxiliares_aux2[] = $valor2;
}
$valores2 = implode('or IdAux=', $Auxiliares_aux2);
$sql_Update = "IdAux=" .$valores2. "";
//echo 'UPDATE `auxiliares` SET Asignado=´SI´ WHERE ' . $sql_Update;
$sqlpc_AuxModi="UPDATE `auxiliares` SET Asignado='SI' WHERE ". $sql_Update.";";
$Modifica=$mysqli->query($sqlpc_AuxModi);

echo'<script type="text/javascript">
    window.location.href="registroEquipoComputo.php";
	</script>';
?>