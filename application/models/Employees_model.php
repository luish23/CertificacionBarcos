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
        $this->db_employee->select('e.id, e.name, e.lastName, e.gender, e.dni, e.position, e.address, e.photo, e.phone, e.codShipowner, e.site_lang, u.codTypeUser');
        $this->db_employee->from("employee e");
        $this->db_employee->join($this->db_employee->database.'.users u', $this->db_employee->database.'.u.id = e.codUser');
        $this->db_employee->where('e.id', $id);
        $this->db_employee->where('e.status', 1);
        $query = $this->db_employee->get();
        $resultEmployee['data'] = ($query!==false && $query->num_rows() > 0) ? $query->row_array() : false;
        return $resultEmployee;
    }

    public function getEmployeeUpdate($id)
    {
        $this->db_employee->select('e.id, e.name, e.lastName, e.gender, e.dni, e.position, e.address, e.photo, e.phone, e.codShipowner, e.status, e.site_lang, u.codTypeUser');
        $this->db_employee->from("employee e");
        $this->db_employee->join($this->db_employee->database.'.users u', $this->db_employee->database.'.u.id = e.codUser');
        $this->db_employee->where('e.id', $id);
        $query = $this->db_employee->get();
        $resultEmployee['data'] = ($query!==false && $query->num_rows() > 0) ? $query->row_array() : false;
        return $resultEmployee;
    }

    public function getEmployees()
    {
        $this->db_employee->select('*');
        $this->db_employee->from("employee");
        $query = $this->db_employee->get();
        $resultEmployees['data'] = ($query!==false && $query->num_rows() > 0) ? $query->result_array() : false;
        return $resultEmployees;
    }

    public function insertEmployee($data)
    {
        $this->db_employee->trans_start();
        $this->db_employee->trans_strict(FALSE);

        $this->db_employee->insert('employee', $data);
        $item_id = $this->db_employee->insert_id();

        $this->db_employee->where('id', $data['codUser']);
        $this->db_employee->update('users', ['assigned' => 1]);

        if ($this->db_employee->trans_status() === FALSE) {
            $this->db_employee->trans_rollback();

            return false;
        }

        $this->db_employee->trans_commit();

        return $item_id;
    }

    public function updateEmployee($data, $id)
    {
        $this->db_employee->where('id', $id);
        $this->db_employee->update('employee',$data);

        return $this->db_employee->affected_rows();
    }

    public function deleteEmployee($id)
    {
        $this->db_users->set('status', 0);
        $this->db_users->where('id', $id);
        $this->db_users->update('employee');

        return $this->db_users->affected_rows();
    }
}