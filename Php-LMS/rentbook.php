<?php
require 'dbconfig.php';

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

$showErr = $showsuccess = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = $_POST['book_id'];
    $rent_duration = $_POST['rent_duration'];
    $purpose = $_POST['purpose'];
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];

    $sql = "INSERT INTO Rentals (book_id, user_id, username, rent_duration, purpose) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iisss", $book_id, $user_id, $username, $rent_duration, $purpose);

    if (mysqli_stmt_execute($stmt)) {
        $showsuccess = "Book rented successfully!";
    } else {
        $showErr = "There was an error renting the book.";
    }

    mysqli_stmt_close($stmt);
}

?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="bootstrap.min.css">
  <title>Rent a Book</title>
  <style>
    #Err{
    margin-left:20%;
    color:red;
    margin-top:2%;
    font-size:15px;
    }
    #success{
        margin-left:20%;
        color:green;
        margin-top:2%;
        font-size:15px;
    }
    </style>
</head>
<body>
<div id="Err"><?php echo $showErr; ?></div>
<div id="success"><?php echo $showsuccess; ?></div>
  <div class="container my-4">
    <h3 class="text-center">Rent a Book</h3>
    <form action="rentbook.php" method="post">
      <div class="form-group col-md-3">
        <label for="rent_duration">Rent Duration: </label>
        <input type="text" class="form-control" id="rent_duration" name="rent_duration" required>
      </div>
      <div class="form-group col-md-3">
        <label for="purpose">Purpose of Renting</label>
        <input type="text" class="form-control" id="purpose" name="purpose" required>
      </div>
      <input type="hidden" name="book_id" value="<?php echo $_GET['bookId']; ?>">
      <button type="submit" class="btn btn-primary">Rent Book</button>
    </form>
  </div>
</body>
</html>