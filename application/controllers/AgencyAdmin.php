<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AgencyAdmin extends CI_Controller {

    private $agency_id;
    private $agency_name;
    private $address;
    private $contact;
    private $email;
    private $username;
    private $travel_agency_id;

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
    }

    public function form_value_init() {
        $this->agency_name = $this->input->post('name');
        $this->address = $this->input->post('address');
        $this->contact = $this->input->post('phone');
        $this->email = $this->input->post('email');
        $this->username = $this->input->post('username');
        $this->travel_agency_id = $this->input->post('travel_agency_id');
        if (!empty($this->input->post('agency_id')) && null !== $this->input->post('agency_id')) {
            $this->agency_id = $this->input->post('agency_id');
        }
    }

    public function array_maker_post_table() {
        return array("name" => $this->name, "address" => $this->address, "phone" => $this->phone, "email" => $this->email, "username" => $this->username,"travel_agency_id" => $this->travel_agency_id);
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
        $this->form_value_init(); // initalize form value
        $data_post_table = $this->array_maker_post_table(); // create array
        if ($this->insert->insert_single_row($data_post_table, "travel_agency")) {
            $this->session->set_flashdata('message', 'Added travel agency ' . ucfirst($this->agency_name) . '!!!');
            redirect(base_url() . 'admin/travel_agencies', 'refresh');
        } else {
            $this->session->set_flashdata('message', 'Unable to add travel agency ' . ucfirst($this->agency_name) . '!!!');
            redirect(base_url() . 'admin/travel_agencies', 'refresh');
        }
    }

    public function editAgency($id) {
        $data['agency'] = (array) $this->select->getSingleRecord('travel_agency', $id);
        $data['agency_id'] = $id;
        $this->loadView($data, "travel_agencies/edit", "Edit Agency");
    }

    public function updateAgency() {
        $this->form_value_init(); // initalize form value
        $data_post_table = $this->array_maker_post_table(); // create array with book
        if ($this->update->updateSingleCondition($data_post_table, "travel_agency", "id", $this->agency_id)) {
            $this->session->set_flashdata('message', 'Updated travel agency ' . ucfirst($this->agency_name) . '!!!');
            redirect(base_url() . 'admin/travel_agencies', 'refresh');
        } else {
            $this->session->set_flashdata('message', 'Unable to update travel agency ' . ucfirst($this->book_name) . '!!!');
            redirect(base_url() . 'admin/travel_agencies', 'refresh');
        }
    }

    public function deleteAgency($id) {
        $post = (array) $this->select->getSingleRecord('travel_agency', $id);
        if ($this->delete->deleteSingleCondition("travel_agency", "id", $id)) {
            $this->session->set_flashdata('message', 'Travel agency ' . ucfirst($post['name']) . ' deleted successfully!!!');
            redirect(base_url() . 'admin/travel_agencies', 'refresh');
        } else {
            $this->session->set_flashdata('message', 'Unable to delete travel agency ' . ucfirst($post['name']) . '!!!');
            redirect(base_url() . 'admin/travel_agencies', 'refresh');
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
