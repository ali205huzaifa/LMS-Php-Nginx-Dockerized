<?php
include 'Adminsite.php';
include 'dbconfig.php';

$showErr = "";
$showsuccess = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $BookName = $_POST["BookName"];
    $Author = $_POST["Author"];
    $Category = $_POST["Category"];
    $Bookpic = $_FILES["Bookpic"];

    $allowedExtensions = ['jpg', 'jpeg', 'png', 'jfif'];
    $fileExtension = pathinfo($Bookpic["name"], PATHINFO_EXTENSION);
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($Bookpic["name"]);
    
    if (in_array($fileExtension, $allowedExtensions)) {
        if (move_uploaded_file($Bookpic["tmp_name"], $uploadFile)) {
            $sql = "INSERT INTO `books` (`BookName`, `Author`, `Category`, `Bookpic`) VALUES ('$BookName', '$Author', '$Category', '$uploadFile')";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                $showsuccess = "Book added successfully!";
            } else {
                $showErr = "Error adding the book.";
            }
        } else {
            $showErr = "Error uploading file.";
        }
    } else {
        $showErr = "Invalid file type. Only jpg, jpeg, and png files are allowed.";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="Addstyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add Book</title>
    <style>
        h3 {
            margin-top: 2%;
        }
        .navbar {
            margin-top: 2%;
        }
        #Bookpic{
            margin-left:4%;
        }
    </style>
</head>
<body>
<div id="Err"><?php echo $showErr; ?></div>
<div id="success"><?php echo $showsuccess; ?></div>
<div style="height:425px;" class="wrapper">
    <h3>Add Book</h3>
    <form action="Addbook.php" method="post" enctype="multipart/form-data">
        <div class="input-box">
            <input type="text" id="BookName" name="BookName" placeholder="Enter Book Name" minlength="2" required>
        </div>
        <div class="input-box">
            <input type="text" id="Author" name="Author" placeholder="Enter Author" minlength="2" required>
        </div>
        <div class="input-box">
            <input type="text" id="Category" name="Category" placeholder="Enter Category" minlength="2" required>
        </div>
        <div>
            <input type="file" id="Bookpic" name="Bookpic" required>
        </div>
        <button type="submit" class="btn">Save</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
</body>
</html>