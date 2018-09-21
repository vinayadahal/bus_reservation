<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Commons {

    public function pageDataLimiter($page, $dataPerPage) {
        if ($page > 1) {
            $page = $page - 1;
            return ($dataPerPage * $page);
        } else {
            return 0;
        }
    }

    public function getTicket($obj_select, $ticket_code) {
        $ticket_detail = $obj_select->getSingleRecordWhere("tickets", "unique_id", $ticket_code);
        if (empty($ticket_detail)) {
            show_error("Sorry, We are unable the find the ticket with ticket ID:<b> $ticket_code </b>in our database. Please contact your respective bus agency for futher details.<br><br><div style='padding-right:20px;text-align: right;'>- Bus Reservation</div>", '404', $heading = 'No Ticket Found');
            return true;
        }
        $reservation_detail = $obj_select->getSingleRecordWhere("reservation", "id", $ticket_detail->reservation_id);
        $bus_detail = $obj_select->getSingleRecordWhere("bus", "id", $ticket_detail->bus_id);
        $agency_detail = $obj_select->getSingleRecordWhere("travel_agency", "id", $bus_detail->travel_agency_id);
        return array('ticket_details' => $ticket_detail, 'reservation_details' => $reservation_detail, 'bus_details' => $bus_detail, 'agency_details' => $agency_detail, 'ticket_id' => $ticket_code);
    }

    public function travel_agency_list($obj_select) {
        return $obj_select->getAllFromTable("travel_agency");
    }

}
