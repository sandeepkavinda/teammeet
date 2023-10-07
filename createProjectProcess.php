<?php
session_start();
require "connection.php";

$pname = $_POST["pname"];
$desc = $_POST["desc"];

if (empty($pname)) {
    echo ("Please Enter Project Name");
} else if (empty($desc)) {
   $desc = "-";
} else {
    Database::iud("INSERT INTO `project` (`project_name`,`project_description`,`project_status_id`,`project_leader`) 
    VALUES ('".$pname."','".$desc."','1','".$_SESSION['user']['email']."' )");

    echo ("success");
}


?>