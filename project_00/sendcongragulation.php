<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_SESSION['signunamenew'];
    $mail=new PHPMailer(true);

    try{
        $mail->isSMTP();
        $mail->Host='smtp.gmail.com';
        $mail->SMTPAuth=true;
        $mail->Username='*your_email_id*';
        $mail->Password='*your_email_app_password*';
        $mail->SMTPSecure='tls';
        $mail->Port=587;

        $mail->setFrom('*your_email_id*','Safari');
        $mail->addAddress($username);
        $mail->isHTML(true);

        $mail->Subject = 'Safari Successful Registration';
        $mail->Body = "Thank you for choosing us";
        $mail->send();
        echo "success";
    }
    catch(Exception $e){
        echo "Email could not be sent. Error: {$mail->ErrorInfo}";
    }   
}
?>