<?php
if(!isset($_GET['token']) or empty($_GET['token'])){
    header('location: login.php');
    exit;
}
require 'partials/_dbconnect.php';

$token = $_GET['token'];
$tokenHash = hash('sha256', $token);

$sql = "SELECT * FROM users WHERE token = '$tokenHash'";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);
if($num == 1){
    $row = mysqli_fetch_assoc($result);
    $expire = $row['token_expire'];
    date_default_timezone_set("Asia/Kolkata");
    if(strtotime($expire) <= time()){
        echo"<script>alert('Your password reset link has expired')
                window.location.href = 'login.php'
                </script>";
        exit;
    }
}
else{
    header('location: login.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title>Reset Password</title>
    <link rel="stylesheet" href="assets/login.css" />
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>
    <div class="container">
      <form action="reset-password-process.php" method="post">
        <div class="title">Reset Password</div>
        <div class="input-box underline">
          <input type="hidden" name="token" value="<?php echo "$token"; ?>">
          <input type="password" placeholder="Enter New Password" name="password" required />
          <div class="underline"></div>
        </div>
        <div class="input-box">
          <input type="password" placeholder="Confirm Password" name="cpassword" required />
          <div class="underline"></div>
        </div>
        <div class="input-box button">
          <input type="submit" value="Continue" />
        </div>
      </form>
    </div>
  </body>
</html>
