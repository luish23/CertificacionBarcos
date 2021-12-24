<?php

class Offices_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->db_office = $this->load->database('offices', true);
    }

    public function getOffice()
    {
        $this->db_office->select('id, office');
        $this->db_office->from('offices');
        $this->db_office->where('status',1);
        $query = $this->db_office->get();
        $resultOffice = ($query!==false && $query->num_rows() > 0) ? $query->result_array() : false;

        return $resultOffice;
    }

}