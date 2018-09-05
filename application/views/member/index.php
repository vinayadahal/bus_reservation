<div class="dashboard_wrap">
    <div class="dashboard_icons_wrap">
        <a href="<?php echo base_url(); ?>member/routes">
            <div class="dashboard_icons"><i class="fa fa-road" style="font-size: 128px;"></i>Routes</div>
        </a>
        <a href="<?php echo base_url(); ?>member/buses">
            <div class="dashboard_icons"><i class="fa fa-bus" style="font-size: 128px;"></i>Buses</div>
        </a>
        <a href="<?php echo base_url(); ?>member/matches">
            <div class="dashboard_icons">
                <i class="fa fa-copy" style="font-size: 128px;"></i>Matching Books <?php
                if (!empty($books)) {
                    $count = 0;
                    foreach ($books as $book) {
                        $count += count($book);
                    }
                    echo "<span>(" . $count . ")</span>";
                }
                ?>
            </div>
        </a>
        <a href="<?php echo base_url(); ?>member/settings">
            <div class="dashboard_icons"><i class="fa fa-cog" style="font-size: 128px;"></i>Settings</div>
        </a>
    </div>
</div>