<div class="bus_search_wrap" >
    <h1>Ticket Details</h1>
    <hr>
    <br>
    <table id="bus_details" style="float:right;width: 20%">
        <tr>
            <th>Ticket ID:</th>
            <td><?php echo $ticket_id; ?></td>
        </tr>
    </table>
    <br><br>
    <table id="bus_details">
        <tr>
            <th>From</th>
            <th>To</th>
            <th>Departure Date</th>
            <th>Departure Time</th>
        </tr>
        <tr>
            <td><?php echo $ticket_details->from; ?></td>
            <td><?php echo $ticket_details->to; ?></td>
            <td><?php echo $reservation_details->departure_date; ?></td>
            <td><?php echo $reservation_details->departure_time; ?></td>
        </tr>
    </table>
    <br><br>
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
    <br><br>
    <table id="bus_details">
        <tr>
            <th>Passenger Name</th>
            <th>Ticket Code</th>
            <th>Contact Number</th>
            <th>Seats</th>
        </tr>
        <tr>
            <td><?php echo $ticket_details->first_name . " " . $ticket_details->last_name; ?></td>
            <td><?php echo $ticket_id; ?></td>
            <td><?php echo $ticket_details->contact; ?></td>
            <td><?php echo $ticket_details->seats; ?></td>
        </tr>
    </table>
    <br><br>
    <table id="bus_details">
        <tr>
            <th>Operator</th>
            <th>Address</th>
            <th>Contact</th>
        </tr>
        <tr>
            <td><?php echo $agency_details->name; ?></td>
            <td><?php echo $agency_details->address; ?></td>
            <td><?php echo $agency_details->contact; ?></td>
        </tr>
    </table>
    <br><br>
    <table id="bus_details">
        <tr>
            <th colspan="2">Payment Information</th>
        </tr>
        <tr>
            <?php
            $seats = explode(',', $ticket_details->seats);
            foreach ($seats as $seat) {
                ?>
                <td>Seat</td>
                <td><?php echo $seat; ?></td>
            <?php } ?>
        </tr>

        <tr>
            <td>Total Amount (Paid)</td>
            <td>Rs. <?php echo $ticket_details->total_price; ?> /-</td>
        </tr>
    </table>
</div>

