<?php

class Log_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->helper('date');
    }
    
    public function insert_log($action, $user_id, $type) {        
        if ($action != NULL && $user_id != NULL) {
            $ip = $this->input->ip_address();        
            $timestring = '%H:%i:%s';
            $_time = time();
            $time = mdate($timestring, $_time);        
            $datestring = '%Y-%m-%d';
            $_date = time();
            $date = mdate($datestring, $_date);        
            $data = array(
                'action' => $action,
                'ip' => $ip,
                'time' => $time,
                'date' => $date,
                'type' => $type,
                'user_id' => $user_id
            );
            return $this->db->insert('log', $data);
        } else {
            return NULL;            
        }        
    }
    
    public function get_log() {        
        $query = $this->db->query("SELECT log.id, type, action, ip, time, date, user.user  FROM log INNER JOIN user ON log.user_id = user.id ORDER BY log.id DESC LIMIT 100");
        return $query->result_array();
    }
    
    public function export_log(){        
        $query = $this->db->query("SELECT log.id, type, action, ip, time, date, user.user  FROM log INNER JOIN user ON log.user_id = user.id ORDER BY log.id DESC LIMIT 50");
        return $query->result_array();
    }
    
}