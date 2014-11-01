<?php
$animation_options = array("fade", "zoomout", "cube-horizontal", "zoomin");
$slider_count = get_option('slider_count');
?>

<ul>	<!-- SLIDE  -->
<?php for ($i = 0; $i < $slider_count; $i++) { ?>
<li data-transition="<?php echo $animation_options[rand(0, 3)] ?>" data-slotamount="4" data-masterspeed="1500" >
    <a href="<?php $slider_link = get_option('slider_' . $i . '_link', ""); echo ($slider_link == '') ? "#" : $slider_link; ?>">
        <!-- MAIN IMAGE -->
        <img src="<?php echo $resource_dir_name ?>/sliderimages/<?php echo get_option('slider_' . $i . '_image', "") ?>" alt="slidebg1"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
        <!-- LAYERS -->

        <!-- LAYER NR. 2 -->
        <?php if (($left_top = trim(get_option('slider_' . $i . '_text_left_top', ""))) != '') { ?>
        <div class="tp-caption medium_bg_darkblue skewfromleft customout"
             data-x="left"
             data-y="190"
             data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
             data-speed="800"
             data-start="1500"
             data-easing="Power4.easeOut"
             data-endspeed="300"
             data-endeasing="Power1.easeIn"
             data-captionhidden="on"
             style="z-index: 6"><?php echo $left_top ?>
        </div>
        <?php } ?>

        <!-- LAYER NR. 3 -->
        <?php if (($left_middle = trim(get_option('slider_' . $i . '_text_left_middle', ""))) != '') { ?>
        <div class="tp-caption medium_bg_darkblue skewfromleft customout"
             data-x="left"
             data-y="245"
             data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
             data-speed="800"
             data-start="1500"
             data-easing="Power4.easeOut"
             data-endspeed="300"
             data-endeasing="Power1.easeIn"
             data-captionhidden="on"
             style="z-index: 6"><?php echo $left_middle ?>
        </div>
        <?php } ?>

        <!-- LAYER NR. 3 -->
        <?php if (($left_bottom = trim(get_option('slider_' . $i . '_text_left_bottom', ""))) != '') { ?>
        <div class="tp-caption medium_bg_darkblue skewfromleft customout"
             data-x="left"
             data-y="300"
             data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
             data-speed="800"
             data-start="1500"
             data-easing="Power4.easeOut"
             data-endspeed="300"
             data-endeasing="Power1.easeIn"
             data-captionhidden="on"
             style="z-index: 6"><?php echo $left_bottom ?>
        </div>
        <?php } ?>

        <!-- LAYER NR. 4 -->
        <?php if (($right_top = trim(get_option('slider_' . $i . '_text_right_top', ""))) != '') { ?>
        <div class="tp-caption medium_bg_darkblue skewfromright customout"
             data-x="right"
             data-y="190"
             data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
             data-speed="800"
             data-start="1800"
             data-easing="Power4.easeOut"
             data-endspeed="300"
             data-endeasing="Power1.easeIn"
             data-captionhidden="on"
             style="z-index: 8"><?php echo $right_top ?>
        </div>
        <?php } ?>

        <!-- LAYER NR. 5 -->
        <?php if (($right_middle = trim(get_option('slider_' . $i . '_text_right_middle', ""))) != '') { ?>
        <div class="tp-caption medium_bg_darkblue skewfromright customout"
             data-x="right"
             data-y="245"
             data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
             data-speed="800"
             data-start="1800"
             data-easing="Power4.easeOut"
             data-endspeed="300"
             data-endeasing="Power1.easeIn"
             data-captionhidden="on"
             style="z-index: 8"><?php echo $right_middle ?>
        </div>
        <?php } ?>

        <!-- LAYER NR. 3 -->
        <?php if (($right_bottom = trim(get_option('slider_' . $i . '_text_right_bottom', ""))) != '') { ?>
        <div class="tp-caption medium_bg_darkblue skewfromleft customout"
             data-x="right"
             data-y="300"
             data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
             data-speed="800"
             data-start="1800"
             data-easing="Power4.easeOut"
             data-endspeed="300"
             data-endeasing="Power1.easeIn"
             data-captionhidden="on"
             style="z-index: 6"><?php echo $right_bottom ?>
        </div>
        <?php } ?>
    </a>
</li>
<?php } ?>
</ul>
