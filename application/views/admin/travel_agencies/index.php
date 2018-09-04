<div class="list_details_wrap">
    <div>
        <a href="<?php echo base_url() ?>admin/travel_agencies/add">
            <button type="button" class="btn btn-success" style="float: right;display: table-cell;">Add New</button>
        </a>
        <a href="<?php echo base_url() ?>admin/agency_admin">
            <button type="button" class="btn btn-primary" style="float: right;display: table-cell;margin-right: 10px;">Agency Admins</button>
        </a>
    </div>
    <h3>Travel Agencies</h3>
    <div class="list_details">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Agency Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Email</th>
                    <th scope="col" colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($agencies as $agency) {
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
                        <td><?php echo $agency->name; ?></td>
                        <td><?php echo $agency->address; ?></td>
                        <td><?php echo $agency->contact; ?></td>
                        <td><?php echo $agency->email; ?></td>
                        <td><a href="<?php echo base_url() ?>admin/travel_agencies/edit/<?php echo $agency->id; ?>">Edit</a></td>
                        <td><a onclick="return confirm('Are you sure to delete <?php echo $agency->name; ?>?')" href="<?php echo base_url() ?>admin/travel_agencies/delete/<?php echo $agency->id; ?>">Delete</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<div class="pagination_wrap">
    <ul class="pagination">
        <li>
            <a href="<?php echo base_url(); ?>admin/travel_agencies/<?php echo 1; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <?php for ($i = 1; $i <= $num_pages; $i++) { ?>
            <li><a href="<?php echo base_url(); ?>admin/travel_agencies/<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php } ?>
        <li>
            <a href="<?php echo base_url(); ?>admin/travel_agencies/<?php echo --$i; ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</div>