<div class="bus_search_wrap">

    Departure Date: <?php echo $bus_details->departure_date; ?>
    <br>
    Departure Time: <?php echo $bus_details->departure_time; ?>

    <?php
    $reserved_array = explode(",", $bus_details->reserved_seat);
    ?>

    <table border="1" class="seat_table" >
        <tr>
            <td colspan="4">Seat Layout for bus:</td>
        </tr>
        <?php if ($bus_type == "Micro") { ?>
            <tr>
                <?php if (in_array("f1", $reserved_array)) { ?>
                    <td class="click_seat" style="background-color: #ff0000">f1</td>
                <?php } else { ?>
                    <td class="click_seat">f1</td>
                <?php } ?>
                <?php if (in_array("f2", $reserved_array)) { ?>
                    <td class="click_seat" style="background-color: #ff0000">f2</td>
                <?php } else { ?>
                    <td class="click_seat">f2</td>
                <?php } ?>
                <td colspan="2">Driver</td>
            </tr>
            <tr>
                <td rowspan="3"></td>
                <?php if (in_array("a1", $reserved_array)) { ?>
                    <td class="click_seat" style="background-color: #ff0000">a1</td>
                <?php } else { ?>
                    <td class="click_seat">a1</td>
                <?php } ?>
                <?php if (in_array("a2", $reserved_array)) { ?>
                    <td class="click_seat" style="background-color: #ff0000">a2</td>
                <?php } else { ?>
                    <td class="click_seat">a2</td>
                <?php } ?>
                <?php if (in_array("a3", $reserved_array)) { ?>
                    <td class="click_seat" style="background-color: #ff0000">a3</td>
                <?php } else { ?>
                    <td class="click_seat">a3</td>
                <?php } ?>
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

</div>