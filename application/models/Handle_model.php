<?php

class Handle_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_trace_analysis($date_i, $date_f) {
        if ($date_i != NULL && $date_f != NULL) {
            $this->db->select('COUNT(type) AS total, type');
            $this->db->where('date >=', $date_i);
            $this->db->where('date <', $date_f);
            $this->db->group_by('type');

            $query = $this->db->get('log');
            return $query->result_array();
        } else {
            return NULL;
        }
    }

//    cambiar para query builder
//    public function get_user_analysis($date_i, $date_f) {
//        if ($date_i != NULL && $date_f != NULL) {
//            $this->db->select('COUNT(user_id) as total, user_id');
//            $this->db->where('date >=', $date_i);
//            $this->db->where('date <', $date_f);
//            $this->db->group_by('type');
//
//            $query = $this->db->get('log');
//            return $query->result_array();
//        } else {
//            return NULL;
//        }
//        $query = $this->db->query("SELECT COUNT(user_id) as total, user_id FROM trace INNER JOIN user ON trace.user_id = user.id WHERE date >= $date_i AND date < $date_f GROUP BY user_id ");
//        return $query->result_array();
//    }

    public function get_total_user() {
        $this->db->select('COUNT(*) AS total');
        $this->db->where('deleted', '0');

        $query = $this->db->get('user');
        return $query->result()[0]->total;
    }

    public function get_trace_warning($id) {
        if ($id != NULL) {
            $datestring = '%Y-%m-%d';
            $_date = time();
            $date = mdate($datestring, $_date);
            $this->db->select();
            $this->db->where('type', '1');
            $this->db->where('user_id', $id);
            $this->db->where('date', $date);

            $query = $this->db->get('log');
            return $query->result_array();
        } else {
            return NULL;
        }
    }
    
    public function get_user_id($username) {
        if ($username != NULL) {
            $this->db->select('id');
            $this->db->where('username', $username);
            $this->db->where('deleted', '0');

            $query = $this->db->get('user');
            return $query->result()[0]->id;
        } else {
            return NULL;            
        }
    }

    public function get_user($id) {
        if ($id != NULL) {
            $this->db->select();
            $this->db->where('id', $id);

            $query = $this->db->get('user');
            return $query->result_array();
        } else {
            return NULL;
        }   
    }

    //cambiar para query builder
    public function get_user_permission($id) {
        if ($id != NULL) {
            $query = $this->db->query("SELECT permission.id AS id, permission.name AS name, permission_group_id , user_permission.permission_id, user_permission.user_id FROM permission INNER JOIN user_permission ON user_permission.permission_id = permission.id WHERE user_id = '$id'");
            return $query->result_array();
        } else {
            return NULL;            
        }
    }

    public function verify_username($username, $id) {
        if ($username != NULL && $id != NULL) {
            $this->db->select();
            $this->db->where('username', $username);
            $this->db->where('id !=', $id);

            $query = $this->db->get('user');
            if ($query->num_rows() > 0) {
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }
    
    public function edit_username($username, $id) {
        if ($username != NULL && $id != NULL ) {
            $data = array(
                'username' => $username
            );
            $this->db->where('id', $id);
            return $this->db->update('user', $data);
        } else {
            return NULL;
        }
    }
    
    public function edit_user($first_name, $last_name, $email, $title, $profession, $photo, $id) {
        if ($first_name != NULL && $last_name != NULL && $email != NULL && $title != NULL &&
            $profession != NULL && $photo != NULL && $id != NULL ) {

            $data = array(
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'title' => $title,
                'profession' => $profession,
                'photo' => $photo
            );
            $this->db->where('id', $id);
            return $this->db->update('user', $data);
        } else {
            return NULL;
        }
    }    
    
}