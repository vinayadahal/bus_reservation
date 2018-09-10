<div class="list_details_wrap">
    <div>
        <a href="<?php echo base_url() ?>member/buses/add">
            <button type="button" class="btn btn-success" style="float: right;display: table-cell;">Add New</button>
        </a>
    </div>
    <h3>Bus Schedule</h3>
    <div class="list_details">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">From</th>
                    <th scope="col">To</th>
                    <th scope="col">Bus Type</th>
                    <th scope="col">Bus Number</th>
                    <th scope="col">Departure Date</th>
                    <th scope="col">Departure Time</th>
                    <th scope="col">Reserved Seats</th>
                    <th scope="col" colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($reservations as $schedule) {
                    ?>
                    <tr>
                        <th scope="row">
                            <?php
                            if (!empty($data_count)) {
                                echo $data_count++;
                            } else {
                                echo $i++;
                            }
                            ?>
                        </th>
                        <td>
                            <?php
                            if (!empty($schedule['from'])) {
                                echo $schedule['from'];
                            } else {
                                echo "N/A";
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if (!empty($schedule['to'])) {
                                echo $schedule['to'];
                            } else {
                                echo "N/A";
                            }
                            ?>
                        </td>
                        <td><?php echo $schedule['type']; ?></td>
                        <td><?php echo $schedule['bus_number']; ?></td>
                        <td><?php echo $schedule['departure_date']; ?></td>
                        <td><?php echo $schedule['departure_time']; ?></td>
                        <td><?php echo $schedule['reserved_seat']; ?></td>
                        <td><a href="<?php echo base_url() ?>member/schedules/edit/<?php echo $schedule['id']; ?>">Edit</a></td>
                        <td><a onclick="return confirm('Are you sure to delete <?php echo "bus type: " . $schedule['type'] . " bus number: " . $schedule['bus_number']; ?>?')" href="<?php echo base_url() ?>member/schedules/delete/<?php echo $schedule['id']; ?>">Delete</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<div class="pagination_wrap">
    <ul class="pagination">
        <li>
            <a href="<?php echo base_url(); ?>member/buses/<?php echo 1; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <?php for ($i = 1; $i <= $num_pages; $i++) { ?>
            <li><a href="<?php echo base_url(); ?>member/buses/<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php } ?>
        <li>
            <a href="<?php echo base_url(); ?>member/buses/<?php echo --$i; ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</div>