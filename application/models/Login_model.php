<?php

class Login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function check($user, $pass) {
        if ($user != NULL &&  $pass != NULL) {
            $this->db->where('user', $user);
            $this->db->where('password', $pass);
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

    public function recover($user, $email) {
        if ($user != NULL &&  $email != NULL) {
            $this->db->where('user', $user);
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

    public function get_user_id($user) {
        if ($user != NULL){
            $this->db->select('id');
            $this->db->where('user', $user);

            $query = $this->db->get('user');
            return $query->result()[0]->id;
        } else {
            return NULL;            
        }
    }

}