<?php
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ERROR | E_PARSE);
session_start();
	
	$varsesion=$_SESSION['user'];
	//$contrasesion=$_SESSION['pass'];
	include 'plantillaPDF2.php';
    require 'conexion.php';
    $consulta="SELECT `RFC`, concat(`Nombre`,' ', `ApePaterno`,' ', `ApeMaterno`) as nombComple,  `Area`, `Subarea`, `Puesto`, `Telefono`, `Extension`, `Domicilio`, `Correo`, `GFC`, `Acceso_correo`, `Estatus`, `Usuario`, `Contra` FROM `persona` WHERE Usuario='$varsesion' or Correo='$varsesion'";
    //'or '1'='1
    $resultado = $mysqli->query($consulta);
    $row = $resultado->fetch_array(MYSQLI_ASSOC);

		$RFC=$row['RFC'];
		$nombr=$row['nombComple'];
	
		if ($varsesion==null || $varsesion='' ) {
			header('location:index.php');
			die();
		}
		
		if ($RFC!='CUAJ800423F77' && $RFC!='BUVG860908DU8') {
			header('location:Resguardante/inicioRes.php');
			die();
		}
    
    

        
$id=1;

$where = "";
	
if(!empty($_POST))
	{
        $valor = $_POST['campo'];
		$valor2=$_POST['Valor2'];
		$valor3=$_POST['Valor3'];
		
		if(!empty($valor)){
			$where = "WHERE $valor2 LIKE '$valor%' and persona.Subarea LIKE '$valor3%'";
		}
	}


	$sqlmostrar = "SELECT `Folio`, zona.Nombre, zona.Sigla, concat(persona.Nombre,' ',persona.ApePaterno,' ',persona.ApeMaterno) as nombResp, persona.RFC, zonaPer.Sigla as zonaPer, persona.Subarea,
			
    cpu.Serie as serieCPU, marCPU.Marca as marcaCPU, modCPU.Modelo as modCPU, cpu.Invetario as InvCPU, cpu.Adquisicion
    FROM `equipos`
    INNER JOIN zona on equipos.Id_Zona=zona.id_Zona 
    INNER JOIN (persona 
    			INNER JOIN zona zonaPer on persona.Area=zonaPer.id_Zona)
    			on equipos.RFC=persona.RFC 
    
    INNER JOIN (cpu 
                INNER JOIN marca marCPU on cpu.Id_Marca=marCPU.id_Marca
                INNER JOIN modelo modCPU on cpu.Id_Modelo=modCPU.id_Modelo) 
                on equipos.Id_CPU=cpu.Id_CPU $where ORDER BY `equipos`.`Folio` ASC";
	$resultadoTabla = $mysqli->query($sqlmostrar);

    $pdf=new PDF2();
    $pdf->AliasNbPages();
    $pdf->AddPage();

    $pdf->SetFillColor(166, 172, 175);
    $pdf->SetFont('Arial','B',10);
    $pdf->SetY(40);

    $pdf->SetX(15);
    $pdf->Cell(10,4,'',1,0,'C',1);
    $pdf->SetX(25);
    $pdf->Cell(50,4,utf8_decode('Responsable'),1,0,'C',1);
    $pdf->SetX(75);
    $pdf->Cell(30,4,utf8_decode('RFC'),1,0,'C',1);
    $pdf->SetX(105);
    $pdf->Cell(20,4,utf8_decode('Area'),1,0,'C',1);
    $pdf->SetX(125);
    $pdf->Cell(30,4,utf8_decode('Subarea'),1,0,'C',1);
    $pdf->SetX(155);
    $pdf->Cell(20,4,utf8_decode('Marca'),1,0,'C',1);
    $pdf->SetX(175);
    $pdf->Cell(20,4,utf8_decode('Modelo'),1,0,'C',1);
    $pdf->SetX(195);
    $pdf->Cell(25,4,utf8_decode('Serie'),1,0,'C',1);
    $pdf->SetX(220);
    $pdf->Cell(25,4,utf8_decode('Inventario'),1,0,'C',1);
    $pdf->SetX(245);
    $pdf->Cell(30,4,utf8_decode('Adquisicion'),1,1,'C',1);


    while($row = $resultadoTabla->fetch_array(MYSQLI_ASSOC)) {
        $pdf->SetFont('Arial','',8);
        $pdf->SetX(15);
        $pdf->Cell(10,12,$id++,1,0,'C');
        $pdf->SetX(25);
        $pdf->Cell(50,12,utf8_decode($row['nombResp']),1,0,'C');
        $pdf->SetX(75);
        $pdf->Cell(30,12,utf8_decode($row['RFC']),1,0,'C');
        $pdf->SetX(105);
        $pdf->Cell(20,12,utf8_decode($row['zonaPer']),1,0,'C');
        $pdf->SetX(125);
        $pdf->MultiCell(30,4,utf8_decode($row['Subarea']),1,'C');
        $pdf->SetX(155);
        $pdf->Cell(20,12,utf8_decode($row['marcaCPU']),1,0,'C');
        $pdf->SetX(175);
        $pdf->Cell(20,12,utf8_decode($row['modCPU']),1,0,'C');
        $pdf->SetX(195);
        $pdf->Cell(25,12,utf8_decode($row['serieCPU']),1,0,'C');
        $pdf->SetX(220);
        $pdf->Cell(25,12,utf8_decode($row['InvCPU']),1,0,'C');
        $pdf->SetX(245);
        $pdf->Cell(30,12,utf8_decode($row['Adquisicion']),1,1,'C');

    }

    

    $pdf->output();

?>