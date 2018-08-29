

<div class="bus_search_wrap" style="display: table;">
    <div class="seat_layout">
        <h1>Bus Details</h1>
        <hr>
        <br>
        <table id="bus_details">
            <tr>
                <th>Operator</th>
                <th>Address</th>
                <th>Contact</th>
                <th>Type</th>
            </tr>
            <tr>
                <td><?php echo $details['travel_agency']; ?></td>
                <td><?php echo $details['address']; ?></td>
                <td><?php echo $details['contact']; ?></td>
                <td><?php echo $details['type']; ?></td>
            </tr>
            <tr>
                <th>Total Capacity</th>
                <th>Number</th>
                <th>Departure Date</th>
                <th>Departure Time</th>
            </tr>
            <tr>
                <td><?php echo $details['total_seat']; ?></td>
                <td><?php echo $details['bus_number']; ?></td>
                <td><?php echo $details['departure_date']; ?></td>
                <td><?php echo $details['departure_time']; ?></td>
            </tr>
        </table>

        <h1>Seat Details</h1>
        <hr>
        <br>
        <table id="bus_details">
            <tr>
                <th colspan="<?php echo count($seat_details); ?>">Seats Name</th>
                <th>Total Selected</th>
                <th>Total Price</th>
            </tr>
            <tr>
                <?php foreach ($seat_details as $seat_name) { ?>
                    <td><?php echo $seat_name; ?></td>
                <?php } ?>
                <td><?php echo count($seat_details); ?></td>
                <td>Rs. <?php echo $total_price; ?> /-</td>
            </tr>
        </table>
    </div>
    <div class="seat_layout">
        <h1>Provide Your Details</h1>
        <hr>
        <br>
        <form method="post" action="<?php // echo base_url()      ?>">
            <table>
                <tr>
                    <td>First Name</td>
                    <td><input type="text" name="fname" class="form-elements" /></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><input type="text" name="lname" class="form-elements" /></td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><input type="text" name="address" class="form-elements" /></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="text" name="email" class="form-elements" /></td>
                </tr>
                <tr>
                    <td>Contact</td>
                    <td><input type="text" name="contact" class="form-elements" /></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button class="btn_submit">Submit</button>
                        <a href="javascript:history.go(-1)"><button class="btn_submit" type="button">Cancel</button></a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>