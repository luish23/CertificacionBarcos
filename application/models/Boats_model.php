<?php

class Boats_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->db_boats = $this->load->database('boats', true);
        $this->db_relation = $this->load->database('relation_user_boat', true);
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

}