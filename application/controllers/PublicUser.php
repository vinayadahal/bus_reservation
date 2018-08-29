<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PublicUser extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->database();
        $this->load->model('select');
        $this->load->helper('url'); // Helps to get base url defined in config.php
        $this->load->library('session'); // starts session
    }

    public function index() {
        $this->session->sess_destroy();
        $data['places'] = $this->select->getAllFromTable("destination");
        $this->loadView("index", "home", $data);
    }

    public function showBuses() {
        $this->session->unset_userdata('buses');
        $start_point = $this->input->post("start_point");
        $end_point = $this->input->post("destination");
        $date = $this->input->post("date");
//        $this->output->enable_profiler(TRUE);
//        date("Y-m-d")
        $buses_id = $this->select->getAllFromTableWhere("route", array("start_point", "end_point"), array($start_point, $end_point), "", "");
        if (!empty($buses_id)) {
            $data['buses'] = $this->bus_array_maker($buses_id, $date);
//            $this->session->set_userdata('user_id', $result->id);
        } else {
            $data['buses'] = array("no records to display");
        }
        $this->session->set_userdata('buses', $data['buses']);

//        var_dump($data);
        $this->loadView("buses", "search result", $data);
    }

    public function bus_array_maker($buses_id, $date) {
        $buses = array();
        $i = $j = 0;
        foreach ($buses_id as $bus_id) {
            $col = array("bus.id", "bus.type", "bus.total_seat", "bus.bus_number", "bus.seat_layout", "travel_agency.name as travel_agency", "travel_agency.address as address", "travel_agency.contact as contact", "reservation.departure_date as departure_date", "reservation.departure_time as departure_time", "reservation.reserved_seat as reserved_seat", "bus.price as price");
            $t1 = 'reservation';
            $t2 = 'bus';
            $t3 = 'travel_agency';
            $t1_c1 = "bus_id";
            $t1_c2 = "departure_date";
            $t2_c1 = $t3_c = "id"; // merged due to same value
            $t2_c2 = "travel_agency_id";
            $all_bus = $this->select->getAllRecordJoinThreeTbl($col, $t1, $t2, $t3, $t1_c1, $t1_c2, $t2_c1, $t2_c2, $t3_c, $bus_id->bus_id, $date);
            foreach ($all_bus as $bus) {
                $avail_seat = $bus->total_seat - count(explode(",", $bus->reserved_seat));
                $buses[$j] = array('id' => $bus->id, 'type' => $bus->type, 'total_seat' => $bus->total_seat, 'bus_number' => $bus->bus_number, 'seat_layout' => $bus->bus_number, 'travel_agency' => $bus->travel_agency, 'address' => $bus->address, 'contact' => $bus->contact, 'departure_date' => $bus->departure_date, 'departure_time' => $bus->departure_time, "avail_seat" => $avail_seat, "price" => $bus->price);
                $j++;
            }
            $i++;
        }
        return $buses;
    }

    public function seats($id) {
        $bus['bus_details'] = $this->session->userdata('buses');
        if (empty($bus['bus_details'][$id])) {
            echo "Someone is getting curious :P";
        } else {
            $data['bus_details'] = $this->select->getSingleRecordWhere("reservation", "bus_id", $bus['bus_details'][$id]['id']);
        }
        if (!empty($this->session->userdata('seats'))) {
            $data['selected_seat'] = $this->session->userdata('seats');
        }
        $data['bus_type'] = $bus['bus_details'][$id]['type'];
        $data['details'] = $bus['bus_details'][$id];
        $this->session->set_userdata('bus_details', $data['details']);
        $this->loadView("seats", "choose seats", $data);
    }

    public function setSeatSession() {
        $all_seat_array = $this->input->get("all");
        $selected_seat = $this->input->get("selected");
        if (!empty($all_seat_array) && !empty($selected_seat)) {
            $all_seat_string = implode(",", $all_seat_array);
            $selected_seat_string = implode(",", $selected_seat);
            $this->session->set_userdata('seats', $all_seat_string); // this should be pushed to the database
            $this->session->set_userdata('selected_seats', $selected_seat_string); // this for gui purpose
        }
    }

    public function confirmSeat() {
        $bus_details = $this->session->userdata('bus_details');
        $selected_seat_array = explode(",", $this->session->userdata('selected_seats'));
        $data['total_price'] = count($selected_seat_array) * $bus_details['price'];
        $data['seat_details'] = $selected_seat_array;
        $data['details'] = $bus_details;
        $this->loadView("confirm_seat", "confirm seat", $data);
    }

    public function loadView($php_file, $page_title, $data = null) {
        $data['title'] = ucfirst($page_title);
        $this->load->view('template/header', $data);
        if ($page_title == "home") {
            $this->load->view('template/slider', $data);
        }
        $this->load->view('public/' . $php_file, $data);
        $this->load->view('template/footer', $data);
    }

}
