<div class="list_details_wrap">
    <h3>Edit User</h3>
    <div class="form_wrap">
        <form method="post" action="<?php echo base_url() ?>member/users/update" onsubmit="return validate(['name', 'email', 'phone', 'address', 'role', 'username', 'password', 'con_password'])">
            <input type="hidden" value="<?php echo $agency_admin_id;?>" name='user_id'/>
            <table border="0">
                <tr>
                    <td>Name:</td>
                    <td><input type="text" class="form-control" name="name" id='name' value="<?php echo $agency_admin['name']; ?>" /></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="text" class="form-control" name="email" id='email' value="<?php echo $agency_admin['email']; ?>"/></td>
                </tr>
                <tr>
                    <td>Phone:</td>
                    <td><input type="text" class="form-control" name="phone" id='phone' value="<?php echo $agency_admin['phone']; ?>"/></td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td><input type="text" class="form-control" name="address" id='address' value="<?php echo $agency_admin['address']; ?>"/></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" class="form-control" name="username" id='username' value="<?php echo $agency_admin['username']; ?>"/></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" class="form-control" name="password"/></td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" class="form-control" name="con_password"/></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="<?php echo base_url(); ?>member/users"><button type="button" class="btn btn-danger">Cancel</button></a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>