<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model
{
	
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', true);
    }

    function logged_id()
    {
        return $this->session->userdata('user_id');
    }

    public function getPermission($idType)
    {
        $this->db->select('previewInfo, editInfo, deleteInfo, generateCert, previewPdf, mNavio, addNavio, listNavio, mOrder, addOrder, listOrder, validOrder, mUser, addUser, listUser, mEmployee, addEmployee, listEmployee, mConfig, business');
        $this->db->from('permission');
        $this->db->where('codTypeUser', $idType);

        $query = $this->db->get();
        $result = ($query!==false && $query->num_rows() > 0) ? $query->row_array() : false;

        return $result;

    }
}
