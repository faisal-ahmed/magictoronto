<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Magic_Toronto
 * @since Magic Toronto 1.0
 */

?>

    <section id="sub-header">
        <div class="container">
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="row">
                    <div class="col-md-12">
                        <h3 style="text-align: center;"><?php the_title(); ?></h3>
                        <hr/>
                        <div style="text-align: justify"><?php the_content(); ?></div>
                    </div><!-- End col-md-8 -->
                </div>
            <?php endwhile; ?>
        </div>
    </section>

<?php get_footer(); ?>