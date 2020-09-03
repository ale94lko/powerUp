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
                'field' => 'user',
                'label' => 'user',
                'rules' => 'required',
                'errors' => array(
                        'required' => 'Please, enter the %s',
                ),
            ),
            array(
                'field' => 'pass',
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
                    'message'           => 'Wrong user and/or password ',
                    'logged_in' => FALSE
                );
                $this->session->set_userdata($userdata);
                $this->load->view('templates/header');
                $this->load->view('public/login');
                $this->load->view('templates/scripts');
            } else {                
                $user = $this->security->xss_clean($this->input->post('user'));
                $pass = hash("sha256",$this->security->xss_clean($this->input->post('pass')));
                
                $userdata = array(
                    'user'              => $user,
                    'pass'              => $pass,
                    'message_type'      => 'success',
                    'message'           => 'You have successfully logged in',
                    'logged_in'         => TRUE
                );
                $cookie = array(
                    'name'   => 'user',
                    'value'  => $user,
                    'expire' => '0'
                );
                if ($this->input->cookie('user', TRUE) == NULL) {
                    delete_cookie('user');
                }
                $this->input->set_cookie($cookie);
                $this->session->set_userdata($userdata);

                $action = "Logged in successfully";
                $type = 0;
                $user_id = $this->login_model->get_user_id($user);
                $this->log_model->insert_log($action, $user_id, $type);
                
                redirect('handle');
            }        
        }
    }

    public function timeout() {
        $config = array(
            array(
                'field' => 'pass',
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
            $data['ci'] = $this->login_model->get_user_ci($user);
            $data['user_data'] = $this->login_model->get_worker($data['ci'])[0];
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
                $user = $this->input->cookie('user', TRUE);
                $pass = hash("sha256", $this->security->xss_clean($this->input->post('pass')));

                $userdata = array(
                    'user' => $user,
                    'pass' => $pass,
                    'message_type' => 'success',
                    'message' => 'You have successfully logged in',
                    'logged_in' => TRUE
                );
                $cookie = array(
                    'name' => 'user',
                    'value' => $user,
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
                $user = $this->security->xss_clean($this->input->post('user'));
                $user_id = $this->login_model->get_user_id($user);
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
                $user_id = $this->login_model->get_user_id($user);
                $this->log_model->insert_log($action, $user_id, $type);

                redirect('login');
            }
        }
    }

    public function pass_recover(){

        $user = $this->security->xss_clean($this->input->post('user'));
        $email = $this->security->xss_clean($this->input->post('email'));
        
        $data = $this->login_model->recover($user, $email);
                
        if ($data == TRUE){
            return TRUE;
        } else{
            return FALSE;  
        }
    }

    public function user(){

        $user = $this->security->xss_clean($this->input->post('user'));
        $pass = hash("sha256",$this->security->xss_clean($this->input->post('pass')));

        $data = $this->login_model->check($user, $pass);

        if ($data == TRUE){
            return TRUE;
        } else{
            return FALSE;
        }
    }

}