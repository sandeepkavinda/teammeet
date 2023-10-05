<?php

session_start();
require "connection.php";

if(isset($_SESSION["user"])){

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $pw = $_POST["pw"];
    $image_path = $_SESSION["user"]["profile_url"];

    if(isset($_FILES["image"])){
        $image = $_FILES["image"];
        $allowed_image_extentions = array("image/jpg","image/jpeg","image/png","image/svg+xml");
        $file_ex = $image["type"];

        if(!in_array($file_ex,$allowed_image_extentions)){
            echo("Invalid File Type");
        }else{

            $new_file_extention;

            if($file_ex=="image/jpg"){
                $new_file_extention=".jpg";
            }else if($file_ex=="image/jpeg"){
                $new_file_extention=".jpeg";
            }else if($file_ex=="image/png"){
                $new_file_extention=".png";
            }else if($file_ex=="image/svg+xml"){
                $new_file_extention=".svg+xml";
            }

            $file_name = "profile_img/".$_SESSION["user"]["first_name"]."_".uniqid().$new_file_extention ;
            $image_path= $file_name;
            move_uploaded_file($image["tmp_name"],$file_name);

        }
    }

    Database::iud("UPDATE `user` SET `first_name`='".$fname."',`last_name`='".$lname."',`password`='".$pw."',`profile_url`='".$image_path."' 
    WHERE `email`='".$_SESSION["user"]["email"]."' ");

    $_SESSION["user"]["first_name"]=$fname;
    $_SESSION["user"]["last_name"]=$lname;
    $_SESSION["user"]["password"]=$pw;
    $_SESSION["user"]["profile_url"]=$image_path;


    echo("success");

}
?>