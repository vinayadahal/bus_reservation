<div class="bus_search_wrap">
    Departure Date: <?php echo $bus_details->departure_date; ?>
    <br>
    Departure Time: <?php echo $bus_details->departure_time; ?>
    <?php // $reserved_array = explode(",", $bus_details->reserved_seat); ?>
    <div style="display: none;" id="reserved_seat"><?php echo $bus_details->reserved_seat; ?></div>
    <?php if (!empty($selected_seat)) { ?>
        <div style="display: none;" id="selected_seat"><?php echo $selected_seat; ?></div>
    <?php } ?>
    <table border="1" class="seat_table" id="seat_table" url="<?php echo base_url(); ?>" >
        <tr>
            <td colspan="4">Seat Layout for bus:</td>
        </tr>
        <?php if ($bus_type == "Micro") { ?>
            <tr>
                <td class="click_seat">f1</td>
                <td class="click_seat">f2</td>
                <td colspan="2">Driver</td>
            </tr>
            <tr>
                <td rowspan="3"></td>
                <td class="click_seat">a1</td>
                <td class="click_seat">a2</td>
                <td class="click_seat">a3</td>
            </tr>
            <tr>
                <td class="click_seat">b1</td>
                <td class="click_seat">b2</td>
                <td class="click_seat">b3</td>
            </tr>
            <tr>
                <td class="click_seat">c1</td>
                <td class="click_seat">c2</td>
                <td class="click_seat">c3</td>
            </tr>
            <tr>
                <td class="click_seat">d1</td>
                <td class="click_seat">d2</td>
                <td class="click_seat">d3</td>
                <td class="click_seat">d4</td>
            </tr>
        <?php } ?>
    </table>

    <button class="btn_submit" onclick="seat_session();">Next</button>

</div> 