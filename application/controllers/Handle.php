<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Handle extends CI_Controller {

    function __construct() {

        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            if ($this->input->cookie('user', TRUE) == NULL) {
                redirect('login');
            } else {
                redirect('login/timeout');
            }
        }
        $this->load->helper(array('form'));
        $this->load->model(array('handle_model', 'log_model'));
        $this->load->library(array('form_validation', 'upload'));
    }

    public function index($class = NULL, $method = NULL, $argument1 = NULL, $argument2 = NULL) {
        $username = $this->session->userdata('username');
        $id = $this->handle_model->get_user_id($username);
        $data['permission'] = $this->handle_model->get_user_permission($id);

        $permission_group[] = FALSE;
        foreach ($data['permission'] as $value):
            $permission_group[$value['permission_group_id']] = TRUE;
        endforeach;

        //$notifications = $this->get_notifications($data['permission'], $id);
        $data['view'] = "home";
        $data['user_data'] = $this->handle_model->get_user($id)[0];
        $key = hash("sha256",$username.$id);
        $userdata = array(
            'view' => 'home',
            'user_data' => $data['user_data'],
            //'notification' => $notifications,
            'permission' => $data['permission'],
            'permission_group' => $permission_group,
            'key' => $key
        );
        $this->session->set_userdata($userdata);

        if ($class != NULL) {
            if ($method != NULL) {
                $this->redirect_controller($class, $method, $argument1, $argument2);            
            } else {
                $method = "index";
                $this->redirect_controller($class, $method, $argument1, $argument2);
            }
        } else {   
            $this->session->unset_userdata('key');         
            $controller = "public";
            $view = "index";
            $this->load_view($controller, $view, $data);
        }
    }

    public function edit() {

        $config = array(
            array(
                'field' => 'username',
                'label' => 'username',
                'rules' => 'required|min_length[5]|max_length[15]|alpha_numeric',
                'errors' => array(
                    'required' => 'Please, enter the %s',
                    'min_length' => 'Please, do not write less than 5 characters',
                    'max_length' => 'Please do not write more than 15 characters',
                    'alpha_numeric' => 'Please, write only letters and numbers'
                )
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $id = $this->session->userdata('id');
            $data['user_edit'] = $this->handle_model->get_user($id);
            $userdata = array(
                'view' => 'edit_profile'
            );
            $this->session->set_userdata($userdata);

            $controller = "public";
            $view = "edit";
            $this->load_view($controller, $view, $data);
        } else {
            $username = $this->security->xss_clean($this->input->post('username'));
            $id = $this->session->userdata('id');
            $key = $this->session->userdata('key');
            $val = $this->handle_model->verify_username($username, $id);

            if ($val) {
                $config['upload_path'] = './uploads/photos/';
                $config['allowed_types'] = 'png';
                $config['file_name'] = $key;
                $config['overwrite'] = TRUE;
                $config['max_size'] = 10240;
                $config['max_width'] = 501;
                $config['max_height'] = 501;
                $config['min_width'] = 499;
                $config['min_height'] = 499;

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('photo')) {
                    $error = $this->upload->display_errors();
                    if ($error == "<p>You have not selected any files to upload</p>") {
                        $photo = 0;
                        $this->handle_model->edit_user_name($username, $id);
                        $this->handle_model->edit_user($photo, $key);
                        $userdata = array(
                            'username' => $username,
                            'message_type' => 'success',
                            'message' => 'You have successfully modified your user profile'
                        );
                        $this->session->set_userdata($userdata);
                        
                        $action = "Modified user profile";
                        $user_id = $this->session->userdata('id');
                        $type = 0;
                        $this->log_model->insert_log($action, $user_id, $type);

                        redirect('handle');
                    } else {
                        $userdata = array(
                            'message_type' => 'error',
                            'message' => $error
                        );
                        $this->session->set_userdata($userdata);

                        $action = "Try to modify user profile. Error: " . $error;
                        $user_id = $this->session->userdata('id');
                        $type = 1;
                        $this->log_model->insert_log($action, $user_id, $type);

                        $controller = "public";
                        $view = "edit";
                        $data = NULL;
                        $this->load_view($controller, $view, $data);
                    }
                } else {
                    $photo = 1;
                    $this->handle_model->edit_user_name($username, $id);
                    $this->handle_model->edit_user($photo, $id);
                    $userdata = array(
                        'username' => $username,
                        'message_type' => 'success',
                        'message' => 'You have successfully modified your user profile'
                    );
                    $this->session->set_userdata($userdata);

                    $action = "Modified user profile. Id: " . $id;
                    $user_id = $this->session->userdata('id');
                    $type = 0;
                    $this->log_model->insert_log($action, $user_id, $type);

                    redirect('handle');
                }
            } else {
                $userdata = array(
                    'message_type' => 'error',
                    'message' => 'That user already exists'
                );
                $this->session->set_userdata($userdata);

                $action = "Try to modify user profile. Error: That user already exists";
                $user_id = $this->session->userdata('id');
                $type = 0;
                $this->log_model->insert_log($action, $user_id, $type);

                redirect('handle/edit');
            }
        }
    }
/*
    public function get_notifications($permisos, $id) {

        $i = 0;
        $notifications = array();
        $message = "";
        $controller = "";
        $action = "";
        $priority = 3;

        foreach ($permisos as $item):
            if ($item['permission_id'] == 1) {
                $worker_without_user = $this->handle_model->get_workers_without_user();
                foreach ($worker_without_user as $value):
                    $message = $value['name_1']." no tiene usuario en el sistema";
                    $controller = "user";
                    $action = "add";
                    $priority = 2;
                    $notifications[$i] = array(
                        'message' => $message,
                        'controller' => $controller,
                        'action' => $action,
                        'priority' => $priority
                    );
                    $i++;
                endforeach;

                $log_warnings = $this->handle_model->get_log_warning($id);
                $cont = count($log_warnings);
                $user = $this->session->userdata('user');
                if ($cont > 10){
                    $message = $cont." violaciones del usuario ".$user;
                    $controller = "log";
                    $action = "index";
                    $priority = 1;
                    $notifications[$i] = array(
                        'message' => $message,
                        'controller' => $controller,
                        'action' => $action,
                        'priority' => $priority
                    );
                    $i++;
                }

            } else if ($item['permission_id'] == 2) {
            }
        endforeach;

        return $notifications;
    }
*/
    public function error_404(){

        $action = "Error 404";
        $user_id = $this->session->userdata('id');
        $type = 1;
        $this->log_model->insert_log($action, $user_id, $type);

        $controller = "public";
        $view = "error_404";
        $data = NULL;
        $this->load_view($controller, $view, $data);

    }

    public function redirect_controller($class, $method, $argument1, $argument2) {        
        $url = $argument1 == NULL ? $class.'/'.$method : $argument2 == NULL ? $class.'/'.$method.'/'.$argument1 : $class.'/'.$method.'/'.$argument1.'/'.$argument2;
        redirect($url);
    }

    public function load_view($controller, $view, $data) {        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $url = $controller != NULL ? $controller.'/'.$view : $view;
        $this->load->view($url);
        $this->load->view('templates/footer');
        $this->load->view('templates/scripts');
    }
    
    public function loggout() {
        $action = "Logged out";
        $type = 0;
        $user_id = $this->session->userdata('id');
        $this->log_model->insert_log($action, $user_id, $type);
        $this->session->sess_destroy();
        delete_cookie('user');
        redirect('login');
    }

}
