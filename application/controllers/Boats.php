<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use chriskacerguis\RestServer\RestController;

require APPPATH.'libraries/REST_Controller.php';
require APPPATH.'libraries/Format.php';

class Boats extends RESTController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array("boats_model", "users_model", "login_model", "logs_model"));
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
				'codShipowner'  => $this->session->codShipowner
			);
            $this->session_data['session'] = $this->login_model->getPermission($this->session->codTypeUser);
			$this->lang->load(array('boats','layout_nav_left'), $this->session->site_lang);

        }else{
            $this->session->unset_userdata('session_data');
            $this->session->sess_destroy();
			redirect("login");
		}
    }

    public function index_get()
    {
        echo "Controller Boats";
    }

    public function listBoat_get()
    {   
        if ($this->session->codTypeUser == 6) // Armador
        {
            $data = $this->boats_model->getBoatsByUser($this->session->codShipowner);
        }else{
            $data = $this->boats_model->getAllBoats();  
        }

        $template = array('title' => $this->lang->line('list_boats'));
        $this->load->view("dashboard/header_dashboard",$template);
        $this->load->view("layout_nav_top");
        $this->load->view("layout_nav_left",$this->session_data);
        $this->load->view('boats/listBoats',$data);
        $this->load->view("boats/footer_boat");
    }

    public function formBoat_get()
    {
        $data['data'] = $this->boats_model->getShipowner();
        $template = array('title' => $this->lang->line('add_boats'));
        $this->load->view("dashboard/header_dashboard",$template);
        $this->load->view("layout_nav_top");
        $this->load->view("layout_nav_left",$this->session_data);
        $this->load->view('boats/formBoat',$data);
        $this->load->view("boats/footer_boat");
    }

    public function registerBoat_post()
    {
        $data = array(
            "name" => $this->input->post('name'),
            "number_imo" => $this->input->post('number_imo'),
            "codShipowner" => $this->input->post('codShipowner'),
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
            "engine_running" => $this->input->post('engine_running'),
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
            $this->logs_model->registerLogs($this->session->user_id, 'registerBoat_post', 'Add', 'Insertó Boat Id: '.$response);
            echo "<script>alert('".$this->lang->line('alert_insert_ok')."');</script>";
            redirect('formBoat', 'refresh');
        }
        else {
            echo "<script>alert('".$this->lang->line('alert_insert_error')."');</script>";
            redirect('dashboard', 'refresh');
        }
    }

    public function updateBoat_post()
    {
        $id = $this->input->post('id');
        $data = array(
            "name" => $this->input->post('name'),
            "number_imo" => $this->input->post('number_imo'),
            "codShipowner" => $this->input->post('codShipowner'),
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
            "engine_running" => $this->input->post('engine_running'),
            "liquid_tonnage" => $this->input->post('liquid_tonnage'),
            "gross_transport" => $this->input->post('gross_transport'),
            "amount" => $this->input->post('amount'),
            "mark" => $this->input->post('mark'),
            "model" => $this->input->post('model'),
            "power_speed" => $this->input->post('power_speed')
        );

        $response = $this->boats_model->updateBoat($data, $id);

        if ($response) {
            $this->logs_model->registerLogs($this->session->user_id, 'updateBoat_post', 'Update', 'Actualizó Boat Id: '.$id);
            echo "<script>alert('".$this->lang->line('alert_update_ok')."');</script>";
            redirect('listBoats', 'refresh');
        }
        else {
            echo "<script>alert('".$this->lang->line('alert_update_error')."');</script>";
            redirect('dashboard', 'refresh');
        }
    }

    public function deleteBoat_post()
    {
        $id = $this->input->post('id');

        $response = $this->boats_model->deleteBoat($id);

        if ($response) {
            $this->logs_model->registerLogs($this->session->user_id, 'deleteBoat_post', 'Delete', 'Eliminó Boat Id: '.$id);
            echo "<script>alert('".$this->lang->line('alert_delete_ok')."');</script>";
            redirect('listBoats', 'refresh');
        }
        else {
            echo "<script>alert('".$this->lang->line('alert_delete_error')."');</script>";
            redirect('dashboard', 'refresh');
        }

    }
    
    public function modalBoats_get()
    {
        $id = $this->input->get('id');
        $data = $this->boats_model->getBoatMinById($id);
        $this->load->view('boats/modalBoat', $data);
    }

    public function modalBoatsUp_get()
    {
        $id = $this->input->get('id');
        $data = $this->boats_model->getBoatMinById($id);
        $data['shipowner'] = $this->boats_model->getShipowner();
        $this->load->view('boats/modalBoatUp', $data);
    }

    public function modalBoatsDel_get()
    {
        $id = $this->input->get('id');
        $data = $this->boats_model->getBoatMinById($id);
        $this->load->view('boats/modalBoatDel', $data);
    }

    /**
     * VALIDAR SI EL NUMERO IMO EXISTE
     * var imo
     * @return boolean
     */

    public function checkIMO_post()
    {
        $imo = $this->input->post('imo');
        $data = $this->boats_model->checkIMO($imo);
        
        if ($data) {
            echo "Ya existe el numero introducido";
        }
        
    }
 
}
