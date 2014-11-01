<?php
/**
 * Created by PhpStorm.
 * User: victoryland
 * Date: 10/27/14
 * Time: 1:12 AM
 */

//upload.php
if (!isset($_FILES["myfile"])) {
    echo "Error: No file was found.";
    exit;
}
$uploaddir = dirname(__FILE__).'/sliderImages/';
$file_name = $_FILES["myfile"]["name"];
$uploadfile = $uploaddir . $file_name;
$uploadfile = str_replace("\\", "/", $uploadfile);

if (isset($_FILES["myfile"])) {
    //Filter the file types , if you want.
    if ($_FILES["myfile"]["error"] > 0) {
        echo "Error: " . $_FILES["file"]["error"] . "<br>";
    } else if (file_exists($uploadfile)) {
        echo "Error: A file already exists with this name (e.g.: $file_name).<br/>";
    } else {
        //move the uploaded file to uploads folder;
        move_uploaded_file($_FILES["myfile"]["tmp_name"], $uploadfile);

        echo "Uploaded File : $file_name";
    }

}
?>