<?php
/*
Plugin Name: Slider Manager
Description: This Plugin manages Slider Settings for the website
Author: Mohammad Faisal Ahmed
Version: 1
Author Email: faisal.ahmed0001@gmail.com
*/

global $resource_dir_name;
$dir_name = str_replace('\\', '/', dirname(__FILE__));
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    $resource_dir_name = "http://" . $_SERVER['HTTP_HOST'] . '/magictoronto/wp-content/plugins/slider/';
} else {
    $resource_dir_name = "http://" . $_SERVER['HTTP_HOST'] . '/wp-content/plugins/slider/';
}

/********** Admin Panel **************************/
add_action('admin_menu', 'slider_plugin_menu');

function slider_plugin_menu()
{
    add_menu_page('Slider Manager', 'Slider Manager', 'manage_options', 'slider-automated-id', 'sliderAutomated_options', '', 40);
}

function sliderAutomated_options()
{
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }

    global $resource_dir_name;

    if (isset($_POST['slider_count'])) {
        update_option( 'slider_count', $_POST['slider_count'] );
        return;
    }

    if (isset($_POST['uploaded_image'])) {
        $images = get_option('uploaded_image') . ";{$_POST['uploaded_image']}";
        update_option( 'uploaded_image',  $images);
        return;
    }

    if (isset($_POST['slider_option_count'])){
        for ($i = 0; $i < $_POST['slider_option_count']; $i++){
            update_option("slider_{$i}_image", $_POST["slider_{$i}_image"]);
            update_option("slider_{$i}_link", $_POST["slider_{$i}_link"]);
            update_option("slider_{$i}_text_left_top", $_POST["slider_{$i}_text_left_top"]);
            update_option("slider_{$i}_text_left_middle", $_POST["slider_{$i}_text_left_middle"]);
            update_option("slider_{$i}_text_left_bottom", $_POST["slider_{$i}_text_left_bottom"]);
            update_option("slider_{$i}_text_right_top", $_POST["slider_{$i}_text_right_top"]);
            update_option("slider_{$i}_text_right_middle", $_POST["slider_{$i}_text_right_middle"]);
            update_option("slider_{$i}_text_right_bottom", $_POST["slider_{$i}_text_right_bottom"]);
        }
    }

    include_once "sliderAdmin.php";
}

function get_slider(){
    global $resource_dir_name;
    include_once "sliderFrontend.php";
}

function debug($var){
    echo "<pre>";
    print_r($var);
    echo "</pre>";
}

?>