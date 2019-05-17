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
            ->setCellValue('A1', 'FOLIO')
            ->setCellValue('B1', 'ZONA')
            ->setCellValue('C1', 'RFC-RESPONSABLE')
            ->setCellValue('D1', 'NOMB-RESPONSABLE')
            ///////////////////////////////// DATOS PERSONAS
            ->setCellValue('E1', 'TELEFONO')
            ->setCellValue('F1', 'DOMICILIO')
            ->setCellValue('G1', 'ADSCRIPCION')
            ->setCellValue('H1', 'AREA')
            ->setCellValue('I1', 'SUBAREA')
            ->setCellValue('J1', 'PUESTO')
            ->setCellValue('K1', 'EXTENSION')
            ->setCellValue('L1', 'CORREO')
            ->setCellValue('M1', 'GFC')
            ->setCellValue('N1', 'ACCESO-CORREO')
            ->setCellValue('O1', 'ESTATUS')
            //////////////////////////////////// DATOS EQUIPO
            ->setCellValue('P1', 'FILTRADO')
            ->setCellValue('Q1', 'IDENTIFICACION')
            ->setCellValue('R1', 'RFC-USUARIO')
            ->setCellValue('S1', 'NOMB-USUARIO')
            ->setCellValue('T1', 'NODO')
            ->setCellValue('U1', 'FECHA-ADQUI')
            ->setCellValue('V1', 'DT-ADQUI')
            ->setCellValue('W1', 'DTB')
            ->setCellValue('X1', 'TIPO-HW')
            ->setCellValue('Y1', 'FOLIO-RESGUARDO')
            ->setCellValue('Z1', 'OBSERVACIONES')
            ->setCellValue('AA1', 'FIN-GARANTIA')
            ->setCellValue('AB1', 'CANDADO')
            ->setCellValue('AC1', 'VALOR')
            ->setCellValue('AD1', 'ESTATUS-EQUIPO')
            ->setCellValue('AE1', 'UBICACION')
            ->setCellValue('AF1', 'FECHA-LLENADO')
            ->setCellValue('AG1', 'OFICIO-MX')
            ->setCellValue('AH1', 'CONTRA-ADMIN')
            //////////////////////////////DATOS-CPU
            ->setCellValue('AI1', 'SERIE-CPU')
            ->setCellValue('AJ1', 'MARCA-CPU')
            ->setCellValue('AK1', 'MODELO-CPU')
            ->setCellValue('AL1', 'INVENTARIO-CPU')
            ->setCellValue('AM1', 'PROCESADOR')
            ->setCellValue('AN1', 'RAM')
            ->setCellValue('AO1', 'DD')
            ->setCellValue('AP1', 'VELOCIDAD')
            ->setCellValue('AQ1', 'IP')
            ->setCellValue('AR1', 'MAC-ETH')
            ->setCellValue('AS1', 'MAC-WIFI')
            ->setCellValue('AT1', 'DOMINIO')
            ->setCellValue('AU1', 'RED-TIPO')
            ->setCellValue('AV1', 'ADQUISICION')
            ->setCellValue('AW1', 'BOSINAS')
            ->setCellValue('AX1', 'P-USB')
            ->setCellValue('AY1', 'P-SERIAL')
            ->setCellValue('AZ1', 'P-PARALELO')
            ->setCellValue('BA1', 'ANTIVIRUS')
            ->setCellValue('BB1', 'AC')
            ->setCellValue('BC1', 'PS2')
            ->setCellValue('BD1', 'Unida Optica')
            ///////////////////////////DATOS MONITOR
            ->setCellValue('BE1', 'SERIE-MONI')
            ->setCellValue('BF1', 'MARCA-MONI')
            ->setCellValue('BG1', 'MODELO-MONI')
            ->setCellValue('BH1', 'INVENTARIO-MONI')
            ->setCellValue('BI1', 'DESC-MONI')
            ->setCellValue('BJ1', 'ADQUI-MONI')
            /////////////////////////////DATOS MOUSE
            ->setCellValue('BK1', 'SERIE-MOUSE')
            ->setCellValue('BL1', 'MARCA-MOUSE')
            ->setCellValue('BM1', 'MODELO-MOUSE')
            ->setCellValue('BN1', 'INVENTARIO-MOUSE')
            ->setCellValue('BO1', 'DESC-MOUSE')
            ->setCellValue('BP1', 'ADQUI-MOUSE')
            ////////////////////////////////DATOS TECLADO
            ->setCellValue('BQ1', 'SERIE-TEC')
            ->setCellValue('BR1', 'MARCA-TEC')
            ->setCellValue('BS1', 'MODELO-TEC')
            ->setCellValue('BT1', 'INVENTARIO-TEC')
            ->setCellValue('BU1', 'DESC-TEC')
            ->setCellValue('BV1', 'ADQUI-TEC');
                    
    
    // Fuente de la primera fila en negrita
    $boldArray = array('font' => array('bold' => true,),'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
    
    $objPHPExcel->getActiveSheet()->getStyle('A1:BV1')->applyFromArray($boldArray);

    $sqlmostrar = "SELECT `Folio`, zona.Nombre, zona.Sigla, concat(persona.Nombre,' ',persona.ApePaterno,' ',persona.ApeMaterno) as nombResp, persona.RFC,persona.Telefono,persona.Domicilio,persona.Adscripcion,persona.Area,persona.Subarea,persona.Puesto,persona.Extension,persona.Correo,persona.GFC,persona.Acceso_correo,persona.Estatus, Filtrado,`Identificacion`, concat(p.Nombre,' ',p.ApePaterno,' ',p.ApeMaterno) as nombUser,p.RFC as RFCUser, `Nodo`, `Fecha_Adquisicion`, `DT_adquisicion`, `DTB`, `Tipo_HW`, `Folio_Resduardo`, `Observaciones`, `Fin_Garantia`, `Candado`, `Valor`,equipos.Estatus as estatus_Equi, `Ubicacion`, `Fecha_Llenado`, `Oficio_Mexico`, `Contra_Admin`, 
			
    cpu.Serie as serieCPU, marCPU.Marca as marcaCPU, modCPU.Modelo as modCPU, cpu.Invetario as InvCPU, proCPU.Procesador,ram.Memoria_RAM, DD.Almacenamiento, vel.Velocidad, cpu.IP,cpu.MacEth,cpu.Mac_wifi,cpu.Dominio, cpu.RedTipo, cpu.Adquisicion,CPU.Bosinas, CPU.P_USB, CPU.P_Serial, CPU.P_Paralelo, cpu.Antivirus, cpu.CA, cpu.PS2,cpu.UnidadOptica,
    
    monitor.Serie as serieMon, marMoni.Marca as marcaMoni, modMoni.Modelo as modMoni, monitor.Inventario as InvMoni, monitor.Descripcion as desMoni ,monitor.Adquisicion as adquiMoni,
    
    mouse.Serie as serieMou, marMou.Marca as marcaMou, modMou.Modelo as modMou, mouse.Inventario as InvMou, mouse.Descripcion as desMou, mouse.Adquisicion as adquiMou,
    
    teclado.Serie as serieTec, marTec.Marca as marcaTec, modTec.Modelo as modTec, teclado.Inventario as InvTec, teclado.Descripcion as desTec, teclado.Adquisicion adquiTec
    FROM `equipos`
    INNER JOIN zona on equipos.Id_Zona=zona.id_Zona 
    INNER JOIN persona on equipos.RFC=persona.RFC 
    INNER JOIN persona p on equipos.RFC_Usuario=p.RFC 
    INNER JOIN (cpu 
                INNER JOIN marca marCPU on cpu.Id_Marca=marCPU.id_Marca
                INNER JOIN modelo modCPU on cpu.Id_Modelo=modCPU.id_Modelo
                INNER JOIN procesador proCPU on cpu.Id_Procesador=proCPU.id_Procesador
                INNER JOIN memoria_ram ram on cpu.Id_MemoriaRam=ram.Id_Memoria
                INNER JOIN disco_duro DD on cpu.Id_DD=DD.id_DD
                INNER JOIN velocidad vel on cpu.Id_Velocidad=vel.Id_velocidad) 
                on equipos.Id_CPU=cpu.Id_CPU 
    INNER JOIN (monitor 
                INNER JOIN marca marMoni on monitor.id_Marca=marMoni.id_Marca 
                INNER JOIN modelo modMoni on monitor.id_Modelo=modMoni.id_Modelo)
                on equipos.id_Monitor=monitor.id_Monitor
    INNER JOIN (mouse 
                INNER JOIN marca marMou on mouse.Id_Marca=marMou.id_Marca 
                INNER JOIN modelo modMou on mouse.Id_Modelo=modMou.id_Modelo) 
                ON equipos.Id_mouse=mouse.Id_mouse 
    INNER JOIN (teclado 
                INNER JOIN marca marTec on teclado.Id_Marca=marTec.id_Marca 
                INNER JOIN modelo modTec on teclado.IdModelo=modTec.id_Modelo) 
                on equipos.Id_Teclado=teclado.Id_Teclado";
    $resultado = $mysqli->query($sqlmostrar);
    
    $cel=2;//Numero de fila donde empezara a crear  el reporte
	while ($row=mysqli_fetch_array($resultado)){
	

        
       

        // Agregar datos
		$objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue("A".$cel, strtoupper($row['Folio']))
        ->setCellValue("B".$cel, strtoupper($row['Sigla']))
        ->setCellValue("C".$cel, strtoupper($row['RFC']))
        ->setCellValue("D".$cel, strtoupper($row['nombResp']))
        ->setCellValue("E".$cel, strtoupper($row['Telefono']))
        ->setCellValue("F".$cel, strtoupper($row['Domicilio']))
        ->setCellValue("G".$cel, strtoupper($row['Adscripcion']))
        ->setCellValue("H".$cel, strtoupper($row['Area']))
        ->setCellValue("I".$cel, strtoupper($row['Subarea']))
        ->setCellValue("J".$cel, strtoupper($row['Puesto']))
        ->setCellValue("K".$cel, strtoupper($row['Extension']))
        ->setCellValue("L".$cel, strtoupper($row['Correo']))
        ->setCellValue("M".$cel, strtoupper($row['GFC']))
        ->setCellValue("N".$cel, strtoupper($row['Acceso_correo']))
        ->setCellValue("O".$cel, strtoupper($row['Estatus']))
        ////////////////////////////////////////////
        ->setCellValue("P".$cel, strtoupper($row['Filtrado']))
        ->setCellValue("Q".$cel, strtoupper($row['Identificacion']))
        ->setCellValue("R".$cel, strtoupper($row['RFCUser']))
        ->setCellValue("S".$cel, strtoupper($row['nombUser']))
        ->setCellValue("T".$cel, strtoupper($row['Nodo']))
        ->setCellValue("U".$cel, strtoupper($row['Fecha_Adquisicion']))
        ->setCellValue("V".$cel, strtoupper($row['DT_adquisicion']))
        ->setCellValue("W".$cel, strtoupper($row['DTB']))
        ->setCellValue("X".$cel, strtoupper($row['Tipo_HW']))
        ->setCellValue("Y".$cel, strtoupper($row['Folio_Resduardo']))
        ->setCellValue("Z".$cel, strtoupper($row['Observaciones']))
        ->setCellValue("AA".$cel, strtoupper($row['Fin_Garantia']))
        ->setCellValue("AB".$cel, strtoupper($row['Candado']))
        ->setCellValue("AC".$cel, strtoupper($row['Valor']))
        ->setCellValue("AD".$cel, strtoupper($row['estatus_Equi']))
        ->setCellValue("AE".$cel, strtoupper($row['Ubicacion']))
        ->setCellValue("AF".$cel, strtoupper($row['Fecha_Llenado']))
        ->setCellValue("AG".$cel, strtoupper($row['Oficio_Mexico']))
        ->setCellValue("AH".$cel, strtoupper($row['Contra_Admin']))
        /////////////////////////////////////////////////////////
        ->setCellValue("AI".$cel, strtoupper($row['serieCPU']))
        ->setCellValue("AJ".$cel, strtoupper($row['marcaCPU']))
        ->setCellValue("AK".$cel, strtoupper($row['modCPU']))
        ->setCellValue("AL".$cel, strtoupper($row['InvCPU']))
        ->setCellValue("AM".$cel, strtoupper($row['Procesador']))
        ->setCellValue("AN".$cel, strtoupper($row['Memoria_RAM']))
        ->setCellValue("AO".$cel, strtoupper($row['Almacenamiento']))
        ->setCellValue("AP".$cel, strtoupper($row['Velocidad']))
        ->setCellValue("AQ".$cel, strtoupper($row['IP']))
        ->setCellValue("AR".$cel, strtoupper($row['MacEth']))
        ->setCellValue("AS".$cel, strtoupper($row['Mac_wifi']))
        ->setCellValue("AT".$cel, strtoupper($row['Dominio']))
        ->setCellValue("AU".$cel, strtoupper($row['RedTipo']))
        ->setCellValue("AV".$cel, strtoupper($row['Adquisicion']))
        ->setCellValue("AW".$cel, strtoupper($row['Bosinas']))
        ->setCellValue("AX".$cel, strtoupper($row['P_USB']))
        ->setCellValue("AY".$cel, strtoupper($row['P_Serial']))
        ->setCellValue("AZ".$cel, strtoupper($row['P_Paralelo']))
        ->setCellValue("BA".$cel, strtoupper($row['Antivirus']))
        ->setCellValue("BB".$cel, strtoupper($row['CA']))
        ->setCellValue("BC".$cel, strtoupper($row['PS2']))
        ->setCellValue("BD".$cel, strtoupper($row['UnidadOptica']))
        ///////////////////////////////////////////////////
        ->setCellValue("BE".$cel, strtoupper($row['serieMon']))
        ->setCellValue("BF".$cel, strtoupper($row['marcaMoni']))
        ->setCellValue("BG".$cel, strtoupper($row['modMoni']))
        ->setCellValue("BH".$cel, strtoupper($row['InvMoni']))
        ->setCellValue("BI".$cel, strtoupper($row['desMoni']))
        ->setCellValue("BJ".$cel, strtoupper($row['adquiMoni']))
        ////////////////////////////////////////
        ->setCellValue("BK".$cel, strtoupper($row['serieMou']))
        ->setCellValue("BL".$cel, strtoupper($row['marcaMou']))
        ->setCellValue("BM".$cel, strtoupper($row['modMou']))
        ->setCellValue("BN".$cel, strtoupper($row['InvMou']))
        ->setCellValue("BO".$cel, strtoupper($row['desMou']))
        ->setCellValue("BP".$cel, strtoupper($row['adquiMou']))
        ///////////////////////////////////////
        ->setCellValue("BQ".$cel, strtoupper($row['serieTec']))
        ->setCellValue("BR".$cel, strtoupper($row['marcaTec']))
        ->setCellValue("BS".$cel, strtoupper($row['modTec']))
        ->setCellValue("BT".$cel, strtoupper($row['InvTec']))
        ->setCellValue("BU".$cel, strtoupper($row['desTec']))
        ->setCellValue("BV".$cel, strtoupper($row['adquiTec']));
        
        $cel+=1;
    }

    /*Fin extracion de datos MYSQL*/
    //$rango="A2:$d";
    $styleArray = array('font' => array( 'name' => 'Arial','size' => 10),
    'borders'=>array('allborders'=>array('style'=> PHPExcel_Style_Border::BORDER_THIN,'color'=>array('argb' => 'FFF'))));
   //$objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($styleArray);

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="REPORTE.xls"');
    header('Cache-Control: max-age=0');
            
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
?>
