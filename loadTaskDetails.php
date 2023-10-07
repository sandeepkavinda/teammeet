<?php

require "connection.php";
$task_id = $_GET["tid"];

$rs = Database::search("SELECT * FROM `task` INNER JOIN `task_members` ON `task`.`id`=`task_members`.`task_id` WHERE `task`.`id`='" . $task_id . "' ");
$rs_num = $rs->num_rows;

$obj = new stdClass();

for($x=0; $x< $rs_num; $x++ ){
    $rs_data = $rs->fetch_assoc();
    $array = array();
    
    $obj->user_email.$x = $rs_data['user_email'];
}

$json = json_encode($obj);
echo($json);


?>