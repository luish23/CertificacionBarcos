<?php

class Cron_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', true);
    }

    public function updateExpirationCerts()
    {
        $this->db->select('id,expired_certificated');
        $this->db->from('issuedCertifications');
        $this->db->where_in('estado',['ACTIVO','VENCE EN']);
        
        $query = $this->db->get();
        $resultCerts = ($query!==false && $query->num_rows() > 0) ? $query->result_array() : false;

        return $resultCerts;
        
    }

    public function updateDaysCerts($id,$estado,$days)
    {
        $this->db->set('estado', $estado);
        $this->db->set('days_remaining', $days);
        $this->db->where('id', $id);
        $this->db->update('issuedCertifications');

        return $this->db->affected_rows();
    }
}