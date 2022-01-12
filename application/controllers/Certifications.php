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
        $this->load->model(array("certifications_model","orders_model","login_model"));
        $this->load->library(array('custom_log','session'));
        $this->load->helper(array("url","custom"));
        setlocale(LC_ALL, 'es_ES');
        // if($this->login_model->logged_id())
		// {
		// 	$this->session_data = array(
		// 		'user_id'       => $this->session->user_id,
		// 		'name'          => $this->session->name,
		// 		'lastName'      => $this->session->lastName,
		// 		'codTypeUser'   => $this->session->codTypeUser
		// 	);
        // }else{
        //     $this->session->unset_userdata('session_data');
        //     $this->session->sess_destroy();
		// 	redirect("login");
		// }
    }

    public function configCert_get()
    {
        $id = $this->input->get('id');
        $codOffice = $this->input->get('codOffice');
        $codTypeCertificate = $this->input->get('codTypeCertificate');
        $certificate = $this->certifications_model->getPathCertificate($codTypeCertificate);
        $data = $this->certifications_model->generarCertificado($id,$codOffice);

        // print_r($data); die;

        $pathDate = date("Y") . "/" . date("m") . "/" . date("d") . "/";
        getDir(FCPATH . 'uploads/Certificaciones/'.$pathDate);

        $config['upload_path'] = 'uploads/Certificaciones/'.$pathDate; 

        if (!empty($data))
        {
            foreach ($data as $key => $value) 
            {
                $file_name = $value['office'].str_pad($value['id'], 3, '0', STR_PAD_LEFT).$value['anyo'].'-'.$value['codTypeCertification'].'_'.$value['number_imo'].'.pdf';
                $pdf = new FPDF();
                $pdf->AddPage('P','A4',0);
                $pdf->Image(FCPATH.'/public/certificaciones/03-NS-Certificado-de-Tracao-Estatica_FRONT.jpg', 0, 0, 210, 300);
              
                $pdf->Output($config['upload_path'].$file_name , 'I' );
            }
        }
    }

    public function index_post()
    {
        $id = $this->input->post('id');
        $codOffice = $this->input->post('codOffice');
        $codTypeCertificate = $this->input->post('codTypeCertificate');
        $certificate = $this->certifications_model->getPathCertificate($codTypeCertificate);
        $data = $this->certifications_model->generarCertificado($id,$codOffice);

        // print_r($certificate); die;

        $pathDate = date("Y") . "/" . date("m") . "/" . date("d") . "/";
        getDir(FCPATH . 'uploads/Certificaciones/'.$pathDate);

        $config['upload_path'] = 'uploads/Certificaciones/'.$pathDate; 

        switch ($codTypeCertificate) {
            case 1:
                $this->_createCertificate1($data,$config,$certificate);
                break;
            
            default:
                # code...
                break;
        }

    }

    private function _createCertificate1($data,$config,$certificate)
    {
        if (!empty($data))
        {
            foreach ($data as $key => $value) 
            {
                $file_name = $value['office'].str_pad($value['id'], 3, '0', STR_PAD_LEFT).$value['anyo'].'-'.$value['codTypeCertification'].'_'.$value['number_imo'].'.pdf';
                $pdf = new FPDF();
                $pdf->AddPage('P','A4',0);
                $pdf->Image(FCPATH.$certificate['path_jpg_certification_front'], 0, 0, 210, 300);
                $pdf->SetFont('Arial','B',12);
                $pdf->SetXY(171,17);
                $pdf->Cell(29,10,$value['office'].str_pad($value['id'], 3, '0', STR_PAD_LEFT).$value['anyo'],0,1,'C');
                $pdf->SetXY(100,80);
                $pdf->Cell(75,10, strtoupper(utf8_decode($value['name'].' '.$value['lastName'])),0,1,'C');
                $pdf->SetXY(10,100);
                $pdf->Cell(114,10,strtoupper(utf8_decode($value['name_ship'])),0,1,'C');
                $pdf->SetXY(127,100);
                $pdf->Cell(32,10,'INDICATIVO',0,1,'C');
                $pdf->SetXY(163,100);
                $pdf->Cell(35,10,'INSCRIPCION',0,1,'C');
                $pdf->SetXY(10,119);
                $pdf->Cell(72,10,'NAVEGACION',0,1,'C');
                $pdf->SetXY(87,119);
                $pdf->Cell(112,10, $value['service'],0,1,'C');
                $pdf->SetXY(10,140);
                $pdf->Cell(44,10, $value['year_build'],0,1,'C');
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
                $pdf->Cell(44,10, $value['power_speed'],0,1,'C');
                $pdf->SetXY(132,188);
                $pdf->Cell(44,10, $value['structure'],0,1,'C');
                $pdf->SetFont('Arial','B',10);
                $pdf->SetXY(104,203);
                $pdf->Cell(51,10,'XXXXXXXXXXXXXXXXXXXXXX',0,1,'C');
                $pdf->SetXY(9,208);
                $pdf->Cell(38,10,'XXXXXXXXXXXXXXXX',0,1,'C');
                $pdf->SetXY(33,247);
                $pdf->Cell(62,10,'RIO DE JANEIRO',0,1,'C');
                $pdf->SetXY(104,247);
                $pdf->Cell(12,10, date('d'),0,1,'C');
                $pdf->SetXY(123,247);
                $pdf->Cell(36,10, strtoupper(strftime('%B')),0,1,'C');
                $pdf->SetXY(166,247);
                $pdf->Cell(20,10, date('Y'),0,1,'C');
                $pdf->Output($config['upload_path'].$file_name , 'F' );
            }

            $config['file_name'] = $file_name;
            $config['extension_file'] = 'pdf';
            $config['codOrder'] = $value['id'];
            $config['codTypeCertification'] = $value['codTypeCertification'];
            $config['numberOrder'] = $value['office'].str_pad($value['id'], 3, '0', STR_PAD_LEFT).$value['anyo'];
            $config['codUserAuthorized'] = $value['codUser'];

            $response = $this->certifications_model->insertCertificate($config);

            if($response)
            {
                    echo "<script>alert('Certificado '".$certificate['name_certificate']."' Generado satisfactoriamente!!');</script>";
                    redirect('listOrders', 'refresh');
            }else{
                echo "<script>alert('Hubo un error al Generar el Certificado.');</script>";
                redirect('listOrders', 'refresh');
            }
        }else{
            echo "<script>alert('No se puede Generar el Certificado.');</script>";
            redirect('listOrders', 'refresh');
        }
    }

    public function modalCertificado_get()
    {
        $id = $this->input->get('id');
        $data = $this->orders_model->getOrderById($id);
        // print_r($data); die;
        $this->load->view('certifications/modalCertificado', $data);
    }
}