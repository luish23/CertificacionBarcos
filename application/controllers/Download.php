<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Download extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array("login_model","orders_model"));
        $this->load->helper(array('url','download', 'file'));
        $this->load->library(array('session'));
    }

	public function index($id)
	{

        $response = $this->orders_model->getDownload($id);

        $fileName = $response->file_name;
        $filePath = FCPATH.$response->path_dir.$response->file_name;
        if(!empty($fileName) && file_exists($filePath)){
            header("Cache-Control: public");
            header("Content-Disposition: attachment; filename=".urlencode($fileName));
            if ($response->file_ext == '.pdf') {
                header("Content-Type: application/pdf");
            }
            else{
                header("Content-Type: application/msword");
            }
            header("Content-Transfer-Encoding: binary");

            readfile($filePath);
            exit;
        }else{
            echo "<script>alert('No existe el archivo');</script>";
            redirect('listOrders', 'refresh');
        }
	}

}