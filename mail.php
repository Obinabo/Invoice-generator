<?php
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';
use phpmailer\phpmailer\PHPMailer;

function sendEmail($recipient, $subject, $body) {
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'walterobinabo@gmail.com';
    $mail->Password = 'Obinabo1995';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    
    // Set email content and recipient(s)
    $mail->setFrom('walterobinabo@gmail', 'Wally');
    $mail->addAddress($recipient);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;
    
    // Send the email
    if (!$mail->send()) {
        return 'Error: ' . $mail->ErrorInfo;
    } /*else {
        return 'Message sent!';
    }*/
}
?>
