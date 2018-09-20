<div class="routes" style="width: 99%;padding: .5%;">
    <h2>Pick A Route</h2>
    <hr/>
    <div class="route_form">
        <table class="tbl_form">
            <tr>
                <th>Start Point:</th>
                <th>Destination:</th>
                <th>Travel Date:</th>
            </tr>
            <tr>
                <td>
                    <select name="start_point" class="form-elements" id="start_point" onchange="change_destination();">
                        <?php foreach ($places as $start) { ?>
                            <option value="<?php echo $start->id; ?>" ><?php echo $start->destination; ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td>
                    <select name="end_point" class="form-elements" id="end_point">
                        <?php foreach (array_reverse($places) as $end) { ?>
                            <option value="<?php echo $end->id; ?>"><?php echo $end->destination; ?></option>
                        <?php } ?>
                    </select>
                </td>
                <td><input type="date" name="date" id='date' class="form-elements" /></td>
            </tr>
            <tr>
                <td colspan="3"><button id="test" url="<?php echo base_url(); ?>search_bus" class="btn_submit">Submit</button></td>
            </tr>
        </table>
        <!--</form>-->
    </div>
</div>

<div class="routes" style="width: 99%;padding: .5%;display: none; " id="bus_info"></div>

<!--<div class="routes" style="width: 99%;padding: .5%;">
    <h2>Travel Agencies</h2>
    <hr/>
    <table class="tbl_travel_agency">
        <tr>
            <th>S.No.</th>
            <th>Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Email</th>
        </tr>

        <?php
//        $i = 1;
//        foreach ($agencies as $agency) {
            ?>
            <tr>
                <td><?php // echo $i++; ?></td>
                <td><?php // echo $agency->name; ?></td>
                <td><?php // echo $agency->address; ?></td>
                <td><?php // echo $agency->contact; ?></td>
                <td><?php // echo $agency->email; ?></td>
            </tr>
        <?php // } ?>
    </table>
</div>-->

<!--<div class="avail_popular_wrap">
    <div class="avail_popular">
        <h2>Available Routes</h2>
        <hr/>
        <table>
            <tr>
                <th>Start Point</th>
                <th>Destination</th>
            </tr>
            <tr class="clickable-row">
                <td>Kathmandu</td>
                <td>Pokhara</td>
            </tr>
            <tr class="clickable-row">
                <td>Kathmandu</td>
                <td>Pokhara</td>
            </tr>
            <tr class="clickable-row">
                <td>Kathmandu</td>
                <td>Pokhara</td>
            </tr>
            <tr class="clickable-row">
                <td>Kathmandu</td>
                <td>Pokhara</td>
            </tr>
            <tr class="clickable-row">
                <td>Kathmandu</td>
                <td>Pokhara</td>
            </tr>
        </table>
    </div>

    <div class="avail_popular">
        <h2>Popular Routes</h2>
        <hr/>
        <table>
            <tr>
                <th>Start Point</th>
                <th>Destination</th>
            </tr>
            <tr class="clickable-row">
                <td>Kathmandu</td>
                <td>Pokhara</td>
            </tr>
            <tr class="clickable-row">
                <td>Kathmandu</td>
                <td>Pokhara</td>
            </tr>
            <tr class="clickable-row">
                <td>Kathmandu</td>
                <td>Pokhara</td>
            </tr>
            <tr class="clickable-row">
                <td>Kathmandu</td>
                <td>Pokhara</td>
            </tr>
            <tr class="clickable-row">
                <td>Kathmandu</td>
                <td>Pokhara</td>
            </tr>
        </table>
    </div>
</div>-->
