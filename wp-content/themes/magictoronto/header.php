<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Magic_Toronto
 * @since Magic Toronto 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>

    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- Favicons-->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri() ?>/img/favicon.ico"/>
    <link rel="apple-touch-icon" type="image/x-icon" href="<?php echo get_template_directory_uri() ?>/img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="<?php echo get_template_directory_uri() ?>/img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="<?php echo get_template_directory_uri() ?>/img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="<?php echo get_template_directory_uri() ?>/img/apple-touch-icon-144x144-precomposed.png">

    <!-- CSS -->
    <link href="<?php echo get_template_directory_uri() ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri() ?>/css/superfish.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri() ?>/css/style.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri() ?>/fontello/css/fontello.css" rel="stylesheet">
    <!-- REVOLUTION BANNER CSS SETTINGS -->
    <link href="<?php echo get_template_directory_uri() ?>/rs-plugin/css/settings.css" media="screen" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-3">
                <a href="index.html" id="logo">Learn</a>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-9" style="padding-top: 20px;">
                <?php ffpc_get_social_links_without_additional_info(); ?>
            </div>
        </div>
    </div>
</header><!-- End header -->

<nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="mobnav-btn"></div>

                <?php
                    $menu = 'main-menu';
                    $items = wp_get_nav_menu_items( $menu );
                    $navMenu = "<ul class=\"sf-menu\">";
                    foreach ($items as $key => $item) {
                        if (is_object($item) && $item->menu_item_parent == 0){
                            $navMenu .= '<li><a href="' . $item->url . '">' . $item->title . '</a>';
                            $currentItemID = $item->ID;
                            //$items[$key] = '';
                            unset($items[$key]);
                            $temp = createSubMenu($currentItemID, $items);
                            if ($temp != '') {
                                $navMenu .= "<div class=\"mobnav-subarrow\"></div>$temp";
                            }
                            $navMenu .= "</li>";
                        }
                    }
                    $navMenu .= "</ul>";
                    echo $navMenu;
                ?>

                <div class="col-md-4 pull-right hidden-sm hidden-xs">
                    <div id="sb-search" class="sb-search">
                        <form>
                            <input class="sb-search-input" placeholder="Enter your search term..." type="text" value="" name="search" id="search">
                            <input class="sb-search-submit" type="submit" value="">
                            <span class="sb-icon-search"></span>
                        </form>
                    </div>
                </div><!-- End search -->

            </div>
        </div><!-- End row -->
    </div><!-- End container -->
</nav>