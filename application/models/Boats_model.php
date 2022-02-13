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

    public function getBoatsNotDocument()
    {
        $this->db_boats->select('b.id, b.name');
        $this->db_boats->from("boats b");
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
        $this->db_boats->select('b.*, of.office, sh.name_ship, SUBSTRING(o.created_at, 3,2) AS anyo');
        $this->db_boats->from('boats b');
        $this->db_boats->join($this->db_boats->database.'.orders o', $this->db_boats->database.'.o.codBoat ='.$id);
        $this->db_boats->join($this->db_boats->database.'.offices of', $this->db_boats->database.'.of.id = o.codOffice');
        $this->db_boats->join($this->db_boats->database.'.shipowner sh', $this->db_boats->database.'.b.codShipowner = sh.id');
        $this->db_boats->where('b.id', $id);
        // $this->db_boats->where('b.status', 1);
        $query = $this->db_boats->get();
        $resultBoat['data'] = ($query!==false && $query->num_rows() > 0) ? $query->row_array() : false;
        return $resultBoat;
    }

    public function getBoatMinById($id)
    {
        $this->db_boats->select('b.*, sh.name_ship');
        $this->db_boats->from('boats b');
        $this->db_boats->join($this->db_boats->database.'.shipowner sh', $this->db_boats->database.'.b.codShipowner = sh.id');
        // $this->db_boats->where('b.codShipowner',$id);
        $this->db_boats->where('b.id', $id);
        $this->db_boats->where('b.status', 1);
        $query = $this->db_boats->get();
        $resultBoatDel['data'] = ($query!==false && $query->num_rows() > 0) ? $query->row_array() : false;
        return $resultBoatDel;
    }

    public function getBoatsByUser($idUser = null)
    {
        $result['data'] = false;
        // $this->db_boats->select('GROUP_CONCAT(codBoat) AS ids');
        // $this->db_boats->from('relation_user_boat');
        // $this->db_boats->where('codUser', $idUser);
        // $query = $this->db_boats->get();
        // $resultBoats = ($query!==false && $query->num_rows() > 0) ? $query->row('ids') : false;

        // if ($resultBoats) {
            $this->db_boats->select('b.*, sh.name_ship');
            $this->db_boats->from('boats b');
            $this->db_boats->join($this->db_boats->database.'.shipowner sh', $this->db_boats->database.'.b.codShipowner = sh.id');
            $this->db_boats->where('b.codShipowner',$idUser);
            $this->db_boats->where('b.status', 1);
            // $this->db_boats->group_by("b.id");
            $query = $this->db_boats->get();
            $resultBoats2 = ($query!==false && $query->num_rows() > 0) ? $query->result_array() : false;

            if ($resultBoats2) {
                $result['data'] = $resultBoats2;
                return $result;
            }

            return $result;
        // }

        return $result;

    }

    public function getAllBoats()
    {
        $result['data'] = false;
        $this->db_boats->select('b.*, sh.name_ship');
        $this->db_boats->from('boats b');
        $this->db_boats->join($this->db_boats->database.'.shipowner sh', $this->db_boats->database.'.b.codShipowner = sh.id');
        $this->db_boats->where('b.status', 1);
        // $this->db_boats->group_by("b.id");
        $query = $this->db_boats->get();
        $resultBoats = ($query!==false && $query->num_rows() > 0) ? $query->result_array() : false;

        if ($resultBoats) {
            $result['data'] = $resultBoats;
            return $result;
        }

        return $result;
    }

    public function updateBoat($data, $id)
    {
        $this->db_boats->where('id', $id);
        $this->db_boats->update('boats',$data);
        return $this->db_boats->affected_rows();
    }

    public function deleteBoat($id)
    {
        $this->db_boats->set('status', 0);
        $this->db_boats->set('conditions', 'ELIMINADO');
        $this->db_boats->where('id', $id);
        $this->db_boats->update('boats');

        $this->_deleteOrder($id);

        return $this->db_boats->affected_rows();
    }

    private function _deleteOrder($id)
    {
        $this->db_orders->set('status', 0);
        $this->db_orders->where('codBoat', $id);
        $this->db_orders->update('orders');
    }

    public function getShipowner()
    {
        // $result['data'] = false;
        $this->db_boats->select('*');
        $this->db_boats->from('shipowner');
        // $this->db_boats->where('status', 1);
        $query = $this->db_boats->get();
        $resultShipowner = ($query!==false && $query->num_rows() > 0) ? $query->result_array() : false;

        if ($resultShipowner) {
            $result = $resultShipowner;
            return $result;
        }

        return $result;
    }

    public function checkIMO($imo)
    {
        $this->db_boats->select('id');
        $this->db_boats->from("boats");
        $this->db_boats->where('number_imo', $imo);
        $query = $this->db_boats->get();
        $result = ($query!==false && $query->num_rows() > 0) ? 1 : 0;

        return $result;
    }

}