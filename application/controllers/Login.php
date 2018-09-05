<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    private $username;
    private $password;
    private $travel_agency_id;

    public function __construct() {
        parent:: __construct();
        $this->load->database();
        $this->load->model('select');
        $this->load->helper('url'); // Helps to get base url defined in config.php
        $this->load->library('session'); // starts session
    }

    public function form_value_init() {
        $this->username = $this->input->post('username');
        $this->password = $this->input->post('password');
    }

    public function index() {
        $data['message'] = $this->session->flashdata('message');
        $page_name = "index";
        $title = 'login';
        $this->loadView($data, $page_name, $title);
    }

    public function checkLogin() {
        $this->form_value_init();
        $result = $this->select->getSingleRecordWhereMultiValue('user', 'username', $this->username, 'password', sha1($this->password));
        if (!isset($result) || empty($result)) {
            $this->session->set_flashdata('message', 'Invaild credentials!!!');
            redirect(base_url() . 'login', 'refresh');
        } else {
//            if ($this->checkActivated($result->active)) {
            $this->session->set_userdata('user_id', $result->id);
            if (!empty($result->travel_agency_id)) {
                $this->travel_agency_id = $result->travel_agency_id;
            }
            $this->checkRole($result->role); // checks which panel to redirect to
//            }
        }
    }

    public function checkActivated($active) {
        if ($active != TRUE) {
            $this->session->set_flashdata('message', 'Account not activated!!!');
            redirect(base_url() . 'login', 'refresh');
            return false;
        } else {
            return true;
        }
    }

    public function checkRole($role) {
        $role_value = $this->select->getSingleRecordWhere('role', 'id', $role);
        if (!empty($role_value->role)) {
            if ($role_value->role == 'role_admin') {
                redirect(base_url() . 'admin', 'refresh');
            } else {
                $this->redirectTo();
//                $this->output->enable_profiler(TRUE);
                $agency = $this->select->getSingleRecordWhere('travel_agency', 'id', $this->travel_agency_id);
                $this->session->set_userdata('agency_id', $agency->id);
                $this->session->set_userdata('user_role', $role_value->role);
                redirect(base_url() . 'member', 'refresh');
            }
        }
    }

    public function redirectTo() {
        if (null !== $this->session->userdata('redirectUrl') && !empty($this->session->userdata('redirectUrl'))) {
            redirect($this->session->userdata('redirectUrl'), 'refresh');
        }
//        else {
//            $this->session->set_flashdata('message', 'Invalid redirect url!!!');
//            redirect(base_url() . 'login', 'refresh');
//        }
    }

    public function logout() {
        $this->session->unset_userdata('user_id');
        $this->session->sess_destroy();
        $this->session_check();
    }

    public function session_check() {
        if (empty($this->session->userdata('user_id'))) {
            redirect(base_url() . 'login', 'refresh');
        }
    }

    public function loadView($data, $page_name, $title) {
        $data['title'] = ucfirst($title);
        $this->load->view('login/template/header', $data);
        $this->load->view('login/' . $page_name, $data);
        $this->load->view('login/template/footer', $data);
    }

}
