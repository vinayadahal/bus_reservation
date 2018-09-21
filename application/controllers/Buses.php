<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Buses extends CI_Controller {

    private $start_point;
    private $end_point;
    private $type;
    private $total_seat;
    private $bus_number;
    private $price;
    private $agency_id;
    private $bus_id;

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
        $this->agency_id = $this->session->userdata('agency_id');
        $this->start_point = $this->input->post('start_point');
        $this->end_point = $this->input->post('end_point');
        $this->type = $this->input->post('type');
        $this->total_seat = $this->input->post('total_seat');
        $this->bus_number = $this->input->post('bus_number');
        $this->price = $this->input->post('price');
        if (!empty($this->input->post('bus_id')) && null !== $this->input->post('bus_id')) {
            $this->bus_id = $this->input->post('bus_id');
        }
    }

    public function array_maker_table() {
        return array("type" => $this->type, "total_seat" => $this->total_seat, "bus_number" => $this->bus_number, "price" => $this->price, "travel_agency_id" => $this->agency_id);
    }

//        $this->output->enable_profiler(TRUE);
    public function index($page = null) {
        $data['message'] = $this->session->flashdata('message');
        $TotalCount = $this->select->getTotalCount("bus", 'travel_agency_id', $this->session->userdata('agency_id'));
        $DataPerPage = 8;
        $data['num_pages'] = ceil($TotalCount / $DataPerPage);
        $start = $this->commons->pageDataLimiter($page, $DataPerPage);
        $all_buses = (array) $this->select->getAllFromTable('bus', 'travel_agency_id', $this->session->userdata('agency_id'), $DataPerPage, $start);
        $buses = array();
        $j = 0;
        foreach ($all_buses as $bus) {
            $route = (array) $this->select->getSingleRecordWhere('route', 'bus_id', $bus->id);
            $start_point = (array) $this->select->getSingleRecord('destination', $route['start_point']);
            $end_point = (array) $this->select->getSingleRecord('destination', $route['end_point']);
            $buses[$j] = array('id' => $bus->id, 'type' => $bus->type, 'total_seat' => $bus->total_seat, 'bus_number' => $bus->bus_number, "price" => $bus->price, "from" => $start_point['destination'], 'to' => $end_point['destination']);
            $j++;
        }
        $data['buses'] = $buses;
        if ($page > 1) {
            $data['data_count'] = (($page - 1) * $DataPerPage) + 1;
        }
        $this->loadView($data, 'buses/index', 'Buses');
    }

    public function addBus() {
        $data['places'] = $this->select->getAllFromTable("destination");
        $this->loadView($data, "buses/create", "Add Bus");
    }

    public function createBus() {
        $this->form_value_init(); // initalize form value
        $data_table = $this->array_maker_table(); // create array with book
        $bus_id = $this->insert->insert_return_id($data_table, "bus");
        if ($this->insert->insert_single_row(array("start_point" => $this->start_point, "end_point" => $this->end_point, "bus_id" => $bus_id), "route")) {
            $this->session->set_flashdata('message', 'Added ' . ucfirst($this->type) . ' bus !!!');
            redirect(base_url() . 'member/buses', 'refresh');
        } else {
            $this->session->set_flashdata('message', 'Unable to add ' . ucfirst($this->type) . '!!!');
            redirect(base_url() . 'member/buses', 'refresh');
        }
    }

    public function editBus($id) {
        $bus = (array) $this->select->getSingleRecord('bus', $id);
        $route = (array) $this->select->getSingleRecordWhere('route', 'bus_id', $bus['id']);
        $data['bus'] = array('id' => $bus['id'], 'type' => $bus['type'], 'total_seat' => $bus['total_seat'], 'bus_number' => $bus['bus_number'], "price" => $bus['price'], "start_point" => $route['start_point'], 'end_point' => $route['end_point']);
        $data['bus_id'] = $id;
        $data['places'] = $this->select->getAllFromTable("destination");
        $this->loadView($data, "buses/edit", "Edit Bus");
    }

    public function updateBus() {
        $this->form_value_init(); // initalize form value
        $data_table = $this->array_maker_table(); // create array with book
        if ($this->update->updateSingleCondition($data_table, "bus", "id", $this->bus_id)) {
            $this->update->updateSingleCondition(array("start_point" => $this->start_point, "end_point" => $this->end_point), "route", "bus_id", $this->bus_id);
            $this->session->set_flashdata('message', 'Updated ' . ucfirst($this->type) . ' bus!!!');
            redirect(base_url() . 'member/buses', 'refresh');
        } else {
            $this->session->set_flashdata('message', 'Unable to update ' . ucfirst($this->type) . ' bus!!!');
            redirect(base_url() . 'member/buses', 'refresh');
        }
    }

    public function deleteBus($id) {
        $bus = (array) $this->select->getSingleRecord('bus', $id);
        if ($this->delete->deleteSingleCondition("route", "bus_id", $id)) {
            $this->delete->deleteSingleCondition("bus", "id", $id);
            $this->session->set_flashdata('message', ucfirst($bus['type']) . ' bus deleted successfully!!!');
            redirect(base_url() . 'member/buses', 'refresh');
        } else {
            $this->session->set_flashdata('message', 'Unable to delete ' . ucfirst($bus['type']) . ' bus!!!');
            redirect(base_url() . 'member/buses', 'refresh');
        }
    }

    public function loadView($data, $page_name, $title) {
        $data['title'] = ucfirst($title);
        $data['user'] = $this->select->getSingleRecordWhere('user', 'id', $this->session->userdata('user_id'));
        $data['role'] = $this->select->getSingleRecordWhere('role', 'id', $data['user']->role);
        $this->load->view('member/template/header', $data);
        $this->load->view('member/' . $page_name, $data);
        $this->load->view('member/template/footer', $data);
    }

}
