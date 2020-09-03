<?php

class User_model extends CI_Model {
    
    public function __construct(){
        parent::__construct();
    }
    
    public function get_user_id($user) {
        if ($user != NULL) {
            $query = $this->db->query("SELECT id FROM user WHERE user = '$user'");
            foreach ($query->result() as $row) {
                return $row->id;
            }
        } else {
            return NULL;            
        }
    }
    
    public function get_user_ci($user) {
        if ($user != NULL) {
            $query = $this->db->query("SELECT worker.ci FROM worker INNER JOIN user ON user.worker_id = worker.id WHERE user.user = '$user'");
            foreach ($query->result() as $row) {
                return $row->ci;
            }
        } else {
            return NULL;            
        }
    }
    
    public function get_worker_ci($id) {
        if ($id != NULL) {
            $query = $this->db->query("SELECT worker.ci FROM worker INNER JOIN user ON user.worker_id = worker.id WHERE user.id = '$id'");
            foreach ($query->result() as $row) {
                return $row->ci;
            }
        } else {
            return NULL;            
        }
    }
    
    public function get_user_permission($id) {
        if ($id != NULL) {
            $query = $this->db->query("SELECT id, name, permission_user.permission_id, permission_user.user_id FROM permission INNER JOIN permission_user ON permission_user.permission_id = permission.id WHERE user_id = '$id'");
            return $query->result_array();
        } else {
            return NULL;            
        }
    }
    
    public function get_permissions() {
        $query = $this->db->query("SELECT * FROM permission");
        return $query->result_array();        
    }

    public function get_permission_group() {
        $query = $this->db->query("SELECT * FROM permission_group");
        return $query->result_array();
    }

    public function get_permission_user() {
        $query = $this->db->query("SELECT user.id, permission.name FROM user INNER JOIN permission_user ON permission_user.user_id = user.id INNER JOIN permission ON permission.id = permission_user.permission_id");
        return $query->result_array();        
    }
        
    public function get_workers_without_user()  {
        $query = $this->db->query("SELECT * FROM worker WHERE user = 0 AND visible = 1");
        return $query->result_array();
    }
    
    public function get_users() {
        $query = $this->db->query("SELECT user.id, user.user, ci, name_1, name_2, last_name_1, last_name_2 FROM user INNER JOIN worker ON worker.id = user.worker_id WHERE user.visible = 1 AND user.id != 1 AND user.id != 2");
        return $query->result_array();
    }
        
    public function get_user($id) {
        if ($id != NULL) {
            $query = $this->db->query("SELECT user.id, user.user, ci, name_1, name_2, last_name_1, last_name_2, photo, color.name  FROM user INNER JOIN worker ON worker.id = user.worker_id INNER JOIN color ON worker.color_id = color.id WHERE user.id = '$id'");
            return $query->result_array();
        } else {
            return NULL;
        }   
    }
    
    public function get_theme_setting($ci) {
        if ($ci != NULL) {
            $query = $this->db->query("SELECT class FROM color INNER JOIN worker ON worker.color_id = color.id WHERE worker.ci = $ci");
            foreach ($query->result() as $row) {
                return $row->class;
            }
        } else {
            return NULL;
        }
    }
    
    public function get_color() {
        $query = $this->db->query("SELECT * FROM color");
        return $query->result_array();
    }
    
    public function del_user($id, $ci) {
        if ($ci != NULL && $id != NULL) {
            $data = array(
                    'visible' => 0
            );
            $this->db->where('id', $id);
            $this->db->update('user', $data);
            
            $data = array(
                    'user' => 0
            );
            $this->db->where('ci', $ci);
            $this->db->update('worker', $data);
        } else {
            return NULL;
        }    
    }
    
    public function del_permission($permission_id, $user_id) {   
        if ($permission_id != NULL && $user_id != NULL) {
            $this->db->where('permission_id', $permission_id);
            $this->db->where('user_id', $user_id);        
            $this->db->delete('permission_user');
        } else {
            return NULL;
        }
    }
    
    public function add_permission($permission_id, $user_id) {
        if ($permission_id != NULL && $user_id != NULL) {
            $data = array(
                'permission_id' => $permission_id,
                'user_id' => $user_id
            );
            return $this->db->insert('permission_user', $data);
        } else {
            return NULL;
        }
    }    
    
    public function add_user($user, $pass, $worker_id ) {
        if ($user != NULL && $pass != NULL && $worker_id != NULL) {
            $data = array(
                'user' => $user,
                'pass' => $pass,
                'visible' => 1,
                'worker_id' => $worker_id
            );
            return $this->db->insert('user', $data); 
        } else {
            return NULL;
        }    
    }    

    public function verify_user_name($user, $id) {
        if ($user != NULL && $id != NULL ) {
            $query = $this->db->query("SELECT * FROM user WHERE user.user = '$user' AND id != '$id'");        
            if ($query->num_rows()>0) {
                return FALSE;                
            } else {
                return TRUE;
            }
        } else {
            return NULL;
        }
    }
    
    public function edit_user_name($user, $id) {
        if ($user != NULL && $id != NULL ) {
            $data = array(
                    'user' => $user
            );
            $this->db->where('id', $id);
            $this->db->update('user', $data);
        } else {
            return NULL;
        }
    }
    
    public function edit_user($user, $color_id, $photo, $id, $ci) {
        if ($user != NULL && $color_id != NULL && $photo != NULL && $id != NULL && $ci != NULL ) {
            $this->edit_user_name($user, $id);
            if ($photo == 1) {
                $data = array(
                        'color_id' => $color_id,
                        'photo' => $photo                
                );
            } else {
                $data = array(
                        'color_id' => $color_id                
                );
            }
            $this->db->where('ci', $ci);
            $this->db->update('worker', $data);
        } else {
            return NULL;
        }
    }    
    
    public function edit_worker_user($id, $value) {
        if ($id != NULL && $value != NULL ) {
            $data = array(
                    'user' => $value
            );
            $this->db->where('id', $id);
            $this->db->update('worker', $data);
        } else {
            return NULL;
        }
    }
    
}