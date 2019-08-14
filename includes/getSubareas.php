<?php 

    include ('../conexion.php');

    $id_area= $_POST['id_area'];

    $queryA="SELECT `IdSubarea`, `NombreSubarea` FROM `subareas` WHERE `Id_Zona`=$id_area ORDER BY `subareas`.`NombreSubarea` ASC";
    $resultadoA=$mysqli->query($queryA);

    $html="<option value='0'> Seleccionar Subarea</option>";


    while ($rowA = $resultadoA->fetch_assoc()) {
        $html .="<option value='".$rowA['NombreSubarea']."'> ".$rowA['NombreSubarea']."</option>";

      
    }

    echo $html;

?>