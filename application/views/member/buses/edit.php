<!--<div class="list_details_wrap">
    <h3>Edit Post</h3>
    <div class="form_wrap">
        <form method="post" action="<?php echo base_url() ?>member/my-posts/update" onsubmit="return validate(['book_name', 'author'])">
            <input type="hidden" value="<?php echo $post_id; ?>" name="post_id" />
            <table border="0">
                <tr>
                    <td>Book Name:</td>
                    <td><input type="text" value="<?php echo $post['book_name']; ?>" class="form-control" name="book_name" id='book_name' /></td>
                </tr>
                <tr>
                    <td>Author:</td>
                    <td><input type="text" value="<?php echo $post['author']; ?>" class="form-control" name="author" id='author'/></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="<?php echo base_url(); ?>member/my-books"><button type="button" class="btn btn-danger">Cancel</button></a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>-->

<div class="list_details_wrap">
    <h3>Edit Bus</h3>
    <div class="form_wrap">
        <form method="post" action="<?php echo base_url() ?>member/buses/update" onsubmit="return validate(['start_point', 'end_point', 'type', 'total_seat', 'bus_number', 'price'])">
            <input type="hidden" value="<?php echo $bus_id; ?>" name="bus_id" />
            <table border="0">
                <tr>
                    <td>From:</td>
                    <td>
                        <select name="start_point" class="form-control" id="start_point" onchange="change_destination();">
                            <?php
                            foreach ($places as $start) {
                                if ($start->id == $bus['start_point']) {
                                    ?>
                                    <option selected="selected" value="<?php echo $start->id; ?>" ><?php echo $start->destination; ?></option>
                                <?php } else { ?>
                                    <option value="<?php echo $start->id; ?>" ><?php echo $start->destination; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>To:</td>
                    <td>
                        <select name="end_point" class="form-control" id="end_point">
                            <?php
                            foreach (array_reverse($places) as $end) {
                                if ($end->id == $bus['end_point']) {
                                    ?>
                                    <option selected="selected" value="<?php echo $end->id; ?>"><?php echo $end->destination; ?></option>
                                    <?php
                                } else {
                                    ?>
                                    <option value="<?php echo $end->id; ?>"><?php echo $end->destination; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Bus Type:</td>
                    <td>
                        <select name="type" class="form-control" id="type">
                            <?php // if($bus['type']=="Micro"){?>
                            <option value="Micro">Micro</option>
                            <option value="Deluxe">Deluxe</option>
                            <option value="AC">AC</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Total Seat:</td>
                    <td><input type="text" class="form-control" name="total_seat" id='total_seat'/></td>
                </tr>
                <tr>
                    <td>Bus Number:</td>
                    <td><input type="text" class="form-control" name="bus_number" id='bus_number'/></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="text" class="form-control" name="price" id='price'/></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-success">Add</button>
                        <a href="<?php echo base_url(); ?>member/buses"><button type="button" class="btn btn-danger">Cancel</button></a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>