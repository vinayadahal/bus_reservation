<a href="<?php echo base_url() ?>print_ticket/<?php echo $ticket_id ?>"><button class="btn_submit"><i class="fa fa-print"></i></button></a>

<div style="margin: 0 auto;">
    <p>
        <em><strong>Notice:</strong></em> Please keep the ticket ID safe for future reference. This will be cross validated before entry to the bus.
    </p>
    <br>
</div>
<div class="bus_search_wrap">
    <table id="bus_details" style="width: 20%">
        <tr>
            <th>Ticket ID:</th>
            <td><?php echo $ticket_id; ?></td>
        </tr>
    </table>
    <div class="seat_layout">
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

    </div>

    <div class="seat_layout">
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
    </div>
</div>