<?php

require "connection.php";

$title = $_POST["title"];
$deadline = $_POST["deadline"];
$description = $_POST["description"];
$email = $_POST["email"];
$projectId = $_POST["projectId"];

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d");
$date2 = $d->format("Y-m-d H:i:s");

if (empty($title)) {
    echo ("Please Enter Task Title Title");
} else if (strlen($title) > 100) {
    echo ("Title is too Long");
} else if (empty($deadline)) {
    echo ("Please Select Deadline");
} else if ($deadline < $date) {
    echo ("Invalid Deadline");
}else if ($description=="") {
    $description="-";
} else if (empty($projectId)) {
    echo ("Something Went Wrong");
} else {
    Database::iud("INSERT INTO `task` (`task_title`,`task_description`,`task_status_id`,`project_id`,`task_added_datetime`,`task_deadline_datetime`) 
    VALUES ('".$title."','".$description."','1','".$projectId."','".$date2."','".$deadline."' )");

    echo("success");


}


?>