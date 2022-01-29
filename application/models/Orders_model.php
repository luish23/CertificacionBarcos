<?php

class Orders_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->db_boats = $this->load->database('boats', true);
        $this->db_relation = $this->load->database('relation_user_boat', true);
        $this->db_orders = $this->load->database('orders', true);
        $this->db_documents = $this->load->database('documents', true);
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

    public function insertDocuments($data)
    {
        $this->db_documents->trans_begin();

        $this->db_documents->insert('documents', $data);
        $item = $this->db_documents->insert_id();

        if ($this->db_documents->trans_status() === FALSE) {
            $this->db_documents->trans_rollback();

            return false;
        }
        else {
            $this->db_documents->trans_commit();
            return $item;
        }
    }

    public function insertOrder($data)
    {
        $this->db_orders->trans_begin();

        $this->db_orders->insert('orders', $data);
        $item = $this->db_orders->insert_id();

        if ($this->db_orders->trans_status() === FALSE) {
            $this->db_orders->trans_rollback();

            return false;
        }
        else {
            $this->db_orders->trans_commit();
            return $item;
        }
    }


    public function getOrdersByUser($id)
    {
        $result['data'] = false;

        $this->db_boats->select('b.id, b.name, b.number_imo, o.provisional, o.id AS idOrder, o.condition, o.codWord, o.codPDF, o.codTypeCertification, tc.name_certificate, tc.name_list_verification, of.office, SUBSTRING(o.created_at, 3,2) AS anyo, ic.id AS idCertificated, ic.upload_path, ic.file_name, ic.estado, ic.days_remaining, ic.created_at AS dateCertificate');
        $this->db_boats->from('orders o');
        $this->db_boats->join($this->db_boats->database.'.boats b', $this->db_boats->database.'.o.codBoat = b.id');
        $this->db_boats->join($this->db_boats->database.'.offices of', 'o.codOffice = '.$this->db_boats->database.'.of.id');
        $this->db_boats->join($this->db_boats->database.'.issuedCertifications ic', $this->db_boats->database.'.ic.codOrder = o.id', 'LEFT');
        $this->db_boats->join($this->db_boats->database.'.typeCertifications tc', $this->db_boats->database.'.o.codTypeCertification = tc.codCert');

        $this->db_boats->group_by("b.id");
        $this->db_boats->where('b.codShipowner',$id);
        $query = $this->db_boats->get();
        $resultBoats = ($query!==false && $query->num_rows() > 0) ? $query->result_array() : false;

        if ($resultBoats) {
            $result['data'] = $resultBoats;
            return $result;
        }

        return $result;


        return $result;
    }

    public function getAllOrders()
    {
        $result['data'] = false;
        $this->db_boats->select('b.id, b.name, b.number_imo, o.provisional, o.id AS idOrder, o.condition, o.codWord, o.codPDF, o.codTypeCertification, tc.name_certificate, tc.name_list_verification, of.office, SUBSTRING(o.created_at, 3,2) AS anyo, ic.id AS idCertificated, ic.upload_path, ic.file_name, ic.estado, ic.days_remaining, ic.created_at AS dateCertificate');
        $this->db_boats->from('orders o');
        $this->db_boats->join($this->db_boats->database.'.boats b', $this->db_boats->database.'.o.codBoat = b.id');
        $this->db_boats->join($this->db_boats->database.'.offices of', 'o.codOffice = '.$this->db_boats->database.'.of.id');
        $this->db_boats->join($this->db_boats->database.'.issuedCertifications ic', 'o.id ='.$this->db_boats->database.'.ic.codOrder', 'LEFT');
        $this->db_boats->join($this->db_boats->database.'.typeCertifications tc', 'o.codTypeCertification ='.$this->db_boats->database.'.tc.id');
        $this->db_boats->where("b.status",1);
        $this->db_boats->where("o.status",1);
        $query = $this->db_boats->get();
        $resultBoats = ($query!==false && $query->num_rows() > 0) ? $query->result_array() : false;

        if ($resultBoats) {
            $result['data'] = $resultBoats;
            return $result;
        }

        return $result;
    }

    public function getOrdersProcess()
    {
        $result['data'] = false;
        $this->db_boats->select('b.id, b.name, b.number_imo, o.id AS idOrder, o.condition, o.codWord, o.codPDF, of.office, SUBSTRING(o.created_at, 3,2) AS anyo');
        $this->db_boats->from('boats b');
        $this->db_boats->join($this->db_boats->database.'.orders o', $this->db_boats->database.'.o.codBoat = b.id');
        $this->db_boats->join($this->db_boats->database.'.offices of', $this->db_boats->database.'.of.id = o.codOffice');
        $this->db_boats->where("o.condition",'PROCESO');
        $this->db_boats->where("b.status",1);
        $this->db_boats->where("o.status",1);
        // $this->db_boats->group_by("b.id");

        $query = $this->db_boats->get();
        $resultBoats = ($query!==false && $query->num_rows() > 0) ? $query->result_array() : false;
        // print_r($this->db_boats->last_query()); die;

        if ($resultBoats) {
            $result['data'] = $resultBoats;
            return $result;
        }

        return $result;
    }


    public function getOrderBoatById($id)
    {
        $this->db_orders->select('b.*, o.id AS idOrder, o.codBoat, o.codWord, o.codPDF, o.provisional, o.condition, o.codTypeCertification, o.codListVerification, of.office, SUBSTRING(o.created_at, 3,2) AS anyo');
        $this->db_orders->from('orders o');
        $this->db_orders->join($this->db_orders->database.'.boats b', $this->db_orders->database.'.b.id = o.codBoat');
        $this->db_orders->join($this->db_orders->database.'.offices of', $this->db_orders->database.'.of.id = o.codOffice');
        $this->db_orders->where('o.id', $id);
        $this->db_orders->where('b.status', 1);
        $query = $this->db_orders->get();
        $resultBoat['data'] = ($query!==false && $query->num_rows() > 0) ? $query->row_array() : false;
        return $resultBoat;
    }

    public function getOrderById($id)
    {
        $this->db_orders->select('o.id, o.codTypeCertification, of.id AS idOffice, of.office, SUBSTRING(o.created_at, 3,2) AS anyo');
        $this->db_orders->from('orders o');
        $this->db_orders->join($this->db_orders->database.'.offices of', $this->db_orders->database.'.of.id = o.codOffice');
        $this->db_orders->where('o.id', $id);
        $this->db_orders->where('o.status', 1);

        $query = $this->db_orders->get();
        $resultOrder['data'] = ($query!==false && $query->num_rows() > 0) ? $query->row_array() : false;

        return $resultOrder;

    }

    public function getDownload($id)
    {
        $this->db_documents->select('path_dir, file_name, file_ext');
        $this->db_documents->from('documents');
        $this->db_documents->where('id', $id);

        $query = $this->db_documents->get();
        $resultDocuments = ($query!==false && $query->num_rows() > 0) ? $query->row() : false;

        return $resultDocuments;
    }

    public function updateOrder($data, $id)
    {
        if ($data['condition'] == 'PROCESO') {
            $data['inspect_date_end'] = date('Y-m-d');
        }
        $this->db_orders->where('id', $id);
        $this->db_orders->update('orders',$data);

        return $this->db_orders->affected_rows();
    }

    public function deleteOrder($idOrder)
    {
        $this->db_boats->select('codBoat');
        $this->db_boats->from('orders');
        $this->db_boats->where('id', $idOrder);
        $query = $this->db_boats->get();
        $idBoat = ($query!==false && $query->num_rows() > 0) ? $query->row('codBoat') : false;

        $this->_updateConditionsBoat($idBoat);

        $this->db_orders->set('status', 0);
        $this->db_orders->where('id', $idOrder);
        $this->db_orders->update('orders');

        return $this->db_orders->affected_rows();
    }

    private function _updateConditionsBoat($idBoat)
    {
        $this->db_boats->set('status', 1);
        $this->db_boats->set('conditions', 'INICIADO');
        $this->db_boats->where('id', $idBoat);
        $this->db_boats->update('boats');
    }

    public function getVerifications($idCer)
    {
        $this->db_orders->select('id, name_list_verification');
        $this->db_orders->from('typeCertifications');
        $this->db_orders->where('codCert', $idCer);
        $query = $this->db_orders->get();
        $result = ($query!==false && $query->num_rows() > 0) ? $query->result_array() : false;
        return $result;
    }

    public function validOrder($idNav, $idCer, $idVerif)
    {
        $this->db_orders->select('id');
        $this->db_orders->from('orders');
        $this->db_orders->where('codBoat', $idNav);
        $this->db_orders->where('codTypeCertification', $idCer);
        $this->db_orders->where('codListVerification', $idVerif);
        $this->db_orders->where('status', 1);
        $this->db_orders->where_not_in('condition', ['CANCELADO']);

        $query = $this->db_orders->get();
        $result = ($query!==false && $query->num_rows() > 0) ? true : false;
        return $result;

    }

    

    public function updateOrdersProcess($id,$condition,$reasonRejection)
    {
        $this->db_orders->set('condition', $condition);
        $this->db_orders->set('reasonRejection', $reasonRejection);
        $this->db_orders->where('id', $id);
        $this->db_orders->update('orders');

        return $this->db_orders->affected_rows();
    }
    

    public function getOrderNS($table, $idOrder)
    {
        $this->db_orders->select('id');
        $this->db_orders->from($table);
        $this->db_orders->where('codOrder', $idOrder);

        $query = $this->db_orders->get();
        $result = ($query!==false && $query->num_rows() > 0) ? $query->row('id') : false;
        return $result;
    }

    public function insertOrderNS($table,$data)
    {
        $this->db_orders->trans_begin();

        $this->db_orders->insert($table, $data);
        $item = $this->db_orders->insert_id();

        if ($this->db_orders->trans_status() === FALSE) {
            $this->db_orders->trans_rollback();

            return false;
        }
        else {
            $this->db_orders->trans_commit();
            return $item;
        }
    }

    public function updateOrderNS($table, $condition, $info)
    {
        $this->db_orders->set($info);
        $this->db_orders->where($condition);
        $this->db_orders->update($table);

        return $this->db_orders->affected_rows();
    }

    public function getDataNS($table, $condition)
    {
        $this->db_orders->select('*');
        $this->db_orders->from($table);
        $this->db_orders->where($condition);

        $query = $this->db_orders->get();
        $result = ($query!==false && $query->num_rows() > 0) ? $query->row_array() : false;
        return $result;
    }
}