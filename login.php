<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
  	// Connecting to database
	require 'partials/_dbconnect.php';

	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

  	// SQL for checking if username exists
	$sql = "SELECT * FROM `users` WHERE `username` = '$username'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
  
  	// If username exists then verifying password 
	if($num == 1){
		$row = mysqli_fetch_assoc($result);
    if(password_verify($password, $row['password'])){
      session_start();
      $_SESSION["login"] = true;
      $_SESSION['username'] = $username;
      $_SESSION['name'] = $row['name'];
      $_SESSION['email'] = $row['email'];
      $_SESSION['gender'] = $row['gender'];
      $_SESSION['phone'] = $row['phone'];
      header("location: welcome.php");
    }
    else{
      echo"<script>alert('Invalid Credentials')</script>";
    }
  }
	else{
		echo"<script>alert('Invalid Credentials')</script>";
	}
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title>Login</title>
    <link rel="stylesheet" href="assets/login.css" />
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body>
    <div class="container">
      <form method="post">
        <div class="title">Login</div>
        <div class="input-box underline">
          <input type="text" placeholder="Enter Your Username" name="username" required />
          <div class="underline"></div>
        </div>
        <div class="input-box">
          <input type="password" placeholder="Enter Your Password" name="password" required />
          <div class="underline"></div>
        </div>
        <div class="input-box button">
          <input type="submit" value="Continue" />
        </div>
      </form>
      <div class="twitter">
        <a href="signup.php"><i class="fab fa-twitter"></i>Register</a>
      </div>
      <div class="facebook">
        <a href="forgot.php"><i class="fab fa-facebook-f"></i>Forgot Password?</a>
      </div>
    </div>
  </body>
</html>