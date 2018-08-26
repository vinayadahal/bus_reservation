<div class="bus_search_wrap">
    <h1>Available Buses For Given Route:</h1>
    <hr>
    <br>
    <table class="bus_search_table">
        <tr>
            <th>S.No.</th>
            <th>Agency</th>
            <th>Bus Type</th>
            <th>Bus Number</th>
            <th>Total Capacity</th>
            <th>Available Capacity</th>
            <th>Departure Time</th>
            <th>Departure Date</th>
        </tr>
        <?php
        $i = 1;
        $j = 0;
//        var_dump($sess_buses_ids);
        ?>
        <?php foreach ($buses as $bus) { ?>
            <tr class="clickable-row" url="<?php echo base_url(); ?>seats/<?php echo $j++; ?>">
                <td><?php echo $i++; ?></td>
                <td><?php echo $bus['travel_agency']; ?></td>
                <td><?php echo $bus['type']; ?></td>
                <td><?php echo $bus['bus_number']; ?></td>
                <td><?php echo $bus['total_seat']; ?></td>
                <td><?php echo $bus['avail_seat']; ?></td>
                <td><?php echo $bus['departure_time']; ?></td>
                <td><?php echo $bus['departure_date']; ?></td>
            </tr>
        <?php } ?>
    </table>
</div>