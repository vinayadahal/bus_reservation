<?php
$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false, true);
$pdf->Header();
$pdf->SetTitle($agency_details->name);
$pdf->SetSubject('TCPDF Tutorial');

$pdf->SetFont('helvetica', '', 10, '', true);
$pdf->AddPage();
$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
$seat_details = "";
$seats = explode(',', $ticket_details->seats);
foreach ($seats as $seat) {
    $seat_details .= "<tr><td>$seat</td><td>Rs. $bus_details->price /-</td></tr>";
}

$html = <<<EX
<div style="width: 595px;height: 842; margin: 0 auto;font-family: sans-serif;">
    <h2>Passenger Details</h2>
    <div style="border-top:1px solid black; margin-bottom: 10px;"></div>
    <table style="width: 100%;" border="1" cellspacing="0" cellpadding="5">
        <tr>
            <th style="text-align: left; background-color: #ccc;">Passenger Name</th>
            <th style="text-align: left; background-color: #ccc;">Contact Number</th>
        </tr>
        <tr>
            <td>$ticket_details->first_name $ticket_details->last_name</td>
            <td>$ticket_details->contact</td>
        </tr>
        <tr>
            <th style="text-align: left; background-color: #ccc;">Ticket Code</th>
            <th style="text-align: left; background-color: #ccc;">Seats</th>
        </tr>
        <tr>
            <td>$ticket_id</td>
            <td>$ticket_details->seats</td>
        </tr>
    </table>
    <h2>Travel Details</h2>
    <div style="border-top:1px solid black; margin-bottom: 10px;"></div>
    <table style="width: 100%;" border="1" cellspacing="0" cellpadding="5">
        <tr>
            <th style="text-align: left; background-color: #ccc;">From</th>
            <th style="text-align: left; background-color: #ccc;">To</th>
        </tr>
        <tr>
            <td style="padding: 8px;">$ticket_details->from</td>
            <td style="padding: 8px;">$ticket_details->to</td>
        </tr>
        <tr>
            <th style="text-align: left;background-color: #ccc;">Departure Date</th>
            <th style="text-align: left;background-color: #ccc;">Departure Time</th>
        </tr>
        <tr>
            <td>$reservation_details->departure_date</td>
            <td>$reservation_details->departure_time</td>
        </tr>
    </table>
    <h1>Bus Details</h1>
    <div style="border-top:1px solid black; margin-bottom: 10px;"></div>
    <table style="width: 100%;" border="1" cellspacing="0" cellpadding="5">
        <tr>
            <th style="text-align: left;background-color: #ccc;">Operator</th>
            <th style="text-align: left;background-color: #ccc;">Contact</th>
        </tr>
        <tr>
            <td>$agency_details->name</td>
            <td>$agency_details->contact</td>
        </tr>
        <tr>
            <th style="text-align: left; background-color: #ccc;">Bus Number</th>
            <th style="text-align: left; background-color: #ccc;">Bus Type</th>
        </tr>
        <tr>
            <td>$bus_details->bus_number</td>
            <td>$bus_details->type</td>
        </tr>
    </table>
    <h2>Payment Details</h2>
    <div style="border-top:1px solid black; margin-bottom: 10px;"></div>
    <table style="width: 100%;" border="1" cellspacing="0" cellpadding="5">
        <tr>
            <th style="text-align: left;background-color: #ccc;">Seats</th>
            <th style="text-align: left;background-color: #ccc;">Amount Per Seat</th>
        </tr>
        $seat_details
       <tr>
            <td>Total Amount (Paid)</td>
            <td>Rs. $ticket_details->total_price /-</td>
        </tr>
    </table>
    <br>
    <div style="margin: 0 auto;">
        <p>
            <em><strong>Notice:</strong></em> Please keep the ticket ID safe for future reference. This will be cross validated before entry to the bus.
        </p>
        <br>
    </div>
</div>
EX;
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
$pdf->Output($ticket_id . '.pdf', 'I');
