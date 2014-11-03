<?php
/**
 * Template Name: Reviews
 *
 */

get_header();

while ( have_posts() ) : the_post();
    $the_header = the_title('', '', false);
    $the_content = get_the_content();
endwhile;

?>

    <section id="sub-header">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <h2 style="text-decoration: underline;"><?php echo $the_header; ?></h2>
                    <div style="text-align: justify"><strong><?php echo $the_content; ?></strong></div>
                </div>
            </div><!-- End row -->
        </div><!-- End container -->
        <div class="divider_top"></div>
    </section><!-- End sub-header -->

    <section id="main_content_gray">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 style="text-transform: uppercase; text-align: center;">Past clients include</h2>
                    <hr>
                    <p class="client_image">
                    <?php
                    $args = array( 'post_type' => 'clients', 'numberposts' => -1, 'order' => 'ASC', 'post_status' => array('publish'), );
                    $loop = new WP_Query( $args );
                    while ( $loop->have_posts() ) : $loop->the_post();
                        $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()));
                        if (isset($thumbnail)) { ?>
                            <img src="<?php echo $thumbnail[0] ?>" alt="Pic" class="img-responsive">
                    <?php }
                    endwhile;
                    ?>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="testimonials">
        <div class="container">
            <div class="row">
                <div class='col-md-offset-2 col-md-8 text-center'>
                    <h2>What are past clients saying?</h2>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-offset-2 col-md-8'>
                    <div class="carousel slide" data-ride="carousel" id="quote-carousel">
                        <?php
                        $args = array( 'post_type' => 'testimonials', 'numberposts' => -1, 'order' => 'ASC', 'post_status' => array('publish'), );
                        $loop = new WP_Query( $args );
                        $testimonials = array();
                        $testimonial_count = $loop->post_count;
                        while ( $loop->have_posts() ) : $loop->the_post();
                            $testimonial = array(
                                'title' => the_title('', '', false),
                                'content' => get_the_content(),
                                'thumbnail' => wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID())),
                            );
                            $testimonials[] = $testimonial;
                        endwhile;
                        ?>

                        <!-- Bottom Carousel Indicators -->
                        <ol class="carousel-indicators">
                            <?php for ($i = 0; $i < $testimonial_count; $i++) { ?>
                            <li data-target="#quote-carousel" data-slide-to="<?php echo $i ?>" <?php echo (!$i) ? 'class="active"' : ""?>></li>
                            <?php } ?>
                        </ol>
                        <!-- Carousel Slides / Quotes -->
                        <div class="carousel-inner">
                            <!-- Quote 1 -->
                            <?php for ($i = 0; $i < $testimonial_count; $i++) { ?>
                            <div class="item <?php echo (!$i) ? "active" : ""?>">
                                <blockquote>
                                    <div class="row">
                                        <div class="col-sm-3 text-center">
                                            <img class="img-circle" src="<?php if (isset($testimonials[$i]['thumbnail'][0])) echo $testimonials[$i]['thumbnail'][0]?>" alt="">
                                        </div>
                                        <div class="col-sm-9">
                                            <p>
                                                <?php echo $testimonials[$i]['content'] ?>
                                            </p>
                                            <small><?php echo $testimonials[$i]['title'] ?></small>
                                        </div>
                                    </div>
                                </blockquote>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End testimonials -->

<?php get_footer(); ?>