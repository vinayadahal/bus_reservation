<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Pdf extends TCPDF {

    public function __construct() {
        parent::__construct();
    }

    public function Header() {
        $this->SetFont('helvetica', 'B', 25);
        $this->Cell(0, 30, "Bus Reservation Ticket", 0, false, 'C', 0, '', 0, false, 'M', 'B');
    }

}
