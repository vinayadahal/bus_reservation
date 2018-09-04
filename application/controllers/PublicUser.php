<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PublicUser extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->database();
        $this->load->model('select');
        $this->load->model('insert');
        $this->load->model('update');
        $this->load->helper('url'); // Helps to get base url defined in config.php
        $this->load->library('session'); // starts session
        $this->load->library('commons');
//        $this->load->library('generator');
//        $this->generator->generate_pdf();
    }

    public function index() {
        $this->session->sess_destroy();
        $data['places'] = $this->select->getAllFromTable("destination");
        $data['agencies'] = $this->commons->travel_agency_list($this->select);
//        $data['agencies'] = $this->select->getAllFromTable("travel_agency");
        $this->loadView("index", "home", $data);
    }

    public function showBuses() {
        $this->session->unset_userdata('buses');
        $start_point = $this->input->post("start_point");
        $end_point = $this->input->post("destination");
        $date = $this->input->post("date");
        $buses_id = $this->select->getAllFromTableWhere("route", array("start_point", "end_point"), array($start_point, $end_point), "", "");
        if (!empty($buses_id)) {
            $data['buses'] = $this->bus_array_maker($buses_id, $date);
        } else {
            $data['buses'] = array("no records to display");
        }
        $data["from"] = $this->route_details($start_point);
        $data["to"] = $this->route_details($end_point);
        $this->session->set_userdata('buses', $data['buses']);
        $this->session->set_userdata('from', $data['from']->destination);
        $this->session->set_userdata('to', $data['to']->destination);
        $this->loadView("buses", "search result", $data);
    }

    public function route_details($id) {
        return $this->select->getSingleRecordWhere("destination", "id", $id);
    }

    public function bus_array_maker($buses_id, $date) {
        $buses = array();
        $i = $j = 0;
        foreach ($buses_id as $bus_id) {
            $col = array("bus.id", "bus.type", "bus.total_seat", "bus.bus_number", "bus.seat_layout", "travel_agency.name as travel_agency", "travel_agency.address as address", "travel_agency.contact as contact", "reservation.departure_date as departure_date", "reservation.departure_time as departure_time", "reservation.reserved_seat as reserved_seat", "reservation.id as reserve_id", "bus.price as price");
            $t1 = 'reservation';
            $t2 = 'bus';
            $t3 = 'travel_agency';
            $t1_c1 = "bus_id";
            $t1_c2 = "departure_date";
            $t2_c1 = $t3_c = "id"; // merged due to same value
            $t2_c2 = "travel_agency_id";
            $all_bus = $this->select->getAllRecordJoinThreeTbl($col, $t1, $t2, $t3, $t1_c1, $t1_c2, $t2_c1, $t2_c2, $t3_c, $bus_id->bus_id, $date, "reservation.id");
            foreach ($all_bus as $bus) {
                $avail_seat = $bus->total_seat - count(explode(",", $bus->reserved_seat));
                $buses[$j] = array('id' => $bus->id, 'type' => $bus->type, 'total_seat' => $bus->total_seat, 'bus_number' => $bus->bus_number, 'seat_layout' => $bus->bus_number, 'travel_agency' => $bus->travel_agency, 'address' => $bus->address, 'contact' => $bus->contact, 'departure_date' => $bus->departure_date, 'departure_time' => $bus->departure_time, "avail_seat" => $avail_seat, "price" => $bus->price, "reserved_seat" => $bus->reserved_seat, "reserve_id" => $bus->reserve_id);
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
            $data['bus_details'] = $this->select->getSingleRecordWhere("reservation", "id", $bus['bus_details'][$id]['reserve_id']);
        }
        if (!empty($this->session->userdata('seats'))) {
            $data['selected_seat'] = $this->session->userdata('seats');
        }
        $data['bus_type'] = $bus['bus_details'][$id]['type'];
        $data['details'] = $bus['bus_details'][$id];
        $data["from"] = $this->session->userdata('from');
        $data["to"] = $this->session->userdata('to');
        $this->session->set_userdata('bus_details', $data['details']);
        $this->loadView("seats", "choose seats", $data);
    }

    public function setSeatSession() {
        $all_seat_array = $this->input->get("all");
        $selected_seat = $this->input->get("selected");
        $all_seat_string = implode(",", $all_seat_array);
        $selected_seat_string = implode(",", $selected_seat);
        $this->session->set_userdata('seats', $all_seat_string); // this should be pushed to the database
        $this->session->set_userdata('selected_seats', $selected_seat_string); // this for gui purpose
    }

    public function confirmSeat() {
        $bus_details = $this->session->userdata('bus_details');
        $res_details = $this->select->getSingleRecordWhere("reservation", "id", $bus_details['reserve_id']);
        $reserved_seat = explode(",", $res_details->reserved_seat);
        $allSeatArray = explode(",", $this->session->userdata('seats'));
        $selected_seat_array = array_diff($allSeatArray, $reserved_seat);
        $data['total_price'] = count($selected_seat_array) * $bus_details['price'];
        $data['seat_details'] = $selected_seat_array;
        $data['details'] = $bus_details;
        $data["from"] = $this->session->userdata('from');
        $data["to"] = $this->session->userdata('to');
        $this->loadView("confirm_seat", "confirm seat", $data);
    }

    public function bookSeat() {
        $first_name = $this->input->post("fname");
        $last_name = $this->input->post("lname");
        $address = $this->input->post("address");
        $email = $this->input->post("email");
        $contact = $this->input->post("contact");
        $bus_details = $this->session->userdata('bus_details');
        $res_details = $this->select->getSingleRecordWhere("reservation", "id", $bus_details['reserve_id']);
        $reserved_seat = explode(",", $res_details->reserved_seat);
        $allSeatArray = explode(",", $this->session->userdata('seats')); // update to db reservation table
        $selected_seat_array = array_diff($allSeatArray, $reserved_seat); // to get calculation and payment
        $total_price = count($selected_seat_array) * $bus_details['price'];
        $random_code = $this->generateRandomString();
        $from = $this->session->userdata('from');
        $to = $this->session->userdata('to');
        $status = $this->insertData($first_name, $last_name, $address, $contact, $email, implode(",", $selected_seat_array), $total_price, $random_code, $bus_details['reserve_id'], $bus_details['id'], $from, $to);
        if ($status) {
            $this->showTicket($random_code);
        } else {
            echo "error page";
        }
    }

    public function showTicket($ticket_code) {
        $ticket_detail = $this->select->getSingleRecordWhere("tickets", "unique_id", $ticket_code);
        $reservation_detail = $this->select->getSingleRecordWhere("reservation", "id", $ticket_detail->reservation_id);
        $bus_detail = $this->select->getSingleRecordWhere("bus", "id", $ticket_detail->bus_id);
        $agency_detail = $this->select->getSingleRecordWhere("travel_agency", "id", $bus_detail->travel_agency_id);
        $data['ticket_details'] = $ticket_detail;
        $data['reservation_details'] = $reservation_detail;
        $data['bus_details'] = $bus_detail;
        $data['agency_details'] = $agency_detail;
        $data['ticket_id'] = $ticket_code;
        $this->loadView("ticket", "ticket detail", $data);
    }

    public function insertData($first_name, $last_name, $address, $contact, $email, $seats, $total_price, $unique_id, $reservation_id, $bus_id, $from, $to) {
        $data_ticket_table = array("first_name" => ucfirst($first_name), "last_name" => ucfirst($last_name), "address" => ucwords($address), "contact" => $contact, "email" => $email, "seats" => $seats, "total_price" => $total_price, "unique_id" => $unique_id, "reservation_id" => $reservation_id, "bus_id" => $bus_id);
        $new_ticket_id = $this->insert->insert_return_id($data_ticket_table, "tickets");
        if (!empty($new_ticket_id)) {
            $this->update->updateSingleCondition(array("reserved_seat" => $this->session->userdata('seats')), "reservation", "id", $reservation_id);
            return true;
        } else {
            return false;
        }
    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function loadView($php_file, $page_title, $data = null) {
        $data['title'] = ucfirst($page_title);
        $this->load->view('public/template/header', $data);
        if ($page_title == "home") {
            $this->load->view('public/template/slider', $data);
        }
        $this->load->view('public/' . $php_file, $data);
        $this->load->view('public/template/footer', $data);
    }

}
