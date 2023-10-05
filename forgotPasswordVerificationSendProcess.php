<?php


require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

$email = $_GET["e"];

$resultset = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "' ");
$result_num = $resultset->num_rows;


if($result_num==1){
    $code = rand(100000, 999999);

    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'teammeet292@gmail.com';
    $mail->Password = 'pibs uayx wypk esug';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('teammeet292@gmail.com', 'Forgot Password Verification');
    $mail->addReplyTo('teammeet292@gmail.com', 'Forgot Password Verification');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'Team Meet Forgot Password Verification';
    $bodyContent = '<h3>Your verification code is <br/> ' . $code . '</h3>';
    $mail->Body    = $bodyContent;
    
    if (!$mail->send()) {
        echo 'sending failed';
    } else {
        Database::iud("UPDATE `user` SET `verification_code`='" . $code . "' WHERE `email`='" . $email . "'");
        echo ("success");
    }
}else{
    echo("Invalid Email");
}

?>