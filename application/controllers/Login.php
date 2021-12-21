<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use chriskacerguis\RestServer\RestController;

require APPPATH.'libraries/REST_Controller.php';
require APPPATH.'libraries/Format.php';

class Login extends RESTController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array("login_model","users_model","employees_model"));
        $this->load->helper(array('url','form'));
        $this->load->library(array('form_validation','session'));
        $this->msg = ['msg' => false];
    }

    public function index_get()
    {
        if($this->login_model->logged_id()){
            redirect("dashboard");

        }else{
            $this->session->unset_userdata('session_data');
            $this->load->view('login/login',$this->msg);
        }
    }

    public function login_post()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $this->form_validation->set_rules('username', 'Username', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE){
            if (empty($username) && empty($password)) {
            $this->msg = ['msg' => 'Usuario y Password vacios'];
            }elseif (empty($username)) {
                $this->msg = ['msg' => 'Campo Usuario está vacio'];
            }elseif(empty($password))
            {
                $this->msg = ['msg' => 'Campo Password está vacio.'];
            }
            $this->load->view('login/login',$this->msg); 
        }else{
            $data = $this->users_model->getUsers($username,$password);

            if ($data) {
                $userData = $this->employees_model->getEmployee($data);
                if ($userData) {
                    $session_data = array(
                        'user_id'       => $data,
                        'name'          => $userData->name,
                        'lastName'      => $userData->lastName,
                        'codTypeUser'   => $userData->codTypeUser
                    );
                    //set session userdata
                    $this->session->set_userdata($session_data);
                    redirect("dashboard");
                }else{
                    $this->msg = array('msg' => 'Usuario No Asignado a Personal. Contacte al Admistrador');
	                $this->load->view('login/login',$this->msg);
                }
                
            }else{
                $this->msg = array('msg' => 'Usuario y/o Password incorrecto.');
	            $this->load->view('login/login',$this->msg);
            } 
        }
    }

    public function logout_get()  
    {  
        //removing session  
        $this->session->unset_userdata('session_data');  
        $this->load->view('login/login',$this->msg);  
    }  
}
