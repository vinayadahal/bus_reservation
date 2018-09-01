<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->database();
        $this->load->model('select');
        $this->load->model('insert');
        $this->load->model('update');
        $this->load->helper('url'); // Helps to get base url defined in config.php
        $this->load->library('session'); // starts session
//        $this->load->library('generator');
//        $this->generator->generate_pdf();
    }

    public function index() {
//        $this->session->sess_destroy();
//        $data['places'] = $this->select->getAllFromTable("destination");
//        $data['agencies'] = $this->select->getAllFromTable("travel_agency");
        $data['name'] = "bla";
        $this->loadView("index", "home", $data);
    }

    public function loadView($php_file, $page_title, $data = null) {
        $data['title'] = ucfirst($page_title);
        $this->load->view('admin/template/header', $data);
//        if ($page_title == "home") {
//            $this->load->view('template/slider', $data);
//        }
        $this->load->view('admin/' . $php_file, $data);
        $this->load->view('admin/template/footer', $data);
    }

}
