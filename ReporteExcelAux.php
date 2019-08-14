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
            ->setCellValue('A1', 'SERIE-CPU')
            ->setCellValue('B1', 'INVENTARIO-CPU')
            ->setCellValue('C1', 'DISPOSITIVO')
            ->setCellValue('D1', 'TIPO')
            ->setCellValue('E1', 'INVENTARIO-DISP')
            ->setCellValue('F1', 'SERIE-DISP')
            ->setCellValue('G1', 'MODELO-DISP')
            ->setCellValue('H1', 'MARCA-DISP')
            ->setCellValue('I1', 'ADQUISICION-DISP')
            ->setCellValue('J1', 'OBSERVACIONES-DISP');

           
                    
    
    // Fuente de la primera fila en negrita
    $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
    
    $objPHPExcel->getActiveSheet()->getStyle('A1:BV1')->applyFromArray($boldArray);

    $sqlmostrar = "SELECT cpu.Serie, cpu.Invetario as inventario_cpu,dispositivos.Nomb_Dispositivo,dispositivos.Tipo, auxiliares.Inventario,auxiliares.serie,modelo.Modelo, marca.Marca, auxiliares.Adquisicion,auxiliares.Observaciones FROM `cpu_aux` INNER JOIN (auxiliares INNER JOIN dispositivos on auxiliares.Id_dispositivo=dispositivos.Id_Dispositivo INNER JOIN marca on auxiliares.id_Marca=marca.id_Marca INNER JOIN modelo on auxiliares.id_modelo=modelo.id_Modelo) on cpu_aux.Id_Aux=auxiliares.IdAux INNER JOIN cpu on cpu_aux.Id_CPU=cpu.Id_CPU ORDER BY `cpu`.`Serie` ASC";
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
        ->setCellValue("J".$cel, strtoupper($row[9]));


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
