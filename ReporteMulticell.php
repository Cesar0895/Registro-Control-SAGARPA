<?php

error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ERROR | E_PARSE);
session_start();
	
	$varsesion=$_SESSION['user'];
    //$contrasesion=$_SESSION['pass'];
    require 'mc_table.php';
    require 'conexion.php';
    //include 'PlantillaPDF2.php';

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

$pdf=new PDF_MC_Table();
$pdf->AddPage();


            

$pdf->SetFillColor(166, 172, 175);
    $pdf->SetFont('Arial','B',9);
    $pdf->SetY(30);
    $pdf->SetX(15);

    $pdf->SetWidths(array(6,40,30,20,40,20,20,25,25,30));
    $pdf->SetAligns(array('','','','C','C','C','C','C','C','C'));

    $pdf->Cell(6,4,'',1,0,'',1);
 
    $pdf->Cell(40,4,utf8_decode('Responsable'),1,0,'C',1);
  
    $pdf->Cell(30,4,utf8_decode('RFC'),1,0,'C',1);
   
    $pdf->Cell(20,4,utf8_decode('Area'),1,0,'C',1);

    $pdf->Cell(40,4,utf8_decode('Subarea'),1,0,'C',1);

    $pdf->Cell(20,4,utf8_decode('Marca'),1,0,'C',1);
  
    $pdf->Cell(20,4,utf8_decode('Modelo'),1,0,'C',1);
 
    $pdf->Cell(25,4,utf8_decode('Serie'),1,0,'C',1);

    $pdf->Cell(25,4,utf8_decode('Inventario'),1,0,'C',1);
 
    $pdf->Cell(30,4,utf8_decode('Adquisicion'),1,1,'C',1);


    while($row = $resultadoTabla->fetch_array(MYSQLI_ASSOC)) {
        $pdf->SetFont('Arial','',9);
        $pdf->SetX(15);
        $pdf->Row(array(
            $id++,
            strtoupper(utf8_decode($row['nombResp'])),
            strtoupper(utf8_decode($row['RFC'])),
            strtoupper(utf8_decode($row['zonaPer'])),
            strtoupper(utf8_decode($row['Subarea'])),
            strtoupper(utf8_decode($row['marcaCPU'])),
            strtoupper(utf8_decode($row['modCPU'])),
            strtoupper(utf8_decode($row['serieCPU'])),
            strtoupper(utf8_decode($row['InvCPU'])),
            strtoupper(utf8_decode($row['Adquisicion']))
        ));

    }    

    

$pdf->Output();
?>