<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array("login_model","dashboard_model"));
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
			$this->session->sess_destroy();
			redirect("login");
		}
    }

	public function index()
	{
		print_r($this->session_data);
		$data = $this->dashboard_model->getInfo();
		$template = array('title' => 'Dashboard');
		$this->load->view("dashboard/header_dashboard",$template);
		$this->load->view("layout_nav_top");
		$this->load->view("layout_nav_left",$this->session_data);
		$this->load->view("dashboard/dashboard", $data);
		$this->load->view("dashboard/footer_dashboard");
	
	}

}