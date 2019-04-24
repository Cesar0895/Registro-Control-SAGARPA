<?php
session_start();
	
	$varsesion=$_SESSION['user'];
	//$contrasesion=$_SESSION['pass'];
    
    include 'plantillaPDF.php';
    require 'conexion.php';
    $consulta="SELECT `RFC`, concat(`Nombre`,' ', `ApePaterno`,' ', `ApeMaterno`) as nombComple, `Adscripcion`, `Area`, `Subarea`, `Puesto`, `Telefono`, `Extension`, `Domicilio`, `Correo`, `GFC`, `Acceso_correo`, `Estatus`, `Usuario`, `Contra` FROM `persona` WHERE Usuario='$varsesion'";
    //'or '1'='1
    $resultado = $mysqli->query($consulta);
    $row = $resultado->fetch_array(MYSQLI_ASSOC);

		$puesto=$row['Puesto'];
		$nombr=$row['nombComple'];
	
		if ($varsesion==null || $varsesion='' ) {
			header('location:index.php');
			die();
		}
		
	


    $folio = $_GET['Folio'];        
            
			$sql = "SELECT `Folio`, zona.Nombre, concat(persona.Nombre,' ',persona.ApePaterno,' ',persona.ApeMaterno) as nombResp, persona.RFC,persona.Telefono,persona.Domicilio,persona.Adscripcion,persona.Area,persona.Subarea,persona.Puesto,persona.Extension,persona.Correo,persona.GFC,persona.Acceso_correo,persona.Estatus, Filtrado,`Identificacion`, concat(p.Nombre,' ',p.ApePaterno,' ',p.ApeMaterno) as nombUser,p.RFC as RFCUser, `Nodo`, `Fecha_Adquisicion`, `DT_adquisicion`, `DTB`, `Tipo_HW`, `Folio_Resduardo`, `Observaciones`, `Fin_Garantia`, `Candado`, `Valor`,equipos.Estatus, `Ubicacion`, `Fecha_Llenado`, `Oficio_Mexico`, `Contra_Admin`, 
			
            cpu.Serie as serieCPU, marCPU.Marca as marcaCPU, modCPU.Modelo as modCPU, cpu.Invetario as InvCPU, proCPU.Procesador,ram.Memoria_RAM, DD.Almacenamiento, vel.Velocidad, cpu.IP,cpu.MacEth,cpu.Mac_wifi,cpu.Dominio, cpu.RedTipo, cpu.Adquisicion,CPU.Bosinas, CPU.P_USB, CPU.P_Serial, CPU.P_Paralelo, cpu.Antivirus, cpu.CA, cpu.PS2,
			
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
						on equipos.Id_Teclado=teclado.Id_Teclado WHERE Folio = '$folio'";
    $resultado=$mysqli->query($sql);
    $row = $resultado->fetch_array(MYSQLI_ASSOC);

    $serie=$row['serieCPU'];
    $RFCresp=$row['RFC'];

    $sqlSoft="SELECT software.Nombre, software.Version, software.Licencia, software.Key_soft, software.Plataforma, software.Fabricante, software.Adquisicion, cpu.Serie FROM `cpu_soft` 
    INNER JOIN software ON cpu_soft.id_Software=software.id_Software 
    INNER JOIN cpu on cpu_soft.Id_CPU=cpu.Id_CPU  
    WHERE cpu.Serie='$serie' GROUP by software.Nombre" ;
    $resultadoSoft=$mysqli->query($sqlSoft);

    $sqlAux="SELECT dispositivos.Nomb_Dispositivo, `Inventario`, marca.Marca, modelo.Modelo, `serie`, `Adquisicion`, `Observaciones`,RFC FROM `auxiliares` 
    INNER JOIN dispositivos on auxiliares.Id_dispositivo=dispositivos.Id_Dispositivo
    INNER JOIN marca on auxiliares.id_Marca=marca.id_Marca
    INNER JOIN modelo on auxiliares.id_modelo=modelo.id_Modelo WHERE RFC = '$RFCresp'";
    $resultadoAux=$mysqli->query($sqlAux);

    $año=date("Y");

    setlocale(LC_TIME, 'spanish');
    $fecha_llenado=strftime("%d de %B de %Y",strtotime($row['Fecha_Llenado']));
    $fecha_Adqui=strftime("%d de %B de %Y",strtotime($row['Fecha_Adquisicion']));
    

    $pdf=new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();

    //-----Folio----
    $pdf->SetFillColor(24, 70, 171);
    $pdf->SetFont('Arial','B',12);
    $pdf->SetY(10);
    $pdf->SetX(245);
    $pdf->Cell(20,5,utf8_decode('Grupo:'),0,0,'C');
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetX(265);
    $pdf->Cell(20,5,$row['Folio'],1,1,'C',true);
    $pdf->SetX(265);
    $pdf->Cell(20,5,$año,1,1,'C',true);

    //------Fecha (LLENADO????)----
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','',9);
    $pdf->ln(2);
    $pdf->SetX(215);
    $pdf->Cell(20,4,utf8_decode('FECHA:'),0,0,'R');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(235);
    $pdf->Cell(50,4,$fecha_llenado,1,1,'C');
    $pdf->ln(2); 
    
    //---Unidad administrativa---
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(10);
    $pdf->Cell(55,4,utf8_decode('UNIDAD ADMINISTRATIVA:'),0,0,'L');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(65);
    $pdf->Cell(85,4,utf8_decode('138.- DELEGACIÓN EN EL ESTADO DE NAYARIT'),1,0,'L');
    //---Adscripción---
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(150);
    $pdf->Cell(30,4,utf8_decode('ADSCRIPCION:'),0,0,'R');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(180);
    $pdf->Cell(105,4,strtoupper(utf8_decode($row['Adscripcion'])),1,1,'R');
    $pdf->ln(2); 

    //---NOMBRE DEL RESGUARDANTE---
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(10);
    $pdf->Cell(55,4,utf8_decode('NOMBRE DEL RESGUARDANTE:'),0,0,'L');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(65);
    $pdf->Cell(85,4,strtoupper(utf8_decode($row['nombResp'])),1,0,'L');
    //---Supongo que ZONA---
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(155);
    $pdf->Cell(130,4,utf8_decode('CENTRO DE APOYO AL DESARROLLO RURAL SAN JUAN DE ABAJO'),1,1,'R');
    $pdf->ln(2); 

    //---R.F.C. DEL RESGUARDANTE:---
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(10);
    $pdf->Cell(55,4,utf8_decode('R.F.C. DEL RESGUARDANTE:'),0,0,'L');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(65);
    $pdf->Cell(25,4,strtoupper($row['RFC']),1,0,'L');
    //---TELEFONO---
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(95);
    $pdf->Cell(30,4,utf8_decode('TELEFONO:'),0,0,'L');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(115);
    $pdf->Cell(35,4,strtoupper($row['Telefono']),1,0,'C');

    ///extención
    $pdf->SetX(155);
    $pdf->Cell(10,4,$row['Extension'],1,0,'C');

    //---UBICACION---
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(165);
    $pdf->Cell(25,4,utf8_decode('UBICACION:'),0,0,'R');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(190);
    $pdf->Cell(95,4,strtoupper(utf8_decode($row['Ubicacion'])),1,1,'R');
    $pdf->ln(2); 

    //---DOMICILIO---
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(10);
    $pdf->Cell(55,4,utf8_decode('DOMICILIO:'),0,0,'L');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(65);
    $pdf->Cell(220,4,strtoupper(utf8_decode($row['Domicilio'])),1,1,'L');
    $pdf->ln(2); 

    //----COMPONENTES DEL EQUIPO DE COMPUTO----
    $pdf->SetFillColor(166, 172, 175);
    $pdf->SetFont('Arial','BI',9);
    $pdf->SetX(10);
    $pdf->Cell(70,4,utf8_decode('COMPONENTES DEL EQUIPO DE COMPUTO'),1,1,'L',1);
    $pdf->Line(10,56,285,56);
    $pdf->Line(10,56,10,169);
    $pdf->Line(10,169,285,169);
    $pdf->Line(285,169,285,56);
    $pdf->ln(2);

    //----UNIDAD CENTRAL DE PROCESO (CPU)----
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(10);
    $pdf->Cell(70,4,utf8_decode('UNIDAD CENTRAL DE PROCESO (CPU)'),0,0,'C');

    //----INVENTARIO----
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(85);
    $pdf->Cell(25,4,utf8_decode('INVENTARIO'),0,1,'C');

    //----NO. SERIE----
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(15);
    $pdf->Cell(32,4,utf8_decode('NO. SERIE'),1,0,'C');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(47);
    $pdf->Cell(32,4,$row['serieCPU'],1,0,'C');

    //----INVENTARIO CELDA----
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(85);
    $pdf->Cell(25,4,utf8_decode($row['InvCPU']),1,0,'C');

    //----Tipo de red----
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(115);
    $pdf->Cell(36,4,utf8_decode('RED:'),0,0,'R');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(153);
    $pdf->Cell(25,4,utf8_decode($row['RedTipo']),1,0,'C');

    //----ADQUISICION----
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(183);
    $pdf->Cell(33,4,utf8_decode('ADQUISICION:'),0,0,'R');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(217);
    $pdf->Cell(50,4,utf8_decode($fecha_Adqui),1,1,'C');

    //---DESCRIPCION (Tipo de hardware)----
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(15);
    $pdf->Cell(32,4,utf8_decode('DESCRICPCION'),1,0,'C');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(47);
    $pdf->Cell(32,4,strtoupper(utf8_decode($row['Tipo_HW'])),1,0,'C');

    //----RESGUARDO----
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(85);
    $pdf->Cell(25,4,utf8_decode('RESGUARDO'),0,0,'C');

    //----NODO----
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(115);
    $pdf->Cell(36,4,utf8_decode('NODO:'),0,0,'R');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(153);
    $pdf->Cell(20,4,utf8_decode($row['Nodo']),1,0,'C');

    //----COMPRA----
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(183);
    $pdf->Cell(33,4,utf8_decode('COMPRA:'),0,0,'R');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(217);
    if ($row['Adquisicion']=='Compra') {
        $pdf->Cell(4,4,utf8_decode('X'),1,1,'C');
    } else {
        $pdf->Cell(4,4,utf8_decode(''),1,1,'C');
    }
    
    //----RESGUARDO CELDA----
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(85);
    $pdf->Cell(25,4,strtoupper(utf8_decode($row['Folio_Resduardo'])),1,0,'C');

    //----UNIDAN OPTICA----
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(115);
    $pdf->Cell(36,4,utf8_decode('UNIDAD OPTICA:'),0,0,'R');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(153);
    $pdf->Cell(20,4,utf8_decode('SI O NO????'),1,0,'C');

    //----COMODATO----
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(183);
    $pdf->Cell(33,4,utf8_decode('COMODATO:'),0,0,'R');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(217);
    if ($row['Adquisicion']=='Comodato') {
        $pdf->Cell(4,4,utf8_decode('X'),1,0,'C');
    } else {
        $pdf->Cell(4,4,utf8_decode(''),1,0,'C');
    }

    //----DT_ADQUISICION----
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(226);
    $pdf->Cell(35,4,utf8_decode($row['DT_adquisicion']),0,0,'C');
   
    //---MARCA----
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(15);
    $pdf->Cell(32,4,utf8_decode('MARCA'),1,0,'C');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(47);
    $pdf->Cell(32,4,strtoupper(utf8_decode($row['marcaCPU'])),1,1,'C');


    //---MODELO----
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(15);
    $pdf->Cell(32,4,utf8_decode('MODELO'),1,0,'C');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(47);
    $pdf->Cell(32,4,strtoupper(utf8_decode($row['modCPU'])),1,0,'C');

    //----GPO. TRABAJO----
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(85);
    $pdf->Cell(25,4,utf8_decode('GPO. TRABAJO'),0,0,'C');

    //----PUERTOS----
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(115);
    $pdf->Cell(23,4,utf8_decode('PUERTOS:'),0,0,'R');

    //----USB----
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(142);
    $pdf->Cell(10,4,utf8_decode('USB:'),0,0,'R');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(153);
    $pdf->Cell(4,4,utf8_decode($row['P_USB']),1,0,'C');

    //----DONACIÓN----
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(183);
    $pdf->Cell(33,4,utf8_decode('DONACIÓN:'),0,0,'R');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(217);
    if ($row['Adquisicion']=='Donacion') {
        $pdf->Cell(4,4,utf8_decode('X'),1,1,'C');
    } else {
        $pdf->Cell(4,4,utf8_decode(''),1,1,'C');
    }

    //---PROCESADOR----
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(15);
    $pdf->Cell(32,4,utf8_decode('PROCESADOR'),1,0,'C');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(47);
    $pdf->Cell(32,4,strtoupper(utf8_decode($row['Procesador'])),1,0,'C');

    //----GPO. TRABAJO CELDA----
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(85);
    $pdf->Cell(25,4,strtoupper(utf8_decode($row['Dominio'])),1,0,'C');

    //----SERIAL----
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(115);
    $pdf->Cell(36,4,utf8_decode('SERIAL:'),0,0,'R');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(153);
    if ($row['P_Serial']=='SI') {
        $pdf->Cell(4,4,utf8_decode('X'),1,0,'C');
    } else {
        $pdf->Cell(4,4,utf8_decode(''),1,0,'C');
    }

    //----TRANSFERENCIA----
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(183);
    $pdf->Cell(33,4,utf8_decode('TRANSFERENCIA:'),0,0,'R');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(217);
    if ($row['Adquisicion']=='Transferencia') {
        $pdf->Cell(4,4,utf8_decode('X'),1,1,'C');
    } else {
        $pdf->Cell(4,4,utf8_decode(''),1,1,'C');
    }

    //---MEMORIA----
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(15);
    $pdf->Cell(32,4,utf8_decode('MEMORIA'),1,0,'C');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(47);
    $pdf->Cell(32,4,strtoupper(utf8_decode($row['Memoria_RAM'])),1,0,'C');

    //----Antivirus----
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(85);
    $pdf->Cell(25,4,utf8_decode('ANTIVIRUS'),0,0,'C');

    //----PARALELO----
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(115);
    $pdf->Cell(36,4,utf8_decode('PARALELO:'),0,0,'R');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(153);
    if ($row['P_Paralelo']=='SI') {
        $pdf->Cell(4,4,utf8_decode('X'),1,0,'C');
    } else {
        $pdf->Cell(4,4,utf8_decode(''),1,0,'C');
    }

    //----ARRENDAMIENTO----
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(183);
    $pdf->Cell(33,4,utf8_decode('ARRENDAMIENTO:'),0,0,'R');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(217);
    if ($row['Adquisicion']=='Arrendamiento') {
        $pdf->Cell(4,4,utf8_decode('X'),1,1,'C');
    } else {
        $pdf->Cell(4,4,utf8_decode(''),1,1,'C');
    }

    //---DISCO DURO----
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(15);
    $pdf->Cell(32,4,utf8_decode('DISCO DURO'),1,0,'C');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(47);
    $pdf->Cell(32,4,strtoupper(utf8_decode($row['Almacenamiento'])),1,0,'C');

    //----ANTIVIRUS CELDA----
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(85);
    $pdf->Cell(25,8,utf8_decode('SI O NO??'),1,0,'C');

    //----ps2----
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(115);
    $pdf->Cell(36,4,utf8_decode('PS2:'),0,0,'R');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(153);  
    $pdf->Cell(4,4,utf8_decode($row['PS2']),1,1,'C');
  

    //---VELOCIDAD----
    $pdf->SetFont('Arial','',9);
    $pdf->SetY(90);
    $pdf->SetX(15);
    $pdf->Cell(32,4,utf8_decode('VELOCIDAD'),1,0,'C');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(47);
    $pdf->Cell(32,4,strtoupper(utf8_decode($row['Velocidad'])),1,1,'C');

    //----BOCINAS----
    $pdf->SetFont('Arial','',9);
    $pdf->SetY(90);
    $pdf->SetX(115);
    $pdf->Cell(36,4,utf8_decode('BOCINAS:'),0,0,'R');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(153);
    if ($row['Bosinas']=='SI') {
        $pdf->Cell(4,4,utf8_decode('X'),1,1,'C');
    } else {
        $pdf->Cell(4,4,utf8_decode(''),1,1,'C');
    }

    //---DIRECCION IP----
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(15);
    $pdf->Cell(32,4,utf8_decode('DIRECCION IP'),1,0,'C');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(47);
    $pdf->Cell(32,4,strtoupper(utf8_decode($row['IP'])),1,0,'C');

    //----STATUS----
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(85);
    $pdf->Cell(25,4,utf8_decode('STATUS'),0,0,'C');

    //----INTERNET GFC----
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(115);
    $pdf->Cell(36,4,utf8_decode('INTERNET GFC:'),0,0,'R');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(153);
    $pdf->Cell(40,4,utf8_decode($row['GFC']),1,1,'L');

    //---MAC ADDRESS ETH----
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(15);
    $pdf->Cell(32,4,utf8_decode('MAC ADDRESS ETH'),1,0,'C');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(47);
    $pdf->Cell(32,4,strtoupper(utf8_decode($row['MacEth'])),1,0,'C');

    //----STATUS----
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(85);
    $pdf->Cell(25,4,strtoupper(utf8_decode($row['Estatus'])),1,0,'C');

    //----ACCESO A CORREO----
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(115);
    $pdf->Cell(36,4,utf8_decode('ACCESO A CORREO:'),0,0,'R');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(153);
    $pdf->Cell(25,4,utf8_decode($row['Acceso_correo']),1,1,'L');

    //---MAC ADDRESS WIFI----
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(15);
    $pdf->Cell(32,4,utf8_decode('MAC ADDRESS WIFI'),1,0,'C');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(47);
    $pdf->Cell(32,4,strtoupper(utf8_decode($row['Mac_wifi'])),1,0,'C');

    //----CORREO ELECTRONICO----
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(115);
    $pdf->Cell(36,4,utf8_decode('CORREO ELECTRONICO:'),0,0,'R');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(153);
    $pdf->Cell(115,4,utf8_decode($row['Correo']),1,1,'L');

    //---NOMBRE PC----
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(15);
    $pdf->Cell(32,4,utf8_decode('NOMBRE PC'),1,0,'C');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(47);
    $pdf->Cell(32,4,strtoupper(utf8_decode($row['Identificacion'])),1,0,'C');

    //----Observaciones----
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(85);
    $pdf->Cell(25,4,utf8_decode('OBSERVACIONES:'),0,1,'L');

    //---ACTIVE DIRECTORY----
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(15);
    $pdf->Cell(32,4,utf8_decode('ACTIVE DIRECTORY'),1,0,'C');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(47);
    $pdf->Cell(32,4,strtoupper(utf8_decode('????')),1,0,'C');

    //OBSERVACIONES CELDA-----
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(85);
    $pdf->MultiCell(183,4,strtoupper(utf8_decode($row['Observaciones'])),1,'L');

    //---TARJETA DE RED----
    $pdf->SetFont('Arial','',9);
    $pdf->SetY(114);
    $pdf->SetX(15);
    $pdf->Cell(32,4,utf8_decode('TARJETA DE RED'),1,0,'C');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(47);
    $pdf->Cell(32,4,strtoupper(utf8_decode('?????')),1,1,'C');
    //---ADAPTADOR CA.----
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(15);
    $pdf->Cell(32,4,utf8_decode('ADAPTADOR CA.'),1,0,'C');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(47);
    $pdf->Cell(32,4,strtoupper(utf8_decode($row['CA'])),1,1,'C');

    $pdf->ln(3);


    //////////////////////////Monitor - Teclado - Mouse//////////////////////
    //////////lineas de los datos de soft////
    $pdf->Line(15,129,15,141);
    $pdf->Line(32,125,32,141);
    $pdf->Line(62,125,62,141);
    $pdf->Line(92,125,92,141);
    $pdf->Line(117,125,117,141);
    $pdf->Line(177,125,177,141);
    $pdf->Line(207,125,207,141);
    $pdf->Line(15,129,32,129);
    $pdf->Line(15,141,285,141);
   
    //---CABECERAS.----
    $pdf->SetX(32);
    $pdf->Cell(30,4,utf8_decode('INVENTARIO'),1,0,'C',1);
    $pdf->SetX(62);
    $pdf->Cell(30,4,utf8_decode('MARCA'),1,0,'C',1);
    $pdf->SetX(92);
    $pdf->Cell(25,4,utf8_decode('MODELO'),1,0,'C',1);
    $pdf->SetX(117);
    $pdf->Cell(60,4,utf8_decode('NUMERO DE SERIE'),1,0,'C',1);
    $pdf->SetX(177);
    $pdf->Cell(30,4,utf8_decode('ADQUISICIÓN'),1,0,'C',1);
    $pdf->SetX(207);
    $pdf->Cell(78,4,utf8_decode('OBSERVACIONES'),1,1,'C',1);

    ////Datos Monitor//////
    $pdf->SetX(15);
    $pdf->Cell(17,4,utf8_decode('MONITOR'),0,0,'C');
    $pdf->SetX(32);
    $pdf->Cell(30,4,strtoupper(utf8_decode($row['InvMoni'])),0,0,'C');
    $pdf->SetX(62);
    $pdf->Cell(30,4,strtoupper(utf8_decode($row['marcaMoni'])),0,0,'C');
    $pdf->SetX(92);
    $pdf->Cell(25,4,strtoupper(utf8_decode($row['modMoni'])),0,0,'C');
    $pdf->SetX(117);
    $pdf->Cell(60,4,strtoupper(utf8_decode($row['serieMon'])),0,0,'C');
    $pdf->SetX(177);
    $pdf->Cell(30,4,strtoupper(utf8_decode($row['adquiMoni'])),0,0,'C');
    $pdf->SetX(207);
    $pdf->Cell(78,4,strtoupper(utf8_decode($row['desMoni'])),0,1,'C');

    ////Datos Teclado//////
    $pdf->SetX(15);
    $pdf->Cell(17,4,utf8_decode('TECLADO'),0,0,'C');
    $pdf->SetX(32);
    $pdf->Cell(30,4,strtoupper(utf8_decode($row['InvTec'])),0,0,'C');
    $pdf->SetX(62);
    $pdf->Cell(30,4,strtoupper(utf8_decode($row['marcaTec'])),0,0,'C');
    $pdf->SetX(92);
    $pdf->Cell(25,4,strtoupper(utf8_decode($row['modTec'])),0,0,'C');
    $pdf->SetX(117);
    $pdf->Cell(60,4,strtoupper(utf8_decode($row['serieTec'])),0,0,'C');
    $pdf->SetX(177);
    $pdf->Cell(30,4,strtoupper(utf8_decode($row['adquiTec'])),0,0,'C');
    $pdf->SetX(207);
    $pdf->Cell(78,4,strtoupper(utf8_decode($row['desTec'])),0,1,'C');

    ////Datos Mouse//////
    $pdf->SetX(15);
    $pdf->Cell(17,4,utf8_decode('MOUSE'),0,0,'C');
    $pdf->SetX(32);
    $pdf->Cell(30,4,strtoupper(utf8_decode($row['InvMou'])),0,0,'C');
    $pdf->SetX(62);
    $pdf->Cell(30,4,strtoupper(utf8_decode($row['marcaMou'])),0,0,'C');
    $pdf->SetX(92);
    $pdf->Cell(25,4,strtoupper(utf8_decode($row['modMou'])),0,0,'C');
    $pdf->SetX(117);
    $pdf->Cell(60,4,strtoupper(utf8_decode($row['serieMou'])),0,0,'C');
    $pdf->SetX(177);
    $pdf->Cell(30,4,strtoupper(utf8_decode($row['adquiMou'])),0,0,'C');
    $pdf->SetX(207);
    $pdf->Cell(78,4,strtoupper(utf8_decode($row['desMou'])),0,1,'C');

    ///////LEY FEDERAL DE DERECHOS DE AUTOR////////////////
    $pdf->SetX(92);
    $pdf->Cell(85,4,'LEY FEDERAL DE DERECHOS DE AUTOR:',0,0,'R');
    $pdf->SetFont('Arial','',6);
    $pdf->SetX(177);
    $pdf->MultiCell(108,4,utf8_decode('LA REPRODUCCIÓN NO AUTORIZADA DE PROGRAMAS DE COMPUTO ES UN DELITO FEDERAL, QUE PUEDE LLEGAR HASTA 10 AÑOS DE PRISION'),0,'L');

    //////soft///
    $pdf->SetY(145);
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(10);
    $pdf->Cell(52,4,'SOFTWARE INSTALADO',1,0,'C',1);

    /////licencia--------
    $pdf->SetX(92);
    $pdf->Cell(85,4,'LICENCIA',1,1,'C',1);

    ///MAS ENCABEZADOS///
    $pdf->SetX(10);
    $pdf->Cell(52,4,'NOMBRE',1,0,'C',1);
    $pdf->SetX(62);
    $pdf->Cell(30,4,'VERSION',1,0,'C',1);
    $pdf->SetX(92);
    $pdf->Cell(25,4,'Tipo',1,0,'C',1);
    $pdf->SetX(117);
    $pdf->Cell(60,4,'NO. LICENCIA',1,0,'C',1);
    $pdf->SetX(177);
    $pdf->Cell(40,4,utf8_decode('ADQUISICIÓN'),1,0,'C',1);
    $pdf->SetX(217);
    $pdf->Cell(30,4,utf8_decode('PLATAFORMA'),1,0,'C',1);
    $pdf->SetX(247);
    $pdf->Cell(38,4,utf8_decode('FABRICANTE'),1,1,'C',1);

    ////DATOS DEL SOFT///
    while($rowSoft = $resultadoSoft->fetch_array(MYSQLI_ASSOC)) {
        $pdf->SetX(10);
        $pdf->Cell(52,4,strtoupper(utf8_decode($rowSoft['Nombre'])),0,0,'C');
        $pdf->SetX(62);
        $pdf->Cell(30,4,strtoupper(utf8_decode($rowSoft['Version'])),0,0,'C');
        $pdf->SetX(92);
        $pdf->Cell(25,4,strtoupper(utf8_decode($rowSoft['Licencia'])),0,0,'C');
        $pdf->SetX(117);
        $pdf->Cell(60,4,strtoupper(utf8_decode($rowSoft['Key_soft'])),0,0,'C');
        $pdf->SetX(177);
        $pdf->Cell(40,4,strtoupper(utf8_decode($rowSoft['Adquisicion'])),0,0,'C');
        $pdf->SetX(217);
        $pdf->Cell(30,4,strtoupper(utf8_decode($rowSoft['Plataforma'])),0,0,'C');
        $pdf->SetX(247);
        $pdf->Cell(38,4,strtoupper(utf8_decode($rowSoft['Fabricante'])),0,1,'C');
    }

    //////////lineas de los datos de soft////
    $pdf->Line(62,153,62,169);
    $pdf->Line(92,153,92,169);
    $pdf->Line(117,153,117,169);
    $pdf->Line(177,153,177,169);
    $pdf->Line(217,153,217,169);
    $pdf->Line(247,153,247,169);

    //////////////marco firmas/////////
    $pdf->Line(10,170,98,170);
    $pdf->Line(10,170,10,190);
    $pdf->Line(10,190,98,190);
    $pdf->Line(98,170,98,190);
    $pdf->Line(10,184,98,184);

    $pdf->Line(103,170,191,170);
    $pdf->Line(103,170,103,190);
    $pdf->Line(103,190,191,190);
    $pdf->Line(191,170,191,190);
    $pdf->Line(103,184,191,184);

    $pdf->Line(196,170,285,170);
    $pdf->Line(196,170,196,190);
    $pdf->Line(196,190,285,190);
    $pdf->Line(285,170,285,190);
    $pdf->Line(196,184,285,184);
    

    //////////firmas/////////
    $pdf->SetFont('Arial','B',8);
    $pdf->SetY(170);
    $pdf->ln(1);
    $pdf->SetX(10);
    $pdf->Cell(88,3,utf8_decode('RESPONSABLE DEL LLENADO'),0,0,'C');
    $pdf->SetX(103);
    $pdf->Cell(88,3,utf8_decode(''),0,0,'C');
    $pdf->SetX(196);
    $pdf->Cell(89,3,utf8_decode('RESGUARDANTE'),0,1,'C');
    $pdf->SetX(10);
    $pdf->Cell(88,10,utf8_decode(''),0,0,'C');
    $pdf->SetX(103);
    $pdf->Cell(88,10,utf8_decode(''),0,0,'C');
    $pdf->SetX(196);
    $pdf->Cell(89,10,utf8_decode(''),0,1,'C');

    
    $pdf->SetY(184);
    $pdf->Cell(88,3,utf8_decode('CURIEL AGUIAR JORGE ALBERTO'),0,0,'C');
    $pdf->SetX(196);
    $pdf->Cell(89,3,strtoupper(utf8_decode($row['nombResp'])),0,1,'C');
    $pdf->SetFont('Arial','B',7);
    $pdf->SetX(10);
    $pdf->Cell(88,2,utf8_decode('JEFE DE LA UNIDAD DE INFORMATICA'),0,0,'C');
    $pdf->SetX(196);
    $pdf->Cell(89,2,strtoupper(utf8_decode($row['Puesto'])),0,1,'C');


    /////////////////////PAGINA 2////////////
    //-----Folio----
    $pdf->SetFillColor(24, 70, 171);
    $pdf->SetFont('Arial','B',12);
    $pdf->SetX(245);
    $pdf->Cell(20,5,utf8_decode('Grupo:'),0,0,'C');
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetX(265);
    $pdf->Cell(20,5,$row['Folio'],1,1,'C',true);
    $pdf->SetX(265);
    $pdf->Cell(20,5,$año,1,1,'C',true);

    //------Fecha (LLENADO????)----
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','',9);
    $pdf->ln(2);
    $pdf->SetX(215);
    $pdf->Cell(20,4,utf8_decode('FECHA:'),0,0,'R');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(235);
    $pdf->Cell(50,4,$fecha_llenado,1,1,'C');
    $pdf->ln(2); 
    
    //---Unidad administrativa---
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(10);
    $pdf->Cell(55,4,utf8_decode('UNIDAD ADMINISTRATIVA:'),0,0,'L');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(65);
    $pdf->Cell(85,4,utf8_decode('138.- DELEGACIÓN EN EL ESTADO DE NAYARIT'),1,0,'L');
    //---Adscripción---
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(150);
    $pdf->Cell(30,4,utf8_decode('ADSCRIPCION:'),0,0,'R');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(180);
    $pdf->Cell(105,4,strtoupper(utf8_decode($row['Adscripcion'])),1,1,'R');
    $pdf->ln(2); 

    //---NOMBRE DEL RESGUARDANTE---
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(10);
    $pdf->Cell(55,4,utf8_decode('NOMBRE DEL RESGUARDANTE:'),0,0,'L');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(65);
    $pdf->Cell(85,4,strtoupper(utf8_decode($row['nombResp'])),1,0,'L');
    //---Supongo que ZONA---
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(155);
    $pdf->Cell(130,4,utf8_decode('CENTRO DE APOYO AL DESARROLLO RURAL SAN JUAN DE ABAJO'),1,1,'R');
    $pdf->ln(2); 

    //---R.F.C. DEL RESGUARDANTE:---
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(10);
    $pdf->Cell(55,4,utf8_decode('R.F.C. DEL RESGUARDANTE:'),0,0,'L');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(65);
    $pdf->Cell(25,4,strtoupper($row['RFC']),1,0,'L');
    //---TELEFONO---
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(95);
    $pdf->Cell(30,4,utf8_decode('TELEFONO:'),0,0,'L');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(115);
    $pdf->Cell(35,4,strtoupper($row['Telefono']),1,0,'C');

    ///extención
    $pdf->SetX(155);
    $pdf->Cell(10,4,$row['Extension'],1,0,'C');

    //---UBICACION---
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(165);
    $pdf->Cell(25,4,utf8_decode('UBICACION:'),0,0,'R');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(190);
    $pdf->Cell(95,4,strtoupper(utf8_decode($row['Ubicacion'])),1,1,'R');
    $pdf->ln(2); 

    //---DOMICILIO---
    $pdf->SetFont('Arial','',9);
    $pdf->SetX(10);
    $pdf->Cell(55,4,utf8_decode('DOMICILIO:'),0,0,'L');
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(65);
    $pdf->Cell(220,4,strtoupper(utf8_decode($row['Domicilio'])),1,1,'L');
    $pdf->ln(2);

    //----DISPOSITIVOS ADICIONALES O AUXILIARES----
    $pdf->SetFillColor(166, 172, 175);
    $pdf->SetFont('Arial','BI',9);
    $pdf->SetX(10);
    $pdf->Cell(70,4,utf8_decode('DISPOSITIVOS ADICIONALES O AUXILIARES'),1,1,'L',1);
    $pdf->Line(10,60,285,60);
    $pdf->Line(10,60,10,167);
    $pdf->Line(10,167,285,167);
    $pdf->Line(285,167,285,60);
    $pdf->ln(5);

    /////CABECERAS DE AUXILIARES///////////
    $pdf->SetFont('Arial','B',9);
    $pdf->SetX(15);
    $pdf->Cell(30,4,utf8_decode('DISPOSITIVO'),1,0,'C',1);
    $pdf->SetX(45);
    $pdf->Cell(25,4,utf8_decode('INVENTARIO'),1,0,'C',1);
    $pdf->SetX(70);
    $pdf->Cell(30,4,utf8_decode('MARCA'),1,0,'C',1);
    $pdf->SetX(100);
    $pdf->Cell(30,4,utf8_decode('MODELO'),1,0,'C',1);
    $pdf->SetX(130);
    $pdf->Cell(30,4,utf8_decode('SERIE'),1,0,'C',1);
    $pdf->SetX(160);
    $pdf->Cell(30,4,utf8_decode('ADQUISICIÓN'),1,0,'C',1);
    $pdf->SetX(190);
    $pdf->Cell(90,4,utf8_decode('OBSERVACIONES'),1,1,'C',1);
    ////DATOS DE AUXILIARES///
    while($rowAux = $resultadoAux->fetch_array(MYSQLI_ASSOC)) {
        $pdf->SetFont('Arial','',8);
        $pdf->SetX(15);
        $pdf->Cell(30,4,strtoupper(utf8_decode($rowAux['Nomb_Dispositivo'])),1,0,'L');
        $pdf->SetX(45);
        $pdf->Cell(25,4,strtoupper(utf8_decode($rowAux['Inventario'])),1,0,'C');
        $pdf->SetX(70);
        $pdf->Cell(30,4,strtoupper(utf8_decode($rowAux['Marca'])),1,0,'C');
        $pdf->SetX(100);
        $pdf->Cell(30,4,strtoupper(utf8_decode($rowAux['Modelo'])),1,0,'C');
        $pdf->SetX(130);
        $pdf->Cell(30,4,strtoupper(utf8_decode($rowAux['serie'])),1,0,'C');
        $pdf->SetX(160);
        $pdf->Cell(30,4,strtoupper(utf8_decode($rowAux['Adquisicion'])),1,0,'C');
        $pdf->SetX(190);
        $pdf->SetFont('Arial','',7);
        $pdf->Cell(90,4,strtoupper(utf8_decode($rowAux['Observaciones'])),1,1,'C');
        
    }

    //////////////marco firmas/////////
    $pdf->Line(10,170,98,170);
    $pdf->Line(10,170,10,190);
    $pdf->Line(10,190,98,190);
    $pdf->Line(98,170,98,190);
    $pdf->Line(10,184,98,184);

    $pdf->Line(103,170,191,170);
    $pdf->Line(103,170,103,190);
    $pdf->Line(103,190,191,190);
    $pdf->Line(191,170,191,190);
    $pdf->Line(103,184,191,184);

    $pdf->Line(196,170,285,170);
    $pdf->Line(196,170,196,190);
    $pdf->Line(196,190,285,190);
    $pdf->Line(285,170,285,190);
    $pdf->Line(196,184,285,184);
    

    //////////firmas/////////
    $pdf->SetFont('Arial','B',8);
    $pdf->SetY(170);
    $pdf->ln(1);
    $pdf->SetX(10);
    $pdf->Cell(88,3,utf8_decode('RESPONSABLE DEL LLENADO'),0,0,'C');
    $pdf->SetX(103);
    $pdf->Cell(88,3,utf8_decode(''),0,0,'C');
    $pdf->SetX(196);
    $pdf->Cell(89,3,utf8_decode('RESGUARDANTE'),0,1,'C');
    $pdf->SetX(10);
    $pdf->Cell(88,10,utf8_decode(''),0,0,'C');
    $pdf->SetX(103);
    $pdf->Cell(88,10,utf8_decode(''),0,0,'C');
    $pdf->SetX(196);
    $pdf->Cell(89,10,utf8_decode(''),0,1,'C');

    
    $pdf->SetY(184);
    $pdf->Cell(88,3,utf8_decode('CURIEL AGUIAR JORGE ALBERTO'),0,0,'C');
    $pdf->SetX(196);
    $pdf->Cell(89,3,strtoupper(utf8_decode($row['nombResp'])),0,1,'C');
    $pdf->SetFont('Arial','B',7);
    $pdf->SetX(10);
    $pdf->Cell(88,2,utf8_decode('JEFE DE LA UNIDAD DE INFORMATICA'),0,0,'C');
    $pdf->SetX(196);
    $pdf->Cell(89,2,strtoupper(utf8_decode($row['Puesto'])),0,1,'C');
 
    $pdf->output();


?>