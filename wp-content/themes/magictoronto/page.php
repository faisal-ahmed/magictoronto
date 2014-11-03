<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Magic_Toronto
 * @since Magic Toronto 1.0
 */

get_header();

while ( have_posts() ) : the_post();
    $content = get_the_content();
    $category = get_the_category();
endwhile;

$category_id = $category[0]->term_id;

$args = array( 'post_type' => 'videos', 'numberposts' => -1, 'cat' => $category_id, 'order' => 'ASC', 'post_status' => array('publish'), );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post(); ?>
    <section id="sub-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <?php the_content(); ?>
                    <h2 style="text-align: justify;"><?php echo $content ?></h2>
                </div>
            </div><!-- End row -->
        </div><!-- End container -->
        <div class="divider_top"></div>
    </section><!-- End sub-header -->
<?php
endwhile;
?>

<section id="sub-header" class="pattern_1" >
    <div class="container">
        <?php
        $args = array( 'post_type' => 'key-points', 'numberposts' => -1, 'cat' => $category_id, 'order' => 'ASC', 'post_status' => array('publish'), );
        $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post();
            $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
        ?>
            <div class="row" id="sub-header-features">
                <div class="col-md-4">
                    <p><img src="<?php echo $thumbnail[0] ?>" alt="Pic" class="img-responsive page4ColumnImage"></p>
                </div>
                <div class="col-md-8">
                    <h2><?php the_title() ?></h2>
                    <p><?php the_content(); ?></p>
                </div>
            </div><!-- End row -->
        <?php endwhile; ?>
    </div><!-- End container -->
<div class="divider_top"></div>
</section>

    <section id="main_content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2>Kid's Shows</h2>
                </div>
            </div><!-- End row -->

            <?php
            $args = array( 'post_type' => 'products', 'numberposts' => -1, 'cat' => $category_id, 'order' => 'ASC', 'post_status' => array('publish'), );
            $loop = new WP_Query( $args );
            $count = 0;
            while ( $loop->have_posts() ) : $loop->the_post();
                $count++;
                $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                $custom_fields = get_post_custom();
                ?>
            <?php if ($count % 4 == 0) { ?><div class="row"><?php } ?>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="col-item">
                        <span class="ribbon_course"></span>
                        <div class="photo">
                            <a href="<?php the_permalink(); ?>"><img class="products" src="<?php echo $thumbnail[0] ?>" alt="" /></a>
                            <div class="cat_row"><i class=" icon-clock"></i><?php echo (isset($custom_fields['show_length'])) ? $custom_fields['show_length'][0] : "Duration Not Available" ?></div>
                        </div>
                        <div class="info">
                            <div class="row">
                                <div class="course_info col-md-12 col-sm-12">
                                    <h4><?php the_title(); ?></h4>
                                    <div style="text-align: justify; height: 150px;"><?php $content = get_the_content(); echo (strlen($content) > 180) ? substr($content, 0, 180)."[........]" : $content; ?></div>
                                </div>
                            </div>
                            <div class="separator clearfix">
                                <p class="btn-details"><a href="<?php the_permalink(); ?>"><i class="icon-list"></i>Details</a></p>
                            </div>
                        </div>
                    </div>
                </div>

            <?php if ($count % 4 == 0) { ?></div><!-- End row --><?php } ?>
            <?php endwhile; ?>
        </div>   <!-- End container -->
    </section><!-- End section gray -->

<section  id="sub-header" class="pattern_1">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center">
                <div class="row">
                    <div class="col-md-2 hidden-sm hidden-xs"><img src="<?php echo get_template_directory_uri() ?>/img/arrow_hand_1.png" alt="Arrow" > </div>
                    <div class="col-md-8"><a href="#" class="button_big">Book A Show</a> </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>