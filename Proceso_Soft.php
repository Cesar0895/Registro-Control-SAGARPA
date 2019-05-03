<?php
require 'conexion.php';

$pc=$_POST['Id_cpu'];

$Softwares = $_POST['Id_sof'];

foreach($Softwares as $Software){
    $valor = "'".$Software."','$pc'";
    $Softwares_aux[] = $valor;
}
$valores = implode('),( ', $Softwares_aux);
$sql_valores = "(" .$valores. ")";

//echo 'INSERT INTO `cpu_soft`(`id_Software`, `Id_CPU`) VALUES ' . $sql_valores;

$sqlpc_Aux="INSERT INTO `cpu_soft`(`id_Software`, `Id_CPU`) VALUES ". $sql_valores.";";
$insertar=$mysqli->query($sqlpc_Aux);

foreach($Softwares as $Software){
    $valor2 = "'".$Software."'";
    $Softwares_aux2[] = $valor2;
}
$valores2 = implode('or id_Software=', $Softwares_aux2);
$sql_Update = "id_Software=" .$valores2. "";
//echo 'UPDATE `auxiliares` SET Asignado=´SI´ WHERE ' . $sql_Update;
$sqlpc_SoftModi="UPDATE `software` SET Asignado='SI' WHERE ". $sql_Update.";";
$Modifica=$mysqli->query($sqlpc_SoftModi);

echo'<script type="text/javascript">
    window.location.href="registroEquipoComputo.php";
	</script>';

?>