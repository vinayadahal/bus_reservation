<?php
ob_start();
$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false, true);
//$pdf->SetTitle('Bus Ticket');
//$pdf->SetHeaderMargin(30);
//$pdf->SetTopMargin(20);
//$pdf->setFooterMargin(20);
//$pdf->SetAutoPageBreak(true);
//$pdf->SetAuthor('Author');
//$pdf->SetDisplayMode('real', 'default');
//
$pdf->SetFont('dejavusans', '', 14, '', true);
$pdf->AddPage();
$pdf->Write(5, 'Bus Ticket Details');
//$pdf->Write(1, 'Passenger Details');
//$pdf->Write(1, 'Name:' . $ticket_details->first_name . " " . $ticket_details->last_name);
ob_end_clean();
$pdf->Output($ticket_id . '.pdf', 'I');
?>



<table id="bus_details" style="width: 20%">
    <tr>
        <th>Ticket ID:</th>
        <td><?php echo $ticket_id; ?></td>
    </tr>
</table>
<h1>Passenger Details</h1>
<hr>
<br>
<table id="bus_details">
    <tr>
        <th>Passenger Name</th>
        <th>Contact Number</th>
    </tr>
    <tr>
        <td><?php echo $ticket_details->first_name . " " . $ticket_details->last_name; ?></td>
        <td><?php echo $ticket_details->contact; ?></td>
    </tr>
    <tr>
        <th>Ticket Code</th>
        <th>Seats</th>
    </tr>
    <tr>
        <td><?php echo $ticket_id; ?></td>
        <td><?php echo $ticket_details->seats; ?></td>
    </tr>
</table>
<h1>Travel Details</h1>
<hr>
<br>
<table id="bus_details">
    <tr>
        <th>From</th>
        <th>To</th>
    </tr>
    <tr>
        <td><?php echo $ticket_details->from; ?></td>
        <td><?php echo $ticket_details->to; ?></td>
    </tr>
    <tr>
        <th>Departure Date</th>
        <th>Departure Time</th>
    </tr>
    <tr>
        <td><?php echo $reservation_details->departure_date; ?></td>
        <td><?php echo $reservation_details->departure_time; ?></td>
    </tr>
</table>
<h1>Bus Details</h1>
<hr>
<br>
<table id="bus_details">
    <tr>
        <th>Operator</th>
        <th>Contact</th>
    </tr>
    <tr>
        <td><?php echo $agency_details->name; ?></td>
        <td><?php echo $agency_details->contact; ?></td>
    </tr>
</table>
<table id="bus_details">
    <tr>
        <th>Bus Number</th>
        <th>Bus Type</th>
    </tr>
    <tr>
        <td><?php echo $bus_details->bus_number; ?></td>
        <td><?php echo $bus_details->type; ?></td>
    </tr>
</table>

<h1>Payment Details</h1>
<hr>
<br>
<table id="bus_details">
<!--        <tr>
        <th colspan="2">Payment Information</th>
    </tr>-->
    <tr>
        <th>Seats</th>
        <th>Amount</th>
    </tr>

    <?php
    $seats = explode(',', $ticket_details->seats);
    foreach ($seats as $seat) {
        ?>
        <tr>
            <td><?php echo $seat; ?></td>
            <td><?php echo $bus_details->price; ?></td>
        </tr>
    <?php } ?>

    <tr>
        <td>Total Amount (Paid)</td>
        <td>Rs. <?php echo $ticket_details->total_price; ?> /-</td>
    </tr>
</table>

<br>
<div style="margin: 0 auto;">
    <p>
        <em><strong>Notice:</strong></em> Please keep the ticket ID safe for future reference. This will be cross validated before entry to the bus.
    </p>
    <br>
</div>