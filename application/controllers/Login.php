<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    
    function __construct() {        
        parent::__construct();        
        if ($this->session->userdata('logged_in')){
            if ($this->input->cookie('user', TRUE) == NULL) {
                redirect('login');
            } else {
                redirect('login/timeout');
            }
        }
        $this->load->helper(array('form', 'security', 'cookie'));
        $this->load->library('form_validation');
        $this->load->model(array('login_model', 'log_model'));
    }
    
    public function index() {             
        $config = array(
            array(
                'field' => 'username',
                'label' => 'username',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'Please, enter the %s',
                ),
            ),
            array(
                'field' => 'password',
                'label' => 'password',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'Please, enter the %s',
                ),
            )
        );
        $this->form_validation->set_rules($config);
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header');
            $this->load->view('public/login');            
            $this->load->view('templates/scripts');
        } else {            
            $val = $this->user();
            if (!$val) {
                $userdata = array(
                    'message_type'      => 'error',
                    'message'           => 'Wrong username and/or password ',
                    'logged_in' => FALSE
                );
                $this->session->set_userdata($userdata);
                $this->load->view('templates/header');
                $this->load->view('public/login');
                $this->load->view('templates/scripts');
            } else {                
                $username = $this->security->xss_clean($this->input->post('username'));
                $user_id = $this->login_model->get_user_id($username);

                $userdata = array(
                    'user_id'           => $user_id,
                    'username'          => $username,
                    'message_type'      => 'success',
                    'message'           => 'You have successfully logged in',
                    'logged_in'         => TRUE
                );
                $cookie = array(
                    'name'   => 'user',
                    'value'  => $username,
                    'expire' => '0'
                );
                if ($this->input->cookie('user', TRUE) == NULL) {
                    delete_cookie('user');
                }
                $this->input->set_cookie($cookie);
                $this->session->set_userdata($userdata);

                $action = "Logged in successfully";
                $type = 0;
                $this->log_model->insert_log($action, $user_id, $type);
                
                redirect('handle');
            }        
        }
    }

    public function timeout() {
        $config = array(
            array(
                'field' => 'password',
                'label' => 'password',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please, enter the %s',
                ),
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $user = $this->input->cookie('user', TRUE);
            $data['id'] = $this->login_model->get_user_id($user);
            $data['user_data'] = $this->login_model->get_user($data['id'])[0];
            $this->load->view('templates/header');
            $this->load->view('public/timeout', $data);
            $this->load->view('templates/scripts');
        } else {
            $val = $this->user();
            if (!$val) {
                $userdata = array(
                    'message_type'      => 'error',
                    'message'           => 'Wrong password',
                    'logged_in' => FALSE
                );
                $this->session->set_userdata($userdata);

                $user = $this->input->cookie('user', TRUE);
                $data['user_data'] = $user;

                $this->load->view('templates/header');
                $this->load->view('public/timeout', $data);
                $this->load->view('templates/scripts');
            } else {
                $username = $this->input->cookie('user', TRUE);
                $password = hash("sha256", $this->security->xss_clean($this->input->post('password')));

                $userdata = array(
                    'username' => $username,
                    'password' => $password,
                    'message_type' => 'success',
                    'message' => 'You have successfully logged in',
                    'logged_in' => TRUE
                );
                $cookie = array(
                    'name' => 'user',
                    'value' => $username,
                    'expire' => '0'
                );
                if ($this->input->cookie('user', TRUE) == NULL) {
                    delete_cookie('user');
                }
                $this->input->set_cookie($cookie);
                $this->session->set_userdata($userdata);

                $action = "Logged in";
                $type = 0;
                $user_id = $this->session->userdata('id');
                $this->log_model->insert_log($action, $user_id, $type);

                redirect('handle');
            }
        }
    }

    public function forgot_password(){
        $config = array(
            array(
                'field' => 'email',
                'label' => 'email',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Please, enter the %s',
                ),
            ),
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header');
            $this->load->view('public/forgot_password');
            $this->load->view('templates/scripts');
        } else {
            $val = $this->pass_recover();
            if (!$val) {
                $userdata = array(
                    'message_type'      => 'error',
                    'message'           => 'Unknown user',
                    'logged_in' => FALSE
                );
                $this->session->set_userdata($userdata);
                $this->load->view('templates/header');
                $this->load->view('public/forgot_password');
                $this->load->view('templates/scripts');
            } else {
                $username = $this->security->xss_clean($this->input->post('username'));
                $user_id = $this->login_model->get_user_id($username);
                $timestring = '%H:%i:%s';
                $_time = time();
                $time = mdate($timestring, $_time);
                $datestring = '%Y-%m-%d';
                $_date = time();
                $date = mdate($datestring, $_date);

                $this->login_model->forgot_password($date, $time, $user_id);

                $userdata = array(
                    'message_type'      => 'success',
                    'message'           => 'Password reseted. Contact the system administrator'
                );
                $this->session->set_userdata($userdata);

                $action = "Request password reset";
                $type = 0;
                $user_id = $this->login_model->get_user_id($username);
                $this->log_model->insert_log($action, $user_id, $type);

                redirect('login');
            }
        }
    }

    public function pass_recover(){

        $username = $this->security->xss_clean($this->input->post('username'));
        $email = $this->security->xss_clean($this->input->post('email'));
        
        $data = $this->login_model->recover($username, $email);
                
        if ($data == TRUE){
            return TRUE;
        } else{
            return FALSE;  
        }
    }

    public function user(){

        $username = $this->security->xss_clean($this->input->post('username'));
        $password = hash("sha256",$this->security->xss_clean($this->input->post('password')));

        $data = $this->login_model->check($username, $password);

        if ($data == TRUE){
            return TRUE;
        } else{
            return FALSE;
        }
    }

}