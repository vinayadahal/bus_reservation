<div class="list_details_wrap">
    <h3>Add Agency</h3>
    <div class="form_wrap">
        <form method="post" action="<?php echo base_url() ?>admin/travel_agencies/create" onsubmit="return validate(['agency_name', 'address','contact','email'])">
            <table border="0">
                <tr>
                    <td>Agency Name:</td>
                    <td><input type="text" class="form-control" name="agency_name" id='agency_name'/></td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td><input type="text" class="form-control" name="address" id='address'/></td>
                </tr>
                <tr>
                    <td>Contact:</td>
                    <td><input type="text" class="form-control" name="contact" id='contact'/></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="text" class="form-control" name="email" id='email'/></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-success">Add</button>
                        <a href="<?php echo base_url(); ?>admin/travel_agencies"><button type="button" class="btn btn-danger">Cancel</button></a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>