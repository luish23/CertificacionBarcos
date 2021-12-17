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

}