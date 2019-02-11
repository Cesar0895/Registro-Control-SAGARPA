<?php

    include 'plantillaPDF.php';
    include 'conexion.php';
    $folio = $_GET['Folio'];        
            
			$sql = "SELECT auxiliares.Folio, zona.Nombre, auxiliares.Presupuesto, dispositivos.Nomb_Dispositivo, auxiliares.Inventario, marca.Marca, modelo.Modelo, auxiliares.serie, dispositivos.Tipo, auxiliares.Adquisicion, auxiliares.Fecha_adquisicion, auxiliares.Fin_Garantia, auxiliares.DT, auxiliares.Observaciones, auxiliares.Direccion_ip, auxiliares.Mac_Eth, auxiliares.Mac_wifi, auxiliares.estatus, auxiliares.RFC, auxiliares.Valor FROM auxiliares inner join modelo on auxiliares.id_Modelo=modelo.id_Modelo inner join marca on auxiliares.id_Marca=marca.id_Marca inner join dispositivos on auxiliares.Id_dispositivo=dispositivos.Id_Dispositivo inner join zona on auxiliares.Id_zona=zona.id_Zona WHERE Folio = '$folio'";
            $resultado = $mysqli->query($sql);

    $pdf=new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();

    $pdf->SetFillColor(232,232,232);
    $pdf->SetFont('Arial','B',12);
    $pdf->cell(30,6,'En construcción... XD',1,0,'C',1);
   
    $pdf->output();


?>