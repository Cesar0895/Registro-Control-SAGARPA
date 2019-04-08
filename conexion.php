<?php

$mysqli =  new mysqli ('localhost','root','','inventariosagarpa');

//$mysqli =  new mysqli ('localhost','id8480341_root','contra123','id8480341_inventariosagarpa');


if ($mysqli->connect_error) {
	die('Error en la conexion ' . $mysqli->connect_error);
}

?>