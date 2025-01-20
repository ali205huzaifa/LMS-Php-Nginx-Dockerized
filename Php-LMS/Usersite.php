<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<head>
<title>User</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  font-family: "Corbel", Times, serif;
  background-color:#f3f3f2;
}
.navbar {
  overflow: hidden;
  background-color: #4a6896;
  font-family: "Corbel", Times, serif;
}

.navbar a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 16px;  
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}
.navbar a:hover, .dropdown:hover .dropbtn {
  background-color: #3b5378;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {
  background-color: #ddd;
}
a:hover{
  color:green;
}

.dropdown:hover .dropdown-content {
  display: block;
}
h3{
  text-align:left;
}
#sidebar {
  float: left;
  width: 20%; 
  height: 82vh; 
  background-color: #eaedf9; 
}
</style>
</head>
<body>
<h3>User Site</h3>
<div class="navbar">
  <a style="float: right; color: white; padding: 14px 16px; text-decoration: none;" onclick="logout()">Logout</a>
</div>

<div id="sidebar">
      <br>
      <a href="Booklist.php">Rent a Book</a>
      <br><br>
      <a href="Reserved.php">Reserved Book's</a>
</div>

<script>
function logout() {
    if (confirm('Are you sure you want to logout?')) {
        window.location.href = 'logout.php';
    }
}
</script>

</body>
</html>