<?php

class Boats_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->db_boats = $this->load->database('boats', true);
        $this->db_relation = $this->load->database('relation_user_boat', true);
        $this->db_orders = $this->load->database('orders', true);
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

    public function relationUserBoat($data)
    {
        
        $this->db_relation->trans_start();
        $this->db_relation->trans_strict(FALSE);

        $this->db_relation->insert('relation_user_boat', $data);
        

        if ($this->db_relation->trans_status() === FALSE) {
            $this->db_relation->trans_rollback();

            return false;
        }

        $this->db_relation->trans_commit();

        return true;
    }

    public function getBoatsNotDocument($id = null)
    {
        $this->db_boats->select('b.id, b.name');
        $this->db_boats->from("boats b");
        $this->db_boats->join($this->db_boats->database.'.relation_user_boat', $this->db_boats->database.'.relation_user_boat.codBoat = b.id');
        $this->db_boats->where('b.conditions', 'INICIADO');
        $this->db_boats->where('b.status', 1);
        $this->db_boats->order_by('b.name', 'ASC');
        $query = $this->db_boats->get();
        $resultBoats = ($query!==false && $query->num_rows() > 0) ? $query->result_array() : false;
        if ($resultBoats) {
            $result['data'] = $resultBoats;
            return $result;
        }
        return false;
    }

    public function getOrdersByUser($id = null)
    {
        $this->db_orders->select('b.id, b.name, b.conditions');
        $this->db_orders->from("boats b");
        $this->db_orders->where('b.status', 1);
        $this->db_orders->order_by('b.created_at', 'ASC');
        $query = $this->db_orders->get();
        $resultOrders = ($query!==false && $query->num_rows() > 0) ? $query->result_array() : false;

        return $resultOrders;
    }

    public function getBoatById($id)
    {
        $this->db_boats->select('*');
        $this->db_boats->from('boats');
        $this->db_boats->where('id', $id);

        $query = $this->db_boats->get();
        $resultBoat['data'] = ($query!==false && $query->num_rows() > 0) ? $query->row_array() : false;

        return $resultBoat;
    }

    public function getBoatsByUser($idUser)
    {
        $result['data'] = false;
        $this->db_boats->select('GROUP_CONCAT(codBoat) AS ids');
        $this->db_boats->from('relation_user_boat');
        $this->db_boats->where('codUser', $idUser);
        $query = $this->db_boats->get();
        $resultBoats = ($query!==false && $query->num_rows() > 0) ? $query->row('ids') : false;

        if ($resultBoats) {
            $this->db_boats->select('b.*');
            $this->db_boats->from('boats b');
            $this->db_boats->where("b.id IN ($resultBoats)");
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

}