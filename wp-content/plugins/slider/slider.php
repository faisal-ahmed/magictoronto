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

    extract($_POST);

    ?>
    <link rel="stylesheet" href="<?php echo $resource_dir_name ?>style.css" type="text/css"/>
    <link rel="stylesheet" href="<?php echo $resource_dir_name ?>select2/select2.css" type="text/css"/>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
    <script type="text/javascript" src="http://malsup.github.com/jquery.form.js"></script>
    <script type="text/javascript" src="<?php echo $resource_dir_name ?>select2/select2.js"></script>

    <hr/>
    <h2 style="margin-bottom: 0;">Upload Slider Image</h2>

    <form id="myForm" action="<?php echo $resource_dir_name ?>uploader.php" method="post" enctype="multipart/form-data">
        <input type="file" name="myfile"><br/>
        <input type="submit" style="float: left;" value="Upload Image">
        <div id="progress">
            <div id="bar"></div>
            <div id="percent">0%</div>
        </div>
    </form>
    <hr/>

    <div class="sliderOptionsContainer">
        <div class="sliderOptions">
            <label>How many slider you want?</label>
            <select name="slider_count" id="slider_count" style="width: 50px">
                <?php for ($i = 2; $i < 11; $i++) { echo "<option value=\"$i\">$i</option>"; } ?>
            </select>
        </div>
        <div style="clear: both"></div>
        <hr/>
    </div>

    <?php for ($i = 0; $i < get_option("slider_count", 2); $i++) { ?>
        <div class="sliderOptionsContainer">
            <div class="sliderOptions">
                <h2>Options for Slider <?php echo ($i+1) ?>:</h2>
                <label>Slider Image:</label>
                <select id="slider_<?php echo $i ?>_image" name="slider_<?php echo $i ?>_image" style="width: 400px;">

                </select><br/>
                <label>Slider Link:</label> <input type="text" name="slider_<?php echo $i ?>_link" /><br/>
                <label>Slider Text (Left Top):</label> <input type="text" name="slider_<?php echo $i ?>_text_left_top" /><br/>
                <label>Slider Text (Left Middle):</label> <input type="text" name="slider_<?php echo $i ?>_text_left_middle" /><br/>
                <label>Slider Text (Left Bottom):</label> <input type="text" name="slider_<?php echo $i ?>_text_left_bottom" /><br/>
                <label>Slider Text (Right Top):</label> <input type="text" name="slider_<?php echo $i ?>_text_right_top" /><br/>
                <label>Slider Text (Right Middle):</label> <input type="text" name="slider_<?php echo $i ?>_text_right_middle" /><br/>
                <label>Slider Text (Right Bottom):</label> <input type="text" name="slider_<?php echo $i ?>_text_right_bottom" /><br/>
            </div>
            <div class="imagePreview">
                <label>Slider Image Preview:</label><br/>
                <img src="<?php echo $resource_dir_name ?>sliderImages/Chrysanthemum.jpg"/>
            </div>
            <div style="clear: both"></div>
            <hr/>
            <script type="text/javascript">
                $(function() {
                    $("#slider_<?php echo $i ?>_image").select2();
                });
            </script>
        </div>
    <?php } ?>

    <div id="message"></div>

    <script type="text/javascript">
        $(function () {
            $("#slider_count").select2();
            var options = {
                beforeSend: function () {
                    $("#progress").show();
                    //clear everything
                    $("#bar").width('0%');
                    $("#message").html("");
                    $("#percent").html("0%");
                },
                uploadProgress: function (event, position, total, percentComplete) {
                    $("#bar").width(percentComplete + '%');
                    $("#percent").html(percentComplete + '%');

                },
                success: function () {
                    $("#bar").width('100%');
                    $("#percent").html('100%');

                },
                complete: function (response) {
                    $("#message").html("<font color='green'>" + response.responseText + "</font>");
                },
                error: function () {
                    $("#message").html("<font color='red'> ERROR: unable to upload files</font>");

                }

            };

            $("#myForm").ajaxForm(options);

        });

    </script>
    <?php
    echo '<button id="donatchart" value="' . basename(__DIR__) . '" style="display:none;"></button>';
}

function debug($var){
    echo "<pre>";
    print_r($var);
    echo "</pre>";
}

?>