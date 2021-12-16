<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use chriskacerguis\RestServer\RestController;

require APPPATH.'libraries/REST_Controller.php';
require APPPATH.'libraries/Format.php';

class Users extends RESTController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array("users_model","login_model"));
        $this->load->helper(array('url'));
        $this->load->library(array('session'));
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
        echo "Controller Users";
    }

    public function listUsers_get()
    {
        $data = $this->users_model->getAllUsers();
        $template = array('title' => 'Listado de Usuarios');
        $this->load->view("dashboard/header_dashboard",$template);
        $this->load->view("layout_nav_top");
        $this->load->view("layout_nav_left",$this->session_data);
        $this->load->view('users/listUsers',array('user' => (array)$data));
        $this->load->view("dashboard/footer_dashboard");
    }

    public function formUsers_get()
    {
        $data = $this->users_model->getAllUsers();
        $template = array('title' => 'Registrar Usuarios');
        $this->load->view("dashboard/header_dashboard",$template);
        $this->load->view("layout_nav_top");
        $this->load->view("layout_nav_left",$this->session_data);
        $this->load->view('users/formUsers');
        $this->load->view("users/footer_users");
    }

    public function registerUsers_post()
    {
        if (!empty($this->input->post('username')) && !empty($this->input->post('password'))) {
            $data = array(  'user' => $this->input->post('username'),
                            'password' => MD5($this->input->post('password')),
                            'activated_date' => date("Y-m-d H:m:i"),
                            'status' => 1
                        );

            $response = $this->users_model->insertUser($data);
            redirect('formUsers');
        }else{
            $this->response( [
                'status' => false,
                'message' => 'Datos no recibidos'
            ], 200 );
        }
        
    }
 
}
