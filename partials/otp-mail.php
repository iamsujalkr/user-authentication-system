<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email, $otp){
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
        $mail->Subject = 'OTP Verification';
        $mail->Body    = "<html><body><div style=;font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2;>
        <div style=;margin:50px auto;width:70%;padding:20px 0;>
          <div style=;border-bottom:1px solid #eee;>
            <p style=;font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600;>iSecure</p>
          </div>
          <p style=;font-size:1.1em;>Hi,</p>
          <p>Thank you for choosing iSecure. Use the following OTP to complete your Sign Up procedures.</p>
          <h2 style=;background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;;>$otp</h2>
          <p style=;font-size:0.9em;;>Regards,<br />iSecure</p>
          <hr style=;border:none;border-top:1px solid #eee; />
          <div style=;float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300;>
            <p>iSecure</p>
            <p>India</p>
          </div>
        </div>
      </div></body></html>";

        $mail->send();
        return true;
    } 
    catch (Exception $e) {
        return false;
    }
}
?>
