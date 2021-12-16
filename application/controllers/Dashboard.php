<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array("login_model"));
        $this->load->helper(array('url'));
        $this->load->library(array('session'));
    }

	public function index()
	{
		if($this->login_model->logged_id())
		{
			$session_data = array(
				'user_id'       => $this->session->user_id,
				'name'          => $this->session->name,
				'lastName'      => $this->session->lastName,
				'codTypeUser'   => $this->session->codTypeUser
			);
			$template = array('title' => 'Dashboard');
			$this->load->view("dashboard/header_dashboard",$template);
			$this->load->view("layout_nav_top");
			$this->load->view("layout_nav_left",$session_data);
			$this->load->view("dashboard/dashboard");
			$this->load->view("dashboard/footer_dashboard");
		}else{
            $this->session->unset_userdata('session_data');
			redirect("login");
		}
	}

}