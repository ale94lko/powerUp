<?php

class Log_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->helper('date');
    }
    
    public function insert_log($action, $user_id, $type) {        
        if ($action != NULL && $user_id != NULL && $type != NULL) {
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

    //cambiar para query builder
    public function get_log($limit) {
        $query = $this->db->query("SELECT log.id, type, action, ip, time, date, user.username  FROM log INNER JOIN user ON log.user_id = user.id ORDER BY log.id DESC LIMIT $limit");
        return $query->result_array();
    }

}