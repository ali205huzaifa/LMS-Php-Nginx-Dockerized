<?php
require 'dbconfig.php';

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

$sql = "SELECT * FROM rentals";
$result = mysqli_query($conn, $sql);
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="bootstrap.min.css">
  <title>Book Logs</title>
  <style>
    body {
      background-color: #f3f3f2;
      font-family: "Corbel", Times, serif;
    }
    table {
      width: 80%;
      margin: auto;
      background-color: #ffffff;
      border-collapse: collapse;
      box-shadow: 0 2px 15px rgba(64, 64, 64, 0.2);
      border-radius: 12px 12px 0 0;
      overflow: hidden;
    }
    th, td {
      padding: 12px 15px;
      text-align: center;
    }
    th {
      background-color: #4a6896;
      color: #ffffff;
      font-family: "Corbel", Times, serif;
      text-transform: uppercase;
    }
    tr:nth-child(even) {
      background-color: #f3f3f2;
    }
  </style>
</head>
<body>
  <div class="container my-4">
    <h3 class="text-center">Book Rental Logs</h3>
    <table class="table">
      <thead>
        <tr>
          <th>Log ID</th>
          <th>Book ID</th>
          <th>User ID</th>
          <th>Username</th>
          <th>Rent Duration</th>
          <th>Purpose</th>
          <th>Rented At</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['book_id']}</td>
                        <td>{$row['user_id']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['rent_duration']}</td>
                        <td>{$row['purpose']}</td>
                        <td>{$row['rented_at']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No rental logs found.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>