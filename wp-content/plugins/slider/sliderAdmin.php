<?php
$slider_count = get_option("slider_count", 2);
$uploaded_images = explode(";", get_option('uploaded_image'));
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
    <div id="message"></div>
</form>
<hr/>

<div class="sliderOptionsContainer">
    <div class="sliderOptions">
        <label>How many slider you want?</label>
        <select name="slider_count" id="slider_count" style="width: 50px" onchange="changeSliderCount();">
            <?php for ($i = 2; $i < 11; $i++) {
                $selected = ($i == $slider_count) ? "selected=\"selected\"" : "";
                echo "<option " . $selected . " value=\"$i\">$i</option>";
            } ?>
        </select>
    </div>
    <div style="clear: both"></div>
    <hr/>
</div>

<form action="" method="post">
<input type="hidden" value="<?php echo $slider_count; ?>" name="slider_option_count"/>
<?php for ($i = 0; $i < $slider_count; $i++) { $slider_image = get_option('slider_' . $i . '_image', "");?>
    <div class="sliderOptionsContainer">
        <div class="sliderOptions">
            <h2>Options for Slider <?php echo ($i+1) ?>:</h2>
            <label>Slider Image:</label>
            <select id="slider_<?php echo $i ?>_image" name="slider_<?php echo $i ?>_image" onchange="updateImage(<?php echo $i ?>)" style="width: 400px;">
                <?php foreach ($uploaded_images as $key => $value) {
                    $selected = ($value == $slider_image) ? "selected=\"selected\"" : "";
                    echo "<option " . $selected . " value=\"$value\">$value</option>";
                } ?>
            </select><br/>
            <label>Slider Link:</label> <input type="text" value="<?php echo get_option('slider_' . $i . '_link', "") ?>" name="slider_<?php echo $i ?>_link" /><br/>
            <label>Slider Text (Left Top):</label> <input type="text" value="<?php echo get_option('slider_' . $i . '_text_left_top', "") ?>" name="slider_<?php echo $i ?>_text_left_top" /><br/>
            <label>Slider Text (Left Middle):</label> <input type="text" value="<?php echo get_option('slider_' . $i . '_text_left_middle', "") ?>" name="slider_<?php echo $i ?>_text_left_middle" /><br/>
            <label>Slider Text (Left Bottom):</label> <input type="text" value="<?php echo get_option('slider_' . $i . '_text_left_bottom', "") ?>" name="slider_<?php echo $i ?>_text_left_bottom" /><br/>
            <label>Slider Text (Right Top):</label> <input type="text" value="<?php echo get_option('slider_' . $i . '_text_right_top', "") ?>" name="slider_<?php echo $i ?>_text_right_top" /><br/>
            <label>Slider Text (Right Middle):</label> <input type="text" value="<?php echo get_option('slider_' . $i . '_text_right_middle', "") ?>" name="slider_<?php echo $i ?>_text_right_middle" /><br/>
            <label>Slider Text (Right Bottom):</label> <input type="text" value="<?php echo get_option('slider_' . $i . '_text_right_bottom', "") ?>" name="slider_<?php echo $i ?>_text_right_bottom" /><br/>
        </div>
        <div class="imagePreview">
            <label>Slider Image Preview:</label><br/>
            <img id="image<?php echo $i ?>" src="<?php echo $resource_dir_name ?>sliderImages/<?php echo $slider_image ?>"/>
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
    <input type="submit" value="Update Sliders" />
</form>

<script type="text/javascript">
    function changeSliderCount(){
        $.post( "<?php echo "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>", { slider_count: $('#slider_count').val() }, function( data ) {
            window.location.reload(true);
        });
    }

    function updateImage(i){
        var imageUrl = "<?php echo $resource_dir_name ?>sliderImages/" + $('#slider_' + i + '_image').val();
        $('#image' + i).attr('src', imageUrl);
    }

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
                var successResult = response.responseText;
                var file_name = successResult.substring(16);
                var selectOption = "<option value=\"" + file_name + "\">" + file_name + "</option>";
                $.post( "<?php echo "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>", { uploaded_image: file_name }, function( data ) {
                });
                for (var i = 0; i < <?php echo $slider_count ?>; i++){
                    $('#slider_' + i +'_image').append(selectOption);
                }
            },
            error: function () {
                $("#message").html("<font color='red'> ERROR: unable to upload files</font>");

            }

        };

        $("#myForm").ajaxForm(options);

    });

</script>