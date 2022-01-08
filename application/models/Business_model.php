<?php

class Business_model extends CI_Model {

    public function __construct()
    {
        $this->db_business = $this->load->database('business', true);
    }

    public function getBusiness()
    {     
        $this->db_business->select('*');
        $this->db_business->from('business');
        $this->db_business->where('status', 1);
        $query = $this->db_business->get();
        $result = ($query!==false && $query->num_rows() > 0) ? $query->row_array() : false;
        return $result;

    }

}