<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Buses extends CI_Controller {

    private $start_point;
    private $end_ppint;
    private $author;
    private $post_id;

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
        $this->user_id = $this->session->userdata('user_id');
        $this->book_name = $this->input->post('book_name');
        $this->author = $this->input->post('author');
        if (!empty($this->input->post('post_id')) && null !== $this->input->post('post_id')) {
            $this->post_id = $this->input->post('post_id');
        }
    }

    public function array_maker_post_table() {
        return array("book_name" => $this->book_name, "author" => $this->author, "user_id" => $this->user_id);
    }

    //        $this->output->enable_profiler(TRUE);
    public function index($page = null) {
        $data['message'] = $this->session->flashdata('message');
        $TotalCount = $this->select->getTotalCount("bus", 'travel_agency_id', $this->session->userdata('agency_id'));
        $DataPerPage = 8;
        $data['num_pages'] = ceil($TotalCount / $DataPerPage);
        $start = $this->commons->pageDataLimiter($page, $DataPerPage);
        $all_buses = (array) $this->select->getAllFromTableWhere('bus', 'travel_agency_id', $this->session->userdata('agency_id'), $DataPerPage, $start);
        $buses = array();
        $j = 0;
        foreach ($all_buses as $bus) {
            $route = (array) $this->select->getSingleRecord('route', $bus->id);
            if (!empty(array_filter($route))) {
                $start_point = (array) $this->select->getSingleRecord('destination', $route['start_point']);
                $end_point = (array) $this->select->getSingleRecord('destination', $route['end_point']);
                $buses[$j] = array('id' => $bus->id, 'type' => $bus->type, 'total_seat' => $bus->total_seat, 'bus_number' => $bus->bus_number, "price" => $bus->price, "from" => $start_point['destination'], 'to' => $end_point['destination']);
            } else {
                $buses[$j] = array('id' => $bus->id, 'type' => $bus->type, 'total_seat' => $bus->total_seat, 'bus_number' => $bus->bus_number, "price" => $bus->price);
            }
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

    public function createPost() {
        $this->form_value_init(); // initalize form value
        $data_post_table = $this->array_maker_post_table(); // create array with book
        if ($this->insert->insert_single_row($data_post_table, "posts")) {
            $this->session->set_flashdata('message', 'Added post for ' . ucfirst($this->book_name) . '!!!');
            redirect(base_url() . 'member/my-posts', 'refresh');
        } else {
            $this->session->set_flashdata('message', 'Unable to add post for ' . ucfirst($this->book_name) . '!!!');
            redirect(base_url() . 'member/my-posts', 'refresh');
        }
    }

    public function editPost($id) {
        $data['books'] = $this->commons->matchingBooks($this->select);
        $data['post'] = (array) $this->select->getSingleRecord('posts', $id);
        $data['post_id'] = $id;
        $this->loadView($data, "posts/edit", "Edit Post");
    }

    public function updatePost() {
        $this->form_value_init(); // initalize form value
        $data_post_table = $this->array_maker_post_table(); // create array with book
        if ($this->update->updateSingleCondition($data_post_table, "posts", "id", $this->post_id)) {
            $this->session->set_flashdata('message', 'Updated post for ' . ucfirst($this->book_name) . '!!!');
            redirect(base_url() . 'member/my-posts', 'refresh');
        } else {
            $this->session->set_flashdata('message', 'Unable to update post for ' . ucfirst($this->book_name) . '!!!');
            redirect(base_url() . 'member/my-posts', 'refresh');
        }
    }

    public function deletePost($id) {
        $post = (array) $this->select->getSingleRecord('posts', $id);
        if ($this->delete->deleteSingleCondition("posts", "id", $id)) {
            $this->session->set_flashdata('message', 'Post for ' . ucfirst($post['book_name']) . ' deleted successfully!!!');
            redirect(base_url() . 'member/my-posts', 'refresh');
        } else {
            $this->session->set_flashdata('message', 'Unable to delete post for ' . ucfirst($post['book_name']) . '!!!');
            redirect(base_url() . 'member/my-posts', 'refresh');
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
