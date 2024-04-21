<?php
$server = "localhost";
$user = "root";
$password = "";
$dbname = "users";

$conn = mysqli_connect($server, $user, $password, $dbname);

if(!$conn){
    require '../session-stop.php';
    echo "Could not connect to Server";
    exit;
}
?>