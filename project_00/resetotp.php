<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_POST['signunamenew'];
    $otp=$_POST['otpval'];
    $mail=new PHPMailer(true);

    try{
        $mail->isSMTP();
        $mail->Host='smtp.gmail.com';
        $mail->SMTPAuth=true;
        $mail->Username='your_mail_here';
        $mail->Password='your_app_password_here';
        $mail->SMTPSecure='tls';
        $mail->Port=587;

        $mail->setFrom('your_mail_here','Safari');
        $mail->addAddress($username);
        $mail->isHTML(true);

        $mail->Subject = 'Safari Email Verification';
        $mail->Body = 'Reset OTP:'."$otp";
        $mail->send();
        echo "success";
    }
    catch(Exception $e){
        echo "Email could not be sent. Error: {$mail->ErrorInfo}";
    }   
}
?>