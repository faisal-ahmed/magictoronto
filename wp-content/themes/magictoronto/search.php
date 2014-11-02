<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Magic_Toronto
 * @since Magic Toronto 1.0
 */

get_header(); ?>

    <section id="sub-header">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <h2><?php printf( __( 'Search Results', 'magictoronto' ) ); ?></h2>
                    <form action="<?php echo esc_url( home_url( '/' ) ) ?>" method="get" id="search-form" >
                        <div class="input-group" >
                            <input type="text" placeholder="Search" name="s" id="autocomplete-ajax" value="<?php echo get_search_query() ?>" class="form-control style-2" />
					<span class="input-group-btn">
					<button class="btn" type="submit"><i class="icon-search"></i></button>
					</span>
                        </div><!-- /input-group -->
                    </form>
                </div>
            </div><!-- End row -->
        </div><!-- End container -->
        <div class="divider_top"></div>
    </section><!-- End sub-header -->

    <section id="strips-course" class="shadow">
    <?php if ( have_posts() ) : ?>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="lead add_bottom_45"><?php printf( __( 'Search Results for: %s', 'magictoronto' ), '<span>' . get_search_query() . '</span>' ); ?></p>
                </div>
            </div>
        </div>

        <?php magictoronto_content_nav(); ?>

        <?php $count = 0; while ( have_posts() ) : the_post(); $count++; ?>
            <article>
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-3 hidden-xs text-center"><img src="<?php echo get_template_directory_uri() ?>/img/number_<?php echo $count ?>_small.png" alt="" ></div>
                        <div class="col-md-9 col-sm-9">
                            <h3><?php the_title() ?></h3>
                            <p><?php the_content(); ?></p>
                            <a href="<?php the_permalink() ?>" class="button_medium">Read More ....</a>
                        </div>

                    </div><!-- End row  -->
                </div><!-- End container  -->
            </article><!-- End strip-program  -->
        <?php endwhile; ?>

        <?php magictoronto_content_nav(); ?>

		<?php else : ?>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="lead add_bottom_45"><?php _e( 'Nothing Found', 'magictoronto' ); ?></p>
                    <p class="lead add_bottom_45"><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'magictoronto' ); ?></p>
                </div>
            </div>
        </div>

		<?php endif; ?>
    </section>

<?php get_footer(); ?>