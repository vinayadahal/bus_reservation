<div class="search_area">
    <form method="get" action="<?php echo base_url() ?>member/tickets/search/">
        <input type="text" placeholder="Search Ticket" class="form-elements search_box" name="keyword"/><button class="btn_submit search_btn" type="submit"><i class="fa fa-search" ></i></button>
    </form>
</div>

<div class="list_details_wrap">
    <h3>Booked Tickets</h3>
    <div class="list_details">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Email</th>
                    <th scope="col">Seats</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">Ticket ID</th>
                    <th scope="col">Route</th>
                    <th scope="col">Departure Date</th>
                    <th scope="col">Departure Time</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($tickets as $ticket) {
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
                        <td><?php echo $ticket->first_name . " " . $ticket->last_name; ?></td>
                        <td><?php echo $ticket->address; ?></td>
                        <td><?php echo $ticket->contact; ?></td>
                        <td><?php echo $ticket->email; ?></td>
                        <td><?php echo $ticket->seats; ?></td>
                        <td>Rs. <?php echo $ticket->total_price; ?> /-</td>
                        <td><?php echo $ticket->unique_id; ?></td>
                        <td><?php echo $ticket->from . " to " . $ticket->to; ?></td>
                        <td><?php echo $ticket->departure_date; ?></td>
                        <td><?php echo $ticket->departure_time; ?></td>
                        <td><a onclick="return confirm('Are you sure to delete <?php echo " ticket for " . $ticket->first_name . " " . $ticket->last_name ?>?')" href="<?php echo base_url() ?>member/tickets/delete/<?php echo $ticket->id; ?>">Delete</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php if (isset($num_pages)) { ?>
    <div class="pagination_wrap">
        <ul class="pagination">
            <li>
                <a href="<?php echo base_url(); ?>member/tickets/<?php echo 1; ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php for ($i = 1; $i <= $num_pages; $i++) { ?>
                <li><a href="<?php echo base_url(); ?>member/tickets/<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php } ?>
            <li>
                <a href="<?php echo base_url(); ?>member/tickets/<?php echo --$i; ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </div>
    <?php
}?>