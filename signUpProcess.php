<?php

$email = $_POST["email"];
$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$password = $_POST["password"];

require "connection.php";

if (empty($email)) {
    echo ("Please enter your Email");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Please enter valid Email");
} else if (empty($firstName)) {
    echo ("Please enter your First Name");
} else if (empty($lastName)) {
    echo ("Please enter your Last Name");
} else if (empty($password)) {
    echo ("Please enter your Password");
} 
else if (!preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/", $password)) {
    echo ("Please enter valid Password");
} 
else {

    $resultset = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' ");
    $result_num = $resultset->num_rows;

    if ($result_num == 1) {
        echo ("User already exists");
    } else {

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `user` (`email`,`first_name`,`last_name`,`password`,`profile_url`,`registered_date`) 
        VALUES ('" . $email . "','" . $firstName . "','" . $lastName . "','" . $password . "','profile_img/default_profile.png','" . $date . "')");

        echo ("success");
    }
}
