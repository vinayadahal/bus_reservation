<div class="slider_wrap">
    <!-- Slideshow container -->
    <div class="slideshow-container">
        <!-- Full-width images with number and caption text -->
        <?php
        foreach (glob('images/slider/*.*') as $file) {
            if (strpos($file, 'svg') != TRUE) {
                ?>
                <div class="mySlides fade">
                    <!--<div class="numbertext">1 / 3</div>-->
                    <img src="<?php echo base_url() . $file ?>" style="width:100%">
                    <!--<div class="text">Caption Text</div>-->
                </div>
                <?php
            }
        }
        ?>
        <!-- Next and previous buttons -->
        <!--        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>-->
        <a class="prev" onclick="lastSlide()">&#10094;</a>
        <a class="next" onclick="nextSlide()">&#10095;</a>

        <!-- The dots/circles -->
        <div class="dot_wrap" style="text-align:center">
            <?php
            $i = 1;
            foreach (glob('images/slider/*.*') as $file) {
                if (strpos($file, 'svg') != TRUE) {
                    ?>
                    <span class="dot" onclick="currentSlide(<?php echo $i++ ?>)"></span>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>