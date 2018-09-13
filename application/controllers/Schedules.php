<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Schedules extends CI_Controller {

    private $time;
    private $date;
    private $bus_id;
    private $reservation_id;

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
        $this->time = $this->input->post('time');
        $this->date = $this->input->post('date');
        $this->bus_id = $this->input->post('bus_id');
        if (!empty($this->input->post('reservation_id')) && null !== $this->input->post('reservation_id')) {
            $this->reservation_id = $this->input->post('reservation_id');
        }
    }

    public function array_maker_table() {
        return array("departure_time" => $this->time, "departure_date" => $this->date, "bus_id" => $this->bus_id);
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
            if (date("Y-m-d") > $schedule->departure_date) {
                continue;
            }
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
        $col = array("route.start_point", "route.end_point", "bus.id", "bus.bus_number", "bus.type");
        $t_name1 = "bus";
        $t_name2 = "route";
        $t_1_col = "id";
        $t_2_col = "bus_id";
        $cond_col = "travel_agency_id";
        $cond_value = $this->session->userdata('agency_id');
        $schedules = $this->select->getAllRecordInnerJoin($col, $t_name1, $t_name2, $t_1_col, $t_2_col, $cond_col, $cond_value);
        $reservation = array();
        $j = 0;
        foreach (array_filter($schedules) as $schedule) {
            $route = (array) $this->select->getSingleRecordWhere('route', 'bus_id', $schedule->id);
            $start_point = (array) $this->select->getSingleRecord('destination', $route['start_point']);
            $end_point = (array) $this->select->getSingleRecord('destination', $route['end_point']);
            $reservation[$j] = array('id' => $schedule->id, 'type' => $schedule->type, 'bus_number' => $schedule->bus_number, "from" => $start_point['destination'], 'to' => $end_point['destination'], "route_id" => $route['id']);
            $j++;
        }
        $data['reservations'] = $reservation;
        $this->loadView($data, "schedules/create", "Add Schedule");
    }

    public function createSchedule() {
        $this->form_value_init(); // initalize form value
        $data_table = $this->array_maker_table(); // create array with book
        if ($this->insert->insert_return_id($data_table, "reservation")) {
            $this->session->set_flashdata('message', 'Added schedule for bus !!!');
            redirect(base_url() . 'schedules/index', 'refresh');
        } else {
            $this->session->set_flashdata('message', 'Unable to add schedule for bus!!!');
            redirect(base_url() . 'schedules/index', 'refresh');
        }
    }

    public function editSchedule($id) {
        $data['reservation'] = $this->select->getSingleRecord("reservation", $id);
        $this->loadView($data, "schedules/edit", "Edit Schedule");
    }

    public function updateSchedule() {
        $this->form_value_init(); // initalize form value
        $data_table = $this->array_maker_table(); // create array with book
        if ($this->update->updateSingleCondition($data_table, "reservation", "id", $this->reservation_id)) {
            $this->session->set_flashdata('message', 'Updated schedule for bus!!!');
            redirect(base_url() . 'schedules/index', 'refresh');
        } else {
            $this->session->set_flashdata('message', 'Unable to update schedule for bus!!!');
            redirect(base_url() . 'schedules/index', 'refresh');
        }
    }

    public function deleteSchedule($id) {
        if ($this->delete->deleteSingleCondition("reservation", "id", $id)) {
            $this->session->set_flashdata('message', 'Schedule for bus deleted successfully!!!');
            redirect(base_url() . 'schedules/index', 'refresh');
        } else {
            $this->session->set_flashdata('message', 'Unable to delete schedule for bus!!!');
            redirect(base_url() . 'schedules/index', 'refresh');
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
