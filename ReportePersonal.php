<?php

    include 'plantillaPDF.php';
    include 'conexion.php';
    $query="SELECT `RFC`, concat( `Nombre`,' ', `ApePaterno`,' ', `ApeMaterno`) as NombreComp, `Adscripcion`, `Area`, `Subarea` FROM `persona`";
    $resultado=$mysqli->query($query);

    $pdf=new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();

    $pdf->SetFillColor(232,232,232);
    $pdf->SetFont('Arial','B',12);
    $pdf->cell(30,6,'RFC',1,0,'C',1);
    $pdf->cell(50,6,'Nombre',1,0,'C',1);
    $pdf->cell(30,6,'Adscripcion',1,0,'C',1);
    $pdf->cell(30,6,'Area',1,0,'C',1);
    $pdf->cell(30,6,'Subarea',1,1,'C',1);
   
    $pdf->SetFont('Arial','',10);
    while ($row = $resultado->fetch_assoc()) 
    {
        $pdf->cell(30,6,$row['RFC'],1,0,'C');
        $pdf->cell(50,6,$row['NombreComp'],1,0,'C');
        $pdf->cell(30,6,$row['Adscripcion'],1,0,'C');
        $pdf->cell(30,6,$row['Area'],1,0,'C');
        $pdf->cell(30,6,$row['Subarea'],1,1,'C');   
    }
    $pdf->output();


?>