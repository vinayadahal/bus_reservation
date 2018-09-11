<div class="list_details_wrap">
    <h3>Add Schedule</h3>
    <div class="form_wrap">

        <div style="display: none">
            <?php
            $i = 1;
            foreach ($reservations as $reservation) {
                ?>
                <span id="id<?php echo $i; ?>"><?php echo $reservation['id']; ?></span>
                <span id="type<?php echo $i; ?>"><?php echo $reservation['type']; ?></span>
                <span id="bus_number<?php echo $i; ?>"><?php echo $reservation['bus_number']; ?></span>
                <span id="date<?php echo $i; ?>"><?php echo $reservation['departure_date']; ?></span>
                <span id="time<?php echo $i; ?>"><?php echo $reservation['departure_time']; ?></span>
                <span id="from_to<?php echo $i++; ?>"><?php echo $reservation['from']; ?> to <?php echo $reservation['to']; ?></span>
            <?php } ?>
        </div>

        <form method="post" action="<?php echo base_url() ?>member/buses/create" onsubmit="return validate(['start_point', 'end_point', 'type', 'total_seat', 'bus_number', 'price'])">
            <table border="0">
                <tr>
                    <td>From:</td>
                    <td>
                        <select name="start_point" class="form-control" id="start_point" onchange="change_destination();">
                            <?php foreach ($places as $start) { ?>
                                <option value="<?php echo $start->id; ?>" ><?php echo $start->destination; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>To:</td>
                    <td>
                        <select name="end_point" class="form-control" id="end_point">
                            <?php foreach (array_reverse($places) as $end) { ?>
                                <option value="<?php echo $end->id; ?>"><?php echo $end->destination; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Bus Type:</td>
                    <td>
                        <select name="type" class="form-control" id="type">
                            <option value="Micro">Micro</option>
                            <option value="Deluxe">Deluxe</option>
                            <option value="AC">AC</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Total Seat:</td>
                    <td><input type="text" class="form-control" name="total_seat" id='total_seat'/></td>
                </tr>
                <tr>
                    <td>Bus Number:</td>
                    <td><input type="text" class="form-control" name="bus_number" id='bus_number'/></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="text" class="form-control" name="price" id='price'/></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-success">Add</button>
                        <a href="<?php echo base_url(); ?>member/buses"><button type="button" class="btn btn-danger">Cancel</button></a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>