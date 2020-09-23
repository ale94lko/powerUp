<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct() {

        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }

        $this->load->helper(array('url', 'security', 'form'));
        $this->load->model(array('user_model', 'log_model'));
        $this->load->library(array('form_validation', 'upload'));
    }

    public function index() {
        $key = hash("sha256", $this->session->userdata('user'));
        $permission = $this->session->userdata('permission');
        $auth = FALSE;
        foreach ($permission as $item):
            if (($item['id'] == 1 || $item['id'] == 2 || $item['id'] == 3)) {
                $auth = TRUE;
                break;
            }
        endforeach;

        if ($key != $this->session->userdata('key') && !$auth) {
            $this->access_denied('user', 'index');
        } else {
            $this->session->unset_userdata('key');
            $data['users'] = $this->user_model->get_users();
            $data['permission_user'] = $this->user_model->get_permission_user();
            $userdata = array(
                'view' => 'user'
            );
            $this->session->set_userdata($userdata);

            $action = "View list of users";
            $type = 0;
            $user_id = $this->session->userdata('id');
            $this->trace_model->insert_log($action, $user_id, $type);

            $controller = "user";
            $view = "index";
            $this->load_view($controller, $view, $data);
        }
    }

    public function add() {
        $key = hash("sha256", $this->session->userdata('user'));
        $reload = $this->security->xss_clean($this->input->post('reload'));
        $permission = $this->session->userdata('permission');
        $auth = FALSE;
        foreach ($permission as $item):
            if (($item['id'] == 1)) {
                $auth = TRUE;
                break;
            }
        endforeach;

        if ($key != $this->session->userdata('key') && !$reload && !$auth) {
            $this->access_denied('user', 'add');
        } else {
            $this->session->unset_userdata('key');
            $userdata = array(
                'view' => 'user'
            );
            $this->session->set_userdata($userdata);
            $config = $this->validation_config();
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {
                $data['worker'] = $this->user_model->get_workers_without_user();
                $data['permissions'] = $this->user_model->get_permissions();
                $data['permission_group'] = $this->user_model->get_permission_group();
                if (count($data['worker']) > 0) {
                    $controller = "user";
                    $view = "add";
                    $this->load_view($controller, $view, $data);
                } else {
                    $userdata = array(
                        'message_type' => 'error',
                        'message' => 'Todos los trabajadores del sistema tienen usuario'
                    );
                    $this->session->set_userdata($userdata);

                    $action = "Intentar adicionar un usuario. Error: Todos los trabajadores del sistema tienen usuario";
                    $type = 1;
                    $user_id = $this->session->userdata('id');
                    $this->trace_model->insert_trace($action, $user_id, $type);

                    redirect('handle/index/user');
                }
            } else {
                $user = $this->security->xss_clean($this->input->post('user'));
                $pass = hash("sha256", $this->security->xss_clean($this->input->post('pass')));
                $worker_ci = $this->security->xss_clean($this->input->post('worker'));

                $this->user_model->add_user($user, $pass, $worker_ci);
                $value = 1;
                $this->user_model->edit_worker_user($worker_ci, $value);

                $id = $this->user_model->get_user_id($user);

                $data['user_permission'] = $this->security->xss_clean($this->input->post('permissions[]'));
                if (is_array($data['user_permission'])) {
                    foreach ($data['user_permission'] as $value):
                        $this->user_model->add_permission($value, $id);
                    endforeach;
                }

                $userdata = array(
                    'message_type' => 'success',
                    'message' => 'Usted ha adicionado los datos de un usuario correctamente'
                );
                $this->session->set_userdata($userdata);

                $action = "Adicionar datos de un usuario. Id: " . $id;
                $type = 0;
                $user_id = $this->session->userdata('id');
                $this->trace_model->insert_trace($action, $user_id, $type);

                redirect('handle/index/user');
            }
        }
    }

    public function edit($id = NULL) {
        $key = hash("sha256", $this->session->userdata('ci'));
        $reload = $this->security->xss_clean($this->input->post('reload'));
        $permission = $this->session->userdata('permission');
        $auth = FALSE;
        foreach ($permission as $item):
            if (($item['id'] == 5)) {
                $auth = TRUE;
                break;
            }
        endforeach;

        if ($key != $this->session->userdata('key') && !$reload && !$auth) {
            $this->access_denied('user', 'edit');
        } else {
            $this->session->unset_userdata('key');
            if ($id != NULL) {
                $config = array(
                    array(
                        'field' => 'user',
                        'label' => 'Usuario',
                        'rules' => 'required|min_length[5]|max_length[15]|alpha_numeric',
                        'errors' => array(
                            'required' => 'Por favor, introduzca el %s',
                            'min_length' => 'Por favor, no escribas menos de 5 caracteres',
                            'max_length' => 'Por favor, no escribas más de 15 caracteres',
                            'alpha_numeric' => 'Por favor, escribe sólo letras y números'
                        )
                    )
                );
                $this->form_validation->set_rules($config);

                if ($this->form_validation->run() == FALSE) {
                    $data['edit_user'] = $this->user_model->get_user($id);
                    $data['user_permission'] = $this->user_model->get_user_permission($id);
                    $data['permissions'] = $this->user_model->get_permissions();
                    $data['permission_group'] = $this->user_model->get_permission_group();
                    $userdata = array(
                        'view' => 'user'
                    );
                    $this->session->set_userdata($userdata);

                    $controller = "user";
                    $view = "edit";
                    $this->load_view($controller, $view, $data);
                } else {
                    $user = $this->security->xss_clean($this->input->post('user'));
                    $id = $this->security->xss_clean($this->input->post('id'));
                    $val = $this->user_model->verify_user_name($user, $id);

                    if ($val) {
                        $up1 = $this->user_model->get_user_permission($id);
                        $up2 = $this->security->xss_clean($this->input->post('permissions[]'));
                        $userdata = array(
                            'message_type' => 'success',
                            'message' => 'Usted ha modificado los datos de un usuario correctamente',
                            'key' => $key
                        );
                        $this->session->set_userdata($userdata);
                        $this->update_permission($up1, $up2, $id);

                        $this->user_model->edit_user_name($user, $id);

                        $action = "Modificar datos de un usuario. Id: " . $id;
                        $type = 0;
                        $user_id = $this->session->userdata('id');
                        $this->trace_model->insert_trace($action, $user_id, $type);

                        redirect('handle/index/user');
                    } else {
                        $data['edit_user'] = $this->user_model->get_user($id);
                        $data['user_permission'] = $this->user_model->get_user_permission($id);
                        $data['permissions'] = $this->user_model->get_permissions();
                        $userdata = array(
                            'message_type' => 'error',
                            'message' => 'Ese nombre de usuario ya existe'
                        );
                        $this->session->set_userdata($userdata);

                        $action = "Intentar modificar datos de un usuario. Error: Ese nombre de usuario ya existe";
                        $type = 1;
                        $user_id = $this->session->userdata('id');
                        $this->trace_model->insert_trace($action, $user_id, $type);

                        $controller = "user";
                        $view = "edit";
                        $this->load_view($controller, $view, $data);
                    }
                }
            } else {
                $this->access_denied('user', 'edit');
            }
        }
    }

    public function delete($id = NULL) {
        $key = hash("sha256", $this->session->userdata('ci'));
        $permission = $this->session->userdata('permission');
        $auth = FALSE;
        foreach ($permission as $item):
            if (($item['id'] == 5)) {
                $auth = TRUE;
                break;
            }
        endforeach;

        if ($key != $this->session->userdata('key') && !$auth) {
            $this->access_denied('user', 'delete');
        } else {
            $this->session->unset_userdata('key');
            if ($id != NULL) {
                $ci = $this->user_model->get_worker_ci($id);
                $this->user_model->del_user($id, $ci);

                $userdata = array(
                    'message_type' => 'success',
                    'message' => 'Usted ha eliminado los datos de un usuario correctamente'
                );
                $this->session->set_userdata($userdata);

                $action = "Eliminar datos de un usuario. Ci: " . $ci;
                $type = 0;
                $user_id = $this->session->userdata('id');
                $this->trace_model->insert_trace($action, $user_id, $type);

                redirect('handle/index/user');
            } else {
                $this->access_denied('user', 'delete');
            }
        }
    }
    
    public function export_pdf() {
        $key = hash("sha256", $this->session->userdata('ci'));
        $permission = $this->session->userdata('permission');
        $auth = FALSE;
        foreach ($permission as $item):
            if (($item['id'] == 4 || $item['id'] == 5 || $item['id'] == 6)) {
                $auth = TRUE;
                break;
            }
        endforeach;

        if ($key != $this->session->userdata('key') && !$auth) {
            $this->access_denied('user', 'export_pdf');
        } else {
            $this->session->unset_userdata('key');
            $data['user'] = $this->user_model->get_users();
            $data['permission_user'] = $this->user_model->get_permission_user();
            $data['pdf'] = "user";
            $html = $this->load->view('public/pdf', $data, TRUE);

            $this->load->library('pdfgenerator');
            $filename = 'Listado de usuarios';
            $this->pdfgenerator->generate($html, $filename, true, 'Letter', 'landscape');

            $action = "Exportar listado de usuarios a PDF";
            $type = 0;
            $user_id = $this->session->userdata('id');
            $this->trace_model->insert_trace($action, $user_id, $type);
        }
    }
    
    public function update_permission($up1, $up2, $id) {
        $key = hash("sha256", $this->session->userdata('ci'));
        $permission = $this->session->userdata('permission');
        $auth = FALSE;
        foreach ($permission as $item):
            if (($item['id'] == 5)) {
                $auth = TRUE;
                break;
            }
        endforeach;

        if ($key != $this->session->userdata('key') && !$auth) {
            $this->access_denied('user', 'update_permission');
        } else {
            $this->session->unset_userdata('key');
            if ($id != NULL) {
                if (is_array($up2)) {
                    foreach ($up1 as $value):
                        $val = FALSE;
                        foreach ($up2 as $value2):
                            if ($value['permission_id'] == $value2) {
                                $val = TRUE;
                                break;
                            }
                        endforeach;
                        if (!$val) {
                            $this->user_model->del_permission($value['permission_id'], $id);
                        }
                    endforeach;
                    foreach ($up2 as $value2):
                        $val = FALSE;
                        foreach ($up1 as $value):
                            if ($value2 == $value['permission_id']) {
                                $val = TRUE;
                                break;
                            }
                        endforeach;
                        if (!$val) {
                            $this->user_model->add_permission($value2, $id);
                        }
                    endforeach;
                } else {
                    foreach ($up1 as $value):
                        $this->user_model->del_permission($value['permission_id'], $id);
                    endforeach;
                }
            } else {
                $this->access_denied('user', 'update_permission');
            }
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
            'message' => 'Acceso denegado'
        );
        $this->session->set_userdata($userdata);

        $action = "Intentar acceder al método '" . $method . "' del controlador '" . $controller . "' por la url";
        $type = 1;
        $user_id = $this->session->userdata('id');
        $this->trace_model->insert_trace($action, $user_id, $type);

        redirect('handle');
    }
    
    public function validation_config() {
        $config = array(
                array(
                    'field' => 'user',
                    'label' => 'Usuario',
                    'rules' => 'required|min_length[5]|max_length[15]|alpha_numeric|is_unique[user.user]',
                    'errors' => array(
                        'required' => 'Por favor, introduzca el %s',
                        'min_length' => 'Por favor, no escribas menos de 5 caracteres',
                        'max_length' => 'Por favor, no escribas más de 15 caracteres',
                        'alpha_numeric' => 'Por favor, escribe sólo letras y números',
                        'is_unique' => 'Ese usuario ya existe'
                    )
                ),
                array(
                    'field' => 'pass',
                    'label' => 'Contraseña',
                    'rules' => 'regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/]',
                    'errors' => array(
                        'regex_match' => 'Por favor, escribe una contraseña segura'
                    )
                ),
                array(
                    'field' => 're_password',
                    'label' => 'Contraseña',
                    'rules' => 'required|matches[pass]',
                    'errors' => array(
                        'required' => 'Por favor, repita la %s.',
                        'regex_match' => 'Por favor, escribe el mismo valor de nuevo'
                    )
                ),
                array(
                    'field' => 'worker',
                    'label' => 'Trabajador',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => 'Por favor, seleccione una %s'
                    )
                )
            );
        return $config;
    }
    
}
