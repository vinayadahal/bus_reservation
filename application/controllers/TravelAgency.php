<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TravelAgency extends CI_Controller {

    private $agency_id;
    private $agency_name;
    private $address;
    private $contact;
    private $email;

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
        $this->agency_name = $this->input->post('agency_name');
        $this->address = $this->input->post('address');
        $this->contact = $this->input->post('contact');
        $this->email = $this->input->post('email');
        if (!empty($this->input->post('agency_id')) && null !== $this->input->post('agency_id')) {
            $this->agency_id = $this->input->post('agency_id');
        }
    }

    public function array_maker_post_table() {
        return array("name" => $this->agency_name, "address" => $this->address, "contact" => $this->contact, "email" => $this->email, "id" => $this->agency_id);
    }

    public function index($page = null) {
        $data['message'] = $this->session->flashdata('message');
        $TotalCount = $this->select->getTotalCount("travel_agency");
        $DataPerPage = 8;
        $data['num_pages'] = ceil($TotalCount / $DataPerPage);
        $start = $this->commons->pageDataLimiter($page, $DataPerPage);
        $data['agencies'] = (array) $this->select->getAllFromTable("travel_agency", $DataPerPage, $start);
        if ($page > 1) {
            $data['data_count'] = (($page - 1) * $DataPerPage) + 1;
        }
        $this->loadView($data, 'travel_agencies/index', 'Travel Agencies');
    }

    public function addAgency() {
        $this->loadView("", "travel_agencies/create", "Add Agency");
    }

    public function createAgency() {
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
