<?php
/**
 * Magic Toronto functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Magic_Toronto
 * @since Magic Toronto 1.0
 */

// Set up the content width value based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 625;

/**
 * Magic Toronto setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * Magic Toronto supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Magic Toronto 1.0
 */
function magictoronto_setup() {
	/*
	 * Makes Magic Toronto available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Magic Toronto, use a find and replace
	 * to change 'magictoronto' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'magictoronto', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'magictoronto' ) );
	register_nav_menu( 'secondary', __( 'Secondary Menu', 'magictoronto' ) );
	register_nav_menu( 'footer1', __( 'Footer Menu 1', 'magictoronto' ) );
	register_nav_menu( 'footer2', __( 'Footer Menu 2', 'magictoronto' ) );
	register_nav_menu( 'footer3', __( 'Footer Menu 3', 'magictoronto' ) );

	/*
	 * This theme supports custom background color and image,
	 * and here we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'e6e6e6',
	) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
}
add_action( 'after_setup_theme', 'magictoronto_setup' );

/**
 * Add support for a custom header image.
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Return the Google font stylesheet URL if available.
 *
 * The use of Open Sans by default is localized. For languages that use
 * characters not supported by the font, the font can be disabled.
 *
 * @since Magic Toronto 1.2
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function magictoronto_get_font_url() {
	$font_url = '';

	/* translators: If there are characters in your language that are not supported
	 * by Open Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'magictoronto' ) ) {
		$subsets = 'latin,latin-ext';

		/* translators: To add an additional Open Sans character subset specific to your language,
		 * translate this to 'greek', 'cyrillic' or 'vietnamese'. Do not translate into your own language.
		 */
		$subset = _x( 'no-subset', 'Open Sans font: add new subset (greek, cyrillic, vietnamese)', 'magictoronto' );

		if ( 'cyrillic' == $subset )
			$subsets .= ',cyrillic,cyrillic-ext';
		elseif ( 'greek' == $subset )
			$subsets .= ',greek,greek-ext';
		elseif ( 'vietnamese' == $subset )
			$subsets .= ',vietnamese';

		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => 'Open+Sans:400italic,700italic,400,700',
			'subset' => $subsets,
		);
		$font_url = add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" );
	}

	return $font_url;
}

/**
 * Enqueue scripts and styles for front-end.
 *
 * @since Magic Toronto 1.0
 */
function magictoronto_scripts_styles() {
	global $wp_styles;

	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	// Adds JavaScript for handling the navigation menu hide-and-show behavior.
	wp_enqueue_script( 'magictoronto-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '20140711', true );

	$font_url = magictoronto_get_font_url();
	if ( ! empty( $font_url ) )
		wp_enqueue_style( 'magictoronto-fonts', esc_url_raw( $font_url ), array(), null );

	// Loads our main stylesheet.
	wp_enqueue_style( 'magictoronto-style', get_stylesheet_uri() );

	// Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'magictoronto-ie', get_template_directory_uri() . '/css/ie.css', array( 'magictoronto-style' ), '20121010' );
	$wp_styles->add_data( 'magictoronto-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'magictoronto_scripts_styles' );

/**
 * Filter TinyMCE CSS path to include Google Fonts.
 *
 * Adds additional stylesheets to the TinyMCE editor if needed.
 *
 * @uses magictoronto_get_font_url() To get the Google Font stylesheet URL.
 *
 * @since Magic Toronto 1.2
 *
 * @param string $mce_css CSS path to load in TinyMCE.
 * @return string Filtered CSS path.
 */
function magictoronto_mce_css( $mce_css ) {
	$font_url = magictoronto_get_font_url();

	if ( empty( $font_url ) )
		return $mce_css;

	if ( ! empty( $mce_css ) )
		$mce_css .= ',';

	$mce_css .= esc_url_raw( str_replace( ',', '%2C', $font_url ) );

	return $mce_css;
}
add_filter( 'mce_css', 'magictoronto_mce_css' );

/**
 * Filter the page title.
 *
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since Magic Toronto 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function magictoronto_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'magictoronto' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'magictoronto_wp_title', 10, 2 );

/**
 * Filter the page menu arguments.
 *
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since Magic Toronto 1.0
 */
function magictoronto_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'magictoronto_page_menu_args' );

/**
 * Register sidebars.
 *
 * Registers our main widget area and the front page widget areas.
 *
 * @since Magic Toronto 1.0
 */
function magictoronto_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'magictoronto' ),
		'id' => 'sidebar-1',
		'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'magictoronto' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'First Front Page Widget Area', 'magictoronto' ),
		'id' => 'sidebar-2',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'magictoronto' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Second Front Page Widget Area', 'magictoronto' ),
		'id' => 'sidebar-3',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'magictoronto' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'magictoronto_widgets_init' );

if ( ! function_exists( 'magictoronto_content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Magic Toronto 1.0
 */
function magictoronto_content_nav() {
	global $wp_query;

    $wp_query->posts_per_page = 5;

	if ( $wp_query->max_num_pages > 1 ) : ?>
        <section id="main_content" style="padding: 0;">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="text-center">
                            <ul class="pagination">
                                <?php
                                    $args = array(
                                        'end_size'          => 2,
                                        'mid_size'          => 2,
                                        'prev_text'         => __('« Previous'),
                                        'next_text'         => __('Next »'),
                                        'type'              => 'array',
                                        'add_fragment'      => "?s=" . get_search_query(),
                                    );
                                    $pagination = paginate_links( $args ) ;

                                    $paged = ( get_query_var( 'paged' ) ) ? intval( get_query_var( 'paged' ) ) : 1;

                                    foreach ($pagination as $key => $value) {
                                        $add = ($paged == 1) ? 1 : 0;
                                        $class = '';
                                        if ( ($key + $add) == $paged) {
                                            $class = 'active';
                                        }
                                        echo "<li class=\"{$class}\">$value</li>";
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
	<?php endif;
}
endif;

if ( ! function_exists( 'magictoronto_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own magictoronto_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Magic Toronto 1.0
 */
function magictoronto_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'magictoronto' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'magictoronto' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'magictoronto' ) . '</span>' : ''
					);
					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'magictoronto' ), get_comment_date(), get_comment_time() )
					);
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'magictoronto' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'magictoronto' ), '<p class="edit-link">', '</p>' ); ?>
			</section><!-- .comment-content -->

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'magictoronto' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

if ( ! function_exists( 'magictoronto_entry_meta' ) ) :
/**
 * Set up post entry meta.
 *
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own magictoronto_entry_meta() to override in a child theme.
 *
 * @since Magic Toronto 1.0
 */
function magictoronto_entry_meta() {
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'magictoronto' ) );

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'magictoronto' ) );

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'magictoronto' ), get_the_author() ) ),
		get_the_author()
	);

	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
	if ( $tag_list ) {
		$utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'magictoronto' );
	} elseif ( $categories_list ) {
		$utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'magictoronto' );
	} else {
		$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'magictoronto' );
	}

	printf(
		$utility_text,
		$categories_list,
		$tag_list,
		$date,
		$author
	);
}
endif;

/**
 * Extend the default WordPress body classes.
 *
 * Extends the default WordPress body class to denote:
 * 1. Using a full-width layout, when no active widgets in the sidebar
 *    or full-width template.
 * 2. Front Page template: thumbnail in use and number of sidebars for
 *    widget areas.
 * 3. White or empty background color to change the layout and spacing.
 * 4. Custom fonts enabled.
 * 5. Single or multiple authors.
 *
 * @since Magic Toronto 1.0
 *
 * @param array $classes Existing class values.
 * @return array Filtered class values.
 */
function magictoronto_body_class( $classes ) {
	$background_color = get_background_color();
	$background_image = get_background_image();

	if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'page-templates/full-width.php' ) )
		$classes[] = 'full-width';

	if ( is_page_template( 'page-templates/front-page.php' ) ) {
		$classes[] = 'template-front-page';
		if ( has_post_thumbnail() )
			$classes[] = 'has-post-thumbnail';
		if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) )
			$classes[] = 'two-sidebars';
	}

	if ( empty( $background_image ) ) {
		if ( empty( $background_color ) )
			$classes[] = 'custom-background-empty';
		elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) )
			$classes[] = 'custom-background-white';
	}

	// Enable custom font class only if the font CSS is queued to load.
	if ( wp_style_is( 'magictoronto-fonts', 'queue' ) )
		$classes[] = 'custom-font-enabled';

	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	return $classes;
}
add_filter( 'body_class', 'magictoronto_body_class' );

/**
 * Adjust content width in certain contexts.
 *
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 *
 * @since Magic Toronto 1.0
 */
function magictoronto_content_width() {
	if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) ) {
		global $content_width;
		$content_width = 960;
	}
}
add_action( 'template_redirect', 'magictoronto_content_width' );

/**
 * Register postMessage support.
 *
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Magic Toronto 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function magictoronto_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'magictoronto_customize_register' );

/**
 * Enqueue Javascript postMessage handlers for the Customizer.
 *
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since Magic Toronto 1.0
 */
function magictoronto_customize_preview_js() {
	wp_enqueue_script( 'magictoronto-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130301', true );
}
add_action( 'customize_preview_init', 'magictoronto_customize_preview_js' );


//My Custom Function for Menu Creation
function createSubMenu($parent, &$menulist){
    $ret = '<ul>';
    $flag = 0;
    foreach ($menulist as $key => $menuItem) {
        if (is_object($menuItem) && $menuItem->menu_item_parent == $parent) {
            $ret .= '<li><a href="' . $menuItem->url . '">' . $menuItem->title . '</a>';
            $currentItemID = $menuItem->ID;
            //$menulist[$key] = '';
            unset($menulist[$key]);
            $temp = createSubMenu($currentItemID, $menulist);
            if ($temp != '') {
                $ret .= "<div class=\"mobnav-subarrow\"></div>$temp";
            }
            $ret .= "</li>";
            $flag = 1;
        }
    }
    $ret .= '</ul>';
    return ($flag) ? $ret : "";
}

add_action( 'init', 'create_testimonials' );
function create_testimonials() {
    register_post_type( 'testimonials',
        array(
            'labels' => array(
                'name' => __( 'Testimonials' ),
                'singular_name' => __( 'Testimonial' )
            ),
            'taxonomies' => array('category', 'post_tag'),
            'hierarchical' => true,
            'query_var' => true,
            'show_ui' => true,
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'testimonials'),
            'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail', 'page-attributes', ),
        )
    );
}

add_action( 'init', 'create_clients' );
function create_clients() {
    register_post_type( 'clients',
        array(
            'labels' => array(
                'name' => __( 'Clients' ),
                'singular_name' => __( 'Client' )
            ),
            'taxonomies' => array('category', 'post_tag'),
            'hierarchical' => true,
            'query_var' => true,
            'show_ui' => true,
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'clients'),
            'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail', 'page-attributes', ),
        )
    );
}

add_action( 'init', 'create_key_points' );
function create_key_points() {
    register_post_type( 'key-points',
        array(
            'labels' => array(
                'name' => __( 'Key Points' ),
                'singular_name' => __( 'Key Point' )
            ),
            'taxonomies' => array('category', 'post_tag'),
            'hierarchical' => true,
            'query_var' => true,
            'show_ui' => true,
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'key-points'),
            'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail', 'page-attributes', ),
        )
    );
}

add_action( 'init', 'create_products' );
function create_products() {
    register_post_type( 'products',
        array(
            'labels' => array(
                'name' => __( 'Products' ),
                'singular_name' => __( 'Product' )
            ),
            'taxonomies' => array('category', 'post_tag'),
            'hierarchical' => true,
            'query_var' => true,
            'show_ui' => true,
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'products'),
            'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail', 'page-attributes', ),
        )
    );
}

add_action( 'init', 'create_videos' );
function create_videos() {
    register_post_type( 'videos',
        array(
            'labels' => array(
                'name' => __( 'Videos' ),
                'singular_name' => __( 'Video' )
            ),
            'taxonomies' => array('category', 'post_tag'),
            'hierarchical' => true,
            'query_var' => true,
            'show_ui' => true,
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'videos'),
            'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail', 'page-attributes', ),
        )
    );
}

add_action( 'init', 'create_faq' );
function create_faq() {
    register_post_type( 'faqs',
        array(
            'labels' => array(
                'name' => __( 'Faqs' ),
                'singular_name' => __( 'Faq' )
            ),
            'taxonomies' => array('category', 'post_tag'),
            'hierarchical' => true,
            'query_var' => true,
            'show_ui' => true,
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'faqs'),
            'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail', 'page-attributes', ),
        )
    );
}

add_action( 'init', 'create_video_gallery' );
function create_video_gallery() {
    register_post_type( 'video-galleries',
        array(
            'labels' => array(
                'name' => __( 'Video Galleries' ),
                'singular_name' => __( 'Video Gallery' )
            ),
            'taxonomies' => array('category', 'post_tag'),
            'hierarchical' => true,
            'query_var' => true,
            'show_ui' => true,
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'video-galleries'),
            'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail', 'page-attributes', ),
        )
    );
}

function myplugin_settings() {
// Add tag metabox to page
    register_taxonomy_for_object_type('post_tag', 'page');
// Add category metabox to page
    register_taxonomy_for_object_type('category', 'page');
}
// Add to the admin_init hook of your theme functions.php file
add_action( 'admin_init', 'myplugin_settings' );
