<div class="list_details_wrap">
    <h3>Edit Schedule</h3>
    <div class="form_wrap">
        <form method="post" action="<?php echo base_url() ?>member/schedules/update" onsubmit="return validate(['date', 'time'])">
            <input type="hidden" name="reservation_id" id="reservation_id" value="<?php echo $reservation->id; ?>"/>
            <input type="hidden" name="bus_id" id="bus_id" value="<?php echo $reservation->bus_id; ?>"/>
            <table border="0">
                <tr>
                    <td>Date:</td>
                    <td><input type="date" class="form-control" name="date" id='date' value="<?php echo $reservation->departure_date; ?>"/></td>
                </tr>
                <tr>
                    <td>Time (24 hour format): </td>
                    <td><input type="number" class="form-control" name="time" id='time' min="0" max="23" value="<?php echo $reservation->departure_time; ?>"/></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="<?php echo base_url(); ?>member/schedules"><button type="button" class="btn btn-danger">Cancel</button></a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>