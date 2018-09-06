<div class="list_details_wrap">
    <div>
        <a href="<?php echo base_url() ?>member/buses/add">
            <button type="button" class="btn btn-success" style="float: right;display: table-cell;">Add New</button>
        </a>
    </div>
    <h3>Buses</h3>
    <div class="list_details">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">From</th>
                    <th scope="col">To</th>
                    <th scope="col">Type</th>
                    <th scope="col">Total Seat</th>
                    <th scope="col">Bus Number</th>
                    <th scope="col">Ticket Price</th>
                    <th scope="col" colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($buses as $bus) {
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
                            if (!empty($bus['from'])) {
                                echo $bus['from'];
                            } else {
                                echo "N/A";
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if (!empty($bus['to'])) {
                                echo $bus['to'];
                            } else {
                                echo "N/A";
                            }
                            ?>
                        </td>
                        <td><?php echo $bus['type']; ?></td>
                        <td><?php echo $bus['total_seat']; ?></td>
                        <td><?php echo $bus['bus_number']; ?></td>
                        <td>Rs. <?php echo $bus['price']; ?> /-</td>
                        <td><a href="<?php echo base_url() ?>member/buses/edit/<?php echo $bus['id']; ?>">Edit</a></td>
                        <td><a onclick="return confirm('Are you sure to delete <?php echo "bus type: " . $bus['type'] . " bus number: " . $bus['bus_number']; ?>?')" href="<?php echo base_url() ?>member/buses/delete/<?php echo $bus['id']; ?>">Delete</a></td>
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