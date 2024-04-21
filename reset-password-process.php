<?php
if(!isset($_POST['token']) or empty($_POST['token'])){
    header('location: login.php');
    exit;
}
require 'partials/_dbconnect.php';

$token = $_POST['token'];
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
    else{
        $username = $row['username'];
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
        if($password == $cpassword){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET password = '$hash' WHERE username = '$username'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_affected_rows($conn)){
                $sql = "UPDATE users SET token = NULL , token_expire = NULL WHERE username = '$username'";
                $result = mysqli_query($conn, $sql);
                echo"<script>alert('Your password has been reset')
                window.location.href = 'login.php'
                </script>";
            }
            else{
                echo "<script>alert('Some error occured, try again')
                window.location.href = 'reset-password.php?token=$token'
                </script>";
            }
        }
        else{
            echo "<script>alert('Passwords do not match')
            window.location.href = 'reset-password.php?token=$token'
            </script>";
        }
    }
}
else{
    header('location: login.php');
}
?>