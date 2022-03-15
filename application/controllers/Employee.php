<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use chriskacerguis\RestServer\RestController;

require APPPATH.'libraries/REST_Controller.php';
require APPPATH.'libraries/Format.php';

class Employee extends RESTController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array("users_model","login_model", "employees_model", "boats_model", "logs_model"));
        $this->load->helper(array('url'));
        $this->load->library(array('session'));
        $this->base_url = $this->config->item('base_url');
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
            $this->lang->load(array('employee','layout_nav_left'), $this->session->site_lang);
        }else{
            $this->session->unset_userdata('session_data');
            $this->session->sess_destroy();
			redirect("login");
		}
    }

    public function index_get()
    {
        echo "Controller Employee";
    }

    public function listEmployee_get()
    {
        $data = $this->employees_model->getEmployees();

        $template = array('title' => $this->lang->line('list_employees'));
        $this->load->view("dashboard/header_dashboard",$template);
        $this->load->view("layout_nav_top");
        $this->load->view("layout_nav_left",$this->session_data);
        $this->load->view('employees/listEmployees', $data);
        $this->load->view("employees/footer_employee");
    }

    public function formEmployee_get()
    {
        $data = $this->users_model->getUsersNotAssigned();        
        $data['shipowner'] = $this->boats_model->getShipowner();
        
        $template = array('title' => $this->lang->line('add_employees'));
        $this->load->view("dashboard/header_dashboard",$template);
        $this->load->view("layout_nav_top");
        $this->load->view("layout_nav_left",$this->session_data);
        $this->load->view('employees/formEmployee',$data);
        $this->load->view("employees/footer_employee");
    }

    public function registerEmployee_post()
    {
        $data = array(
            "name" => $this->input->post('name'),
            "lastName" => $this->input->post('lastName'),
            "gender" => $this->input->post('gender'),
            "phone" => $this->input->post('phone'),
            "dni" => $this->input->post('dni'),
            "position" => $this->input->post('position'),
            "address" => $this->input->post('address'),
            "codShipowner" => $this->input->post('codShipowner'),
            "codUser" => $this->input->post('codUser')
            
        );

        $response = $this->employees_model->insertEmployee($data);

        if ($response) {
            $this->logs_model->registerLogs($this->session->user_id, 'registerEmployee_post', 'Add', 'Insertó Employee Id: '.$response);
            echo "<script>alert('".$this->lang->line('alert_add_employee')."');</script>";
            redirect('formEmployee', 'refresh');
        }
        else {
            echo "<script>alert('".$this->lang->line('alert_error_employee')."');</script>";
            redirect('formEmployee', 'refresh');
        }
    }

    public function updateEmployee_post()
    {
        $id = $this->input->post('id');
        $data = array(
            "name" => $this->input->post('name'),
            "lastName" => $this->input->post('lastName'),
            "gender" => $this->input->post('gender'),
            "phone" => $this->input->post('phone'),
            "dni" => $this->input->post('dni'),
            "position" => $this->input->post('position'),
            "address" => $this->input->post('address'),
            "status" => $this->input->post('status')
        );

        $response = $this->employees_model->updateEmployee($data, $id);

        if ($response) {
            $this->logs_model->registerLogs($this->session->user_id, 'updateEmployee_post', 'Update', 'Actualizó Employee Id: '.$id);
            echo "<script>alert('".$this->lang->line('alert_update_employee')."');</script>";
            redirect('listEmployee', 'refresh');
        }
        else {
            echo "<script>alert('".$this->lang->line('alert_error_update_employee')."');</script>";
            redirect('listEmployee', 'refresh');
        }
        
        
    }

    public function deleteEmployee_post()
    {
        $id = $this->input->post('id');

        $response = $this->employees_model->deleteEmployee($id);

        if ($response) {
            $this->logs_model->registerLogs($this->session->user_id, 'deleteEmployee_post', 'Delete', 'Borró Employee Id: '.$id);
            echo "<script>alert('".$this->lang->line('alert_delete_employee')."');</script>";
            redirect('listEmployee', 'refresh');
        }
        else {
            echo "<script>alert('".$this->lang->line('alert_error_delete_employee')."');</script>";
            redirect('dashboard', 'refresh');
        }

    }

    public function modalEmployee_get()
    {
        $id = $this->input->get('id');
        $data = $this->employees_model->getEmployee($id);
        $this->load->view('employees/modalEmployee', $data);
    }

    public function modalEmployeeUp_get()
    {
        $id = $this->input->get('id');
        $data = $this->employees_model->getEmployeeUpdate($id);
        $this->load->view('employees/modalEmployeeUp', $data);
        $this->load->view('employees/footer_modalEmployee');
    }

    public function modalEmployeeDel_get()
    {
        $id = $this->input->get('id');
        $data = $this->employees_model->getEmployee($id);
        $this->load->view('employees/modalEmployeeDel', $data);
    }
 
}
