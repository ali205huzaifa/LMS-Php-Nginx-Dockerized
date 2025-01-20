<?php 
include 'Adminsite.php';
include 'dbconfig.php';

if(isset($_GET['delete'])){
  $id = $_GET['delete'];
  $sql = "DELETE FROM `books` WHERE `id` = $id";
  $result = mysqli_query($conn, $sql);
}
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
    .edit{
      
      color:#3377ff;
    }
    .delete{
      color:#ff3333;
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
                <button class='edit btn btn-sm btn-primary' id='".$row['id']."'><i class='fa fa-edit'></i></button>
                <button class='delete btn btn-sm btn-primary' id='d".$row['id']."'><i class='fa fa-trash'></i></button>
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
    });
  </script>
  <script>

    let edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {

        let id = e.target.closest("button").id;

      window.location.href = `Editbook.php?edit=${id}`;
      });
    });

    let deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
  
        let id = e.target.closest("button").id.substr(1);

        if (confirm("Are you sure you want to delete this entry?")) {
          window.location = `Inventory.php?delete=${id}`;
        }
      });
    });
  </script>
</body>
</html>