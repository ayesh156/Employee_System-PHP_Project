<?php

require "../../config/connection.php";

require "../../includes/SMTP.php";
require "../../includes/PHPMailer.php";
require "../../includes/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (empty($_GET["e"])) {

    echo ("Please enter your email address");
    
} else {

    $email = $_GET["e"];

    $rs = Database::search("SELECT * FROM `staff` WHERE `email`='" . $email . "'");
    $n = $rs->num_rows;

    if ($n > 0) {
        $code = uniqid();
        Database::iud("UPDATE `staff` SET `varification_code`='" . $code . "' WHERE `email`='" . $email . "' ");

        // Verification code send process

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ayeshchathuranga531@gmail.com';
        $mail->Password = 'hqhutzzfbpovirng';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('ayeshchathuranga531@gmail.com', 'Reset Password');
        $mail->addReplyTo('ayeshchathuranga531@gmail.com', 'Reset Password');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Employee System Forgot Password Verfication Code';
        $bodyContent = '<h1 style="color:green;">Your Verification code is ' . $code . '</h1>';
        $mail->Body    = $bodyContent;

        if (!$mail->send()) {
            echo "Varification code sending failed";
        } else {
            echo "Success";
        }
    } else {
        echo ("Invalid email address");
    }
}
