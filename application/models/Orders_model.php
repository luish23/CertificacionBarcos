<?php

class Orders_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->db_boats = $this->load->database('boats', true);
        $this->db_relation = $this->load->database('relation_user_boat', true);
        $this->db_orders = $this->load->database('orders', true);
        $this->db_documents = $this->load->database('documents', true);
    }

    public function insertBoat($data)
    {
        $this->db_boats->trans_begin();

        $this->db_boats->insert('boats', $data);
        $item_id = $this->db_boats->insert_id();

        if ($this->db_boats->trans_status() === FALSE) {
            $this->db_boats->trans_rollback();

            return false;
        }
        else {
            $this->db_boats->trans_commit();
            return $item_id;
        }
        
    }

    public function insertDocuments($data)
    {
        $this->db_documents->trans_begin();

        $this->db_documents->insert('documents', $data);
        $item = $this->db_documents->insert_id();

        if ($this->db_documents->trans_status() === FALSE) {
            $this->db_documents->trans_rollback();

            return false;
        }
        else {
            $this->db_documents->trans_commit();
            return $item;
        }
    }

    public function insertOrder($data)
    {
        $this->db_orders->trans_begin();

        $this->db_orders->insert('orders', $data);
        $item = $this->db_orders->insert_id();

        if ($this->db_orders->trans_status() === FALSE) {
            $this->db_orders->trans_rollback();

            return false;
        }
        else {
            $this->db_orders->trans_commit();
            return $item;
        }
    }

    public function updateOrderConditions($id)
    {
        $this->db_boats->set('conditions', 'PROCESO');
        $this->db_boats->where('id', $id);
        $this->db_boats->update('boats');

        $result = ($this->db_boats->affected_rows() > 0) ? true :  false;
        return $result;
    }

    public function getOrdersByUser($id)
    {
        $result['data'] = false;
        $this->db_orders->select('GROUP_CONCAT(codBoat) AS ids');
        $this->db_orders->from('relation_user_boat');
        $this->db_orders->where('codUser', $id);
        $query = $this->db_orders->get();
        $resultOrders = ($query!==false && $query->num_rows() > 0) ? $query->row('ids') : false;

        if ($resultOrders) {
            $this->db_boats->select('b.id, b.name, b.number_imo, b.conditions, o.codWord, o.codPDF, of.office, SUBSTRING(o.created_at, 3,2) AS anyo');
            $this->db_boats->from('boats b');
            $this->db_boats->join($this->db_boats->database.'.orders o', $this->db_boats->database.'.o.codBoat = b.id');
            $this->db_boats->join($this->db_boats->database.'.documents d', ($this->db_boats->database.'.o.codWord = d.id OR '. $this->db_boats->database.'.o.codPDF = d.id'));
            $this->db_boats->join($this->db_boats->database.'.offices of', $this->db_boats->database.'.of.id = o.codOffice');
            $this->db_boats->where("b.id IN ($resultOrders)");
            $this->db_boats->where("b.status",1);
            $this->db_boats->group_by("b.id");
            $query = $this->db_boats->get();
            $resultBoats = ($query!==false && $query->num_rows() > 0) ? $query->result_array() : false;

            if ($resultBoats) {
                $result['data'] = $resultBoats;
                return $result;
            }

            return $result;
        }

        return $result;
    }

    public function getDownload($id)
    {
        $this->db_documents->select('path_dir, file_name, file_ext');
        $this->db_documents->from('documents');
        $this->db_documents->where('id', $id);

        $query = $this->db_documents->get();
        $resultDocuments = ($query!==false && $query->num_rows() > 0) ? $query->row() : false;

        return $resultDocuments;
    }

}