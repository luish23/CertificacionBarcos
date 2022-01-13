<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use chriskacerguis\RestServer\RestController;

require APPPATH.'libraries/REST_Controller.php';
require APPPATH.'libraries/Format.php';

class Employee extends RESTController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array("users_model","login_model", "employees_model", "boats_model"));
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
        // print_r($data); die;
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
            echo "<script>alert('Empleado registrado satisfactoriamente!!');</script>";
            redirect('formEmployee', 'refresh');
        }
        else {
            echo "<script>alert('EHubo un error al Insertar la data');</script>";
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
            echo "<script>alert('Empleado Actualizado satisfactoriamente!!');</script>";
            redirect('listEmployee', 'refresh');
        }
        else {
            echo "<script>alert('Hubo un error al Actualizar la Informacion');</script>";
            redirect('listEmployee', 'refresh');
        }
        
        
    }

    public function deleteEmployee_post()
    {
        $id = $this->input->post('id');

        $response = $this->employees_model->deleteEmployee($id);

        if ($response) {
            echo "<script>alert('Empleado Eliminado satisfactoriamente!!');</script>";
            redirect('listEmployee', 'refresh');
        }
        else {
            echo "<script>alert('Hubo un error al Eliminar la data');</script>";
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
        $this->load->view('employees/footer_modalEmployee', $data);
    }

    public function modalEmployeeDel_get()
    {
        $id = $this->input->get('id');
        $data = $this->employees_model->getEmployee($id);
        $this->load->view('employees/modalEmployeeDel', $data);
    }
 
}
