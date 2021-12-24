<?php

class Dashboard_model extends CI_Model {

    public function __construct()
    {
        $this->db_dashboard = $this->load->database('dashboard', true);
    }

    public function getInfo()
    {
        $this->db_dashboard->select('COUNT(id) AS totalOrders');
        $this->db_dashboard->from("orders");
        $query = $this->db_dashboard->get();
        $result['orders'] = ($query!==false && $query->num_rows() > 0) ? $query->row('totalOrders') : false;
        
        $this->db_dashboard->select('COUNT(conditions) AS totalConditions, conditions');
        $this->db_dashboard->from("boats");
        $this->db_dashboard->group_by("conditions");
        $query = $this->db_dashboard->get();
        $result2['conditions'] = ($query!==false && $query->num_rows() > 0) ? $query->result_array() : false;
        
        foreach ($result2['conditions'] as $key => $value) {
            $result[$value['conditions']] = $value['totalConditions'];
        }

        return $result;
    }

}