<?php
require 'dbconfig.php';

$showErr = $showsuccess = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $rpassword = $_POST["rpassword"];
    $exists = false;

    $usernamePattern = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/";
    $passwordPattern = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/";

    if (preg_match($usernamePattern, $username)) {
        if (preg_match($passwordPattern, $password)) {
            if ($password == $rpassword && !$exists) {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users` (`username`, `password`) VALUES ('$username', '$hash')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                  $showsuccess = "Your Account is created!";
                } else {
                    $showErr = "Username already exists.";
                }
            } else {
                $showErr = "Passwords do not match";
            }
        } 
    } 
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="bootstrap.min.css">
  <title>My Library</title>
    <style>
    #Err{
    margin-left:38%;
    color:red;
    margin-top:1%;
    font-size:22px;
    }
    #success{
        margin-left:38%;
        color:green;
        margin-top:1%;
        font-size:22px;
    }
    </style>
</head>
<body>
<div id="Err"><?php echo $showErr; ?></div>
 <div id="success"><?php echo $showsuccess ?></div>  
  <div class="d-flex justify-content-center">
  <form action="index.php" method="post">
    <h3 class= "mt-4">Sign Up Here</h3>
    <div class="form-group mt-3">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" minlength="8" title="Username must be at least 8 characters long and contain both letters and numbers">  
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" minlength="8" title="Username must be at least 8 characters long and contain both letters and numbers">
        </div>
        <div class="form-group">
            <label for="rpassword">Re-Enter Password</label>
            <input type="password" class="form-control" id="rpassword" name="rpassword" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" minlength="8" title="Username must be at least 8 characters long and contain both letters and numbers">
        </div>        
        <button type="submit" class="btn btn-primary">Register</button>
        <p style="margin-top: 2%;">Already Registered, <a href="login.php"> Login Now! </a> </p>
    </div>
    </form>
    </div>
</body>
</html>