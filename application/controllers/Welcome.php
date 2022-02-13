<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model(array("boats_model","users_model","login_model", "orders_model", "offices_model", "certifications_model"));
        $this->load->helper(array("url","custom"));
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
            $this->lang->load(array('orders','layout_nav_left'), $this->session->site_lang);
        }else{
            $this->session->unset_userdata('session_data');
            $this->session->sess_destroy();
			redirect("login");
		}
    }
	
	public function index()
	{
		$template = array('title' => 'Pagina de Ejemplo');
        $this->load->view("dashboard/header_dashboard",$template);
        $this->load->view("layout_nav_top");
        $this->load->view("layout_nav_left",$this->session_data);
        $this->load->view('welcome_message');
        $this->load->view("welcome_footer");

		
	}
}
