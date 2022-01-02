<?php

class Certifications_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->db_certifications = $this->load->database('certifications', true);
    }

    public function getTypeCertifications()
    {
        $this->db_certifications->select('*');
        $this->db_certifications->from("typeCertifications");
        $this->db_certifications->where('status', 1);
        $query = $this->db_certifications->get();
        $resultCertifications = ($query!==false && $query->num_rows() > 0) ? $query->result_array() : false;

        return $resultCertifications;
    }
}