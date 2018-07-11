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

    public function loadView($php_file, $page_title, $data = null) {
        $data['title'] = ucfirst($page_title);
        $this->load->view('template/header', $data);
        $this->load->view('template/slider', $data);
        $this->load->view('public/' . $php_file, $data);
        $this->load->view('template/footer', $data);
    }

}
