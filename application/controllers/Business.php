<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use chriskacerguis\RestServer\RestController;

require APPPATH.'libraries/REST_Controller.php';
require APPPATH.'libraries/Format.php';

class Business extends RESTController {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array("business_model", "login_model", "logs_model"));
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
            $this->lang->load(array('business','layout_nav_left'), $this->session->site_lang);
        }else{
            $this->session->unset_userdata('session_data');
            $this->session->sess_destroy();
			redirect("login");
		}
    }

    public function index_get()
    {
        echo "Controller Business";
    }

    public function listBusiness_get()
    {
        $data['data'] = $this->business_model->getBusiness();

        $template = array('title' => $this->lang->line('business'));
        $this->load->view("dashboard/header_dashboard",$template);
        $this->load->view("layout_nav_top");
        $this->load->view("layout_nav_left",$this->session_data);
        $this->load->view('business/listBusiness', $data);
        $this->load->view("business/footer_business");
    }


}