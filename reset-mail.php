<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email, $token){
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    require 'PHPMailer/src/Exception.php';

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            
        $mail->Host       = 'smtp.gmail.com';                     
        $mail->SMTPAuth   = true;                                 
        $mail->Username   = 'Your email';        
        $mail->Password   = 'Your password';                   
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;       
        $mail->Port       = 587;                                  

        //Recipients
        $mail->setFrom('Your email', 'iSecure');
        $mail->addAddress($email);    

        //Content
        $mail->isHTML(true);                                 
        $mail->Subject = 'Reset Password Link';
        $mail->Body    = "Click here to <a href='localhost/phprpg/loginsystem/reset-password.php?token=$token'>Reset Password</a>";

        $mail->send();
        return true;
    } 
    catch (Exception $e) {
        return false;
    }
}
?>