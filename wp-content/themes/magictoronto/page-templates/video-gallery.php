<?php
/**
 * Template Name: Video-Gallery
 */

get_header();

while ( have_posts() ) : the_post();
    $the_header = the_title('', '', false);
    $the_content = get_the_content();
endwhile;
?>

    <section id="sub-header">
        <div class="container">
            <h3 style="text-align: center;"><?php echo $the_header; ?></h3><hr/>
            <div style="text-align: justify"><strong><?php echo $the_content; ?></strong></div>
            <?php
            $args = array( 'post_type' => 'video-galleries', 'numberposts' => -1, 'order' => 'ASC', 'post_status' => array('publish'), );
            $loop = new WP_Query( $args );
            $count = 0;
            while ( $loop->have_posts() ) : $loop->the_post();
            $count++;
            ?>
            <div class="row">
                <div class="col-md-12">
                    <h3><?php the_title() ?></h3>
                    <?php the_content() ?>
                </div>
            </div>
            <?php endwhile; ?><div class="col-md-12"><h3></h3><div class="col-md-3"></div><div class="col-md-9"></div><hr/></div>
        </div>
    </section>

<?php get_footer(); ?>