<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function dashboard()
	{
		$this->load->view('login/dashboard');
	}

    public function index()
    {
        $this->load->view('login/login');
    }
}
