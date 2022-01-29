<?php

class Logs_model extends CI_Model {

    public function __construct()
    {
        $this->db_logs = $this->load->database('default', true);
    }

    public function registerLogs($codUser, $module, $action, $description)
    {
        $data = array(
            'codUser'           => $codUser,
            'module'            => $module,
            'action'            => $action,
            'description'       => $description
        );
        $this->db_logs->insert('logs', $data);
    }

}