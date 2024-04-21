<?php
session_start();
if(!isset($_SESSION['login']) || $_SESSION['login'] != true) {
    header('location: login.php');
    exit;
}
$username = $_SESSION['username'];
$name = $_SESSION['name'];
$email = $_SESSION['email'];
$gender = $_SESSION['gender'];
$phone = $_SESSION['phone'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome</title>
  <style>
    
.profile-wrapper {
    background-color: #f7f7f7cc;
    border-bottom: 5px solid #165ee4;
    padding: 40px 20px;
    font-family: "Inter", sans-serif;
}

.profile-container {
    width: 600px;
    margin: 0 auto;
}

.header-line {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
}

.profile-panel {
    border: 1px solid #ddd;
    border-radius: 4px;
    margin-bottom: 20px;
    background-color: #fff;
}

.profile-panel .panel-heading {
    background-color: #165ee4;
    color: #fff;
    padding: 10px 15px;
}

.profile-panel .panel-body {
    padding: 15px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    margin-bottom: 5px; 
}

.form-control {
    width: calc(100% - 20px);
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

#log1{
    font-size: 15px;
    border: 1px solid #000;
    border-radius: 4px;
    color: #fff;
    padding: 10px 15px;
}

#log{
    background-color: #165ee4;
    font-size: 15px;
    border-radius: 4px;
    color: #fff;
    padding: 10px 15px;
}
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#"><img src="assets/PHP-logo.svg.png" height="35px"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">iSecure</a>
              </li>
              </li>
            </ul>
            <div class="nav-item nav-link active" id="log1" onclick="logout()">Logout</div>
          </div>
        </div>
      </nav>
<div class="profile-wrapper">
    <div class="profile-container">
        <h4 class="header-line">My Profile</h4>
        <div class="profile-row">
            <div class="profile-panel">
                <div class="panel-heading">
                    My Profile
                </div>
                <div class="panel-body">
                    <form>
                    <div class="form-group">
                        <label>Full Name:</label>
                        <input class="form-control" type="text" name="full_name" value="<?php echo $name; ?>" readonly />
                    </div>
                    <div class="form-group">
                        <label>Username:</label>
                        <input class="form-control" type="text" name="username" value="<?php echo $username; ?>" readonly />
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input class="form-control" type="text" name="email" value="<?php echo $email; ?>" readonly />
                    </div>
                    <div class="form-group">
                        <label>Gender:</label>
                        <input class="form-control" type="text" name="gender" value="<?php echo $gender; ?>" readonly />
                    </div>
                    <div class="form-group">
                        <label>Phone:</label>
                        <input class="form-control" type="text" name="phone" value="<?php echo $phone; ?>" readonly />
                    </div>
                    </form>
            </div>
        </div>
        <center><button id="log" type="button" onclick="logout()" >Logout</button></center>
    </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script> 
function logout(){
window.location.href = 'logout.php';
}
</script>
</body>
</html>