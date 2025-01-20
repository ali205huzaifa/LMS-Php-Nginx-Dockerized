<?php
include 'dbconfig.php';

$showAlert = false;
$showErr = "";

$BookName = '';
$Author = '';
$Category = '';
$Bookpic = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $BookName = $_POST["BookName"];
    $Author = $_POST["Author"];
    $Category = $_POST["Category"];
    
    if (isset($_FILES['Bookpic']) && $_FILES['Bookpic']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['Bookpic']['tmp_name'];
        $fileName = $_FILES['Bookpic']['name'];
        $fileSize = $_FILES['Bookpic']['size'];
        $fileType = $_FILES['Bookpic']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedExts = array("jpg", "jpeg", "png", "gif", "jfif");

        if (in_array($fileExtension, $allowedExts)) {
            $uploadFileDir = 'uploads/';

            if (move_uploaded_file($fileTmpPath, $dest_path . $fileName)) {
                $Bookpic = $uploadFileDir . $fileName;
            } else {
                $showErr = "Error moving the file.";
            }
        } else {
            $showErr = "Invalid file extension.";
        }
    } else {
        $showErr = "No file uploaded or upload error.";
    }

    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $sql = "UPDATE `books` SET `BookName` = '$BookName', `Author` = '$Author', `Category` = '$Category', `Bookpic` = '$Bookpic' WHERE `id` = $id";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("Location: /php-LMS/Inventory.php");
            exit();
        } else {
            $showErr = "Update failed. Please try again.";
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["edit"])) {
    $id = $_GET["edit"];
    $sql = "SELECT * FROM `books` WHERE `id` = $id";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $BookName = $row["BookName"];
        $Author = $row["Author"];
        $Category = $row["Category"];
        $Bookpic = $row["Bookpic"];
    }
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="Editstyle.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Edit Book</title>
</head>
<body>
<div id="Err"><?php echo $showErr; ?></div>
  <div style="height:500px;background-color:white;" class="wrapper">
    <h3>Edit Book</h3>
    <form action="Editbook.php<?php echo isset($_GET["edit"]) ? "?edit=".$_GET["edit"] : ""; ?>" method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label" for="BookName">Book Name: </label>
        <input style="height:30px;" class="form-control" type="text" id="BookName" name="BookName" value="<?php echo htmlspecialchars($BookName); ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label" for="Author">Author: </label>
        <input style="height:30px;" class="form-control" type="text" id="Author" name="Author" value="<?php echo htmlspecialchars($Author); ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label" for="Category">Category: </label>
        <input style="height:30px;" class="form-control" type="text" id="Category" name="Category" value="<?php echo htmlspecialchars($Category); ?>" required>
      </div>
      <div class="mb-3">
        <label class="form-label" for="Bookpic">Book Image: </label>
        <input type="file" id="Bookpic" name="Bookpic" <?php echo !empty($Bookpic) ? '' : 'required'; ?>>
        <?php if (!empty($Bookpic)) : ?>
          <p>Current Image: <img src="<?php echo htmlspecialchars($Bookpic); ?>" alt="Book Image" style="max-width: 100px; height: auto;"></p>
        <?php endif; ?>
      </div>
      <button type="submit" id="btn">Update</button>
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
</body>
</html>