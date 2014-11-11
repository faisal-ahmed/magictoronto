<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Magic_Toronto
 * @since Magic Toronto
 */

get_header();

get_template_part( 'content', get_post_type() );

if ( comments_open() || get_comments_number() ) {
    comments_template();
}

?>

<?php get_footer(); ?>