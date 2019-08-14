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
            ->setCellValue('A1', 'SERIE')
            ->setCellValue('B1', 'INVENTARIO')
            ->setCellValue('C1', 'NOMBRE')
            ->setCellValue('D1', 'VERSION')
            ->setCellValue('E1', 'LICENCIA')
            ->setCellValue('F1', 'KEY')
            ->setCellValue('G1', 'PLATAFORMA')
            ->setCellValue('H1', 'FABRICANTE')
            ->setCellValue('I1', 'ADQUISICION');

            /*
            /////////////////////////////////////////////
            ->setCellValue('H1', 'NOMBRE (Soft-2)')
            ->setCellValue('I1', 'VERSION (Soft-2)')
            ->setCellValue('J1', 'LICENCIA (Soft-2)')
            ->setCellValue('K1', 'KEY (Soft-2)')
            ->setCellValue('L1', 'PLATAFORMA (Soft-2)')
            ->setCellValue('M1', 'FABRICANTE (Soft-2)')
            ->setCellValue('N1', 'ADQUISICION (Soft-2)')
            /////////////////////////////////////////////////
            ->setCellValue('O1', 'NOMBRE (Soft-3)')
            ->setCellValue('P1', 'VERSION (Soft-3)')
            ->setCellValue('Q1', 'LICENCIA (Soft-3)')
            ->setCellValue('R1', 'KEY (Soft-3)')
            ->setCellValue('S1', 'PLATAFORMA (Soft-3)')
            ->setCellValue('T1', 'FABRICANTE (Soft-3)')
            ->setCellValue('U1', 'ADQUISICION (Soft-3)')
            ->setCellValue('V1', 'NOMBRE (Soft-3)')
            ////////////////////////////////////////////
            ->setCellValue('W1', 'VERSION (Soft-4)')
            ->setCellValue('X1', 'LICENCIA (Soft-4)')
            ->setCellValue('Y1', 'KEY (Soft-4)')
            ->setCellValue('Z1', 'PLATAFORMA (Soft-4)')
            ->setCellValue('AA1', 'FABRICANTE (Soft-4)')
            ->setCellValue('AB1', 'ADQUISICION (Soft-4)')
            ->setCellValue('AC1', 'NOMBRE (Soft-5)')
            /////////////////////////////////////////////
            ->setCellValue('AD1', 'VERSION (Soft-5)')
            ->setCellValue('AE1', 'LICENCIA (Soft-5)')
            ->setCellValue('AF1', 'KEY (Soft-5)')
            ->setCellValue('AG1', 'PLATAFORMA (Soft-5)')
            ->setCellValue('AH1', 'FABRICANTE (Soft-5)')
            ->setCellValue('AI1', 'ADQUISICION (Soft-5)')
            ///////////////////////////////////////////////////
            ->setCellValue('AJ1', 'NOMBRE (Soft-6)')
            ->setCellValue('AK1', 'VERSION (Soft-6)')
            ->setCellValue('AL1', 'LICENCIA (Soft-6)')
            ->setCellValue('AM1', 'KEY (Soft-6)')
            ->setCellValue('AN1', 'PLATAFORMA (Soft-6)')
            ->setCellValue('AO1', 'FABRICANTE (Soft-6)')
            ->setCellValue('AP1', 'ADQUISICION (Soft-6)')
            //////////////////////////////////////////////////
            ->setCellValue('AQ1', 'NOMBRE (Soft-7)')
            ->setCellValue('AR1', 'VERSION (Soft-7)')
            ->setCellValue('AS1', 'LICENCIA (Soft-7)')
            ->setCellValue('AT1', 'KEY (Soft-7)')
            ->setCellValue('AU1', 'PLATAFORMA (Soft-7)')
            ->setCellValue('AV1', 'FABRICANTE (Soft-7)')
            ->setCellValue('AW1', 'ADQUISICION (Soft-7)')
            ///////////////////////////////////////////////////
            ->setCellValue('AX1', 'NOMBRE (Soft-8)')
            ->setCellValue('AY1', 'VERSION (Soft-8)')
            ->setCellValue('AZ1', 'LICENCIA (Soft-8)')
            ->setCellValue('BA1', 'KEY (Soft-8)')
            ->setCellValue('BB1', 'PLATAFORMA (Soft-8)')
            ->setCellValue('BC1', 'FABRICANTE (Soft-8)')
            ->setCellValue('BD1', 'ADQUISICION (Soft-8)')
            //////////////////////////////////////////////////
            ->setCellValue('BE1', 'NOMBRE (Soft-9)')
            ->setCellValue('BF1', 'VERSION (Soft-9)')
            ->setCellValue('BG1', 'LICENCIA (Soft-9)')
            ->setCellValue('BH1', 'KEY (Soft-9)')
            ->setCellValue('BI1', 'PLATAFORMA (Soft-9)')
            ->setCellValue('BJ1', 'FABRICANTE (Soft-9)')
            ->setCellValue('BK1', 'ADQUISICION (Soft-9)')
            /////////////////////////////////////////////
            ->setCellValue('BL1', 'NOMBRE (Soft-10)')
            ->setCellValue('BM1', 'VERSION (Soft-10)')
            ->setCellValue('BN1', 'LICENCIA (Soft-10)')
            ->setCellValue('BO1', 'KEY (Soft-10)')
            ->setCellValue('BP1', 'PLATAFORMA (Soft-10)')
            ->setCellValue('BQ1', 'FABRICANTE (Soft-10)')
            ->setCellValue('BR1', 'ADQUISICION (Soft-10)');*/
                    
    
    // Fuente de la primera fila en negrita
    $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
    
    $objPHPExcel->getActiveSheet()->getStyle('A1:BV1')->applyFromArray($boldArray);

    $sqlmostrar = "SELECT cpu.Serie,cpu.Invetario,software.Nombre,software.Version, software.Licencia, software.Key_soft, software.Plataforma, software.Fabricante, software.Adquisicion FROM `cpu_soft` 
    INNER JOIN cpu on cpu_soft.Id_CPU=cpu.Id_CPU
    INNER join software on cpu_soft.id_Software=software.id_Software ORDER BY  cpu.Serie";
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
        ->setCellValue("I".$cel, strtoupper($row[8]));


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
