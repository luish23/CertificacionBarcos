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
    }

    public function getAllUsers()
    {
        $result['data'] = false;
        $this->db_users->select('u.id, u.user, u.password, u.assigned, u.status');
        $this->db_users->from("users u");
        $query = $this->db_users->get();
        $resultUsers = ($query!==false && $query->num_rows() > 0) ? $query->result_array() : false;

        if ($resultUsers) {
            $result['data'] = $resultUsers;
            return $result;
        }

        return $result;
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

        return $result;
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

    public function getUserById($id)
    {
        $result['data'] = false;
        $this->db_users->select('e.*, u.*');
        $this->db_users->from('employee e');
        $this->db_users->join($this->db_users->database.'.users u', $this->db_users->database.'.u.id ='.$id);
        $this->db_users->where('e.codUser',$id);
        $query = $this->db_users->get();
        $resultUser = ($query!==false && $query->num_rows() > 0) ? $query->row_array() : false;

        if ($resultUser) {
            $result['data'] = $resultUser;
            return $result;
        }

        return $result;
    }

}