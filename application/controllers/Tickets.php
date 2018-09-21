<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends CI_Controller {

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
        if (!empty($this->input->post('place_id')) && null !== $this->input->post('place_id')) {
            $this->place_id = $this->input->post('place_id');
        }
    }

    public function array_maker_post_table() {
        return array("destination" => $this->name);
    }

    public function index($page = null) {
        $data['message'] = $this->session->flashdata('message');
        $TotalCount = $this->select->getTotalCount("tickets");
        $DataPerPage = 8;
        $data['num_pages'] = ceil($TotalCount / $DataPerPage);
        $start = $this->commons->pageDataLimiter($page, $DataPerPage);
        $col = array('tickets.id', 'tickets.first_name', 'tickets.last_name', 'tickets.address',
            'tickets.contact', 'tickets.email', 'tickets.seats', 'tickets.total_price',
            'tickets.unique_id', 'tickets.reservation_id', 'tickets.bus_id',
            'tickets.from', 'tickets.to', 'reservation.departure_time', 'reservation.departure_date',
            'reservation.reserved_seat');
        $t_name1 = 'tickets';
        $t_name2 = 'reservation';
        $t_1_col = 'reservation_id';
        $t_2_col = 'id';
        $data['tickets'] = (array) $this->select->getAllRecordInnerJoinNoCondition($col, $t_name1, $t_name2, $t_1_col, $t_2_col, $DataPerPage, $start);
        $this->loadView($data, 'tickets/index', 'Tickets');
    }

    public function searchTicket() {
        $ticket_code = $this->input->get('keyword');
        $col = array('tickets.id', 'tickets.first_name', 'tickets.last_name', 'tickets.address',
            'tickets.contact', 'tickets.email', 'tickets.seats', 'tickets.total_price',
            'tickets.unique_id', 'tickets.reservation_id', 'tickets.bus_id',
            'tickets.from', 'tickets.to', 'reservation.departure_time', 'reservation.departure_date',
            'reservation.reserved_seat');
        $t_name1 = 'tickets';
        $compare_cols = array('unique_id', 'first_name', 'contact', 'email');
        $keyword = $ticket_code;
        $t_name2 = 'reservation';
        $t_1_col = 'reservation_id';
        $t_2_col = 'id';
        $data['tickets'] = (array) $this->select->searchRecordJoinWhere($col, $t_name1, $compare_cols, $keyword, $t_name2, $t_1_col, $t_2_col);
        $this->loadView($data, 'tickets/index', 'Tickets');
    }

    public function deleteTicket($id) {
        $ticket = (array) $this->select->getSingleRecord('tickets', $id);
        $reservation = (array) $this->select->getSingleRecord('reservation', $ticket['reservation_id']);
        $ticket_seats = explode(',', $ticket['seats']);
        $reservation_seats = explode(",", $reservation['reserved_seat']);
        $final_seat_array = array_diff($reservation_seats, $ticket_seats);
        $final_seat = implode(",", $final_seat_array);
        if ($this->update->updateSingleCondition(array("reserved_seat" => $final_seat), "reservation", "id", $reservation['id'])) {
            $this->delete->deleteSingleCondition("tickets", "id", $id);
            $this->session->set_flashdata('message', 'Ticket of ' . ucwords($ticket['first_name'] . " " . $ticket['last_name']) . ' deleted successfully for ' . $reservation['departure_date'] . ' !!!');
        } else {
            $this->session->set_flashdata('message', 'Unable to deleteTicket of ' . ucwords($ticket['first_name'] . " " . $ticket['last_name']) . '!!!');
        }
        redirect(base_url() . 'member/tickets', 'refresh');
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
