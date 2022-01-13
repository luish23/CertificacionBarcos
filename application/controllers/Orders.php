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
        // print_r($data); die;
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
        getDir(FCPATH . 'uploads/Ordernes/'.$pathDate);

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
                        'condition' => 'PROCESO',
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
        $response = $this->orders_model->validOrder($idNav, $idCer);

        $this->response( [
                    'response' => $response,
                ], 200 );
    }

    /**
     * FUNCION QUE PERMITE LISTAR LAS ORDENES A VALIDAR PARA GENERAR PDF
     * Inputs: user_id
     * Output: view orders/checktOrders
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
        if ($data) {
            $data['offices'] = $this->offices_model->getOffice();
        }
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
    
}
