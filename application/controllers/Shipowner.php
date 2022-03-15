<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use chriskacerguis\RestServer\RestController;

require APPPATH.'libraries/REST_Controller.php';
require APPPATH.'libraries/Format.php';

class Shipowner extends RESTController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array("shipowner_model", "login_model", "logs_model"));
        $this->load->helper(array('url'));
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
            $this->lang->load(array('shipowner','layout_nav_left'), $this->session->site_lang);
        }else{
            $this->session->unset_userdata('session_data');
            $this->session->sess_destroy();
			redirect("login");
		}
    }

    public function index_get()
    {
        echo "Controller Shipowner";
    }

    public function listShipowner_get()
    {
        $data['data'] = $this->shipowner_model->getShipowner();

        $template = array('title' => $this->lang->line('list_shipowner'));
        $this->load->view("dashboard/header_dashboard",$template);
        $this->load->view("layout_nav_top");
        $this->load->view("layout_nav_left",$this->session_data);
        $this->load->view('shipowner/listShipowner', $data);
        $this->load->view("shipowner/footer_shipowner");
    }

    public function formShipowner_get()
    {
        $template = array('title' => $this->lang->line('add_shipowner'));
        $this->load->view("dashboard/header_dashboard",$template);
        $this->load->view("layout_nav_top");
        $this->load->view("layout_nav_left",$this->session_data);
        $this->load->view('shipowner/formShipowner');
        $this->load->view("shipowner/footer_shipowner");
    }

    public function modalShipownerUp_get()
    {
        $id = $this->input->get('id');
        $data['data'] = $this->shipowner_model->getShipownerById($id);
        $this->load->view('shipowner/modalShipownerUp', $data);
        $this->load->view("shipowner/footer_modalShipowner");
    }

    public function registerShipowner_post()
    {
        $id = $this->input->post('id');
    }

    public function updateShipowner_post()
    {
        $id = $this->input->post('id');
        $data = array ( 'name_ship' => $this->input->post('name_ship'), 
                        'address' => $this->input->post('address'),
                        'phone' => $this->input->post('phone')
                    );

        $result = $this->shipowner_model->updateShipowner($data, $id);

        if ($result) {
            $this->logs_model->registerLogs($this->session->user_id, 'updateShipowner_post', 'Update', 'Actualizó Id: '.$id);
            echo "<script>alert('".$this->lang->line('alert_update_shipowner')."');</script>";
            redirect('listShipowner', 'refresh');
        }
        else {
            echo "<script>alert('".$this->lang->line('alert_error_shipowner')."');</script>";
            redirect('dashboard', 'refresh');
        }
    }

}