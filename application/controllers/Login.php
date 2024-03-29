<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use chriskacerguis\RestServer\RestController;

require APPPATH.'libraries/REST_Controller.php';
require APPPATH.'libraries/Format.php';

class Login extends RESTController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array("login_model", "users_model", "employees_model", "logs_model"));
        $this->load->helper(array('url','form'));
        $this->load->library(array('form_validation','session','encryption'));
        $this->key = $this->config->item('encryption_key');
        $this->base_url = $this->config->item('base_url');
        $this->encryption->initialize(
            array(  'driver' => 'openssl',
                    'cipher' => 'aes-128',
                    'mode' => 'ctr',
                    'key' => $this->key
            )
        );
        $this->msg = ['msg' => false];
    }

    public function index_get()
    {
        if($this->login_model->logged_id()){
            redirect("dashboard");

        }else{
            $this->session->unset_userdata('session_data');
            $this->session->sess_destroy();
            $this->load->view('login/login',$this->msg);
        }
    }

    public function login_post()
    {
        $username = $this->input->post('username');
        $password =$this->input->post('password');

        $this->form_validation->set_rules('username', 'Username', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE){
            if (empty($username) && empty($password)) {
            $this->msg = ['msg' => $this->lang->line('empty_user_pwd')];
            }elseif (empty($username)) {
                $this->msg = ['msg' => $this->lang->line('empty_user')];
            }elseif(empty($password))
            {
                $this->msg = ['msg' => $this->lang->line('empty_pwd')];
            }
            $this->load->view('login/login',$this->msg); 
        }else{
            $data = $this->users_model->veriffUsers($username,$password);

            if ($data) {
                $userData = $this->employees_model->getEmployee($data);

                if ($userData['data']) {
                    $session_data = array(
                        'user_id'       => $data,
                        'name'          => $userData['data']['name'],
                        'lastName'      => $userData['data']['lastName'],
                        'codTypeUser'   => $userData['data']['codTypeUser'],
                        'codShipowner'  => $userData['data']['codShipowner'],
                        'site_lang'     => $userData['data']['site_lang']
                    );
                    //set session userdata
                    $this->session->set_userdata($session_data);
                    $this->logs_model->registerLogs($data, 'login_post', 'Login System', NULL);
                    redirect("dashboard");
                }else{
                    $this->msg = array('msg' => $this->lang->line('alert_adm'));
	                $this->load->view('login/login',$this->msg);
                }
                
            }else{
                $this->msg = array('msg' => $this->lang->line('alert_error_user_pwd'));
	            $this->load->view('login/login',$this->msg);
            } 
        }
    }

    public function logout_get()  
    {  
        //removing session  
        if (isset($this->session->user_id)) {
            $this->logs_model->registerLogs($this->session->user_id, 'logout_get', 'Logout System', NULL);
        }
        
        $this->session->unset_userdata('session_data');  
        $this->session->sess_destroy();
        $this->load->view('login/login',$this->msg);  
    }  
}
