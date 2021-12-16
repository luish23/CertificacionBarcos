<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use chriskacerguis\RestServer\RestController;

require APPPATH.'libraries/REST_Controller.php';
require APPPATH.'libraries/Format.php';

class Boats extends RESTController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array("boats_model","users_model","login_model"));
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
        echo "Controller Boats";
    }

    public function listBoat_get()
    {
        $data = $this->users_model->getAllUsers();
        $template = array('title' => 'Listado de Empleados');
        $this->load->view("dashboard/header_dashboard",$template);
        $this->load->view("layout_nav_top");
        $this->load->view("layout_nav_left",$this->session_data);
        $this->load->view('employees/listEmployees',array('user' => (array)$data));
        $this->load->view("dashboard/footer_dashboard");
    }

    public function formBoat_get()
    {
        $data = $this->users_model->getAllUsers();
        $template = array('title' => 'Registrar Empleados');
        $this->load->view("dashboard/header_dashboard",$template);
        $this->load->view("layout_nav_top");
        $this->load->view("layout_nav_left",$this->session_data);
        $this->load->view('boats/formBoat');
        $this->load->view("boats/footer_boat");
    }

    public function registerBoat_post()
    {
        $data = array(
            "name" => $this->input->post('name'),
            "number_imo" => $this->input->post('number_imo'),
            "shipowner" => $this->input->post('shipowner'),
            "number_register" => $this->input->post('number_register'),
            "call_sign" => $this->input->post('call_sign'),
            "year_build" => $this->input->post('year_build'),
            "place_build" => $this->input->post('place_build'),
            "shipyard" => $this->input->post('shipyard'),
            "type_boat" => $this->input->post('type_boat'),
            "navigation" => $this->input->post('navigation'),
            "service" => $this->input->post('service'),
            "number_approved_passengers" => $this->input->post('number_approved_passengers'),
            "total_length" => $this->input->post('total_length'),
            "length_perpendiculars" => $this->input->post('length_perpendiculars'),
            "manga" => $this->input->post('manga'),
            "structure" => $this->input->post('structure'),
            "gross_tonnage" => $this->input->post('gross_tonnage'),
            "liquid_tonnage" => $this->input->post('liquid_tonnage'),
            "gross_transport" => $this->input->post('gross_transport'),
            "amount" => $this->input->post('amount'),
            "mark" => $this->input->post('mark'),
            "model" => $this->input->post('model'),
            "power_speed" => $this->input->post('power_speed')
        );

        $response = $this->boats_model->insertBoat($data);
        if ($response) {
            $relation = array('codUser' => $this->session->user_id, 'codBoat' => $response);
            $this->boats_model->relationUserBoat($relation);
            redirect('formBoat');
        }
        else {
            echo "Hubo un error al Insertar la data"; die;
        }
        
        
    }
 
}
