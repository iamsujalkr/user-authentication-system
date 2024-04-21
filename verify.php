<?php
session_start();
// This page not availabe if there is no registration process going on
if(!isset($_SESSION['register']) || $_SESSION['register'] != true){
    require 'session-stop.php';
    header('location: signup.php');
    exit;
}

// Connecting to database
require 'partials/_dbconnect.php';
// Including Mailer file
require 'partials/otp-mail.php';

// if user does not enter OTP
if(isset($_POST['sub']) and empty($_POST['pin'])){
    echo "<script>alert('Enter the OTP to proceed')</script>";
    goto flag;
}

// if user exceeds the maximum OTP entering limit
if($_SESSION['retry'] == 0){
    require 'session-stop.php';
    echo "<script>alert('Max OTP limit reached')
                window.location.href = 'signup.php'
            </script>";
    exit;

}

// extracting user data from session variables
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$name = $_SESSION['name'];
$phone = $_SESSION['phone'];
$gender = $_SESSION['gender'];
$password = $_SESSION['password'];
$otp = $_SESSION['otp'];

// Block for sending mail to user 
if(!isset($_POST['sub']) or isset($_POST['resend'])){
    if($_SESSION['retry'] != 0){
        if(!sendMail($email, $otp)){
            require 'session-stop.php';
            echo "<script>alert('Some error occured, try again')
                    window.location.href = 'signup.php'
                </script>";
            exit;
        }
        $_SESSION['resend']--;
    }
    else{
        require 'session-stop.php';
        echo "<script>alert('Max Resend limit reached')
                window.location.href = 'signup.php'
            </script>";
        exit;
    }
}

// Verifying OTP then entering in database
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['pin']) and !empty($_POST['pin'])){
        $pin = mysqli_real_escape_string($conn, $_POST['pin']);
        if($pin == $otp){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`username`, `name`, `email`, `phone`, `gender`,`password`) VALUES ('$username', '$name', '$email', '$phone','$gender', '$hash')";
            $result = mysqli_query($conn, $sql);
            if($result){
                echo "<script>alert('Account created succesfully, You can now login')
                    window.location.href = 'login.php'   
                    </script>";
            }
            else{
                require 'session-stop.php';
                echo "<script>alert('Some error occured, try again')
                    window.location.href = 'signup.php'
                    </script>";
            }
        }
        else{
            $_SESSION['retry']--;
            echo "<script>alert('Wrong OTP, Enter again')</script>";
        }
    }
}
flag:
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title>OTP</title>
    <link rel="stylesheet" href="assets/login.css" />
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>
    <div class="container">
      <form method="post">
        <div class="title">OTP Verification</div>
        <h5>An OTP has been sent to your Email-Id</h5>
        <div class="input-box underline">
          <input type="text" placeholder="Enter the OTP" maxlength="6" minlength="6" name="pin" />
          <div class="underline"></div>
        </div>
        <div class="input-box button">
          <input type="submit" name="sub" value="Submit OTP" />
        </div>
        <div class="input-box button">
          <input type="submit" name="retry" value="Resend OTP" />
        </div>
      </form>
    </div>
  </body>
</html>