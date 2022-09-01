<?php
error_reporting(E_ALL); ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../utils/vendor/autoload.php';

$mail = new PHPMailer(true);

try {

    $website = 'appkiller.app';
    $message = nl2br($_POST['message']);
    
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;

    $mail->isSMTP();                                         
    $mail->Host       = "smtp.gmail.com";                    
    $mail->SMTPAuth   = true;                                
    $mail->Username   = 'yaniszaf@gmail.com';
    $mail->Password   = 'jN271086!@#';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom($_POST['email'], $_POST['name']);
    $mail->addReplyTo($_POST['email'], $_POST['name']);
    $mail->addAddress('info@ensili.co', 'enSili.co');

    $mail->isHTML(true);
    $mail->Subject = "[SUPPORT] ". $_POST['subject'];
    $mail->Body    = "<b>Website:</b><br>{$website}<br><br><b>Subject:</b><br>{$_POST['subject']}<br><br><b>Message:</b><br>{$message}";

    $mail->send();
    echo 'OK';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>