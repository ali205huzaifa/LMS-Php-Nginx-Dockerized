<?php
require 'dbconfig.php';

$showErr = $showsuccess = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `users` WHERE `username` = '$username'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row['id'];

            if ($row['role'] == 'admin') {
                header("Location: Adminsite.php");
            } else {
                header("Location: Usersite.php");
            }
            exit;
        } else {
            $showErr = "Invalid password.";
        }
    } else {
        $showErr = "No account found with that username.";
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
  </style>
</head>
<body>
  <div id="Err"><?php echo $showErr; ?></div> 
  <div class="d-flex justify-content-center">
    <form action="login.php" method="post">
      <h3 class="mt-4" style="margin-top:5%;"> Login Here </h3>
      <div class="form-group mt-3">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>  
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>        
      <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary mr-2"> Login </button>
      </div>
      <p class="text-center" style="font-size:15px; margin-top:4%;">If you are not Registered, <a href="index.php">Click here</a>.</p>
    </form>
  </div>
</body>
</html>