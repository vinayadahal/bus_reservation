<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Schedules extends CI_Controller {

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

    public function common_query($data_per_page = null, $start = null) {
        $col = array("bus.id", "bus.type", "bus.total_seat", "bus.bus_number", "bus.seat_layout", "reservation.id as reservation_id", "reservation.departure_date as departure_date", "reservation.departure_time as departure_time", "reservation.reserved_seat as reserved_seat", "reservation.id as reserve_id", "bus.price as price");
        $t_name1 = "bus";
        $t_name2 = "reservation";
        $t_1_col = "id";
        $t_2_col = "bus_id";
        $cond_col = "travel_agency_id";
        $cond_val = $this->session->userdata('agency_id');
        return $this->select->getAllRecordInnerJoin($col, $t_name1, $t_name2, $t_1_col, $t_2_col, $cond_col, $cond_val, $data_per_page, $start);
    }

//        $this->output->enable_profiler(TRUE);
    public function index($page = null) {
        $data['message'] = $this->session->flashdata('message');
        $TotalCount = count($this->common_query());
        $DataPerPage = 8;
        $data['num_pages'] = ceil($TotalCount / $DataPerPage);
        $start = $this->commons->pageDataLimiter($page, $DataPerPage);
        $reservation = array();
        $j = 0;
        $schedules = $this->common_query($DataPerPage, $start);
        foreach ($schedules as $schedule) {
            $route = (array) $this->select->getSingleRecordWhere('route', 'bus_id', $schedule->id);
            $start_point = (array) $this->select->getSingleRecord('destination', $route['start_point']);
            $end_point = (array) $this->select->getSingleRecord('destination', $route['end_point']);
            $reservation[$j] = array('id' => $schedule->id, 'type' => $schedule->type, 'bus_number' => $schedule->bus_number, "departure_date" => $schedule->departure_date, "departure_time" => $schedule->departure_time, "reserved_seat" => $schedule->reserved_seat, "reservation_id" => $schedule->reservation_id, "from" => $start_point['destination'], 'to' => $end_point['destination']);
            $j++;
        }
        $data['reservations'] = $reservation;
        if ($page > 1) {
            $data['data_count'] = (($page - 1) * $DataPerPage) + 1;
        }
        $this->loadView($data, 'schedules/index', 'Bus Schedules');
    }

    public function addSchedule() {
        $schedules = $this->common_query();
        $reservation = array();
        $j = 0;
        foreach ($schedules as $schedule) {
            $route = (array) $this->select->getSingleRecordWhere('route', 'bus_id', $schedule->id);
            $start_point = (array) $this->select->getSingleRecord('destination', $route['start_point']);
            $end_point = (array) $this->select->getSingleRecord('destination', $route['end_point']);
            $reservation[$j] = array('id' => $schedule->id, 'type' => $schedule->type, 'bus_number' => $schedule->bus_number, "departure_date" => $schedule->departure_date, "departure_time" => $schedule->departure_time, "reserved_seat" => $schedule->reserved_seat, "reservation_id" => $schedule->reservation_id, "from" => $start_point['destination'], 'to' => $end_point['destination'], "route_id" => $route['id']);
            $j++;
        }
        $data['reservations'] = $reservation;
        var_dump($reservation);
        $this->loadView($data, "schedules/create", "Add Schedule");
    }

    public function createBus() {
        $this->form_value_init(); // initalize form value
        $data_table = $this->array_maker_table(); // create array with book
        $bus_id = $this->insert->insert_return_id($data_table, "bus");
        if ($this->insert->insert_single_row(array("start_point" => $this->start_point, "end_point" => $this->end_point, "bus_id" => $bus_id), "route")) {
            $this->session->set_flashdata('message', 'Added ' . ucfirst($this->type) . ' bus !!!');
            redirect(base_url() . 'buses/index', 'refresh');
        } else {
            $this->session->set_flashdata('message', 'Unable to add ' . ucfirst($this->type) . '!!!');
            redirect(base_url() . 'buses/index', 'refresh');
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
            redirect(base_url() . 'buses/index', 'refresh');
        } else {
            $this->session->set_flashdata('message', 'Unable to update ' . ucfirst($this->type) . ' bus!!!');
            redirect(base_url() . 'buses/index', 'refresh');
        }
    }

    public function deleteBus($id) {
        $bus = (array) $this->select->getSingleRecord('bus', $id);
        if ($this->delete->deleteSingleCondition("route", "bus_id", $id)) {
            $this->delete->deleteSingleCondition("bus", "id", $id);
            $this->session->set_flashdata('message', ucfirst($bus['type']) . ' bus deleted successfully!!!');
            redirect(base_url() . 'buses/index', 'refresh');
        } else {
            $this->session->set_flashdata('message', 'Unable to delete ' . ucfirst($bus['type']) . ' bus!!!');
            redirect(base_url() . 'buses/index', 'refresh');
        }
    }

    public function loadView($data, $page_name, $title) {
        $data['title'] = ucfirst($title);
        $data['user'] = $this->select->getSingleRecordWhere('user', 'id', $this->session->userdata('user_id'));
        $this->load->view('member/template/header', $data);
        $this->load->view('member/' . $page_name, $data);
        $this->load->view('member/template/footer', $data);
    }

}
