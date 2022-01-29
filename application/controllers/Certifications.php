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
        $this->load->model(array("certifications_model","orders_model","login_model", "logs_model"));
        $this->load->library(array('custom_log','session'));
        $this->load->helper(array("url","custom"));
        setlocale(LC_ALL, 'es_ES');
        // if($this->login_model->logged_id())
		// {
		// 	$this->session_data = array(
		// 		'user_id'       => $this->session->user_id,
		// 		'name'          => $this->session->name,
		// 		'lastName'      => $this->session->lastName,
		// 		'codTypeUser'   => $this->session->codTypeUser,
        //         'codShipowner'  => $this->session->codShipowner,
        //         'site_lang'  	=> $this->session->site_lang
		// 	);
        //  $this->session_data['session'] = $this->login_model->getPermission($this->session->codTypeUser);
        // }else{
        //     $this->session->unset_userdata('session_data');
        //     $this->session->sess_destroy();
		// 	redirect("login");
		// }
    }
    /**
     * METODO PARA REALIZAR PRUEBAS DE AJUSTE DEL CERTIFICADO
     */
    public function configCert_get()
    {
        $id = $this->input->get('id');
        $codTypeCertificate = $this->input->get('codTypeCertification');
        $downloadType = $this->input->get('downloadType');
        $certificate = $this->certifications_model->getPathCertificate($codTypeCertificate);
        $retVal = ($downloadType == 'F') ? 'VALIDADO' : 'PROCESO' ;
        $data = $this->certifications_model->generarCertificado($id,$retVal);

        $pathDate = date("Y") . "/" . date("m") . "/" . date("d") . "/";
        getDir(FCPATH . 'uploads/Certificaciones/'.$pathDate);

        $config['upload_path'] = 'uploads/Certificaciones/'.$pathDate;

        if ($codTypeCertificate == 1) {
            /** DATA EXTRA convalidationsNS01 / dataExtraNS01 */
            $data['dataNS'] = $this->orders_model->getDataNS('dataExtraNS01', ['codOrder' => $id]);
            if ($data['dataNS']) {
                $data['dataNSEx'] = $this->orders_model->getDataNS('convalidationsNS01', ['codNS01' => $data['dataNS']['id']]);
            }

            if (!empty($data))
            {
                $dateInspect = explode('-',$data['data']['inspect_date_end']);
                $expireCert = date("Y-m-d",strtotime($data['data']['inspect_date_end']."+ 1824 days"));
                $array_expireCert =  explode("-", date("Y-m-d",strtotime($data['data']['inspect_date_end']."+ 1824 days")));
                $file_name = $data['data']['office'].str_pad($data['data']['codOrder'], 3, '0', STR_PAD_LEFT).$data['data']['anyo'].'-'.$data['data']['codTypeCertification'].'_'.$data['data']['number_imo'].'.pdf';
                $pdf = new FPDF();
                $pdf->AddPage('P','A4',0);
                $pdf->Image(FCPATH.$certificate['path_jpg_certification_front'], 0, 0, 210, 300);
                $pdf->SetFont('Arial','B',12);
                $pdf->SetXY(171,17);
                $pdf->Cell(29,10,$data['data']['office'].' '.str_pad($data['data']['codOrder'], 3, '0', STR_PAD_LEFT).$data['data']['anyo'],0,1,'C');
                $pdf->SetXY(100,80);
                $pdf->Cell(75,10, strtoupper(utf8_decode($data['data']['nameEmployee'].' '.$data['data']['lastName'])),0,1,'C');
                $pdf->SetXY(10,100);
                $pdf->Cell(114,10,strtoupper(utf8_decode($data['data']['name'])),0,1,'C');
                $pdf->SetXY(127,100);
                $pdf->Cell(32,10,$data['data']['call_sign'],0,1,'C');
                $pdf->SetXY(163,100);
                $pdf->Cell(35,10,$data['data']['number_register'],0,1,'C');
                $pdf->SetXY(10,119);
                $pdf->Cell(72,10,$data['data']['navigation'],0,1,'C');
                $pdf->SetXY(87,119);
                $pdf->Cell(112,10, $data['data']['service'],0,1,'C');
                $pdf->SetXY(10,140);
                $pdf->Cell(44,10, $data['data']['year_build'],0,1,'C');
                $pdf->SetXY(58,140);
                $pdf->Cell(44,10,$data['data']['structure'],0,1,'C');
                $pdf->SetXY(106,140);
                $pdf->Cell(44,10,$data['data']['gross_tonnage'],0,1,'C');
                $pdf->SetXY(156,140);
                $pdf->Cell(44,10,$data['data']['total_length'],0,1,'C');

                if ($data['dataNS']['transport_commodity']) {
                    $pdf->SetXY(40,164);
                    $pdf->Cell(44,10,'X',0,1,'C');
                }else{
                    $pdf->SetXY(59,164);
                    $pdf->Cell(44,10,'X',0,1,'C');
                }
                
                $pdf->SetXY(35,188);
                $pdf->Cell(44,10,$data['dataNS']['propulsion_plant_type'],0,1,'C');
                $pdf->SetXY(83,188);
                $pdf->Cell(44,10, $data['dataNS']['power_total_efective'],0,1,'C');
                $pdf->SetXY(132,188);
                $pdf->Cell(44,10, $data['data']['structure'],0,1,'C');
                $pdf->SetFont('Arial','B',10);
                $pdf->SetXY(104,203);
                $pdf->Cell(51,10,$data['data']['name'],0,1,'C');
                $pdf->SetXY(9,208);
                $pdf->Cell(38,10,$data['dataNS']['poll'],0,1,'C');
                if ($data['dataNS']['normam01']) {
                    $pdf->SetXY(135,209);
                    $pdf->Cell(18,10,'X',0,1,'C');
                }
                if ($data['dataNS']['normam02']) {
                    $pdf->SetXY(163,209);
                    $pdf->Cell(18,10,'X',0,1,'C');
                }
                if ($data['dataNS']['public_water_transport']) {
                    $pdf->SetXY(168,218);
                    $pdf->Cell(18,10,'X',0,1,'C');
                }
                $pdf->SetXY(33,247);
                $pdf->Cell(62,10,$data['dataNS']['issued_in'],0,1,'C');
                $pdf->SetXY(104,247);
                $pdf->Cell(12,10, $dateInspect[2],0,1,'C');
                $pdf->SetXY(123,247);
                $pdf->Cell(36,10, $this->_formatDate($dateInspect[1]),0,1,'C');
                $pdf->SetXY(166,247);
                $pdf->Cell(20,10, $dateInspect[0],0,1,'C');
                /**
                 * PAGINA 2
                 */
                $pdf->AddPage('P','A4',0);
                $pdf->Image(FCPATH.$certificate['path_jpg_certification_back'], 0, 0, 210, 300);
                if ($data['dataNSEx']['visit_annual01_init']) {
                    $pdf->SetXY(44,94);
                    $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual01_init'],-2),0,1,'C');
                    $pdf->SetXY(50,94);
                    $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual01_init'],-5,2),0,1,'C');
                    $pdf->SetXY(59,94);
                    $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual01_init'],0,4),0,1,'C');
                }
                if ($data['dataNSEx']['visit_annual01_end']) {
                    $pdf->SetXY(76,94);
                    $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual01_end'],-2),0,1,'C');
                    $pdf->SetXY(83,94);
                    $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual01_end'],-5,2),0,1,'C');
                    $pdf->SetXY(91,94);
                    $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual01_end'],0,4),0,1,'C');
                }
                if ($data['dataNSEx']['place_date_visit01']) {
                    $pdf->SetXY(106,94);
                    $pdf->Cell(62,6,$data['dataNSEx']['place_date_visit01'],0,1,'C');
                }
                if ($data['dataNSEx']['surveyor01']) {
                    $pdf->SetXY(171,94);
                    $pdf->Cell(30,6,$data['dataNSEx']['surveyor01'],0,1,'C');
                }

                if ($data['dataNSEx']['visit_annual02_init']) {
                    $pdf->SetXY(44,102);
                    $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual02_init'],-2),0,1,'C');
                    $pdf->SetXY(50,102);
                    $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual02_init'],-5,2),0,1,'C');
                    $pdf->SetXY(59,102);
                    $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual02_init'],0,4),0,1,'C');
                }
                if ($data['dataNSEx']['visit_annual02_end']) {
                    $pdf->SetXY(76,102);
                    $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual02_end'],-2),0,1,'C');
                    $pdf->SetXY(83,102);
                    $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual02_end'],-5,2),0,1,'C');
                    $pdf->SetXY(91,102);
                    $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual02_end'],0,4),0,1,'C');
                }
                if ($data['dataNSEx']['place_date_visit02']) {
                    $pdf->SetXY(106,102);
                    $pdf->Cell(62,6,$data['dataNSEx']['place_date_visit02'],0,1,'C');
                }
                if ($data['dataNSEx']['surveyor02']) {
                    $pdf->SetXY(171,102);
                    $pdf->Cell(30,6,$data['dataNSEx']['surveyor02'],0,1,'C');
                }

                if ($data['dataNSEx']['visit_intermedia_init']) {
                    $pdf->SetXY(44,110);
                    $pdf->Cell(8,6,substr($data['dataNSEx']['visit_intermedia_init'],-2),0,1,'C');
                    $pdf->SetXY(50,110);
                    $pdf->Cell(8,6,substr($data['dataNSEx']['visit_intermedia_init'],-5,2),0,1,'C');
                    $pdf->SetXY(59,110);
                    $pdf->Cell(8,6,substr($data['dataNSEx']['visit_intermedia_init'],0,4),0,1,'C');
                }
                if ($data['dataNSEx']['visit_intermedia_end']) {
                    $pdf->SetXY(76,110);
                    $pdf->Cell(8,6,substr($data['dataNSEx']['visit_intermedia_end'],-2),0,1,'C');
                    $pdf->SetXY(83,110);
                    $pdf->Cell(8,6,substr($data['dataNSEx']['visit_intermedia_end'],-5,2),0,1,'C');
                    $pdf->SetXY(91,110);
                    $pdf->Cell(8,6,substr($data['dataNSEx']['visit_intermedia_end'],0,4),0,1,'C');
                }
                if ($data['dataNSEx']['place_date_intermedia']) {
                    $pdf->SetXY(106,110);
                    $pdf->Cell(62,6,$data['dataNSEx']['place_date_intermedia'],0,1,'C');
                }
                if ($data['dataNSEx']['intermedia_surveyor']) {
                    $pdf->SetXY(171,110);
                    $pdf->Cell(30,6,$data['dataNSEx']['intermedia_surveyor'],0,1,'C');
                }

                if ($data['dataNSEx']['visit_annual03_init']) {
                    $pdf->SetXY(44,119);
                    $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual03_init'],-2),0,1,'C');
                    $pdf->SetXY(50,119);
                    $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual03_init'],-5,2),0,1,'C');
                    $pdf->SetXY(59,119);
                    $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual03_init'],0,4),0,1,'C');
                }
                if ($data['dataNSEx']['visit_annual03_end']) {
                    $pdf->SetXY(76,119);
                    $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual03_end'],-2),0,1,'C');
                    $pdf->SetXY(83,119);
                    $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual03_end'],-5,2),0,1,'C');
                    $pdf->SetXY(91,119);
                    $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual03_end'],0,4),0,1,'C');
                }
                if ($data['dataNSEx']['place_date_visit03']) {
                    $pdf->SetXY(106,119);
                    $pdf->Cell(62,6,$data['dataNSEx']['place_date_visit03'],0,1,'C');
                }
                if ($data['dataNSEx']['surveyor03']) {
                    $pdf->SetXY(171,119);
                    $pdf->Cell(30,6,$data['dataNSEx']['surveyor03'],0,1,'C');
                }

                if ($data['dataNSEx']['visit_annual04_init']) {
                    $pdf->SetXY(44,127);
                    $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual04_init'],-2),0,1,'C');
                    $pdf->SetXY(50,127);
                    $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual04_init'],-5,2),0,1,'C');
                    $pdf->SetXY(59,127);
                    $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual04_init'],0,4),0,1,'C');
                }
                if ($data['dataNSEx']['visit_annual04_end']) {
                    $pdf->SetXY(76,127);
                    $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual04_end'],-2),0,1,'C');
                    $pdf->SetXY(83,127);
                    $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual04_end'],-5,2),0,1,'C');
                    $pdf->SetXY(91,127);
                    $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual04_end'],0,4),0,1,'C');
                }
                if ($data['dataNSEx']['place_date_visit04']) {
                    $pdf->SetXY(106,127);
                    $pdf->Cell(62,6,$data['dataNSEx']['place_date_visit04'],0,1,'C');
                }
                if ($data['dataNSEx']['surveyor04']) {
                    $pdf->SetXY(171,127);
                    $pdf->Cell(30,6,$data['dataNSEx']['surveyor04'],0,1,'C');
                }

                $pdf->SetXY(70,162);
                $pdf->Cell(38,6,$data['dataNS']['seated_passengersP'],0,0,'C');
                $pdf->SetXY(116,162);
                $pdf->Cell(38,6,$data['dataNS']['seated_passengersS'],0,0,'C');
                $pdf->SetXY(162,162);
                $pdf->Cell(38,6,$data['dataNS']['seated_passengersL'],0,0,'C');

                $pdf->SetXY(70,170);
                $pdf->Cell(38,6,$data['dataNS']['passengers_cabinP'],0,0,'C');
                $pdf->SetXY(116,170);
                $pdf->Cell(38,6,$data['dataNS']['passengers_cabinS'],0,0,'C');
                $pdf->SetXY(162,170);
                $pdf->Cell(38,6,$data['dataNS']['passengers_cabinL'],0,0,'C');

                $pdf->SetXY(70,179);
                $pdf->Cell(38,6,$data['dataNS']['passengers_networksP'],0,0,'C');
                $pdf->SetXY(116,179);
                $pdf->Cell(38,6,$data['dataNS']['passengers_networksS'],0,0,'C');
                $pdf->SetXY(162,179);
                $pdf->Cell(38,6,$data['dataNS']['passengers_networksL'],0,0,'C');

                $pdf->SetXY(70,189);
                $pdf->Cell(130,6,$data['dataNS']['carga_geral'],0,0,'L');
                $pdf->SetXY(70,197);
                $pdf->Cell(130,6,$data['dataNS']['helmet'],0,1,'L');
                $pdf->SetXY(70,207);
                $pdf->Cell(130,6,$data['dataNS']['almoxarifado'],0,1,'L');
                $pdf->SetXY(70,216);
                $pdf->Cell(130,6,$data['dataNS']['main_deposit'],0,1,'L');
                $pdf->SetXY(70,225);
                $pdf->Cell(130,6,$data['dataNS']['upper_deposit'],0,1,'L');
                
                $pdf->SetXY(12,243);
                $pdf->MultiCell(188,6,utf8_decode($data['dataNS']['observations']),0,'L',false);
                $pdf->SetXY(30,265);
                $pdf->Cell(8,6,$array_expireCert[2],0,1,'C');
                $pdf->SetXY(45,265);
                $pdf->Cell(42,6,$this->_formatDate($array_expireCert[1]),0,1,'C');
                $pdf->SetXY(97,265);
                $pdf->Cell(17,6,$array_expireCert[0],0,1,'C');
                
                $pdf->Output($config['upload_path'].$file_name , 'I' ); // I: envia el fichero a navegador F: guarda el fichero en un fichero local de nombre name
            
            }
        }

        if ($codTypeCertificate == 2) {
            /** DATA EXTRA convalidationsNS01 / dataExtraNS01 */
            $data['dataNS'] = $this->orders_model->getDataNS('dataExtraNS02', ['codOrder' => $id]);
// print_r($data); die;
            if (!empty($data))
            {
                // foreach ($data as $key => $value) 
                // {
                    $dateInspect = explode('-',$data['data']['inspect_date_end']);
                    $expireCert = date("Y-m-d",strtotime($data['data']['inspect_date_end']."+ 364 days"));
                    $array_expireCert =  explode("-", date("Y-m-d",strtotime($data['data']['inspect_date_end']."+ 364 days")));
                    $file_name = $data['data']['office'].str_pad($data['data']['codOrder'], 3, '0', STR_PAD_LEFT).$data['data']['anyo'].'-'.$data['data']['codTypeCertification'].'_'.$data['data']['number_imo'].'.pdf';
                    $pdf = new FPDF();
                    $pdf->AddPage('P','A4',0);
                    $pdf->Image(FCPATH.$certificate['path_jpg_certification_front'], 0, 0, 210, 300);
                    $pdf->SetFont('Arial','B',12);
                    $pdf->SetXY(170,23);
                    $pdf->Cell(28,10,$data['data']['office'].' '.str_pad($data['data']['codOrder'], 3, '0', STR_PAD_LEFT).$data['data']['anyo'],0,1,'C');
                    $pdf->SetXY(49,109);
                    $pdf->Cell(146,8,$data['data']['name'],0,1,'C');
                    $pdf->SetXY(10,138);
                    $pdf->Cell(61,8,$data['data']['call_sign'],0,1,'C');
                    $pdf->SetXY(75,138);
                    $pdf->Cell(61,8,$data['dataNS']['port_inscription'],0,1,'C');
                    $pdf->SetXY(140,138);
                    $pdf->Cell(61,8,$data['dataNS']['batimento'],0,1,'C');
                    $pdf->SetXY(10,167);
                    $pdf->Cell(61,8,$data['dataNS']['ruler_length'],0,1,'C');
                    $pdf->SetXY(75,167);
                    $pdf->Cell(61,8,$data['dataNS']['boca'],0,1,'C');
                    $pdf->SetXY(140,167);
                    $pdf->Cell(61,8,$data['dataNS']['molded_knit'],0,1,'C');
                    $pdf->SetXY(108,192);
                    $pdf->Cell(41,8,$data['data']['gross_tonnage'],0,1,'C');
                    $pdf->SetXY(108,210);
                    $pdf->Cell(41,8,$data['data']['liquid_tonnage'],0,1,'C');
                    $pdf->SetXY(33,254);
                    $pdf->Cell(76,8,$data['dataNS']['emitido'],0,1,'C');
                    $pdf->SetXY(119,254);
                    $pdf->Cell(12,8,$dateInspect[2],0,1,'C');
                    $pdf->SetXY(138,254);
                    $pdf->Cell(35,8,$this->_formatDate($dateInspect[1]),0,1,'C');
                    $pdf->SetXY(180,254);
                    $pdf->Cell(20,8,$dateInspect[0],0,1,'C');
                    /**
                     * PAGINA 2
                     */
                    $pdf->AddPage('P','A4',0);
                    $pdf->Image(FCPATH.$certificate['path_jpg_certification_back'], 0, 0, 210, 300);
                    $pdf->SetXY(173,198);
                    $pdf->Cell(26,8,$data['dataNS']['number_passengers_berths'],0,1,'C');
                    $pdf->SetXY(173,215);
                    $pdf->Cell(26,8,$data['dataNS']['number_total_passengers'],0,1,'C');
                    $pdf->SetXY(108,235);
                    $pdf->Cell(90,8,$data['dataNS']['molded_project'],0,1,'C');

                    $pdf->SetXY(10,254);
                    $pdf->Cell(90,8,$data['dataNS']['place_date_original'],0,1,'C');
                    $pdf->SetXY(108,254);
                    $pdf->Cell(90,8,$data['dataNS']['place_date_last'],0,1,'C');
                    
                    $pdf->SetFont('Arial','',10);
                    $pdf->SetXY(10,198);
                    $pdf->MultiCell(94,8,utf8_decode($data['dataNS']['place_exclude']),0,'L',false);
                    $pdf->SetXY(46,267);
                    $pdf->MultiCell(155,4,utf8_decode($data['dataNS']['observations']),0,'L',false);

                    $pdf->Output($config['upload_path'].$file_name , 'I' ); // I: envia el fichero a navegador F: guarda el fichero en un fichero local de nombre name
                // }
            }
        }

    }

    public function index_post()
    {
        $id = $this->input->post('id');
        $codTypeCertificate = $this->input->post('codTypeCertification');
        $downloadType = $this->input->post('downloadType');
        $certificate = $this->certifications_model->getPathCertificate($codTypeCertificate);
        $retVal = ($downloadType == 'F') ? 'VALIDADO' : 'PROCESO' ;
        $data = $this->certifications_model->generarCertificado($id,$retVal);

        $pathDate = date("Y") . "/" . date("m") . "/" . date("d") . "/";
        getDir(FCPATH . 'uploads/Certificaciones/'.$pathDate);

        $config['upload_path'] = 'uploads/Certificaciones/'.$pathDate; 

        switch ($codTypeCertificate) {
            case 1:
                /** DATA EXTRA convalidationsNS01 / dataExtraNS01 */
                $data['dataNS'] = $this->orders_model->getDataNS('dataExtraNS01', ['codOrder' => $id]);
                if ($data['dataNS']) {
                    $data['dataNSEx'] = $this->orders_model->getDataNS('convalidationsNS01', ['codNS01' => $data['dataNS']['id']]);
                }
                $this->_createCertificate1($data,$config,$certificate,$downloadType);
                break;
            
            case 2:
                $data['dataNS'] = $this->orders_model->getDataNS('dataExtraNS02', ['codOrder' => $id]);
                $this->_createCertificate2($data,$config,$certificate,$downloadType);
                break;
            
            case 3:
                $this->_createCertificate3($data,$config,$certificate,$downloadType);
                break;

        }

    }

    private function _createCertificate1($data,$config,$certificate,$downloadType)
    {
        if (!empty($data))
        {
            $dateInspect = explode('-',$data['data']['inspect_date_end']);
            $expireCert = date("Y-m-d",strtotime($data['data']['inspect_date_end']."+ 1824 days"));
            $array_expireCert =  explode("-", date("Y-m-d",strtotime($data['data']['inspect_date_end']."+ 1824 days")));
            $file_name = $data['data']['office'].str_pad($data['data']['codOrder'], 3, '0', STR_PAD_LEFT).$data['data']['anyo'].'-'.$data['data']['codTypeCertification'].'_'.$data['data']['number_imo'].'.pdf';
            
            $pdf = new FPDF();
            $pdf->AddPage('P','A4',0);
            $pdf->Image(FCPATH.$certificate['path_jpg_certification_front'], 0, 0, 210, 300);
            $pdf->SetFont('Arial','B',12);
            $pdf->SetXY(171,17);
            $pdf->Cell(29,10,$data['data']['office'].' '.str_pad($data['data']['codOrder'], 3, '0', STR_PAD_LEFT).$data['data']['anyo'],0,1,'C');
            $pdf->SetXY(100,80);
            $pdf->Cell(75,10, strtoupper(utf8_decode($data['data']['nameEmployee'].' '.$data['data']['lastName'])),0,1,'C');
            $pdf->SetXY(10,100);
            $pdf->Cell(114,10,strtoupper(utf8_decode($data['data']['name'])),0,1,'C');
            $pdf->SetXY(127,100);
            $pdf->Cell(32,10,$data['data']['call_sign'],0,1,'C');
            $pdf->SetXY(163,100);
            $pdf->Cell(35,10,$data['data']['number_register'],0,1,'C');
            $pdf->SetXY(10,119);
            $pdf->Cell(72,10,$data['data']['navigation'],0,1,'C');
            $pdf->SetXY(87,119);
            $pdf->Cell(112,10, $data['data']['service'],0,1,'C');
            $pdf->SetXY(10,140);
            $pdf->Cell(44,10, $data['data']['year_build'],0,1,'C');
            $pdf->SetXY(58,140);
            $pdf->Cell(44,10,$data['data']['structure'],0,1,'C');
            $pdf->SetXY(106,140);
            $pdf->Cell(44,10,$data['data']['gross_tonnage'],0,1,'C');
            $pdf->SetXY(156,140);
            $pdf->Cell(44,10,$data['data']['total_length'],0,1,'C');

            if ($data['dataNS']['transport_commodity']) {
                $pdf->SetXY(40,164);
                $pdf->Cell(44,10,'X',0,1,'C');
            }else{
                $pdf->SetXY(59,164);
                $pdf->Cell(44,10,'X',0,1,'C');
            }

            $pdf->SetXY(35,188);
            $pdf->Cell(44,10,$data['dataNS']['propulsion_plant_type'],0,1,'C');
            $pdf->SetXY(83,188);
            $pdf->Cell(44,10, $data['dataNS']['power_total_efective'],0,1,'C');
            $pdf->SetXY(132,188);
            $pdf->Cell(44,10, $data['data']['structure'],0,1,'C');
            $pdf->SetFont('Arial','B',10);
            $pdf->SetXY(104,203);
            $pdf->Cell(51,10,$data['data']['name'],0,1,'C');
            $pdf->SetXY(9,208);
            $pdf->Cell(38,10,$data['dataNS']['poll'],0,1,'C');
            if ($data['dataNS']['normam01']) {
                $pdf->SetXY(135,209);
                $pdf->Cell(18,10,'X',0,1,'C');
            }
            if ($data['dataNS']['normam02']) {
                $pdf->SetXY(163,209);
                $pdf->Cell(18,10,'X',0,1,'C');
            }
            if ($data['dataNS']['public_water_transport']) {
                $pdf->SetXY(168,218);
                $pdf->Cell(18,10,'X',0,1,'C');
            }
            $pdf->SetXY(33,247);
            $pdf->Cell(62,10,$data['dataNS']['issued_in'],0,1,'C');
            $pdf->SetXY(104,247);
            $pdf->Cell(12,10, $dateInspect[2],0,1,'C');
            $pdf->SetXY(123,247);
            $pdf->Cell(36,10, $this->_formatDate($dateInspect[1]),0,1,'C');
            $pdf->SetXY(166,247);
            $pdf->Cell(20,10, $dateInspect[0],0,1,'C');
            /**
             * PAGINA 2
             */
            $pdf->AddPage('P','A4',0);
            $pdf->Image(FCPATH.$certificate['path_jpg_certification_back'], 0, 0, 210, 300);
            if ($data['dataNSEx']['visit_annual01_init']) {
                $pdf->SetXY(44,94);
                $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual01_init'],-2),0,1,'C');
                $pdf->SetXY(50,94);
                $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual01_init'],-5,2),0,1,'C');
                $pdf->SetXY(59,94);
                $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual01_init'],0,4),0,1,'C');
            }
            if ($data['dataNSEx']['visit_annual01_end']) {
                $pdf->SetXY(76,94);
                $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual01_end'],-2),0,1,'C');
                $pdf->SetXY(83,94);
                $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual01_end'],-5,2),0,1,'C');
                $pdf->SetXY(91,94);
                $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual01_end'],0,4),0,1,'C');
            }
            if ($data['dataNSEx']['place_date_visit01']) {
                $pdf->SetXY(106,94);
                $pdf->Cell(62,6,$data['dataNSEx']['place_date_visit01'],0,1,'C');
            }
            if ($data['dataNSEx']['surveyor01']) {
                $pdf->SetXY(171,94);
                $pdf->Cell(30,6,$data['dataNSEx']['surveyor01'],0,1,'C');
            }

            if ($data['dataNSEx']['visit_annual02_init']) {
                $pdf->SetXY(44,102);
                $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual02_init'],-2),0,1,'C');
                $pdf->SetXY(50,102);
                $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual02_init'],-5,2),0,1,'C');
                $pdf->SetXY(59,102);
                $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual02_init'],0,4),0,1,'C');
            }
            if ($data['dataNSEx']['visit_annual02_end']) {
                $pdf->SetXY(76,102);
                $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual02_end'],-2),0,1,'C');
                $pdf->SetXY(83,102);
                $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual02_end'],-5,2),0,1,'C');
                $pdf->SetXY(91,102);
                $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual02_end'],0,4),0,1,'C');
            }
            if ($data['dataNSEx']['place_date_visit02']) {
                $pdf->SetXY(106,102);
                $pdf->Cell(62,6,$data['dataNSEx']['place_date_visit02'],0,1,'C');
            }
            if ($data['dataNSEx']['surveyor02']) {
                $pdf->SetXY(171,102);
                $pdf->Cell(30,6,$data['dataNSEx']['surveyor02'],0,1,'C');
            }

            if ($data['dataNSEx']['visit_intermedia_init']) {
                $pdf->SetXY(44,110);
                $pdf->Cell(8,6,substr($data['dataNSEx']['visit_intermedia_init'],-2),0,1,'C');
                $pdf->SetXY(50,110);
                $pdf->Cell(8,6,substr($data['dataNSEx']['visit_intermedia_init'],-5,2),0,1,'C');
                $pdf->SetXY(59,110);
                $pdf->Cell(8,6,substr($data['dataNSEx']['visit_intermedia_init'],0,4),0,1,'C');
            }
            if ($data['dataNSEx']['visit_intermedia_end']) {
                $pdf->SetXY(76,110);
                $pdf->Cell(8,6,substr($data['dataNSEx']['visit_intermedia_end'],-2),0,1,'C');
                $pdf->SetXY(83,110);
                $pdf->Cell(8,6,substr($data['dataNSEx']['visit_intermedia_end'],-5,2),0,1,'C');
                $pdf->SetXY(91,110);
                $pdf->Cell(8,6,substr($data['dataNSEx']['visit_intermedia_end'],0,4),0,1,'C');
            }
            if ($data['dataNSEx']['place_date_intermedia']) {
                $pdf->SetXY(106,110);
                $pdf->Cell(62,6,$data['dataNSEx']['place_date_intermedia'],0,1,'C');
            }
            if ($data['dataNSEx']['intermedia_surveyor']) {
                $pdf->SetXY(171,110);
                $pdf->Cell(30,6,$data['dataNSEx']['intermedia_surveyor'],0,1,'C');
            }

            if ($data['dataNSEx']['visit_annual03_init']) {
                $pdf->SetXY(44,119);
                $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual03_init'],-2),0,1,'C');
                $pdf->SetXY(50,119);
                $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual03_init'],-5,2),0,1,'C');
                $pdf->SetXY(59,119);
                $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual03_init'],0,4),0,1,'C');
            }
            if ($data['dataNSEx']['visit_annual03_end']) {
                $pdf->SetXY(76,119);
                $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual03_end'],-2),0,1,'C');
                $pdf->SetXY(83,119);
                $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual03_end'],-5,2),0,1,'C');
                $pdf->SetXY(91,119);
                $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual03_end'],0,4),0,1,'C');
            }
            if ($data['dataNSEx']['place_date_visit03']) {
                $pdf->SetXY(106,119);
                $pdf->Cell(62,6,$data['dataNSEx']['place_date_visit03'],0,1,'C');
            }
            if ($data['dataNSEx']['surveyor03']) {
                $pdf->SetXY(171,119);
                $pdf->Cell(30,6,$data['dataNSEx']['surveyor03'],0,1,'C');
            }

            if ($data['dataNSEx']['visit_annual04_init']) {
                $pdf->SetXY(44,127);
                $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual04_init'],-2),0,1,'C');
                $pdf->SetXY(50,127);
                $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual04_init'],-5,2),0,1,'C');
                $pdf->SetXY(59,127);
                $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual04_init'],0,4),0,1,'C');
            }
            if ($data['dataNSEx']['visit_annual04_end']) {
                $pdf->SetXY(76,127);
                $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual04_end'],-2),0,1,'C');
                $pdf->SetXY(83,127);
                $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual04_end'],-5,2),0,1,'C');
                $pdf->SetXY(91,127);
                $pdf->Cell(8,6,substr($data['dataNSEx']['visit_annual04_end'],0,4),0,1,'C');
            }
            if ($data['dataNSEx']['place_date_visit04']) {
                $pdf->SetXY(106,127);
                $pdf->Cell(62,6,$data['dataNSEx']['place_date_visit04'],0,1,'C');
            }
            if ($data['dataNSEx']['surveyor04']) {
                $pdf->SetXY(171,127);
                $pdf->Cell(30,6,$data['dataNSEx']['surveyor04'],0,1,'C');
            }

            $pdf->SetXY(70,162);
            $pdf->Cell(38,6,$data['dataNS']['seated_passengersP'],0,0,'C');
            $pdf->SetXY(116,162);
            $pdf->Cell(38,6,$data['dataNS']['seated_passengersS'],0,0,'C');
            $pdf->SetXY(162,162);
            $pdf->Cell(38,6,$data['dataNS']['seated_passengersL'],0,0,'C');

            $pdf->SetXY(70,170);
            $pdf->Cell(38,6,$data['dataNS']['passengers_cabinP'],0,0,'C');
            $pdf->SetXY(116,170);
            $pdf->Cell(38,6,$data['dataNS']['passengers_cabinS'],0,0,'C');
            $pdf->SetXY(162,170);
            $pdf->Cell(38,6,$data['dataNS']['passengers_cabinL'],0,0,'C');

            $pdf->SetXY(70,179);
            $pdf->Cell(38,6,$data['dataNS']['passengers_networksP'],0,0,'C');
            $pdf->SetXY(116,179);
            $pdf->Cell(38,6,$data['dataNS']['passengers_networksS'],0,0,'C');
            $pdf->SetXY(162,179);
            $pdf->Cell(38,6,$data['dataNS']['passengers_networksL'],0,0,'C');

            $pdf->SetXY(70,189);
            $pdf->Cell(130,6,$data['dataNS']['carga_geral'],0,0,'L');
            $pdf->SetXY(70,197);
            $pdf->Cell(130,6,$data['dataNS']['helmet'],0,1,'L');
            $pdf->SetXY(70,207);
            $pdf->Cell(130,6,$data['dataNS']['almoxarifado'],0,1,'L');
            $pdf->SetXY(70,216);
            $pdf->Cell(130,6,$data['dataNS']['main_deposit'],0,1,'L');
            $pdf->SetXY(70,225);
            $pdf->Cell(130,6,$data['dataNS']['upper_deposit'],0,1,'L');
            
            $pdf->SetXY(12,243);
            $pdf->MultiCell(188,6,utf8_decode($data['dataNS']['observations']),0,'L',false);
            $pdf->SetXY(30,265);
            $pdf->Cell(8,6,$array_expireCert[2],0,1,'C');
            $pdf->SetXY(45,265);
            $pdf->Cell(42,6,$this->_formatDate($array_expireCert[1]),0,1,'C');
            $pdf->SetXY(97,265);
            $pdf->Cell(17,6,$array_expireCert[0],0,1,'C');
            
            $pdf->Output($config['upload_path'].$file_name , $downloadType ); // I: envia el fichero a navegador F: guarda el fichero en un fichero local de nombre name


            $config['file_name'] = $file_name;
            $config['extension_file'] = 'pdf';
            $config['codOrder'] = $data['data']['codOrder'];
            $config['codTypeCertification'] = $data['data']['codTypeCertification'];
            $config['numberOrder'] = $data['data']['office'].str_pad($data['data']['codOrder'], 3, '0', STR_PAD_LEFT).$data['data']['anyo'];
            $config['codUserAuthorized'] = $data['data']['codUser'];
            $config['expired_certificated'] = $expireCert;

            $response = ($downloadType == 'F') ? $this->certifications_model->insertCertificate($config) : true;            

            if($response)
            {
                $this->logs_model->registerLogs($this->session->user_id, '_createCertificate1', 'Get', 'Generó Certificado Id: '.$response);
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

    private function _createCertificate2($data,$config,$certificate,$downloadType)
    {
        if (!empty($data))
        {
            $dateInspect = explode('-',$data['data']['inspect_date_end']);
            $expireCert = date("Y-m-d",strtotime($data['data']['inspect_date_end']."+ 364 days"));
            $array_expireCert =  explode("-", date("Y-m-d",strtotime($data['data']['inspect_date_end']."+ 364 days")));
            $file_name = $data['data']['office'].str_pad($data['data']['codOrder'], 3, '0', STR_PAD_LEFT).$data['data']['anyo'].'-'.$data['data']['codTypeCertification'].'_'.$data['data']['number_imo'].'.pdf';
            $pdf = new FPDF();
            $pdf->AddPage('P','A4',0);
            $pdf->Image(FCPATH.$certificate['path_jpg_certification_front'], 0, 0, 210, 300);
            $pdf->SetFont('Arial','B',12);
            $pdf->SetXY(170,23);
            $pdf->Cell(28,10,$data['data']['office'].' '.str_pad($data['data']['codOrder'], 3, '0', STR_PAD_LEFT).$data['data']['anyo'],0,1,'C');
            $pdf->SetXY(49,109);
            $pdf->Cell(146,8,$data['data']['name'],0,1,'C');
            $pdf->SetXY(10,138);
            $pdf->Cell(61,8,$data['data']['call_sign'],0,1,'C');
            $pdf->SetXY(75,138);
            $pdf->Cell(61,8,$data['dataNS']['port_inscription'],0,1,'C');
            $pdf->SetXY(140,138);
            $pdf->Cell(61,8,$data['dataNS']['batimento'],0,1,'C');
            $pdf->SetXY(10,167);
            $pdf->Cell(61,8,$data['dataNS']['ruler_length'],0,1,'C');
            $pdf->SetXY(75,167);
            $pdf->Cell(61,8,$data['dataNS']['boca'],0,1,'C');
            $pdf->SetXY(140,167);
            $pdf->Cell(61,8,$data['dataNS']['molded_knit'],0,1,'C');
            $pdf->SetXY(108,192);
            $pdf->Cell(41,8,$data['data']['gross_tonnage'],0,1,'C');
            $pdf->SetXY(108,210);
            $pdf->Cell(41,8,$data['data']['liquid_tonnage'],0,1,'C');
            $pdf->SetXY(33,254);
            $pdf->Cell(76,8,$data['dataNS']['emitido'],0,1,'C');
            $pdf->SetXY(119,254);
            $pdf->Cell(12,8,$dateInspect[2],0,1,'C');
            $pdf->SetXY(138,254);
            $pdf->Cell(35,8,$this->_formatDate($dateInspect[1]),0,1,'C');
            $pdf->SetXY(180,254);
            $pdf->Cell(20,8,$dateInspect[0],0,1,'C');
            /**
             * PAGINA 2
             */
            $pdf->AddPage('P','A4',0);
            $pdf->Image(FCPATH.$certificate['path_jpg_certification_back'], 0, 0, 210, 300);
            $pdf->SetXY(173,198);
            $pdf->Cell(26,8,$data['dataNS']['number_passengers_berths'],0,1,'C');
            $pdf->SetXY(173,215);
            $pdf->Cell(26,8,$data['dataNS']['number_total_passengers'],0,1,'C');
            $pdf->SetXY(108,235);
            $pdf->Cell(90,8,$data['dataNS']['molded_project'],0,1,'C');

            $pdf->SetXY(10,254);
            $pdf->Cell(90,8,$data['dataNS']['place_date_original'],0,1,'C');
            $pdf->SetXY(108,254);
            $pdf->Cell(90,8,$data['dataNS']['place_date_last'],0,1,'C');
            
            $pdf->SetFont('Arial','',10);
            $pdf->SetXY(10,198);
            $pdf->MultiCell(94,8,utf8_decode($data['dataNS']['place_exclude']),0,'L',false);
            $pdf->SetXY(46,267);
            $pdf->MultiCell(155,4,utf8_decode($data['dataNS']['observations']),0,'L',false);

            $pdf->Output($config['upload_path'].$file_name , $downloadType ); // I: envia el fichero a navegador F: guarda el fichero en un fichero local de nombre name


            $config['file_name'] = $file_name;
            $config['extension_file'] = 'pdf';
            $config['codOrder'] = $data['data']['codOrder'];
            $config['codTypeCertification'] = $data['data']['codTypeCertification'];
            $config['numberOrder'] = $data['data']['office'].str_pad($data['data']['codOrder'], 3, '0', STR_PAD_LEFT).$data['data']['anyo'];
            $config['codUserAuthorized'] = $data['data']['codUser'];
            $config['expired_certificated'] = $expireCert;

            $response = ($downloadType == 'F') ? $this->certifications_model->insertCertificate($config) : true;

            if($response)
            {
                $this->logs_model->registerLogs($this->session->user_id, '_createCertificate2', 'Get', 'Generó Certificado Id: '.$response);
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

    private function _createCertificate3($data,$config,$certificate,$downloadType)
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
                $pdf->Output($config['upload_path'].$file_name , $downloadType ); // I: envia el fichero a navegador F: guarda el fichero en un fichero local de nombre name
            }

            $config['file_name'] = $file_name;
            $config['extension_file'] = 'pdf';
            $config['codOrder'] = $value['codOrder'];
            $config['codTypeCertification'] = $value['codTypeCertification'];
            $config['numberOrder'] = $value['office'].str_pad($value['codOrder'], 3, '0', STR_PAD_LEFT).$value['anyo'];
            $config['codUserAuthorized'] = $value['codUser'];

            $response = ($downloadType == 'F') ? $this->certifications_model->insertCertificate($config) : true;

            if($response)
            {
                $this->logs_model->registerLogs($this->session->user_id, '_createCertificate3', 'Get', 'Generó Certificado Id: '.$response);
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
        if (isset($data)) {
            $data['data']['downloadType'] = $this->input->get('downloadType');
        }
        // print_r($data); die;
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