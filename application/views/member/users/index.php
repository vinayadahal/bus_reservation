<div class="list_details_wrap">
    <div>
        <a href="<?php echo base_url() ?>member/users/add">
            <button type="button" class="btn btn-success" style="float: right;display: table-cell;">Add New</button>
        </a>
    </div>
    <h3>Agency Users</h3>
    <div class="list_details">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Username</th>
                    <th scope="col" colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($users as $user) {
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
                        <td><?php echo $user->name; ?></td>
                        <td><?php echo $user->address; ?></td>
                        <td><?php echo $user->phone; ?></td>
                        <td><?php echo $user->email; ?></td>
                        <td><?php echo $user->username; ?></td>
                        <td><a href="<?php echo base_url() ?>member/users/edit/<?php echo $user->id; ?>">Edit</a></td>
                        <td><a onclick="return confirm('Are you sure to delete <?php echo $user->name; ?>?')" href="<?php echo base_url() ?>member/users/delete/<?php echo $user->id; ?>">Delete</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<div class="pagination_wrap">
    <ul class="pagination">
        <li>
            <a href="<?php echo base_url(); ?>member/users/<?php echo 1; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <?php for ($i = 1; $i <= $num_pages; $i++) { ?>
            <li><a href="<?php echo base_url(); ?>member/users/<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php } ?>
        <li>
            <a href="<?php echo base_url(); ?>member/users/<?php echo --$i; ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</div>