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
        $data['places'] = $this->select->getAllFromTable("destination");
        $this->loadView("index", "home", $data);
    }

    public function showBuses() {
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
        $this->loadView("buses", "search result", $data);
    }

    public function bus_array_maker($buses_id, $date) {
        $buses = array();
        $i = $j = 0;
        foreach ($buses_id as $bus_id) {
            $col = array("bus.id", "bus.type", "bus.total_seat", "bus.bus_number", "bus.seat_layout", "travel_agency.name as travel_agency", "travel_agency.address as address", "travel_agency.contact as contact", "reservation.departure_date as departure_date", "reservation.departure_time as departure_time", "reservation.reserved_seat as reserved_seat");
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
                $buses[$j] = array('id' => $bus->id, 'type' => $bus->type, 'total_seat' => $bus->total_seat, 'bus_number' => $bus->bus_number, 'seat_layout' => $bus->bus_number, 'travel_agency' => $bus->travel_agency, 'address' => $bus->address, 'contact' => $bus->contact, 'departure_date' => $bus->departure_date, 'departure_time' => $bus->departure_time, "avail_seat" => $avail_seat);
                $j++;
            }
            $i++;
        }
        return $buses;
    }

    public function seats() {
        echo 'Bla';
        $id = $this->uri->segment(2);
        $date = $this->uri->segment(3);
        $time = $this->uri->segment(4);
        echo $id, $date, $time;

        $this->select->getSingleWhereMultiValue("");
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
