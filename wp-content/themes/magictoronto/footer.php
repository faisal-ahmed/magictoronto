<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Magic_Toronto
 * @since Magic Toronto 1.0
 */
?>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>Subscribe to our Newsletter for latest news.</h3>
                <div id="message-newsletter"></div>
                <form method="post" action="assets/newsletter.php" name="newsletter" id="newsletter" class="form-inline">
                    <input name="email_newsletter" id="email_newsletter" type="email" value="" placeholder="Your Email" class="form-control">
                    <button id="submit-newsletter" class=" button_outline"> Subscribe</button>
                </form>
            </div>
        </div>
    </div>

    <hr>

    <div class="container" id="nav-footer">
        <div class="row text-left">
            <div class="col-md-3 col-sm-3">
                <h4>Browse</h4>
                <?php
                    $menu = 'footer-menu-1';
                    $items = wp_get_nav_menu_items( $menu );
                    $navMenu = "<ul>";
                    foreach ($items as $key => $item) {
                        $navMenu .= '<li><a href="' . $item->url . '">' . $item->title . '</a></li>';
                    }
                    $navMenu .= "</ul>";
                    echo $navMenu;
                ?>
            </div><!-- End col-md-4 -->
            <div class="col-md-3 col-sm-3">
                <h4>Next Courses</h4>
                <?php
                    $menu = 'footer-menu-2';
                    $items = wp_get_nav_menu_items( $menu );
                    $navMenu = "<ul>";
                    foreach ($items as $key => $item) {
                        $navMenu .= '<li><a href="' . $item->url . '">' . $item->title . '</a></li>';
                    }
                    $navMenu .= "</ul>";
                    echo $navMenu;
                ?>
            </div><!-- End col-md-4 -->
            <div class="col-md-3 col-sm-3">
                <h4>About Learn</h4>
                <?php
                    $menu = 'footer-menu-3';
                    $items = wp_get_nav_menu_items( $menu );
                    $navMenu = "<ul>";
                    foreach ($items as $key => $item) {
                        $navMenu .= '<li><a href="' . $item->url . '">' . $item->title . '</a></li>';
                    }
                    $navMenu .= "</ul>";
                    echo $navMenu;
                ?>
            </div><!-- End col-md-4 -->
            <div class="col-md-3 col-sm-3">
                <?php ffpc_get_social_links_with_additional_info(); ?>
            </div><!-- End col-md-4 -->
        </div><!-- End row -->
    </div>
    <div id="copy_right">&copy; 1998-2014</div>
</footer>

<?php wp_footer(); ?>
<div id="toTop">Back to top</div>

<!-- JQUERY -->
<script src="<?php echo get_template_directory_uri() ?>/js/jquery-1.10.2.min.js"></script>
<!-- jQuery REVOLUTION Slider  -->
<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript">

    var revapi;

    jQuery(document).ready(function() {

        revapi = jQuery('.tp-banner').revolution(
            {
                delay:9000,
                startwidth:1170,
                startheight:500,
                hideThumbs:true,
                navigationType:"none",
                fullWidth:"on",
                forceFullWidth:"on"
            });

    });	//ready

</script>

<!-- OTHER JS -->
<script src="<?php echo get_template_directory_uri() ?>/js/superfish.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/js/bootstrap.min.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/js/retina.min.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/assets/validate.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/js/jquery.placeholder.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/js/functions.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/js/classie.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/js/uisearch.js"></script>
<script>new UISearch( document.getElementById( 'sb-search' ) );</script>
</body>
</html>