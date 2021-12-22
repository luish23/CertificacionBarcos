<?php

class Users_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->db_users = $this->load->database('users', true);
        $this->db_typeuser = $this->load->database('typeUser', true);
        $this->db_employee = $this->load->database('employee', true);
    }

    public function getUsers($user,$pwd)
    {
        $this->db_users->select("id");
        $this->db_users->from("users");
        $this->db_users->where('user', $user);
        $this->db_users->where('password', MD5($pwd));
        $query = $this->db_users->get();
        $resultUsers = ($query!==false && $query->num_rows() > 0) ? $query->row("id") : false;
        return $resultUsers;
        // return $this->db_users->last_Query();
    }

    public function getAllUsers()
    {
        $this->db_employee->select('e.codUser, e.name, e.lastName, e.codTypeUser, e.status, '.$this->db_typeuser->database.'.typeUser.description, ' .$this->db_users->database.'.users.user, '.$this->db_users->database.'.users.password');
        $this->db_employee->from("employee e");
        $this->db_employee->join($this->db_typeuser->database.'.typeUser', $this->db_typeuser->database.'.typeUser.id = e.codTypeUser');
        $this->db_employee->join($this->db_users->database.'.users', $this->db_users->database.'.users.id = e.codUser');
        $query = $this->db_employee->get();
        $resultUsers = ($query!==false && $query->num_rows() > 0) ? $query->row() : false;
        return $resultUsers;
        // return $this->db_employee->last_Query();
    }

    public function insertUser($data)
    {
        $this->db_users->trans_start();
        $this->db_users->trans_strict(FALSE);

        $this->db_users->insert('users', $data);

        if ($this->db_users->trans_status() === FALSE) {
            $this->db_users->trans_rollback();

            return false;
        }

        $this->db_users->trans_commit();

        return true;
    }
    public function getUsersNotAssigned()
    {
        $result['data'] = false;
        $this->db_users->select('id, user');
        $this->db_users->from('users');
        $this->db_users->where('assigned',0);
        $this->db_users->where('status',1);
        $query = $this->db_users->get();
        $resultUsers = ($query!==false && $query->num_rows() > 0) ? $query->result_array() : false;

        if ($resultUsers) {
            $result['data'] = $resultUsers;
            return $result;
        }

        return $resultUsers;
    }

    public function getTypeUser()
    {
        $this->db_typeuser->select('id, description');
        $this->db_typeuser->from('typeUser');
        $this->db_typeuser->where('status',1);
        $query = $this->db_typeuser->get();
        $resultTypeUsers = ($query!==false && $query->num_rows() > 0) ? $query->result_array() : false;

        return $resultTypeUsers;
    }

}