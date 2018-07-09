</div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>js/slider.js"></script>


<div class="footerWrap" id="footerWrap">
    <div class="footerLinkWrap">
        <div class="footerLink">
            <i class="fa fa-bus fa-5x"></i> <span style="font-size: 24px;">Bus Reservation</span>
            <br />
            <br />
            <?php
            $copyright = "© Copyright 2018 Bus Reservation. All Rights Reseverd. Privacy and Policy.";
            if (!empty($copyright)) {
                echo $copyright;
            }
            ?>
        </div>
        <div class="footerLink">
            <ul>
                <li><h4>This Site</h4></li>
                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                <li><a href="<?php echo base_url() ?>register">Travel Agencies</a></li>
                <li><a href="<?php echo base_url(); ?>request">Available Routes</a></li>
                <li><a href="<?php echo base_url(); ?>request">Popular Routes</a></li>
            </ul>
        </div>
        <div class="footerLink">
            <ul>
                <li><h4>About Us</h4></li>
                <li><a href="<?php echo base_url(); ?>request">News</a></li>
                <li><a href="<?php echo base_url() ?>register">Services</a></li>
                <li><a href="<?php echo base_url() ?>member/my-books">Objectives</a></li>
                <li><a href="<?php echo base_url() ?>member/matches">Contact Us</a></li>
            </ul>
        </div>
        <div class="footerLink">
            <ul>
                <li><h4>Other</h4></li>
                <li><a href="javascript:void(0)" onclick="loadForm('Suggestion');">Gallery</a></li>
                <li><a href="javascript:void(0)" onclick="loadForm('Suggestion');">Suggestion</a></li>
                <li><a href="javascript:void(0)" onclick="loadForm('Feedback');">Feedback</a></li>
            </ul>
        </div>
        <div class="footerLink">
            <ul>
                <li><h4>Follow us</h4></li>
                <li><a href="https://www.facebook.com/"><span class="footerIcon fb">Facebook</span></a></li>
                <li><a href="https://twitter.com/"><span class="footerIcon tw">Twitter</span></a></li>
                <li><a href="https://plus.google.com/"><span class="footerIcon gp">Google +</span></a></li>
                <li><a href="https://www.linkedin.com/"><span class="footerIcon in">Linked In</span></a></li>
            </ul>
        </div>
    </div>
</body>
</html>