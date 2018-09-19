

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
        <h1>Route Information</h1>
        <hr>
        <br>
        <table id="bus_details">
            <tr>
                <th>From</th>
                <th>To</th>
            </tr>
            <tr>
                <td><?php echo $from; ?></td>
                <td><?php echo $to; ?></td>
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
                <?php
                if (!empty($seat_details)) {
                    foreach ($seat_details as $seat_name) {
                        ?>
                        <td><?php echo $seat_name; ?></td>
                    <?php } ?>
                    <td><?php echo count($seat_details); ?></td>
                    <td>Rs. <?php echo $total_price; ?> /-</td>
                <?php } else { ?>
                    <td>N/A</td>
                    <td>0</td>
                    <td>Rs. 0 /-</td>
                <?php } ?>

            </tr>
        </table>
    </div>
    <div class="seat_layout">
        <h1>Provide Passenger Details</h1>
        <hr>
        <br>
        <form onsubmit="return validate(['fname', 'lname', 'address', 'email', 'contact'])" method="post" action="<?php echo base_url(); ?>reserve_seat" >
            <table class="form_table">
                <tr>
                    <th>First Name</th>
                </tr>
                <tr>
                    <td><input type="text" name="fname" id="fname" class="form-elements" /></td>
                </tr>
                <tr>
                    <th>Last Name</th>
                </tr>
                <tr>
                    <td><input type="text" name="lname" id="lname" class="form-elements" /></td>
                </tr>
                <tr>
                    <th>Address</th>
                </tr>
                <tr>
                    <td><input type="text" name="address" id="address" class="form-elements" /></td>
                </tr>
                <tr>
                    <th>Email</th>
                </tr>
                <tr>
                    <td><input type="text" name="email" id="email" class="form-elements" /></td>
                </tr>
                <tr>
                    <th>Contact</th>
                </tr>
                <tr>
                    <td><input type="text" name="contact" id="contact" class="form-elements" /></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <button class="btn_submit" type="submit">Submit</button>
                        <a href="javascript:history.go(-1)"><button class="btn_submit" type="button">Cancel</button></a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>