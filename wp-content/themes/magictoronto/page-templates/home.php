<?php
/**
 * Template Name: Home
 *
 */

get_header(); ?>

    <section class="tp-banner-container">
    <div class="tp-banner" >
        <?php get_slider() ?>
    <div class="tp-bannertimer"></div>
    </div>
    </section><!-- End slider -->

    <section id="main-features">
        <div class="divider_top_black"></div>
        <div class="container">
            <?php while ( have_posts() ) : the_post(); ?>
            <div class="row">
                <div class=" col-md-10 col-md-offset-1 text-center">
                    <p class="lead" style="margin-bottom: 0">
                        <h2><?php the_title() ?></h2>
                    </p>
                </div>
            </div>
            <div class="row" style="text-align: justify;">
                <div class="col-md-12">
                    <h3><?php the_content() ?></h3>
                </div>
            </div><!-- End row -->
            <?php endwhile; // end of the loop. ?>
        </div><!-- End container-->
    </section><!-- End main-features -->


    <section id="main_content_gray" style="padding: 20px 0 0 0;">
    <div class="container">
        <div class="row add_bottom_30">
            <div class="col-md-12 text-center">
                <h2>Why My?</h2>
            </div>
        </div>
        <hr/>

        <div class="row">
            <?php
            $args = array( 'post_type' => 'key-points', 'numberposts' => -1,  'post_status' => array('publish'), );
            $loop = new WP_Query( $args );
            while ( $loop->have_posts() ) : $loop->the_post();
                $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()));
                if (isset($thumbnail)) { ?>
                <div class="col-md-6">
                    <div class="media">
                        <div class="circ-wrapper pull-left"><img src="<?php echo $thumbnail[0] ?>" alt="Pic" class="img-responsive"></div>
                        <div class="media-body">
                            <h4 class="media-heading"><?php the_title() ?></h4>
                            <div style="text-align: justify;"><?php the_content(); ?></div>
                        </div>
                    </div>
                </div><!-- End col md 6 -->
            <?php }
            endwhile;
            ?>
        </div><!-- End row -->
        <hr>

    </div><!-- End container -->
    </section><!-- End main_content -->



    <section id="main_content_gray" style="padding: 0;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 style="text-transform: uppercase; text-align: center;">Magician's Clients</h2>
                    <hr>
                    <p class="client_image">
                    <?php
                    $args = array( 'post_type' => 'clients', 'numberposts' => -1,  'post_status' => array('publish'), );
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
                    <h2>What they say</h2>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-offset-2 col-md-8'>
                    <div class="carousel slide" data-ride="carousel" id="quote-carousel">
                        <?php
                        $args = array( 'post_type' => 'testimonials', 'numberposts' => -1,  'post_status' => array('publish'), );
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