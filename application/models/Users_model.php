<?php

class Users_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->db_users = $this->load->database('users', true);
        $this->db_typeuser = $this->load->database('typeUser', true);
        $this->db_employee = $this->load->database('employee', true);
        $CI =& get_instance();
        $CI->load->library(array('encryption'));
        $this->key = $CI->config->item('encryption_key');
        $CI->encryption->initialize(
            array(  'driver' => 'openssl',
                    'cipher' => 'aes-128',
                    'mode' => 'ctr',
                    'key' => $this->key
            )
        );
    }

    public function veriffUsers($user,$pwd)
    {
        $CI =& get_instance();
        $this->db_users->select("id, password");
        $this->db_users->from("users");
        $this->db_users->where('user', $user);
        $this->db_users->where('status', 1);
        $query = $this->db_users->get();
        $resulPassword = ($query!==false && $query->num_rows() > 0) ? $query->row() : false;

        if ($resulPassword) {
            $decryptPWD = $CI->encryption->decrypt($resulPassword->password);

            if ($pwd == $decryptPWD) {
                return $resulPassword->id;
            }
        }
        return false;
    }

    public function getUsers($user,$pwd)
    {
        $this->db_users->select("id");
        $this->db_users->from("users");
        $this->db_users->where('user', $user);
        $this->db_users->where('password', $pwd);
        $query = $this->db_users->get();
        $resultUsers = ($query!==false && $query->num_rows() > 0) ? $query->row("id") : false;
        return $resultUsers;
    }

    public function getAllUsers()
    {
        $result['data'] = false;
        $this->db_users->select('u.id, u.user, tu.description, u.password, u.assigned, u.status');
        $this->db_users->from("users u");
        $this->db_users->join($this->db_users->database.'.typeUser tu', $this->db_users->database.'.tu.id = u.codTypeUser');
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
        $item_id = $this->db_users->insert_id();

        if ($this->db_users->trans_status() === FALSE) {
            $error = $this->db_users->error();
            $this->db_users->trans_rollback();
            return $error;
        }

        $this->db_users->trans_commit();

        return $item_id;

    }

    public function updatetUser($data, $id)
    {
        $this->db_users->set('password', $data['password']);
        $this->db_users->set('codTypeUser', $data['codTypeUser']);
        $this->db_users->set('status', $data['status']);
        $this->db_users->where('id', $id);
        $this->db_users->update('users');

        $result = ($this->db_users->affected_rows() > 0) ? true :  false;
        return $result;

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
        $this->db_typeuser->order_by('description','ASC');
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

    public function getOnlyUserById($idUser)
    {
        $result['data'] = false;
        $this->db_users->select('u.*');
        $this->db_users->from('users u');
        $this->db_users->where('u.id',$idUser);
        $query = $this->db_users->get();
        $resultUser['data'] = ($query!==false && $query->num_rows() > 0) ? $query->row_array() : false;

        return $resultUser;
    }

    public function deleteUser($id)
    {
        $this->db_users->set('status', 0);
        $this->db_users->where('id', $id);
        $this->db_users->update('users');

        return $this->db_users->affected_rows();
    }

}