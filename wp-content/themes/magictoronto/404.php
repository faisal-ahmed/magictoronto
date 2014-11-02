<?php
/**
 * The template for displaying 404 pages (Not Found)
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
                    <h1><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'magictoronto' ); ?></h1>
                    <p class="lead boxed"><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'magictoronto' ); ?></p>
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

<?php get_footer(); ?>