<div class="bus_search_wrap">
    <h1>Travel Agencies</h1>
    <hr>
    <br>
    <table class="bus_search_table">
        <tr>
            <th>S.No.</th>
            <th>Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Email</th>
        </tr>

        <?php
        $i = 1;
        foreach ($agencies as $agency) {
            ?>
            <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $agency->name; ?></td>
                <td><?php echo $agency->address; ?></td>
                <td><?php echo $agency->contact; ?></td>
                <td><?php echo $agency->email; ?></td>
            </tr>
        <?php } ?>
    </table>
</div>