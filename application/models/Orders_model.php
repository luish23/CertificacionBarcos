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

    public function updateOrderConditions($id)
    {
        $this->db_boats->set('conditions', 'PROCESO');
        $this->db_boats->where('id', $id);
        $this->db_boats->update('boats');

        $result = ($this->db_boats->affected_rows() > 0) ? true :  false;
        return $result;
    }

    public function getOrdersByUser($id)
    {
        $result['data'] = false;
        $this->db_orders->select('GROUP_CONCAT(codBoat) AS ids');
        $this->db_orders->from('relation_user_boat');
        $this->db_orders->where('codUser', $id);
        $query = $this->db_orders->get();
        $resultOrders = ($query!==false && $query->num_rows() > 0) ? $query->row('ids') : false;

        if ($resultOrders) {
            $this->db_boats->select('b.id, b.name, b.number_imo, b.conditions, o.id AS idOrder, o.codWord, o.codPDF, of.office, SUBSTRING(o.created_at, 3,2) AS anyo');
            $this->db_boats->from('boats b');
            $this->db_boats->join($this->db_boats->database.'.orders o', $this->db_boats->database.'.o.codBoat = b.id');
            $this->db_boats->join($this->db_boats->database.'.documents d', ($this->db_boats->database.'.o.codWord = d.id OR '. $this->db_boats->database.'.o.codPDF = d.id'));
            $this->db_boats->join($this->db_boats->database.'.offices of', $this->db_boats->database.'.of.id = o.codOffice');
            $this->db_boats->where("b.id IN ($resultOrders)");
            $this->db_boats->where("b.status",1);
            $this->db_boats->where("o.status",1);
            $this->db_boats->group_by("b.id");
            $query = $this->db_boats->get();
            $resultBoats = ($query!==false && $query->num_rows() > 0) ? $query->result_array() : false;

            if ($resultBoats) {
                $result['data'] = $resultBoats;
                return $result;
            }

            return $result;
        }

        return $result;
    }

    public function getAllOrders()
    {
        $result['data'] = false;
        $this->db_boats->select('b.id, b.name, b.number_imo, o.id AS idOrder, o.condition, o.codWord, o.codPDF, tc.name_certificate, tc.name_list_verification, of.office, SUBSTRING(o.created_at, 3,2) AS anyo, ic.id AS idCertificated, ic.upload_path, ic.file_name, ic.codTypeCertification, ic.estado, ic.created_at AS dateCertificate');
        $this->db_boats->from('boats b');
        $this->db_boats->join($this->db_boats->database.'.orders o', $this->db_boats->database.'.o.codBoat = b.id');
        $this->db_boats->join($this->db_boats->database.'.offices of', $this->db_boats->database.'.of.id = o.codOffice');
        $this->db_boats->join($this->db_boats->database.'.issuedCertifications ic', $this->db_boats->database.'.ic.codOrder = o.id', 'LEFT');
        $this->db_boats->join($this->db_boats->database.'.typeCertifications tc', $this->db_boats->database.'.tc.id = o.codTypeCertification');
        $this->db_boats->where("b.status",1);
        $this->db_boats->where("o.status",1);
        // $this->db_boats->group_by("b.id");
        $query = $this->db_boats->get();
        // print_r($this->db_boats->last_query()); die;
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
        $this->db_orders->select('b.*, o.id AS idOrder, o.codBoat, o.codWord, o.codPDF, o.codTypeCertification, of.office, SUBSTRING(o.created_at, 3,2) AS anyo');
        $this->db_orders->from('boats b');
        $this->db_orders->join($this->db_orders->database.'.orders o', $this->db_orders->database.'.o.id ='.$id);
        $this->db_orders->join($this->db_orders->database.'.offices of', $this->db_orders->database.'.of.id = o.codOffice');
        // $this->db_orders->where('o.id', $id);
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

    public function validOrder($idNav, $idCer)
    {
        $this->db_orders->select('id');
        $this->db_orders->from('orders');
        $this->db_orders->where('codBoat', $idNav);
        $this->db_orders->where('codTypeCertification', $idCer);
        $this->db_orders->where('status', 1);
        $this->db_orders->where_not_in('condition', ['CANCELADO']);

        $query = $this->db_orders->get();
        $result = ($query!==false && $query->num_rows() > 0) ? true : false;
        // print_r($result); die;

        // if ($result) {
        //     $this->db_orders->select('id');
        //     $this->db_orders->from('issuedCertifications');
        //     $this->db_orders->where_in('codOrder', (array)$result);
        //     $this->db_orders->where('estado', 'ACTIVO');
        //     $query = $this->db_orders->get();
        //     $result = ($query!==false && $query->num_rows() > 0) ? true : false;
        // }
        // return $this->db_orders->last_query(); die;
        return $result;

    }

    public function updateOrdersProcess($id)
    {
        $this->db_orders->set('condition', 'VALIDADO');
        $this->db_orders->where('id', $id);
        $this->db_orders->update('orders');

        return $this->db_orders->affected_rows();
    }
    

}