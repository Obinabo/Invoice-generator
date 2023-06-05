<?php
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';
use phpmailer\phpmailer\PHPMailer;

function sendEmail($recipient, $subject, $body) {
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host = 'server288.web-hosting.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'support@melksreality.com';
    $mail->Password = 'realmacmem2023';
    $mail->SMTPSecure = '';
    $mail->Port = 587;
    
    // Set email content and recipient(s)
    $mail->setFrom('support@melksreality.com', 'MelksReality Support');
    $mail->addAddress($recipient);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->Send();
}
?>
