<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use chriskacerguis\RestServer\RestController;

require APPPATH.'libraries/REST_Controller.php';
require APPPATH.'libraries/Format.php';

class Orders extends RESTController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array("boats_model","users_model","login_model", "orders_model"));
        $this->load->helper(array('url'));
        $this->load->library(array('session'));
        $this->load->helper(array("custom"));
        if($this->login_model->logged_id())
		{
			$this->session_data = array(
				'user_id'       => $this->session->user_id,
				'name'          => $this->session->name,
				'lastName'      => $this->session->lastName,
				'codTypeUser'   => $this->session->codTypeUser
			);
        }else{
            $this->session->unset_userdata('session_data');
			redirect("login");
		}
    }

    public function index_get()
    {
        echo "Controller Orders";
    }

    public function listOrder_get()
    {
        $data = $this->orders_model->getOrdersByUser($this->session->user_id);
        $template = array('title' => 'Listado de Ordenes');
        $this->load->view("dashboard/header_dashboard",$template);
        $this->load->view("layout_nav_top");
        $this->load->view("layout_nav_left",$this->session_data);
        $this->load->view('orders/listOrders',$data);
        $this->load->view("orders/footer_order");
        
    }

    public function formOrder_get()
    {
        $data = $this->boats_model->getBoatsNotDocument($this->session->user_id);
        if($data)
        {
            $template = array('title' => 'Registrar Ordenes');
            $this->load->view("dashboard/header_dashboard",$template);
            $this->load->view("layout_nav_top");
            $this->load->view("layout_nav_left",$this->session_data);
            $this->load->view('orders/formOrder', $data);
            $this->load->view("orders/footer_order");
        }else{
            echo "<script>alert('No tiene registro de Navios pendientes por Orden');</script>";
            redirect('dashboard', 'refresh');
        }
        
    }

    public function registerOrder_post()
    {        
        $idWord = null;
        $idPdf = null;

        $pathDate = date("Y") . "/" . date("m") . "/" . date("d") . "/";
        getDir(FCPATH . 'uploads/'.$pathDate);

        if(!empty($_FILES['word']['name']))
        {
            $_FILES['word']['name'] = $_FILES['word']['name'];
            $_FILES['word']['type'] = $_FILES['word']['type'];
            $_FILES['word']['tmp_name'] = $_FILES['word']['tmp_name'];
            $_FILES['word']['error'] = $_FILES['word']['error'];
            $_FILES['word']['size'] = $_FILES['word']['size'];
            
            $config['upload_path'] = 'uploads/'.$pathDate; 
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
            
            $config['upload_path'] = 'uploads/'.$pathDate; 
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
                        'codBoat' => $this->input->post('id_boat'),
                        'codWord' => $retVal = ($idWord != null) ? $idWord : null,
                        'codPDF' => $retVal = ($idPdf != null) ? $idPdf : null 
                    );
        if($this->orders_model->insertOrder($data))
        {
            $response = $this->orders_model->updateOrderConditions($this->input->post('id_boat'));
            if ($response) {
                echo "<script>alert('Orden Registrada satisfactoriamente!!');</script>";
                redirect('formOrder', 'refresh');
            }
        }
    }

    public function modalOrder_get()
    {
        $id = $this->input->get('id');

        $data = $this->boats_model->getBoatById($id);
        $this->load->view('orders/modalOrder', $data);
    }
 
}
