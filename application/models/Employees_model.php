<?php

class Employees_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->db_users = $this->load->database('users', true);
        $this->db_typeuser = $this->load->database('typeUser', true);
        $this->db_employee = $this->load->database('employee', true);
    }

    public function getEmployee($id)
    {
        $this->db_employee->select('e.name, e.lastName, e.codTypeUser, '.$this->db_typeuser->database.'.typeUser.description');
        $this->db_employee->from("employee e");
        $this->db_employee->join($this->db_typeuser->database.'.typeUser', $this->db_typeuser->database.'.typeUser.id = e.codTypeUser');
        $this->db_employee->where('e.codUser', $id);
        $this->db_employee->where('e.status', 1);
        $query = $this->db_employee->get();
        $resultEmployee = ($query!==false && $query->num_rows() > 0) ? $query->row() : false;
        return $resultEmployee;
        // return $this->db_employee->last_Query();
    }
}