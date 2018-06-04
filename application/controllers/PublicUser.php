<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PublicUser extends CI_Controller {

    public function index() {
        $this->load->view('public/index.php');
    }

}
