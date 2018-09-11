<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AgencyAdmin extends CI_Controller {

    private $name;
    private $address;
    private $phone;
    private $email;
    private $username;
    private $password;
    private $con_password;
    private $user_id;
    private $role;

    public function __construct() {
        parent:: __construct();
        $this->load->database();
        $this->load->model('select');
        $this->load->model('insert');
        $this->load->model('update');
        $this->load->model('delete');
        $this->load->helper('url'); // Helps to get base url defined in config.php
        $this->load->library('session'); // starts session
        $this->load->library('commons');
        $this->load->library('authorized');
        $this->authorized->check_auth($this->select, $this->session->userdata('user_id'));
        $this->session_check();
    }

    public function session_check() {
        if (empty($this->session->userdata('user_id'))) {
            $this->session->set_flashdata('message', 'Invaild credentials!!!');
            redirect(base_url() . 'login', 'refresh');
        }
    }

    public function form_value_init() {
        $this->name = $this->input->post('name');
        $this->address = $this->input->post('address');
        $this->phone = $this->input->post('phone');
        $this->email = $this->input->post('email');
        $this->username = $this->input->post('username');
        $this->password = $this->input->post('password');
        $this->con_password = $this->input->post('con_password');
        $this->travel_agency_id = $this->input->post('agency_id');
        if (!empty($this->input->post('user_id')) && null !== $this->input->post('user_id')) {
            $this->user_id = $this->input->post('user_id');
        }
    }

    public function array_maker_user_table() {
        if (empty($this->password) && empty($this->con_password)) {
            return array("name" => $this->name, "address" => $this->address, "phone" => $this->phone, "email" => $this->email, "username" => $this->username, "travel_agency_id" => $this->travel_agency_id);
        } else {
            return array("name" => $this->name, "address" => $this->address, "phone" => $this->phone, "email" => $this->email, "username" => $this->username, "travel_agency_id" => $this->travel_agency_id, "password" => sha1($this->password), "role" => $this->role);
        }
    }

    public function index($page = null) {
        $data['message'] = $this->session->flashdata('message');
        $TotalCount = $this->select->getTotalCount("user");
        $DataPerPage = 8;
        $data['num_pages'] = ceil($TotalCount / $DataPerPage);
        $start = $this->commons->pageDataLimiter($page, $DataPerPage);
        $col = array("user.id", "user.name", "user.email", "user.phone", "user.address", "user.created", "user.username", "travel_agency.name as travel_agency");
        $t_name1 = "user";
        $t_name2 = "travel_agency";
        $t_1_col = "travel_agency_id";
        $t_2_col = "id";
        $data['agency_admins'] = (array) $this->select->getAllRecordInnerJoinNoCondition($col, $t_name1, $t_name2, $t_1_col, $t_2_col, $DataPerPage, $start);
        if ($page > 1) {
            $data['data_count'] = (($page - 1) * $DataPerPage) + 1;
        }
        $this->loadView($data, 'agency_admin/index', 'Agency Admins');
    }

    public function addAgencyAdmin() {
        $data['agency_ids'] = (array) $this->select->getAllFromTable("travel_agency");
        $this->loadView($data, "agency_admin/create", "Add Agency Admin");
    }

    public function createAgencyAdmin() {
        $role_agency_admin = (array) $this->select->getSingleRecordWhere("role", "role", "role_agency_admin");
        $this->role = $role_agency_admin['id'];
        $this->form_value_init(); // initalize form value
        $data_user_table = $this->array_maker_user_table(); // create array with book
        if ($this->password != $this->con_password) {
            $this->session->set_flashdata('message', "Passwords are not equal!!!");
        } else {
            if ($this->insert->insert_single_row($data_user_table, "user")) {
                $this->session->set_flashdata('message', ucwords($this->name) . " added successfully!!!");
            } else {
                $this->session->set_flashdata('message', 'Unable to add ' . ucwords($this->name) . '!!!');
            }
        }
        redirect(base_url() . 'admin/agency_admin', 'refresh');
    }

    public function editAgencyAdmin($id) {
        $data['agency_admin'] = (array) $this->select->getSingleRecordWhere('user', 'id', $id);
        $data['agency_admin_id'] = $id;
        $data['agency_ids'] = (array) $this->select->getAllFromTable("travel_agency");
        $this->loadView($data, "agency_admin/edit", "Edit Agency Admin");
    }

    public function updateAgencyAdmin() {
        $this->form_value_init(); // initalize form value
        $data_user_table = $this->array_maker_user_table(); // create array with book
        if ($this->password != $this->con_password) {
            $this->session->set_flashdata('message', "Passwords are not equal!!!");
        } else {
            if ($this->update->updateSingleCondition($data_user_table, "user", "id", $this->user_id)) {
                $this->session->set_flashdata('message', 'Updated agency admin ' . ucfirst($this->name) . '!!!');
                redirect(base_url() . 'admin/agency_admin', 'refresh');
            } else {
                $this->session->set_flashdata('message', 'Unable to update agency admin ' . ucfirst($this->book_name) . '!!!');
                redirect(base_url() . 'admin/agency_admin', 'refresh');
            }
        }
    }

    public function deleteAgencyAdmin($id) {
        $post = (array) $this->select->getSingleRecord('user', $id);
        if ($this->delete->deleteSingleCondition("user", "id", $id)) {
            $this->session->set_flashdata('message', 'Agency admin ' . ucfirst($post['name']) . ' deleted successfully!!!');
            redirect(base_url() . 'admin/agency_admin', 'refresh');
        } else {
            $this->session->set_flashdata('message', 'Unable to delete agency admin ' . ucfirst($post['name']) . '!!!');
            redirect(base_url() . 'admin/agency_admin', 'refresh');
        }
    }

    public function loadView($data, $page_name, $title) {
        $data['title'] = ucfirst($title);
        $data['user'] = $this->select->getSingleRecordWhere('user', 'id', $this->session->userdata('user_id'));
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/' . $page_name, $data);
        $this->load->view('admin/template/footer', $data);
    }

}
