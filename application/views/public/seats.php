<div class="bus_search_wrap" style="display: table;">
    <div class="seat_layout">
        <h1>Seat Layout</h1>
        <hr>
        <br>
        <div style="display: none;" id="reserved_seat"><?php echo $bus_details->reserved_seat; ?></div>
        <?php if (!empty($selected_seat)) { ?>
            <div style="display: none;" id="selected_seat"><?php echo $selected_seat; ?></div>
        <?php } ?>
        <table class="seat_table" id="seat_table" url="<?php echo base_url(); ?>" >
            <?php if ($bus_type == "Micro") { ?>
                <tr>
                    <td class="click_seat seat_image">f1</td>
                    <td class="click_seat seat_image">f2</td>
                    <td colspan="2">Driver</td>
                </tr>
                <tr>
                    <td rowspan="3">Door</td>
                    <td class="click_seat seat_image">a1</td>
                    <td class="click_seat seat_image">a2</td>
                    <td class="click_seat seat_image">a3</td>
                </tr>
                <tr>
                    <td class="click_seat seat_image">b1</td>
                    <td class="click_seat seat_image">b2</td>
                    <td class="click_seat seat_image">b3</td>
                </tr>
                <tr>
                    <td class="click_seat seat_image">c1</td>
                    <td class="click_seat seat_image">c2</td>
                    <td class="click_seat seat_image">c3</td>
                </tr>
                <tr>
                    <td class="click_seat seat_image">d1</td>
                    <td class="click_seat seat_image">d2</td>
                    <td class="click_seat seat_image">d3</td>
                    <td class="click_seat seat_image">d4</td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <div class="seat_layout">
        <h1>Color Index</h1>
        <hr>
        <br>
        <table id="bus_details">
            <tr>
                <th>Booked</th>
                <th>Selected</th>
                <th>In Progress</th>
            </tr>
            <tr>
                <td style="background-color: #ac0022;">&nbsp;</td>
                <td style="background-color: #00592e;">&nbsp;</td>
                <td style="background-color: #b4d2e0;">&nbsp;</td>
            </tr>
        </table>
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
                <th>Capacity</th>
                <th>Number</th>
                <th>Departure Date</th>
                <th>Departure Time</th>
            </tr>
            <tr>
                <td><?php echo $details['total_seat']; ?> People</td>
                <td><?php echo $details['bus_number']; ?></td>
                <td><?php echo $bus_details->departure_date; ?></td>
                <td><?php echo $bus_details->departure_time; ?></td>
            </tr>

            <tr>
                <th>Ticket Price</th>
                <th>Selected Seats</th>
                <th>Seat Name</th>
                <th>Total Price</th>
            </tr>
            <tr>
                <td>Rs. <span id="price"><?php echo $details['price']; ?></span> /-</td>
                <td id="selected_seat_count">N/A</td>
                <td id="seat_name">N/A</td>
                <td id="total_price">Rs. 0 /-</td>
            </tr>

        </table>
        <br>
        <br>
        <button class="btn_submit" onclick="seat_session();">Next</button>
    </div>
</div> 