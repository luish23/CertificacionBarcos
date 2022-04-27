<?php

class Shipowner_model extends CI_Model {

    public function __construct()
    {
        $this->db_shipowner = $this->load->database('shipowner', true);
    }

    public function getShipowner()
    {     
        $this->db_shipowner->select('*');
        $this->db_shipowner->from('shipowner');
        $this->db_shipowner->where('status', 1);
        $query = $this->db_shipowner->get();
        $result = ($query!==false && $query->num_rows() > 0) ? $query->result_array() : false;
        return $result;

    }

    public function getShipownerById($id)
    {     
        $this->db_shipowner->select('*');
        $this->db_shipowner->from('shipowner');
        $this->db_shipowner->where('id', $id);
        $this->db_shipowner->where('status', 1);
        $query = $this->db_shipowner->get();
        $result = ($query!==false && $query->num_rows() > 0) ? $query->row_array() : false;
        return $result;

    }

    public function insertShipowner($data)
    {
        $this->db_shipowner->trans_begin();

        $this->db_shipowner->insert('shipowner', $data);
        $item_id = $this->db_shipowner->insert_id();

        if ($this->db_shipowner->trans_status() === FALSE) {
            $this->db_shipowner->trans_rollback();

            return false;
        }
        else {
            $this->db_shipowner->trans_commit();
            return $item_id;
        }
        
    }

    public function updateShipowner($data, $id)
    {
        $this->db_shipowner->where('id', $id);
        $this->db_shipowner->update('shipowner',$data);
        return $this->db_shipowner->affected_rows();
    }

    

}