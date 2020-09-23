<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {

    function __construct() {

        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        $this->load->helper(array('url', 'security', 'form'));
        $this->load->model(array('user_model', 'log_model'));
    }

    public function index() {
        $key = hash("sha256", $this->session->userdata('user'));
        $permission = $this->session->userdata('permission');
        $auth = FALSE;
        foreach ($permission as $item):
            if (($item['id'] == 4)) {
                $auth = TRUE;
                break;
            }
        endforeach;

        if ($key != $this->session->userdata('key') && !$auth) {
            $this->access_denied('log', 'index');
        } else {
            $this->session->unset_userdata('key');
            $limit = 100;
            $data['log'] = $this->log_model->get_log($limit);
            $userdata = array(
                'view' => 'log'
            );
            $this->session->set_userdata($userdata);

            $controller = "log";
            $view = "index";
            $this->load_view($controller, $view, $data);
        }
    }
    
    public function export_pdf() {
        $key = hash("sha256", $this->session->userdata('user'));
        $permission = $this->session->userdata('permission');
        $auth = FALSE;
        foreach ($permission as $item):
            if (($item['id'] == 5)) {
                $auth = TRUE;
                break;
            }
        endforeach;

        if ($key != $this->session->userdata('key') && !$auth) {
            $this->access_denied('log', 'export_pdf');
        } else {
            $this->session->unset_userdata('key');
            $limit = 50;
            $data['log'] = $this->log_model->get_log($limit);
            $data['pdf'] = "log";
            $html = $this->load->view('public/pdf', $data, TRUE);

            $this->load->library('pdfgenerator');
            $filename = 'Logs';
            $this->pdfgenerator->generate($html, $filename, true, 'Letter', 'landscape');

            $action = "Export logs to PDF";
            $type = 0;
            $user_id = $this->session->userdata('id');
            $this->trace_model->insert_log($action, $user_id, $type);
        }
    }
    
    public function load_view($controller, $view, $data) {

        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('templates/sidebar');
        $url = $controller != NULL ? $controller . '/' . $view : $view;
        $this->load->view($url);
        $this->load->view('templates/footer');
        $this->load->view('templates/scripts');
    }

    public function access_denied($controller, $method) {
        $userdata = array(
            'message_type' => 'error',
            'message' => 'Access denied'
        );
        $this->session->set_userdata($userdata);

        $action = "Trying to access the function '" . $method . "' of controller '" . $controller;
        $type = 1;
        $user_id = $this->session->userdata('id');
        $this->log_model->insert_log($action, $user_id, $type);

        redirect('handle');
    }
    
}
