<div class="list_details_wrap">
    <h3>Edit Place</h3>
    <div class="form_wrap">
        <form method="post" action="<?php echo base_url() ?>admin/places/update" onsubmit="return validate(['name'])">
            <input type="hidden" value="<?php echo $place_id; ?>" name="place_id" />
            <table border="0">
                <tr>
                    <td>Name:</td>
                    <td><input type="text" value="<?php echo $place['destination']; ?>" class="form-control" name="name" id='name'/></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="<?php echo base_url(); ?>admin/places"><button type="button" class="btn btn-danger">Cancel</button></a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>