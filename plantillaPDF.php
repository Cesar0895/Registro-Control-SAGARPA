<?php

    require 'fpdf/fpdf.php';

    class PDF extends FPDF
    {
        function Header()
        {
            $this->Image('./img/logoSader.jpg',10,10,50);
            $this->SetFont('Arial','B',10);
            $this->Cell(80);
            $this->Cell(120,4,utf8_decode('CEDULA DE IDENTIFICACIÓN DE EQUIPO DE COMPUTO'),0,1,'C');
            $this->Cell(80);
            $this->Cell(120,4,utf8_decode('ANEXO '.$this->PageNo()),0,0,'C');

            
        }

        function Footer()
        {
            $this->SetY(-15);
            $this->SetFont('Arial','I',10);

           
            $this->Cell(0,4,'Page '.$this->PageNo().'/{nb}',0,0,'C');  
        }
    }

?>