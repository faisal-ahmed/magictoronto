<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Magic_Toronto
 * @since Magic Toronto 1.0
 */

get_header();

get_template_part( 'content', get_post_type() );

if ( comments_open() || get_comments_number() ) {
    comments_template();
}

?>

<?php get_footer(); ?>