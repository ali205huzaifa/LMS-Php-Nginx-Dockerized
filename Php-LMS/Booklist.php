<?php
include 'Usersite.php';

include 'dbconfig.php';
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <title>My Library</title>
  <style>
    body{
      background-color:#f3f3f2;
      font-family: "Corbel", Times, serif;
    }
    a:hover {
      color:green;
    }
    td{
      text-align:center;
      font-family: "Verdana", Times, serif;
      font-size:11px;
    }
    th{
      font-size:13px;
      background-color: #8095b6;
    }
    #myTable tr:nth-child(odd){
      background-color: #eaedf9;
    }
    #myTable tr:nth-child(even){
      background-color:#ffffff;
    }
    #content {
      float:right;
      width: 79%;
      padding:2px;
    }
  </style>
</head>
<body>
<h4 style="margin-left:2%; margin-top:2%;"> Books Inventory: </h4>
<div id="content">
  <div class="container my-4">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">Book Image</th>
          <th scope="col">Book Name</th>
          <th scope="col">Author</th>
          <th scope="col">Category</th>
          <th scope="col">Time</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php 
        $sql = "SELECT * FROM `books`";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
          echo "<tr>
            <td><img src='". $row['Bookpic'] . "' alt='Book Cover' style='width:50px; height:auto;'></td>
            <td>". $row['BookName'] . "</td>
            <td>". $row['Author'] . "</td>
            <td>". $row['Category'] . "</td>
            <td>". $row['created_at'] . "</td>
            <td>
                <button class='rent btn btn-sm btn-success' data-id='".$row['id']."'><i class='fa fa-book'></i> Rent</button>
            </td>
            </tr>";
    } 
    ?>
      </tbody>
    </table>
  </div>
</div>

<hr>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
<script>
  $(document).ready(function () {
    $('#myTable').DataTable();

    $('.rent').on('click', function() {
      var bookId = $(this).data('id');
      window.location.href = 'rentbook.php?bookId=' + bookId;
    });
  });
</script>
</body>
</html>