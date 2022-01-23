<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use chriskacerguis\RestServer\RestController;

require APPPATH.'libraries/REST_Controller.php';
require APPPATH.'libraries/Format.php';

class Orders extends RESTController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array("boats_model","users_model","login_model", "orders_model", "offices_model", "certifications_model"));
        $this->load->helper(array("url","custom"));
        $this->load->library(array('session'));
       
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
            $this->lang->load(array('orders','layout_nav_left'), $this->session->site_lang);
        }else{
            $this->session->unset_userdata('session_data');
            $this->session->sess_destroy();
			redirect("login");
		}
    }

    public function index_get()
    {
        echo "Controller Orders";
    }

    /**
     * FUNCION QUE PERMITE LISTAR LAS ORDENES
     * Inputs: user_id
     * Output: view orders/listOrders
     */
    public function listOrder_get()
    {   
        if ($this->session->codTypeUser == 6) { // ARMADOR
            $data = $this->orders_model->getOrdersByUser($this->session->codShipowner);
        }else{
            $data = $this->orders_model->getAllOrders();
        }
        // echo "<pre>";
        // print_r($data); die;
        // echo "</pre>";
        $template = array('title' => $this->lang->line('title_listOrders'));
        $this->load->view("dashboard/header_dashboard",$template);
        $this->load->view("layout_nav_top");
        $this->load->view("layout_nav_left",$this->session_data);
        $this->load->view('orders/listOrders',$data);
        $this->load->view("orders/footer_order");
    }

    /**
     * FUNCION QUE PERMITE GENERAR LA VISTA DE FORMULARIO
     * Output: view orders/formOrder
     */
    public function formOrder_get()
    {
        $data = $this->boats_model->getBoatsNotDocument();
        if($data)
        {
            $data['offices'] = $this->offices_model->getOffice();
            $data['certifications'] = $this->certifications_model->getTypeCertifications();
            // print_r($data['certifications']); die;
            $template = array('title' => $this->lang->line('title_formOrders'));
            $this->load->view("dashboard/header_dashboard",$template);
            $this->load->view("layout_nav_top");
            $this->load->view("layout_nav_left",$this->session_data);
            $this->load->view('orders/formOrder', $data);
            $this->load->view("orders/footer_order");
        }else{
            echo "<script>alert('".$this->lang->line('alert_formOrders')."');</script>";
            redirect('dashboard', 'refresh');
        }
        
    }

    /**
     * FUNCION QUE PERMITE REGISTRAR LA ORDEN
     * Inputs: Files, user_id, codOffice, codBoat
     * Output: null
     */
    public function registerOrder_post()
    {        
        $idWord = null;
        $idPdf = null;

        $pathDate = date("Y") . "/" . date("m") . "/" . date("d") . "/";
        getDir(FCPATH . 'uploads/Ordenes/'.$pathDate);

        if(!empty($_FILES['word']['name']))
        {
            $_FILES['word']['name'] = $_FILES['word']['name'];
            $_FILES['word']['type'] = $_FILES['word']['type'];
            $_FILES['word']['tmp_name'] = $_FILES['word']['tmp_name'];
            $_FILES['word']['error'] = $_FILES['word']['error'];
            $_FILES['word']['size'] = $_FILES['word']['size'];
            
            $config['upload_path'] = 'uploads/Ordenes/'.$pathDate; 
            $config['allowed_types'] = 'pdf|docx|doc|xls|xlsx';
            $config['max_size'] = '5000';
            $config['file_name'] = $_FILES['word']['name'];
            $config['overwrite']     = FALSE;
            $this->load->library('upload',$config); 
            $this->upload->initialize($config);
        
            if($this->upload->do_upload('word')){
                $uploadData = $this->upload->data();
                $doc_word = array('file_name' => $uploadData['file_name'], 'file_ext' => $uploadData['file_ext'], 'path_dir' => $config['upload_path']);
                $idWord = $this->orders_model->insertDocuments($doc_word);
            }
        }

        if(!empty($_FILES['pdf']['name']))
        {
            $_FILES['pdf']['name'] = $_FILES['pdf']['name'];
            $_FILES['pdf']['type'] = $_FILES['pdf']['type'];
            $_FILES['pdf']['tmp_name'] = $_FILES['pdf']['tmp_name'];
            $_FILES['pdf']['error'] = $_FILES['pdf']['error'];
            $_FILES['pdf']['size'] = $_FILES['pdf']['size'];
            
            $config['upload_path'] = 'uploads/Ordenes/'.$pathDate; 
            $config['allowed_types'] = 'pdf|docx|doc|xls|xlsx';
            $config['max_size'] = '5000';
            $config['file_name'] = $_FILES['pdf']['name'];
            $config['overwrite']     = FALSE;
            $this->load->library('upload',$config); 
            $this->upload->initialize($config);
        
            if($this->upload->do_upload('pdf')){
                $uploadData = $this->upload->data();
                $doc_pdf = array('file_name' => $uploadData['file_name'], 'file_ext' => $uploadData['file_ext'], 'path_dir' => $config['upload_path']);
                $idPdf = $this->orders_model->insertDocuments($doc_pdf);
            }
        }  
        
        $data = array(  'codUser' => $this->session->user_id, 
                        'codOffice' => $this->input->post('codOffice'),
                        'codBoat' => $this->input->post('codBoat'),
                        'codTypeCertification' => $this->input->post('codTypeCertification'),
                        'codListVerification' => $this->input->post('codListVerification'),
                        'provisional' => $this->input->post('provisional'),
                        'condition' => 'INICIADO',
                        'codWord' => $retVal = ($idWord != null) ? $idWord : null,
                        'codPDF' => $retVal = ($idPdf != null) ? $idPdf : null 
                    );

        if($this->orders_model->insertOrder($data))
        {
            // $response = $this->orders_model->updateOrderConditions($this->input->post('codBoat'));

            // if ($response) {
                echo "<script>alert('".$this->lang->line('alert_registerOrder')."');</script>";
                redirect('formOrder', 'refresh');
            // }
        }
    }

    public function updateOrder_post()
    {        
        $idWord = null;
        $idPdf = null;

        $pathDate = date("Y") . "/" . date("m") . "/" . date("d") . "/";
        getDir(FCPATH . 'uploads/Ordenes/'.$pathDate);

        $idOrder = $this->input->post('idOrder');

        if(!empty($_FILES['word']['name']))
        {
            $_FILES['word']['name'] = $_FILES['word']['name'];
            $_FILES['word']['type'] = $_FILES['word']['type'];
            $_FILES['word']['tmp_name'] = $_FILES['word']['tmp_name'];
            $_FILES['word']['error'] = $_FILES['word']['error'];
            $_FILES['word']['size'] = $_FILES['word']['size'];
            
            $config['upload_path'] = 'uploads/Ordenes/'.$pathDate; 
            $config['allowed_types'] = 'pdf|docx|doc|xls|xlsx';
            $config['max_size'] = '5000';
            $config['file_name'] = $_FILES['word']['name'];
            $config['overwrite']     = FALSE;
            $this->load->library('upload',$config); 
            $this->upload->initialize($config);
        
            if($this->upload->do_upload('word')){
                $uploadData = $this->upload->data();
                $doc_word = array('file_name' => $uploadData['file_name'], 'file_ext' => $uploadData['file_ext'], 'path_dir' => $config['upload_path']);
                $idWord = $this->orders_model->insertDocuments($doc_word);
            }
        }

        if(!empty($_FILES['pdf']['name']))
        {
            $_FILES['pdf']['name'] = $_FILES['pdf']['name'];
            $_FILES['pdf']['type'] = $_FILES['pdf']['type'];
            $_FILES['pdf']['tmp_name'] = $_FILES['pdf']['tmp_name'];
            $_FILES['pdf']['error'] = $_FILES['pdf']['error'];
            $_FILES['pdf']['size'] = $_FILES['pdf']['size'];
            
            $config['upload_path'] = 'uploads/Ordenes/'.$pathDate; 
            $config['allowed_types'] = 'pdf|docx|doc|xls|xlsx';
            $config['max_size'] = '5000';
            $config['file_name'] = $_FILES['pdf']['name'];
            $config['overwrite']     = FALSE;
            $this->load->library('upload',$config); 
            $this->upload->initialize($config);
        
            if($this->upload->do_upload('pdf')){
                $uploadData = $this->upload->data();
                $doc_pdf = array('file_name' => $uploadData['file_name'], 'file_ext' => $uploadData['file_ext'], 'path_dir' => $config['upload_path']);
                $idPdf = $this->orders_model->insertDocuments($doc_pdf);
            }
        }  
        
        $data = array(  'codUser' => $this->session->user_id, 
                        'codOffice' => $this->input->post('codOffice'),
                        'codBoat' => $this->input->post('codBoat'),
                        'codTypeCertification' => $this->input->post('codTypeCertification'),
                        'codListVerification' => $this->input->post('codListVerification'),
                        'provisional' => $this->input->post('provisional'),
                        'condition' => $this->input->post('condition'),
                        'codWord' => $retVal = ($idWord != null) ? $idWord : $this->input->post('idword_old'),
                        'codPDF' => $retVal = ($idPdf != null) ? $idPdf : $this->input->post('idpdf_old') 
                    );
        if($this->orders_model->updateOrder($data, $idOrder))
        {
                echo "<script>alert('".$this->lang->line('alert_updateOrder')."');</script>";
                redirect('listOrders', 'refresh');
        }else{
            echo "Hubo un error al actualizar Orden!!.";
        }
    }

    public function deleteOrder_post()
    {
        $id = $this->input->post('id');

        $response = $this->orders_model->deleteOrder($id);

        if ($response) {
            echo "<script>alert('".$this->lang->line('alert_deleteOrder')."');</script>";
            redirect('listOrders', 'refresh');
        }
        else {
            echo "<script>alert('".$this->lang->line('alertError_deleteOrder')."');</script>";
            redirect('dashboard', 'refresh');
        }

    }

    /**
     * FUNCION QUE VALIDA QUE NO EXISTA ESA ORDEN EN PROCESO PARA EL NAVIO INDICADO
     */
    public function veriffOrder_post()
    {
        $idNav = $this->input->post('idNav');
        $idCer = $this->input->post('idCer');
        $idVerif = $this->input->post('idVerif');
        $response = $this->orders_model->validOrder($idNav, $idCer, $idVerif);

        $this->response( [
                    'response' => $response,
                ], 200 );
    }

    /**
     * FUNCION QUE VALIDA QUE NO EXISTA ESA ORDEN EN PROCESO PARA EL NAVIO INDICADO
     */
    public function getVerifications_post()
    {
        $idCer = $this->input->post('idCer');
        $result = $this->orders_model->getVerifications($idCer);

        if ($result) {
            $response = '<div class="form-group err-form">';
            $response .= '<label for="exampleInputEmail1">'.$this->lang->line("list_verification").'</label>';
            $response .= '<select class="form-control" id="codListVerification" onChange="listVerif()" name="codListVerification">';
            $response .= '<option value="0">'.$this->lang->line("select").'</option>';
            foreach ($result as $key => $value) {
                $response .= '<option value="'.$value['id'].'">'.$value['name_list_verification'].'</option>';;
            }
            $response .= '</select></div>';
            
        }else {
            $response = '<div class="form-group err-form">';
            $response .= '<label for="exampleInputEmail1">'.$this->lang->line("list_verification").'</label>';
            $response .= '<select class="form-control" id="codListVerification" name="codListVerification">';
            $response .= '<option value="0">'.$this->lang->line("select").'</option>';
            $response .= '</select></div>';
        }

        print($response);

    }
    

    /**
     * FUNCION QUE PERMITE LISTAR LAS ORDENES A VALIDAR PARA GENERAR PDF
     * Inputs: user_id
     * Output: view orders/checkOrders
     */
    public function checkOrders_get()
    {
        $data = $this->orders_model->getOrdersProcess();
        // print_r($data); die;
        
        $template = array('title' => $this->lang->line('title_checkOrders'));
        $this->load->view("dashboard/header_dashboard",$template);
        $this->load->view("layout_nav_top");
        $this->load->view("layout_nav_left",$this->session_data);
        $this->load->view('orders/checkOrders',$data);
        $this->load->view("orders/footer_order");
    }

    public function processOrder_post()
    {
        $response = $this->orders_model->updateOrdersProcess($this->input->post('idOrder'));

        if ($response) {
            echo "<script>alert('".$this->lang->line('alert_process_orders')."');</script>";
            redirect('listOrders', 'refresh');
        }
        else {
            echo "<script>alert('".$this->lang->line('alert_process_error')."');</script>";
            redirect('checkOrders', 'refresh');
        }
        
    }

    public function modalOrder_get()
    {
        $id = $this->input->get('id');
        $data = $this->boats_model->getBoatById($id);
        $this->load->view('orders/modalOrder', $data);
    }

    public function modalOrderUp_get()
    {
        $id = $this->input->get('id');
        $data = $this->orders_model->getOrderBoatById($id);
        // print_r($data);

        if ($data) {
            $data['offices'] = $this->offices_model->getOffice();            
        }
        // echo "</br>ENTRE</br>";
        // print_r($data);

        switch ($data['data']['codTypeCertification']) {
            case 1:
                $data['dataNS'] = $this->orders_model->getDataNS('dataExtraNS01', ['codOrder' => $id]);
                if ($data['dataNS']) {
                    $data['dataNSEx'] = $this->orders_model->getDataNS('convalidationsNS01', ['codNS01' => $data['dataNS']['id']]);
                }
                break;
            
            // case 2:
            //     $data['dataNS02'] = $this->orders_model->getDataNS('dataExtraNS02', ['codOrder' => $id]);
            //     if ($data['dataNS02']) {
            //         $data['dataNSGT'] = $this->orders_model->getDataNS('grossTonnage', ['codExtra02_gt' => $data['dataNS']['id']]);
            //         $data['dataNSLT'] = $this->orders_model->getDataNS('liquidTonnage', ['codExtra02_lt' => $data['dataNS']['id']]);
            //     }
            //     break;
            
            // case 3:
            //     $data['dataNS03'] = $this->orders_model->getDataNS('dataExtraNS03', ['codOrder' => $id]);
            //     if ($data['dataNS03']) {
            //         $data['dataNSEx03'] = $this->orders_model->getDataNS('testResultNS03', ['codNS03' => $data['dataNS']['id']]);
            //     }
            //     break;
            
            default:
                echo "<script>alert('".$this->lang->line('alert_error_codTypeCertification')."');</script>";
                redirect('dashboard', 'refresh');
                break;
        }
        // echo "</br>FINAL</br>";
        // print_r($data); // die;

        $this->load->view('orders/modalOrderUp', $data);
        $this->load->view("orders/footer_modalOrderUp");
    }

    public function modalOrderDel_get()
    {
        $id = $this->input->get('id');
        $data = $this->orders_model->getOrderById($id);
        // print_r($data); die;
        $this->load->view('orders/modalOrderDel', $data);
    }

    public function modalValidOrder_get()
    {
        $id = $this->input->get('id');
        $data = $this->orders_model->getOrderBoatById($id);
        if ($data) {
            $data['offices'] = $this->offices_model->getOffice();
        }

        $this->load->view('orders/modalValidOrder', $data);
        $this->load->view("orders/footer_modalOrderUp");

    }

    /**
     * COVALIDAÇÕES CERTIFICADO DE SEGURANÇA DA NAVEGAÇÃO NS01
     */
    public function updateOrderNS01_post()
    {
        $idOrder = $this->input->post('idOrder');
        $msg = false;

        // si orden existe hacer update sino insert
        $info = array(
            'transport_commodity' => $transport_commodity = ($this->input->post('transport_commodity')) ? $this->input->post('transport_commodity') : 0,
            'propulsion_plant_type' => $propulsion_plant_type = ($this->input->post('propulsion_plant_type')) ? $this->input->post('propulsion_plant_type') : NULL,
            'power_total_efective' => $power_total_efective = ($this->input->post('power_total_efective')) ? $this->input->post('power_total_efective') : 0,
            'towing_destination' => $towing_destination = ($this->input->post('towing_destination')) ? $this->input->post('towing_destination') : NULL,
            'vessel' => $vessel = ($this->input->post('vessel')) ? $this->input->post('vessel') : NULL,
            'poll' => $poll = ($this->input->post('poll')) ? $this->input->post('poll') : 0,
            'normam01' => $normam01 = ($this->input->post('normam01')) ? $this->input->post('normam01') : 0,
            'normam02' => $normam02 = ($this->input->post('normam02')) ? $this->input->post('normam02') : 0,
            'public_water_transport' => $public_water_transport = ($this->input->post('public_water_transport')) ? $this->input->post('public_water_transport') : NULL,
            'issued_in' => $issued_in = ($this->input->post('issued_in')) ? $this->input->post('issued_in') : NULL,
            'seated_passengersP' => $seated_passengersP = ($this->input->post('seated_passengersP')) ? $this->input->post('seated_passengersP') : 0,
            'seated_passengersS' => $seated_passengersS = ($this->input->post('seated_passengersS')) ? $this->input->post('seated_passengersS') : 0,
            'seated_passengersL' => $seated_passengersL = ($this->input->post('seated_passengersL')) ? $this->input->post('seated_passengersL') : 0,
            'passengers_cabinP' => $passengers_cabinP = ($this->input->post('passengers_cabinP')) ? $this->input->post('passengers_cabinP') : 0,
            'passengers_cabinS' => $passengers_cabinS = ($this->input->post('passengers_cabinS')) ? $this->input->post('passengers_cabinS') : 0,
            'passengers_cabinL' => $passengers_cabinL = ($this->input->post('passengers_cabinL')) ? $this->input->post('passengers_cabinL') : 0,
            'passengers_networksP' => $passengers_networksP = ($this->input->post('passengers_networksP')) ? $this->input->post('passengers_networksP') : 0,
            'passengers_networksS' => $passengers_networksS = ($this->input->post('passengers_networksS')) ? $this->input->post('passengers_networksS') : 0,
            'passengers_networksL' => $passengers_networksL = ($this->input->post('passengers_networksL')) ? $this->input->post('passengers_networksL') : 0,
            'carga_geral' => $carga_geral = ($this->input->post('carga_geral')) ? $this->input->post('carga_geral') : NULL,
            'helmet' => $helmet = ($this->input->post('helmet')) ? $this->input->post('helmet') : NULL,
            'almoxarifado' => $almoxarifado = ($this->input->post('almoxarifado')) ? $this->input->post('almoxarifado') : NULL,
            'main_deposit' => $main_deposit = ($this->input->post('main_deposit')) ? $this->input->post('main_deposit') : NULL,
            'upper_deposit' => $upper_deposit = ($this->input->post('upper_deposit')) ? $this->input->post('upper_deposit') : NULL,
            'observations' => $observations = ($this->input->post('observations')) ? $this->input->post('observations') : NULL
        );

        $infoEx = array(
            'visit_annual01_init' => $visit_annual01_init = ($this->input->post('visit_annual01_init')) ? date("Y-m-d", strtotime($this->input->post('visit_annual01_init'))) : NULL,
            'visit_annual01_end' => $visit_annual01_end = ($this->input->post('visit_annual01_end')) ? date("Y-m-d", strtotime($this->input->post('visit_annual01_end'))) : NULL,
            'place_date_visit01' => $place_date_visit01 = ($this->input->post('place_date_visit01')) ? $this->input->post('place_date_visit01') : NULL,
            'surveyor01' => $surveyor01 = ($this->input->post('surveyor01')) ? $this->input->post('surveyor01') : NULL,
            'visit_annual02_init' => $visit_annual02_init = ($this->input->post('visit_annual02_init')) ? date("Y-m-d", strtotime($this->input->post('visit_annual02_init'))) : NULL,
            'visit_annual02_end' => $visit_annual02_end = ($this->input->post('visit_annual02_end')) ? date("Y-m-d", strtotime($this->input->post('visit_annual02_end'))) : NULL,
            'place_date_visit02' => $place_date_visit02 = ($this->input->post('place_date_visit02')) ? $this->input->post('place_date_visit02') : NULL,
            'surveyor02' => $surveyor02 = ($this->input->post('surveyor02')) ? $this->input->post('surveyor02') : NULL,
            'visit_intermedia_init' => $visit_intermedia_init = ($this->input->post('visit_intermedia_init')) ? date("Y-m-d", strtotime($this->input->post('visit_intermedia_init'))) : NULL,
            'visit_intermedia_end' => $visit_intermedia_end = ($this->input->post('visit_intermedia_end')) ? date("Y-m-d", strtotime($this->input->post('visit_intermedia_end'))) : NULL,
            'place_date_intermedia' => $place_date_intermedia = ($this->input->post('place_date_intermedia')) ? $this->input->post('place_date_intermedia') : NULL,
            'intermedia_surveyor' => $intermedia_surveyor = ($this->input->post('intermedia_surveyor')) ? $this->input->post('intermedia_surveyor') : NULL,
            'visit_annual03_init' => $visit_annual03_init = ($this->input->post('visit_annual03_init')) ? date("Y-m-d", strtotime($this->input->post('visit_annual03_init'))) : NULL,
            'visit_annual03_end' => $visit_annual03_end = ($this->input->post('visit_annual03_end')) ? date("Y-m-d", strtotime($this->input->post('visit_annual03_end'))) : NULL,
            'place_date_visit03' => $place_date_visit03 = ($this->input->post('place_date_visit03')) ? $this->input->post('place_date_visit03') : NULL,
            'surveyor03' => $surveyor03 = ($this->input->post('surveyor03')) ? $this->input->post('surveyor03') : NULL,
            'visit_annual04_init' => $visit_annual04_init = ($this->input->post('visit_annual04_init')) ? date("Y-m-d", strtotime($this->input->post('visit_annual04_init'))) : NULL,
            'visit_annual04_end' => $visit_annual04_end = ($this->input->post('visit_annual04_end')) ? date("Y-m-d", strtotime($this->input->post('visit_annual04_end'))) : NULL,
            'place_date_visit04' => $place_date_visit04 = ($this->input->post('place_date_visit04')) ? $this->input->post('place_date_visit04') : NULL,
            'surveyor04' => $surveyor04 = ($this->input->post('surveyor04')) ? $this->input->post('surveyor04') : NULL
        );

        $idOrderNS = $this->orders_model->getOrderNS('dataExtraNS01',$idOrder);

        if ($idOrderNS) {
            $responseNS = $this->orders_model->updateOrderNS('dataExtraNS01', ['id' => $idOrderNS], $info);
            $responseEx = $this->orders_model->updateOrderNS('convalidationsNS01', ['codNS01' => $idOrderNS], $infoEx);
            $msg = true;
        }else {
            $data = array_merge($info,['codOrder' => $idOrder]);
            $responseNS = $this->orders_model->insertOrderNS('dataExtraNS01',$data);

            $dataEx = array_merge($infoEx,['codNS01' => $idOrder]);
            if ($dataEx) {
                $responseEx = $this->orders_model->insertOrderNS('convalidationsNS01',$dataEx);
                $msg = true;
            }
            
        }

        if ($msg) {
            echo "<script>alert('".$this->lang->line('alert_process_orders')."');</script>";
            redirect('listOrders', 'refresh');
        }
        else {
            echo "<script>alert('".$this->lang->line('alert_process_error')."');</script>";
            redirect('dashboard', 'refresh');
        }

    }
}
