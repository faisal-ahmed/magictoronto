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
            <div class="row">
                <div class=" col-md-10 col-md-offset-1 text-center">
                    <h2><?php bloginfo( 'description' ) ?></h2>
                    <p class="lead">
                        Lorem ipsum dolor sit amet, ius minim gubergren ad. <br>
                        At mei sumo sonet audiam, ad mutat elitr platonem vix. Ne nisl idque fierent vix. Ferri clitaponderum ne.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="feature">
                        <i class="icon-trophy"></i>
                        <h3>Expert teachers</h3>
                        <p>
                            Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="feature">
                        <i class=" icon-ok-4"></i>
                        <h3>Trusted certifications</h3>
                        <p>
                            Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="feature">
                        <i class="icon-mic"></i>
                        <h3>+500 Audio lessons</h3>
                        <p>
                            Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="feature">
                        <i class="icon-video"></i>
                        <h3>+1.200 Video lessons</h3>
                        <p>
                            Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex, appareat similique an usu.
                        </p>
                    </div>
                </div>
            </div><!-- End row -->
        </div><!-- End container-->
    </section><!-- End main-features -->




        <?php while ( have_posts() ) : the_post(); ?>

        <?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>