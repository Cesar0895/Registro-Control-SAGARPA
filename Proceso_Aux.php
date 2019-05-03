<?php
require 'conexion.php';

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