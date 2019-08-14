<?php 
    require 'Classes/PHPExcel.php';
    require 'conexion.php';

    $objPHPExcel = new PHPExcel();

    $objPHPExcel->getProperties()
        ->setCreator("SADER")
        ->setLastModifiedBy("SADER")
        ->setTitle("REPORTE INVENTARIO")
        ->setSubject("Documento de prueba")
        ->setDescription("Documento generado con PHPExcel")
        ->setKeywords("excel phpexcel php")
        ->setCategory("Ejemplos");

    // Combino las celdas desde A1 hasta E1
    //$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:BV1');

    $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'EXTENCION')
            ->setCellValue('B1', 'DISPLAY')
            ->setCellValue('C1', 'RFC')
            ->setCellValue('D1', 'INMUEBLE')
            ->setCellValue('E1', 'SITIO')
            ->setCellValue('F1', 'SERIE')
            ->setCellValue('G1', 'MARCA')
            ->setCellValue('H1', 'MODELO')
            ->setCellValue('I1', 'MAC')
            ->setCellValue('J1', 'NODO RED')
            ->setCellValue('K1', 'GPO CAPTURA')
            ->setCellValue('L1', 'NIVEL COR')
            ->setCellValue('M1', 'NIVEL AUT')
            ->setCellValue('N1', 'CODIGO AUT')
            ->setCellValue('O1', 'FUNCION')
            ->setCellValue('P1', 'DID')
            ->setCellValue('Q1', 'CORREO VOZ')
            ->setCellValue('R1', 'MASK')
            ->setCellValue('S1', 'GATEWAY')
            ->setCellValue('T1', 'VLAN')
            ->setCellValue('U1', 'NOTAS')
            ->setCellValue('V1', 'ADQUISICION')
            ->setCellValue('W1', 'ELIMINADOR')
            ->setCellValue('X1', 'F_RESGUARDO')
            ->setCellValue('Y1', 'FECHA RESGUARDO')
            ->setCellValue('Z1', 'OBSERVACIONES')
            ->setCellValue('AA1', 'STATUS');

           
                    
    
    // Fuente de la primera fila en negrita
    $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
    
    $objPHPExcel->getActiveSheet()->getStyle('A1:BV1')->applyFromArray($boldArray);

    $sqlmostrar = "SELECT `Extencion`, `Display`, `RFC`, `Inmueble`, `Sitio`, `Serie`, marca.Marca, modelo.Modelo, `Mac`, `NodoRed`, `GpoCaptura`, `Nivel_Cor`, `Nivel_Aut`, `Codigo_Aut`, `Funcion`, `DID`, `CorreoVoz`, `Puerto`, `Dir_IP`, `Mask`, `Gateway`, `VLAN`, `Notas`, `Adquisicion`, `Eliminador`, `F_Resguardo`, `Fecha_Resguardo`, `Observaciones`, `Estatus` FROM `telefonia` INNER JOIN marca on telefonia.id_Marca=marca.id_Marca INNER JOIN modelo on telefonia.id_Modelo=modelo.id_Modelo ORDER BY `telefonia`.`Extencion` ASC";
    $resultado = $mysqli->query($sqlmostrar);
    
    $cel=2;//Numero de fila donde empezara a crear  el reporte
	while ($row=mysqli_fetch_array($resultado)){
	

        
       

        // Agregar datos
		$objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue("A".$cel, strtoupper($row[0]))
        ->setCellValue("B".$cel, strtoupper($row[1]))
        ->setCellValue("C".$cel, strtoupper($row[2]))
        ->setCellValue("D".$cel, strtoupper($row[3]))
        ->setCellValue("E".$cel, strtoupper($row[4]))
        ->setCellValue("F".$cel, strtoupper($row[5]))
        ->setCellValue("G".$cel, strtoupper($row[6]))
        ->setCellValue("H".$cel, strtoupper($row[7]))
        ->setCellValue("I".$cel, strtoupper($row[8]))
        ->setCellValue("J".$cel, strtoupper($row[9]))
        ->setCellValue("K".$cel, strtoupper($row[10]))
        ->setCellValue("L".$cel, strtoupper($row[11]))
        ->setCellValue("M".$cel, strtoupper($row[12]))
        ->setCellValue("N".$cel, strtoupper($row[13]))
        ->setCellValue("O".$cel, strtoupper($row[14]))
        ->setCellValue("P".$cel, strtoupper($row[15]))
        ->setCellValue("Q".$cel, strtoupper($row[16]))
        ->setCellValue("R".$cel, strtoupper($row[17]))
        ->setCellValue("S".$cel, strtoupper($row[18]))
        ->setCellValue("T".$cel, strtoupper($row[19]))
        ->setCellValue("U".$cel, strtoupper($row[20]))
        ->setCellValue("V".$cel, strtoupper($row[21]))
        ->setCellValue("W".$cel, strtoupper($row[22]))
        ->setCellValue("X".$cel, strtoupper($row[23]))
        ->setCellValue("Y".$cel, strtoupper($row[24]))
        ->setCellValue("Z".$cel, strtoupper($row[25]))
        ->setCellValue("AA".$cel, strtoupper($row[26]));


        $cel+=1;
        
        
    }

    /*Fin extracion de datos MYSQL*/
    //$rango="A2:$d";
    $styleArray = array('font' => array( 'name' => 'Arial','size' => 10),
    'borders'=>array('allborders'=>array('style'=> PHPExcel_Style_Border::BORDER_THIN,'color'=>array('argb' => 'FFF'))));
   //$objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($styleArray);

   header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
   header('Content-Disposition: attachment;filename="Reporte.xlsx"');
   header('Cache-Control: max-age=0');
   $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
   $objWriter->save('php://output');
?>
