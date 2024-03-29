<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use chriskacerguis\RestServer\RestController;

require APPPATH.'libraries/REST_Controller.php';
require APPPATH.'libraries/Format.php';

class Users extends RESTController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array("users_model", "login_model", "logs_model"));
        $this->load->helper(array('url'));
        $this->load->library(array('session','encryption'));
        $this->base_url = $this->config->item('base_url');
        
        if($this->login_model->logged_id())
		{
            $this->key = $this->config->item('encryption_key');
            $this->encryption->initialize(
                array(  'driver' => 'openssl',
                        'cipher' => 'aes-128',
                        'mode' => 'ctr',
                        'key' => $this->key
                )
            );
			$this->session_data = array(
				'user_id'       => $this->session->user_id,
				'name'          => $this->session->name,
				'lastName'      => $this->session->lastName,
				'codTypeUser'   => $this->session->codTypeUser,
                'codShipowner'  => $this->session->codShipowner,
				'site_lang'  	=> $this->session->site_lang
			);
            $this->session_data['session'] = $this->login_model->getPermission($this->session->codTypeUser);
            $this->lang->load(array('users','layout_nav_left'), $this->session->site_lang);
        }else{
            $this->session->unset_userdata('session_data');
            $this->session->sess_destroy();
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

        $template = array('title' => $this->lang->line('title_users'));
        $this->load->view("dashboard/header_dashboard",$template);
        $this->load->view("layout_nav_top");
        $this->load->view("layout_nav_left",$this->session_data);
        $this->load->view('users/listUsers',$data);
        $this->load->view("users/footer_users");
    }

    public function formUsers_get()
    {
        $template = array('title' => $this->lang->line('add_users'));
        $data['typeUser'] = $this->users_model->getTypeUser();

        $this->load->view("dashboard/header_dashboard",$template);
        $this->load->view("layout_nav_top");
        $this->load->view("layout_nav_left",$this->session_data);
        $this->load->view('users/formUsers',$data);
        $this->load->view("users/footer_users");
    }

    public function registerUsers_post()
    {
        if (!empty($this->input->post('username')) && !empty($this->input->post('password'))) {
            $data = array(  'user' => $this->input->post('username'),
                            'codTypeUser' => $this->input->post('codTypeUser'),
                            'password' => $this->encryption->encrypt($this->input->post('password')),
                            'status' => 1
                        );

            $response = $this->users_model->insertUser($data);

            // switch ($response['code']) {
            //     case 1062:
            //         echo "<script>alert('".$this->lang->line('exist_user')."');</script>";
            //         redirect('listUsers', 'refresh');
            //         break;
            // }

            if ($response) {
                $this->logs_model->registerLogs($this->session->user_id, 'registerUsers_post', 'Add', 'Insertó User Id: '.$response);
                echo "<script>alert('".$this->lang->line('alert_register_user_ok')."');</script>";
                redirect('listUsers', 'refresh');
            }
            else {
                echo "<script>alert('".$this->lang->line('alert_error_insert_user')."');</script>";
                redirect('formUsers', 'refresh');
            }
        }else{
            echo "<script>alert('".$this->lang->line('alert_no_data')."');</script>";
            redirect('listUsers', 'refresh');
            // $this->response( [
            //     'status' => false,
            //     'message' => 'Datos no recibidos'
            // ], 200 );
        }
        
    }

    public function updateUsers_post()
    {
        
        if (!empty($this->input->post('id')) && !empty($this->input->post('password')) && !empty($this->input->post('password_confirm'))) {
            $id = $this->input->post('id');

            if ($this->input->post('password') != $this->input->post('password_confirm')) {
                echo "<script>alert('".$this->lang->line('alert_no_equal_pwd')."');</script>";
                redirect('listUsers', 'refresh');
            }else {
                $data['password'] = $this->encryption->encrypt($this->input->post('password'));
                $data['codTypeUser'] = $this->input->post('codTypeUser');
                $data['status'] = $this->input->post('status');

                $response = $this->users_model->updatetUser($data, $id);
                if ($response) {
                    $this->logs_model->registerLogs($this->session->user_id, 'updateUsers_post', 'Update', 'Actualizó User Id: '.$id);
                    echo "<script>alert('".$this->lang->line('alert_update_user_ok')."');</script>";
                    redirect('listUsers', 'refresh');
                }
                else {
                    echo "<script>alert('".$this->lang->line('alert_no_update_data')."');</script>";
                    redirect('listUsers', 'refresh');
                }     
            }
        }else{
            $this->response( [
                'status' => false,
                'message' => 'Datos no recibidos'
            ], 200 );
        }
    }

    public function deleteUser_post()
    {
        $id = $this->input->post('id');

        $response = $this->users_model->deleteUser($id);

        if ($response) {
            $this->logs_model->registerLogs($this->session->user_id, 'deleteUser_post', 'Delete', 'Eliminó User Id: '.$id);
            echo "<script>alert('".$this->lang->line('alert_deleteUser')."');</script>";
            redirect('listUsers', 'refresh');
        }
        else {
            echo "<script>alert('".$this->lang->line('alertError_deleteUser')."');</script>";
            redirect('dashboard', 'refresh');
        }

    }

    public function modalUser_get()
    {
        $id = $this->input->get('id');
        $data = $this->users_model->getUserById($id);
        $this->load->view('users/modalUser', $data);
    }

    public function modalUserUp_get()
    {
        $id = $this->input->get('id');
        $data = $this->users_model->getOnlyUserById($id);
        $data['typeUser'] = $this->users_model->getTypeUser();
        $data['data']['password'] = $this->encryption->decrypt($data['data']['password']);
        $this->load->view('users/modalUserUp', $data);
    }

    public function modalUserDel_get()
    {
        $id = $this->input->get('id');
        $data = $this->users_model->getOnlyUserById($id);
        // print_r($data); 
        $this->load->view('users/modalUserDel', $data);
    }
 
}
