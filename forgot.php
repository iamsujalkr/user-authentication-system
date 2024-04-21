<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require 'partials/_dbconnect.php';
    $username = mysqli_escape_string($conn, $_POST['username']);
    $email = mysqli_escape_string($conn, $_POST['email']);

    $sql = "SELECT * FROM users WHERE username = '$username' AND email = '$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if($num == 1){
        $token = bin2hex(random_bytes(16));
        $tokenHash = hash('sha256', $token);
        date_default_timezone_set("Asia/Kolkata");
        $expire = date('Y-m-d H:i:s',time() + 60 * 30);

        $sql = "UPDATE users SET token = '$tokenHash', token_expire = '$expire' WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_affected_rows($conn)) {
            require 'partials/reset-mail.php';
            if(sendMail($email, $token)){
                echo "<script>alert('An email has been sent to your registered email for resetting your password')</script>";
            }
            else{
                echo "<script>alert('Some error occured, try again')</script>";
            }
        }
        else{
            echo "<script>alert('Some error occured, try again')</script>";
        }
    }
    else{
        echo "<script>alert('Username/Email not found')</script>";
    }

}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title>Forgot Password</title>
    <link rel="stylesheet" href="assets/login.css" />
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>
    <div class="container">
      <form method="post">
        <div class="title">Forgot Password</div>
        <div class="input-box underline">
          <input type="text" placeholder="Enter Your Username" name="username" required />
          <div class="underline"></div>
        </div>
        <div class="input-box">
          <input type="email" placeholder="Enter Your Email" name="email" required />
          <div class="underline"></div>
        </div>
        <div class="input-box button">
          <input type="submit" value="Continue" />
        </div>
      </form>
      <div class="twitter">
        <a href="login.php"><i class="fab fa-twitter"></i>Cancel</a>
      </div>
    </div>
  </body>
</html>