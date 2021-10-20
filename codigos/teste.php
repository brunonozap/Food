<?php

namespace nozapfood\public_html;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';
$mail = new \PHPMailer\PHPMailer\PHPMailer();

$mail->isSMTP();
$mail->Host = 'mail.nozapfood.com.br';
$mail->SMTPAuth = true;
$mail->Username = 'noreply@nozapfood.com.br';
$mail->Password = 'Shopenozap@21';
$mail->SMTPDebug = 0;
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

$mail->setFrom('noreply@nozapfood.com.br', 'Mailtrap');
$mail->addReplyTo('info@nozapfood.com.br', 'Mailtrap');
$mail->addAddress('danilobrum03@hotmail.com', 'Danilo');
$mail->addCC('brunoferreira378@gmail.com', 'Bruno');
//$mail->addBCC('bcc1@example.com', 'Alex');

$mail->Subject = 'Test Email via SMTP using PHPMailer';

$mail->isHTML(true);

$mailContent = "<h1>Send HTML Email using SMTP in PHP</h1>
    <p>This is a test email I’m sending using SMTP mail server with PHPMailer.</p>";
$mail->Body = $mailContent;

if($mail->send()){
    echo 'Message has been sent';
}else{
    echo 'Message could not be sent.';
    echo '<br /><br />Mailer Error: ' . $mail->ErrorInfo;
}