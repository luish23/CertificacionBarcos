<?php

class Certifications_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->db_certifications = $this->load->database('certifications', true);
        $this->db_orders = $this->load->database('orders', true);
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

    public function generarCertificado($id,$codOffice)
    {
        $this->db_orders->select('o.*, b.*, s.name_ship, e.name, e.lastName, of.office, SUBSTRING(o.created_at, 3,2) AS anyo');
        $this->db_orders->from('orders o');
        $this->db_orders->join($this->db_orders->database.'.boats b', $this->db_orders->database.'.b.id = o.codBoat');
        $this->db_orders->join($this->db_orders->database.'.employee e', $this->db_orders->database.'.e.codUser = o.codUser');
        $this->db_orders->join($this->db_orders->database.'.offices of', $this->db_orders->database.'.of.id = '.$codOffice);
        $this->db_orders->join($this->db_orders->database.'.shipowner s', $this->db_orders->database.'.s.id = b.codShipowner');
        $this->db_orders->where('o.id', $id);
        $this->db_orders->where('o.condition', 'VALIDADO');
        $this->db_orders->where('o.status', 1);
        $query = $this->db_orders->get();
        $resultCertificate['data'] = ($query!==false && $query->num_rows() > 0) ? $query->row_array() : false;

        return $resultCertificate;
    }

    public function insertCertificate($data)
    {
        $this->db_orders->trans_begin();

        $this->db_orders->insert('issuedCertifications', $data);

        if ($this->db_orders->trans_status() === FALSE) {
            $this->db_orders->trans_rollback();
            return false;
        }
        else {
            $this->db_orders->trans_commit();
            $this->_changeCondition($data['codOrder']);
            return true;
        }
    }

    private function _changeCondition($id)
    {
        $this->db_orders->set('condition', 'FINALIZADO');
        $this->db_orders->where('id', $id);
        $this->db_orders->update('orders');

        $result = ($this->db_orders->affected_rows() > 0) ? true :  false;
        return $result;
    }

    public function getPathCertificate($id)
    {
        $this->db_orders->select('name_certificate, name_list_verification, path_jpg_certification_front, path_jpg_certification_back');
        $this->db_orders->from('typeCertifications');
        $this->db_orders->where('id', $id);
        $this->db_orders->where('status', 1);
        $query = $this->db_orders->get();
        $resultCertificate = ($query!==false && $query->num_rows() > 0) ? $query->row_array() : false;

        return $resultCertificate;
    }
}