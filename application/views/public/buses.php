<div class="bus_search_wrap">
    <h1>Available Buses For: <?php echo $from->destination; ?> To <?php echo $to->destination; ?></h1>
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
            <th>Ticket Price</th>
        </tr>
        <?php
        $i = 1;
        $j = 0;
        ?>
        <?php
        if (count($buses) == 0) {
            ?>
            <tr><td colspan="9">No records to display. Please choose another destination or date.</td></tr>
            <?php
        } else {
            foreach ($buses as $bus) {
                ?>
                <tr class="clickable-row" url="<?php echo base_url(); ?>seats/<?php echo $j++; ?>">
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $bus['travel_agency']; ?></td>
                    <td><?php echo $bus['type']; ?></td>
                    <td><?php echo $bus['bus_number']; ?></td>
                    <td><?php echo $bus['total_seat']; ?></td>
                    <td><?php echo $bus['avail_seat']; ?></td>
                    <td><?php echo $bus['departure_time']; ?>:00:00</td>
                    <td><?php echo $bus['departure_date']; ?></td>
                    <td>Rs. <?php echo $bus['price']; ?> /-</td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
</div>

<script type="text/javascript">
    $(".clickable-row").click(function () {
        console.log("checking");
        var redirect_url = $(this).attr("url");
        window.location = redirect_url;
    });
</script>