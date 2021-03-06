<div class="list_details_wrap">
    <h3>Add Agency Admin</h3>
    <div class="form_wrap">
        <form method="post" action="<?php echo base_url() ?>admin/agency_admin/create" onsubmit="return validate(['name', 'address', 'phone', 'email', 'username', 'agency_id','password','con_password'])">
            <table border="0">
                <tr>
                    <td>Name:</td>
                    <td><input type="text" class="form-control" name="name" id='name'/></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="text" class="form-control" name="email" id='email'/></td>
                </tr>
                <tr>
                    <td>Phone:</td>
                    <td><input type="text" class="form-control" name="phone" id='phone'/></td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td><input type="text" class="form-control" name="address" id='address'/></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" class="form-control" name="username" id='username'/></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" class="form-control" name="password" id='password'/></td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" class="form-control" name="con_password" id='con_password'/></td>
                </tr>
                <tr>
                    <td>Travel Agency:</td>
                    <td>
                        <select class="form-control" name="agency_id" id='agency_id'>
                            <?php foreach ($agency_ids as $agency_id) { ?>
                                <option value="<?php echo $agency_id->id; ?>"><?php echo $agency_id->name; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-success">Add</button>
                        <a href="<?php echo base_url(); ?>admin/agency_admin"><button type="button" class="btn btn-danger">Cancel</button></a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>