<div class="list_details_wrap">
    <div>
        <a href="<?php echo base_url() ?>admin/agency_admin/add">
            <button type="button" class="btn btn-success" style="float: right;display: table-cell;">Add New</button>
        </a>
    </div>
    <h3>Agency Admins</h3>
    <div class="list_details">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Address</th>
                    <th scope="col">Created</th>
                    <th scope="col">Username</th>
                    <th scope="col">Travel Agency</th>
                    <th scope="col" colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($agency_admins as $agency_admin) {
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
                        <td><?php echo $agency_admin->name; ?></td>
                        <td><?php echo $agency_admin->email; ?></td>
                        <td><?php echo $agency_admin->phone; ?></td>
                        <td><?php echo $agency_admin->address; ?></td>
                        <td><?php echo $agency_admin->created; ?></td>
                        <td><?php echo $agency_admin->username; ?></td>
                        <td><?php echo $agency_admin->travel_agency; ?></td>
                        <td><a href="<?php echo base_url() ?>admin/agency_admin/edit/<?php echo $agency_admin->id; ?>">Edit</a></td>
                        <td><a onclick="return confirm('Are you sure to delete <?php echo $agency_admin->name; ?>?')" href="<?php echo base_url() ?>admin/agency_admin/delete/<?php echo $agency_admin->id; ?>">Delete</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<div class="pagination_wrap">
    <ul class="pagination">
        <li>
            <a href="<?php echo base_url(); ?>admin/agency_admin/<?php echo 1; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <?php for ($i = 1; $i <= $num_pages; $i++) { ?>
            <li><a href="<?php echo base_url(); ?>admin/agency_admin/<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php } ?>
        <li>
            <a href="<?php echo base_url(); ?>admin/agency_admin/<?php echo --$i; ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</div>