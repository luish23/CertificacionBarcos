<?php

class Dashboard_model extends CI_Model {

    public function __construct()
    {
        $this->db_dashboard = $this->load->database('dashboard', true);
    }

    public function getInfo()
    {     
        $result['TOTAL'] = 0;
        $result['INICIADO'] = 0;
        $result['PROCESO'] = 0;
        $result['VALIDADO'] = 0;
        $result['FINALIZADO'] = 0;
        $result['CANCELADO'] = 0;
        $this->db_dashboard->select('COUNT(id) AS totalCondition, condition');
        $this->db_dashboard->from("orders");
        $this->db_dashboard->group_by("condition");
        $query = $this->db_dashboard->get();
        $resultC['conditions'] = ($query!==false && $query->num_rows() > 0) ? $query->result_array() : false;

        if ($resultC['conditions']) {
            foreach ($resultC['conditions'] as $key => $value) {
                $result[$value['condition']] = $value['totalCondition'];
                $result['TOTAL'] = $result['TOTAL'] + $value['totalCondition'];
            }
        }
        

        return $result;
    }

    public function getInfoById($id)
    {     
        $result['TOTAL'] = 0;
        $result['INICIADO'] = 0;
        $result['PROCESO'] = 0;
        $result['VALIDADO'] = 0;
        $result['FINALIZADO'] = 0;
        $result['CANCELADO'] = 0;
        $this->db_dashboard->select('COUNT(o.id) AS totalCondition, o.condition');
        $this->db_dashboard->from("orders o");
        $this->db_dashboard->join($this->db_dashboard->database.'.boats b', $this->db_dashboard->database.'.o.codBoat = b.id AND b.codShipowner = '.$id);
        $this->db_dashboard->group_by("o.condition");
        $query = $this->db_dashboard->get();
        $resultC['conditions'] = ($query!==false && $query->num_rows() > 0) ? $query->result_array() : false;

        if ($resultC['conditions']) {
            foreach ($resultC['conditions'] as $key => $value) {
                $result[$value['condition']] = $value['totalCondition'];
                $result['TOTAL'] = $result['TOTAL'] + $value['totalCondition'];
            }
        }
        

        return $result;
    }

}