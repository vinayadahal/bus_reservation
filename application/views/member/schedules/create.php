<div class="list_details_wrap">
    <h3>Add Schedule</h3>
    <div class="form_wrap">

        <div style="display: none">
            <?php
            $i = 1;
            foreach ($reservations as $reservation) {
                ?>
                <span id="id<?php echo $reservation['id']; ?>"><?php echo $reservation['id']; ?></span><!--this is bus id-->
                <span id="type<?php echo $reservation['id']; ?>"><?php echo $reservation['type']; ?></span>
                <span id="bus_number<?php echo $reservation['id']; ?>"><?php echo $reservation['bus_number']; ?></span>
                <span id="date<?php echo $reservation['id']; ?>"><?php echo $reservation['departure_date']; ?></span>
                <span id="time<?php echo $reservation['id']; ?>"><?php echo $reservation['departure_time']; ?></span>
                <span id="from_to<?php echo $reservation['id']; ?>"><?php echo $reservation['from']; ?> to <?php echo $reservation['to']; ?></span>
            <?php } ?>
        </div>

        <form method="post" action="<?php echo base_url() ?>member/schedules/create" onsubmit="return validate(['route', 'type', 'bus_number', 'date', 'time'])">
            <input type="hidden" name="bus_id" id="bus_id" />
            <table border="0">
                <tr>
                    <td>Destination:</td>
                    <td>
                        <select name="route" class="form-control" id="route" onchange="change_destination();">
                            <?php foreach ($reservations as $reservation) { ?>
                                <option value="<?php echo $reservation['id']; ?>" ><?php echo $reservation['from']; ?> to <?php echo $reservation['to']; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Bus Type:</td>
                    <td><input type="text" class="form-control" name="type" id='type' disabled/></td>
                </tr>
                <tr>
                    <td>Bus Number:</td>
                    <td><input type="text" class="form-control" name="bus_number" id='bus_number' disabled/></td>
                </tr>
                <tr>
                    <td>Date:</td>
                    <td><input type="date" class="form-control" name="date" id='date' /></td>
                </tr>
                <tr>
                    <td>Time (24 hour format): </td>
                    <td><input type="number" class="form-control" name="time" id='time' min="0" max="23"/></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-success">Add</button>
                        <a href="<?php echo base_url(); ?>member/schedules"><button type="button" class="btn btn-danger">Cancel</button></a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>