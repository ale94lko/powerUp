<?php

class Login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function check($username, $password) {
        if ($username != NULL &&  $password != NULL) {
            $this->db->where('username', $username);
            $this->db->where('password', $password);
            $this->db->where('deleted', '0');

            $query = $this->db->get('user');
            if ($query->num_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return NULL;
        }
    }

    public function recover($username, $email) {
        if ($username != NULL &&  $email != NULL) {
            $this->db->where('username', $username);
            $this->db->where('email', $email);
            $this->db->where('deleted', '0');

            $query = $this->db->get('user');
            if ($query->num_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return NULL;
        }
    }

    public function get_user_id($username) {
        if ($username != NULL){
            $this->db->select('id');
            $this->db->where('username', $username);

            $query = $this->db->get('user');
            return $query->result()[0]->id;
        } else {
            return NULL;            
        }
    }

    public function get_user($id) {
        if ($id != NULL){
            $this->db->select();
            $this->db->where('id', $id);
            $this->db->where('deleted', '0');

            $query = $this->db->get('user');
            return $query->result_array();
        } else {
            return NULL;
        }
    }

}