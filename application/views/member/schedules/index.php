<div class="list_details_wrap">
    <div>
        <a href="<?php echo base_url() ?>member/my-books/add">
            <button type="button" class="btn btn-success" style="float: right;display: table-cell;">Add New</button>
        </a>
    </div>
    <h3>My Books</h3>
    <div class="list_details">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Book Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Author</th>
                    <th scope="col">Year</th>
                    <th scope="col">Edition</th>
                    <th scope="col">Offer</th>
                    <th scope="col">Price</th>
                    <th scope="col">Pages</th>
                    <th scope="col">Condition</th>
                    <th scope="col" colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($AllBooks as $book) {
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
                        <td><?php echo $book->name; ?></td>
                        <td><?php echo $book->category_name; ?></td>
                        <td><?php echo $book->author; ?></td>
                        <td><?php echo date('Y', strtotime($book->year)); ?></td>
                        <td><?php echo $book->edition; ?></td>
                        <td><?php echo $book->offer; ?></td>
                        <td>Rs. <?php echo $book->price; ?> /-</td>
                        <td><?php echo $book->pages; ?></td>
                        <td><?php echo $book->condition; ?></td>
                        <?php if (empty($book->publish) || $book->publish == 'No') { ?>
                            <td><a onclick="return confirm('Are you sure to publish <?php echo $book->name; ?>?')" href="<?php echo base_url() ?>member/my-books/publish/<?php echo $book->id; ?>">Publish</a></td>
                            <?php
                        } else {
                            ?>
                            <td><a onclick="return confirm('Are you sure to hide <?php echo $book->name; ?>?')" href="<?php echo base_url() ?>member/my-books/hide/<?php echo $book->id; ?>">Hide</a></td>
                        <?php } ?>
                        <td><a href="<?php echo base_url() ?>member/my-books/edit/<?php echo $book->id; ?>">Edit</a></td>
                        <td><a onclick="return confirm('Are you sure to delete <?php echo $book->name; ?>?')" href="<?php echo base_url() ?>member/my-books/delete/<?php echo $book->id; ?>">Delete</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<div class="pagination_wrap">
    <ul class="pagination">
        <li>
            <a href="<?php echo base_url(); ?>member/my-books/<?php echo 1; ?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <?php for ($i = 1; $i <= $num_pages; $i++) { ?>
            <li><a href="<?php echo base_url(); ?>member/my-books/<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php } ?>
        <li>
            <a href="<?php echo base_url(); ?>member/my-books/<?php echo --$i; ?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</div>