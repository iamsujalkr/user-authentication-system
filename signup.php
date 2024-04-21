<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
	// Connecting to Database
	require 'partials/_dbconnect.php';

	// Extracting user information
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$phone = mysqli_real_escape_string($conn, $_POST['phone']);
	$gender = mysqli_real_escape_string($conn, $_POST['gender']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

	// SQL for checking if username exists
	$existsql = "SELECT username FROM `users` WHERE `username` = '$username'";
	$result = mysqli_query($conn, $existsql);
	$usernameexists = mysqli_num_rows($result);

	// SQL for checking if email exists
	$existsql = "SELECT email FROM `users` WHERE `email` = '$email'";
	$result = mysqli_query($conn, $existsql);
	$emailexists = mysqli_num_rows($result);

	// SQL for checking if phone exists
	$existsql = "SELECT phone FROM `users` WHERE `phone` = '$phone'";
	$result = mysqli_query($conn, $existsql);
	$phoneexist = mysqli_num_rows($result);

	if($usernameexists > 0){
		echo"<script>alert('Username already exists')</script>";
	}
	elseif($emailexists > 0){
		echo"<script>alert('Email already linked to an account')</script>";
	}
	elseif($phoneexist > 0){
		echo"<script>alert('Phone already linked to an account')</script>";
	}
	elseif($password != $cpassword){
		echo"<script>alert('Passwords do not match')</script>";
	}
	else{
    // Entry in Database only after OTP verification
    session_start();
    $_SESSION['register'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    $_SESSION['phone'] = $phone;
    $_SESSION['gender'] = $gender;
    $_SESSION['password'] = $password;
    $_SESSION['otp'] = rand(100000,999999);
    $_SESSION['resend'] = 4;
    $_SESSION['retry'] = 4;
    header('location: verify.php');
	}
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="assets/signup.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <div class="title">Registration</div>
    <div class="content">
      <form method="post">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Full Name</span>
            <input type="text" placeholder="Enter your name" name="name" required>
          </div>
          <div class="input-box">
            <span class="details">Username</span>
            <input type="text" placeholder="Enter your username" name="username" required>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="email" placeholder="Enter your email" name="email" required>
          </div>
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="text" placeholder="Enter your number" name="phone" minlength="10" maxlength="10" required>
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" placeholder="Enter your password" name="password" required>
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="password" placeholder="Confirm your password" name="cpassword" required>
          </div>
        </div>
        <div class="gender-details">
          <input type="radio" name="gender" value="M" id="dot-1" required>
          <input type="radio" name="gender" value="F" id="dot-2">
          <input type="radio" name="gender" value="T" id="dot-3">
          <span class="gender-title">Gender</span>
          <div class="category">
            <label for="dot-1">
            <span class="dot one"></span>
            <span class="gender">Male</span>
          </label>
          <label for="dot-2">
            <span class="dot two"></span>
            <span class="gender">Female</span>
          </label>
          <label for="dot-3">
            <span class="dot three"></span>
            <span class="gender">Prefer not to say</span>
            </label>
          </div>
        </div>
        <div class="button">
          <input type="submit" value="Register">
        </div>
      </form>
      <div class="login" >
        <a href="login.php">Already have an account</a>
      </div>
    </div>
  </div>
</body>
</html>
