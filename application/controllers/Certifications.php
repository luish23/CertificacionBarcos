<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use chriskacerguis\RestServer\RestController;
require APPPATH.'libraries/REST_Controller.php';
require APPPATH.'libraries/Format.php';
require_once APPPATH.'third_party/fpdf/fpdf.php';

class Certifications extends RESTController {

    public function __construct()
    {
        parent::__construct();
    }

    public function index_get()
    {
        $pdf = new FPDF();
        $pdf->AddPage('P','A4',0);
        $pdf->Image('/var/www/html/sgcb.development.com/public_html/public/certificaciones/01-NS-certificado-de-seguranca-da-navegacao_FRONT.jpg', 0, 0, 210, 300);
        $pdf->SetFont('Arial','B',12);
        $pdf->SetXY(171,17);
        $pdf->Cell(29,10,'XYZ-123-2021',0,1,'C');
        $pdf->SetXY(100,80);
        $pdf->Cell(75,10,'JOSE MANUEL VILLANUEVA',0,1,'C');
        $pdf->SetXY(10,100);
        $pdf->Cell(114,10,'BARCO ATLANTICO SUR',0,1,'C');
        $pdf->SetXY(127,100);
        $pdf->Cell(32,10,'INDICATIVO',0,1,'C');
        $pdf->SetXY(163,100);
        $pdf->Cell(35,10,'INSCRIPCION',0,1,'C');
        $pdf->SetXY(10,119);
        $pdf->Cell(72,10,'NAVEGACION',0,1,'C');
        $pdf->SetXY(87,119);
        $pdf->Cell(112,10,'SERVICIO',0,1,'C');
        $pdf->SetXY(10,140);
        $pdf->Cell(44,10,'CONSTRUCCION',0,1,'C');
        $pdf->SetXY(58,140);
        $pdf->Cell(44,10,'CASCO',0,1,'C');
        $pdf->SetXY(106,140);
        $pdf->Cell(44,10,'ARQUEO',0,1,'C');
        $pdf->SetXY(156,140);
        $pdf->Cell(44,10,'COMPRIMIENTO',0,1,'C');
        /** NAVIO AUTORIZADO Y NUMERO DE PASAJEROS */
        /** FALTA INFORMACION */
        $pdf->SetXY(35,188);
        $pdf->Cell(44,10,'PROPULSORA',0,1,'C');
        $pdf->SetXY(83,188);
        $pdf->Cell(44,10,'POTENCIA',0,1,'C');
        $pdf->SetXY(132,188);
        $pdf->Cell(44,10,'REBOQUE',0,1,'C');
        $pdf->SetFont('Arial','B',10);
        $pdf->SetXY(104,203);
        $pdf->Cell(51,10,'XXXXXXXXXXXXXXXXXXXXXX',0,1,'C');
        $pdf->SetXY(9,208);
        $pdf->Cell(38,10,'XXXXXXXXXXXXXXXX',0,1,'C');
        $pdf->SetXY(33,247);
        $pdf->Cell(62,10,'RIO DE JANEIRO',0,1,'C');
        $pdf->SetXY(104,247);
        $pdf->Cell(12,10,'31',0,1,'C');
        $pdf->SetXY(123,247);
        $pdf->Cell(36,10,'DICIEMBRE',0,1,'C');
        $pdf->SetXY(166,247);
        $pdf->Cell(20,10,'2021',0,1,'C');
        $pdf->Output('paginaEnBlanco.pdf' , 'I' );

      
    }
}