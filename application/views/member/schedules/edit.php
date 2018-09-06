<div class="list_details_wrap">
    <h3>Edit Book</h3>
    <div class="form_wrap">
        <form method="post" enctype="multipart/form-data" action="<?php echo base_url() ?>member/my-books/update" onsubmit="return validate(['book_name', 'category', 'author', 'year', 'edition', 'pages', 'desc'])">
            <input type="hidden" value="<?php echo $book_id; ?>" name="book_id" />
            <table border="0">
                <tr>
                    <td>Book Name:</td>
                    <td><input type="text" value="<?php echo $book['name']; ?>" class="form-control" name="book_name" id='book_name'/></td>
                </tr>
                <tr>
                    <td>Image:</td>
                    <td>
                        <?php if (!empty($images['image_location'])) { ?>
                            <img id='imgLocation' class='productImg' style="margin-bottom: 10px;" src="<?php echo base_url() . "images/icons/" . $images['image_location']; ?>">
                        <?php } else { ?>
                            <img id='imgLocation' class='productImg' style="margin-bottom: 10px;">
                        <?php } ?>
                        <div class="input-group">
                            <span class="btn btn-default btn-file">Browse <input type="file" name="imgFile" id="img" /></span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select class="form-control" name="category" id='category'>
                            <?php
                            foreach ($categories as $category) {
                                if ($category->id == $book['category_id']) {
                                    ?>
                                    <option value="<?php echo $category->id; ?>" selected="selected"><?php echo $category->name; ?></option>
                                <?php } else { ?>
                                    <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Author:</td>
                    <td><input type="text" value="<?php echo $book['author']; ?>" class="form-control" name="author" id='author'/></td>
                </tr>
                <tr>
                    <td>Year:</td>
                    <td>
                        <select class="form-control" name="year">
                            <?php
                            $Startyear = date('Y');
                            $endYear = $Startyear - 50;
                            $yearArray = range($Startyear, $endYear);
                            foreach ($yearArray as $year) {
                                if ($year == date("Y", strtotime($book['year']))) {
                                    ?>
                                    <option value="<?php echo $year; ?>-01-01" selected="selected"><?php echo $year; ?></option>
                                    <?php
                                } else {
                                    ?>
                                    <option value="<?php echo $year; ?>-01-01"><?php echo $year; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Edition:</td>
                    <td><input type="text" value="<?php echo $book['edition']; ?>" class="form-control" name="edition" id='edition'/></td>
                </tr>
                <tr>
                    <td>Offer:</td>
                    <td><input type="text" value="<?php echo $book['offer']; ?>" class="form-control" name="offer" /></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="number" value="<?php echo $book['price']; ?>" class="form-control" name="price" /></td>
                </tr>
                <tr>
                    <td>Pages:</td>
                    <td><input type="number" value="<?php echo $book['pages']; ?>" class="form-control" name="pages" id='pages'/></td>
                </tr>
                <tr>
                    <td>Condition:</td>
                    <td>
                        <select class="form-control" name="condition">
                            <?php if ("Brand New" == $book['condition']) { ?>
                                <option value="Brand New" selected="selected">Brand New</option>
                                <option value="Used">Used</option>
                            <?php } else { ?>
                                <option value="Brand New">Brand New</option>
                                <option value="Used" selected="selected">Used</option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea class="form-control" name="description" rows="6" id="desc"><?php
                            if (!empty($description['description'])) {
                                echo $description['description'];
                            }
                            ?></textarea>
                    </td>
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
</div>