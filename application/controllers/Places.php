<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Places extends CI_Controller {

    private $name;
    private $place_id;

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
        $this->name = $this->input->post('name');
        if (!empty($this->input->post('place_id')) && null !== $this->input->post('place_id')) {
            $this->place_id = $this->input->post('place_id');
        }
    }

    public function array_maker_post_table() {
        return array("destination" => $this->name);
    }

    public function index($page = null) {
        $data['message'] = $this->session->flashdata('message');
        $TotalCount = $this->select->getTotalCount("destination");
        $DataPerPage = 8;
        $data['num_pages'] = ceil($TotalCount / $DataPerPage);
        $start = $this->commons->pageDataLimiter($page, $DataPerPage);
        $data['categories'] = (array) $this->select->getAllFromTable('destination', $DataPerPage, $start);
        $this->loadView($data, 'places/index', 'places');
    }

    public function addPlace() {
        $this->loadView("", "places/create", "Add Place");
    }

    public function createPlace() {
        $this->form_value_init(); // initalize form value
        $data_post_table = $this->array_maker_post_table(); // create array with book
        if ($this->insert->insert_single_row($data_post_table, "destination")) {
            $this->session->set_flashdata('message', 'Added a new place as ' . ucfirst($this->name) . '!!!');
        } else {
            $this->session->set_flashdata('message', 'Unable to add place as ' . ucfirst($this->name) . '!!!');
        }
        redirect(base_url() . 'admin/places', 'refresh');
    }

    public function editPlace($id) {
        $data['place'] = (array) $this->select->getSingleRecord('destination', $id);
        $data['place_id'] = $id;
        $this->loadView($data, "places/edit", "Edit Place");
    }

    public function updatePlace() {
        $this->form_value_init(); // initalize form value
        $data_post_table = $this->array_maker_post_table(); // create array with book
        if ($this->update->updateSingleCondition($data_post_table, "destination", "id", $this->place_id)) {
            $this->session->set_flashdata('message', 'Updated place ' . ucfirst($this->name) . '!!!');
        } else {
            $this->session->set_flashdata('message', 'Unable to update place ' . ucfirst($this->name) . '!!!');
        }
        redirect(base_url() . 'admin/places', 'refresh');
    }

    public function deletePlace($id) {
        $post = (array) $this->select->getSingleRecord('destination', $id);
        if ($this->delete->deleteSingleCondition("destination", "id", $id)) {
            $this->session->set_flashdata('message', 'Place ' . ucfirst($post['destination']) . ' deleted successfully!!!');
        } else {
            $this->session->set_flashdata('message', 'Unable to delete place ' . ucfirst($post['destination']) . '!!!');
        }
        redirect(base_url() . 'admin/places', 'refresh');
    }

    public function loadView($data, $page_name, $title) {
        $data['title'] = ucfirst($title);
        $data['user'] = $this->select->getSingleRecordWhere('user', 'id', $this->session->userdata('user_id'));
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/' . $page_name, $data);
        $this->load->view('admin/template/footer', $data);
    }

}
