<div id="jssor_1" class="slider_wrap">
    <div data-u="loading" class="jssorl-009-spin slider_loading_icon">
        <img class="loading_image" src="images/slider/spin.svg" />
    </div>
    <div data-u="slides" class="slider_area">
        <?php
        foreach (glob('images/slider/*.*') as $file) {
            if (strpos($file, 'svg') != TRUE) {
                ?>
                <div>
                    <img data-u="image" src="<?php echo base_url() . $file ?>" />
                </div>
                <?php
            }
        }
        ?>
    </div>

    <div data-u="navigator" class="bullet_nav_wrap"  data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
        <div data-u="prototype" class="i">
            <svg viewbox="0 0 16000 16000">
            <circle class="b" cx="8000" cy="8000" r="5800"></circle>
            </svg>
        </div>
    </div>

    <div data-u="arrowleft" class="arrow_nav_common arrow-left" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
        <svg viewbox="0 0 16000 16000">
        <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
        </svg>
    </div>
    <div data-u="arrowright" class="arrow_nav_common arrow-right" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
        <svg viewbox="0 0 16000 16000">
        <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
        </svg>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>js/style-slider.js"></script>
<script type="text/javascript">jssor_1_slider_init();</script>

<!--<div style="width: 100px; background-color: #333; float: left;">
    News
</div>-->