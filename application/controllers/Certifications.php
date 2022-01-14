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
        if($this->login_model->logged_id())
		{
			$this->session_data = array(
				'user_id'       => $this->session->user_id,
				'name'          => $this->session->name,
				'lastName'      => $this->session->lastName,
				'codTypeUser'   => $this->session->codTypeUser,
                'codShipowner'  => $this->session->codShipowner,
                'site_lang'  	=> $this->session->site_lang
			);
         $this->session_data['session'] = $this->login_model->getPermission($this->session->codTypeUser);
        }else{
            $this->session->unset_userdata('session_data');
            $this->session->sess_destroy();
			redirect("login");
		}
    }
    /**
     * METODO PARA REALIZAR PRUEBAS DE AJUSTE DEL CERTIFICADO
     */
    // public function configCert_get()
    // {
    //     $id = $this->input->get('id');
    //     $codTypeCertificate = $this->input->get('codTypeCertificate');
    //     $certificate = $this->certifications_model->getPathCertificate($codTypeCertificate);
    //     $data = $this->certifications_model->generarCertificado($id);

    //     // print_r($data); die;

    //     $pathDate = date("Y") . "/" . date("m") . "/" . date("d") . "/";
    //     getDir(FCPATH . 'uploads/Certificaciones/'.$pathDate);

    //     $config['upload_path'] = 'uploads/Certificaciones/'.$pathDate; 

    //     if (!empty($data))
    //     {
    //         foreach ($data as $key => $value) 
    //         {
    //             $file_name = $value['office'].str_pad($value['codOrder'], 3, '0', STR_PAD_LEFT).$value['anyo'].'-'.$value['codTypeCertification'].'_'.$value['number_imo'].'.pdf';
    //             $pdf = new FPDF();
    //             $pdf->AddPage('P','A4',0);
    //             $pdf->Image(FCPATH.'/public/certificaciones/02-NS-certificado-nacional-de-arqueacao_FRONT.jpg', 0, 0, 210, 300);
    //             $pdf->SetFont('Arial','B',12);
    //             $pdf->SetXY(169,23);
    //             $pdf->Cell(28,10,$value['office'].str_pad($value['codOrder'], 3, '0', STR_PAD_LEFT).$value['anyo'],0,1,'C');
    //             $pdf->SetXY(49,109);
    //             $pdf->Cell(146,8,$value['name'],0,1,'C');
    //             $pdf->SetXY(10,138);
    //             $pdf->Cell(61,8,'INDICATIVO DO NAVIO',0,1,'C');
    //             $pdf->SetXY(75,138);
    //             $pdf->Cell(61,8,'PORTO',0,1,'C');
    //             $pdf->SetXY(140,138);
    //             $pdf->Cell(61,8,'BATIMENTO DE  QUILHA',0,1,'C');
    //             $pdf->SetXY(10,167);
    //             $pdf->Cell(61,8,'COMPRIMIENTO DE REGRA',0,1,'C');
    //             $pdf->SetXY(75,167);
    //             $pdf->Cell(61,8,'BOCA',0,1,'C');
    //             $pdf->SetXY(140,167);
    //             $pdf->Cell(61,8,'PONTAL MOLDADO',0,1,'C');
    //             $pdf->SetXY(108,192);
    //             $pdf->Cell(41,8,'ARQUEACAO B',0,1,'C');
    //             $pdf->SetXY(108,210);
    //             $pdf->Cell(41,8,'ARQUEACAO LIQ',0,1,'C');
    //             $pdf->SetXY(119,254);
    //             $pdf->Cell(12,8,date('d'),0,1,'C');
    //             $pdf->SetXY(138,254);
    //             $pdf->Cell(35,8,$this->_formatDate(date('m')),0,1,'C');
    //             $pdf->SetXY(180,254);
    //             $pdf->Cell(20,8,date('Y'),0,1,'C');
    //             $pdf->Output($config['upload_path'].$file_name , 'I' );
    //         }
    //     }
    // }

    public function index_post()
    {
        $id = $this->input->post('id');
        $codTypeCertificate = $this->input->post('codTypeCertification');
        $certificate = $this->certifications_model->getPathCertificate($codTypeCertificate);
        $data = $this->certifications_model->generarCertificado($id);

        $pathDate = date("Y") . "/" . date("m") . "/" . date("d") . "/";
        getDir(FCPATH . 'uploads/Certificaciones/'.$pathDate);

        $config['upload_path'] = 'uploads/Certificaciones/'.$pathDate; 

        switch ($codTypeCertificate) {
            case 1:
                $this->_createCertificate1($data,$config,$certificate);
                break;
            
            case 2:
                $this->_createCertificate2($data,$config,$certificate);
                break;
            
            case 3:
                $this->_createCertificate3($data,$config,$certificate);
                break;

        }

    }

    private function _createCertificate1($data,$config,$certificate)
    {
        if (!empty($data))
        {
            foreach ($data as $key => $value) 
            {
                $file_name = $value['office'].str_pad($value['codOrder'], 3, '0', STR_PAD_LEFT).$value['anyo'].'-'.$value['codTypeCertification'].'_'.$value['number_imo'].'.pdf';
                $pdf = new FPDF();
                $pdf->AddPage('P','A4',0);
                $pdf->Image(FCPATH.$certificate['path_jpg_certification_front'], 0, 0, 210, 300);
                $pdf->SetFont('Arial','B',12);
                $pdf->SetXY(171,17);
                $pdf->Cell(29,10,$value['office'].str_pad($value['codOrder'], 3, '0', STR_PAD_LEFT).$value['anyo'],0,1,'C');
                $pdf->SetXY(100,80);
                $pdf->Cell(75,10, strtoupper(utf8_decode($value['nameEmployee'].' '.$value['lastName'])),0,1,'C');
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
            $config['codOrder'] = $value['codOrder'];
            $config['codTypeCertification'] = $value['codTypeCertification'];
            $config['numberOrder'] = $value['office'].str_pad($value['codOrder'], 3, '0', STR_PAD_LEFT).$value['anyo'];
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

    private function _createCertificate2($data,$config,$certificate)
    {
        if (!empty($data))
        {
            foreach ($data as $key => $value) 
            {
                $file_name = $value['office'].str_pad($value['codOrder'], 3, '0', STR_PAD_LEFT).$value['anyo'].'-'.$value['codTypeCertification'].'_'.$value['number_imo'].'.pdf';
                $pdf = new FPDF();
                $pdf->AddPage('P','A4',0);
                $pdf->Image(FCPATH.$certificate['path_jpg_certification_front'], 0, 0, 210, 300);
                $pdf->SetFont('Arial','B',12);
                $pdf->SetXY(169,23);
                $pdf->Cell(28,10,$value['office'].str_pad($value['codOrder'], 3, '0', STR_PAD_LEFT).$value['anyo'],0,1,'C');
                $pdf->SetXY(49,109);
                $pdf->Cell(146,8,$value['name'],0,1,'C');
                $pdf->SetXY(10,138);
                $pdf->Cell(61,8,'INDICATIVO DO NAVIO',0,1,'C');
                $pdf->SetXY(75,138);
                $pdf->Cell(61,8,'PORTO',0,1,'C');
                $pdf->SetXY(140,138);
                $pdf->Cell(61,8,'BATIMENTO DE  QUILHA',0,1,'C');
                $pdf->SetXY(10,167);
                $pdf->Cell(61,8,'COMPRIMIENTO DE REGRA',0,1,'C');
                $pdf->SetXY(75,167);
                $pdf->Cell(61,8,'BOCA',0,1,'C');
                $pdf->SetXY(140,167);
                $pdf->Cell(61,8,'PONTAL MOLDADO',0,1,'C');
                $pdf->SetXY(108,192);
                $pdf->Cell(41,8,'ARQUEACAO B',0,1,'C');
                $pdf->SetXY(108,210);
                $pdf->Cell(41,8,'ARQUEACAO LIQ',0,1,'C');
                $pdf->SetXY(119,254);
                $pdf->Cell(12,8,date('d'),0,1,'C');
                $pdf->SetXY(138,254);
                $pdf->Cell(35,8,$this->_formatDate(date('m')),0,1,'C');
                $pdf->SetXY(180,254);
                $pdf->Cell(20,8,date('Y'),0,1,'C');
                $pdf->Output($config['upload_path'].$file_name , 'F' );
            }

            $config['file_name'] = $file_name;
            $config['extension_file'] = 'pdf';
            $config['codOrder'] = $value['codOrder'];
            $config['codTypeCertification'] = $value['codTypeCertification'];
            $config['numberOrder'] = $value['office'].str_pad($value['codOrder'], 3, '0', STR_PAD_LEFT).$value['anyo'];
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

    private function _createCertificate3($data,$config,$certificate)
    {
        if (!empty($data))
        {
            foreach ($data as $key => $value) 
            {
                $file_name = $value['office'].str_pad($value['codOrder'], 3, '0', STR_PAD_LEFT).$value['anyo'].'-'.$value['codTypeCertification'].'_'.$value['number_imo'].'.pdf';
                $pdf = new FPDF();
                $pdf->AddPage('P','A4',0);
                $pdf->Image(FCPATH.$certificate['path_jpg_certification_front'], 0, 0, 210, 300);
                $pdf->SetFont('Arial','B',12);
                $pdf->SetXY(168,23);
                $pdf->Cell(29,10,$value['office'].str_pad($value['codOrder'], 3, '0', STR_PAD_LEFT).$value['anyo'],0,1,'C');
                $pdf->SetXY(55,53);
                $pdf->Cell(146,8,$value['name'],0,1,'C');
                $pdf->SetXY(50,60);
                $pdf->Cell(46,8,$value['year_build'],0,1,'C');
                $pdf->SetXY(120,60);
                $pdf->Cell(82,8,$value['shipyard'],0,1,'C');
                $pdf->SetXY(28,67);
                $pdf->Cell(72,8,$value['name_ship'],0,1,'C');
                $pdf->SetXY(128,67);
                $pdf->Cell(74,8,'INTERESSADO',0,1,'C');
                $pdf->SetXY(48,74);
                $pdf->Cell(153,8,'EXECUTOR DO ENSAIO',0,1,'C');
                $pdf->SetXY(10,102);
                $pdf->Cell(60,8,'LO(m)',0,1,'C');
                $pdf->SetXY(75,102);
                $pdf->Cell(60,8,'BOCA MOLDADA (m)',0,1,'C');
                $pdf->SetXY(140,102);
                $pdf->Cell(60,8,'PONTAL MOLDADO (m)',0,1,'C');
                $pdf->SetXY(26,125);
                $pdf->Cell(77,8,'MARCA',0,1,'C');
                $pdf->SetXY(123,125);
                $pdf->Cell(77,8,'MODELO',0,1,'C');
                $pdf->SetXY(34,135);
                $pdf->Cell(68,8,'N DE SERIE',0,1,'C');
                $pdf->SetXY(132,135);
                $pdf->Cell(68,8,'QUANTIDADE',0,1,'C');
                $pdf->SetXY(47,144);
                $pdf->Cell(55,8,'POTENCIA HP',0,1,'C');
                $pdf->SetXY(138,144);
                $pdf->Cell(63,8,'ROTACION',0,1,'C');
                $pdf->SetXY(30,154);
                $pdf->Cell(170,8,'REDUCCION',0,1,'C');
                $pdf->SetXY(21,174);
                $pdf->Cell(82,8,'TIPO',0,1,'C');
                $pdf->SetXY(128,174);
                $pdf->Cell(72,8,'N PAS',0,1,'C');
                $pdf->SetXY(32,183);
                $pdf->Cell(71,8,'DIAMETRO',0,1,'C');
                $pdf->SetXY(123,183);
                $pdf->Cell(78,8,'PASSO',0,1,'C');
                $pdf->SetXY(96,196);
                $pdf->Cell(62,8,'ESTATICA',0,1,'C');
                $pdf->SetXY(22,209);
                $pdf->Cell(80,8,'LOCAL',0,1,'C');
                $pdf->SetXY(117,209);
                $pdf->Cell(34,8,'DATA',0,1,'C');
                $pdf->SetXY(167,209);
                $pdf->Cell(34,8,'HORA',0,1,'C');
                $pdf->SetXY(34,219);
                $pdf->Cell(27,8,'VENTO',0,1,'C');
                $pdf->SetXY(101,219);
                $pdf->Cell(30,8,'CORRENTEZA',0,1,'C');
                $pdf->SetXY(172,219);
                $pdf->Cell(29,8,'PROFUNDID',0,1,'C');
                $pdf->SetXY(28,228);
                $pdf->Cell(27,8,'HAV',0,1,'C');
                $pdf->SetXY(76,228);
                $pdf->Cell(27,8,'HAR',0,1,'C');
                $pdf->SetXY(127,228);
                $pdf->Cell(26,8,'TRIM',0,1,'C');
                $pdf->SetXY(174,228);
                $pdf->Cell(27,8,'LCABO',0,1,'C');
                $pdf->Output($config['upload_path'].$file_name , 'F' );
            }

            $config['file_name'] = $file_name;
            $config['extension_file'] = 'pdf';
            $config['codOrder'] = $value['codOrder'];
            $config['codTypeCertification'] = $value['codTypeCertification'];
            $config['numberOrder'] = $value['office'].str_pad($value['codOrder'], 3, '0', STR_PAD_LEFT).$value['anyo'];
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
        // print_r($data);
        $this->load->view('certifications/modalCertificado', $data);
    }

    /**
     * FUNCION PARA DAR FORMATO AL MES EN LETRAS
     */
    private function _formatDate($month)
    {
        switch ($month) {
            case 1:
                return 'Enero';
                break;
            
            case 2:
                return 'Febrero';
                break;
            
            case 3:
                return 'Marzo';
                break;

            case 4:
                return 'Abril';
                break;
            
            case 5:
                return 'Mayo';
                break;
            
            case 6:
                return 'Junio';
                break;

            case 7:
                return 'Julio';
                break;
            
            case 8:
                return 'Agosto';
                break;

            case 9:
                return 'Septiembre';
                break;

            case 10:
                return 'Octubre';
                break;

            case 11:
                return 'Noviembre';
                break;

            case 12:
                return 'Diciembre';
                break;
        }
    }
}