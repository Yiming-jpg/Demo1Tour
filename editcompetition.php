<?php
session_start();

if (!isset($_SESSION["username"])) {
  header("location:login.php");
}
include 'header.php';

$host = "localhost";
$user = "root";
$password = "";
$db = "user";

// Create connection
$conn = mysqli_connect($host, $user, $password, $db);

if ($conn === false) {
  die("connection error");
}

// Get the id of the class to be edited from the query string
$id = $_GET["id"];

// Get the details of the class from the database
$sql = "SELECT * FROM concerts WHERE id=$id";
$result = mysqli_query($conn, $sql);
$class = mysqli_fetch_assoc($result);

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the updated details of the class from the form
  $name = mysqli_real_escape_string($conn, $_POST["name"]);
  $description = mysqli_real_escape_string($conn, $_POST["description"]);
  $url = mysqli_real_escape_string($conn, $_POST["url"]);

  // Update the details of the class in the database
  $sql = "UPDATE competitions SET name='$name', description='$description', url='$url' WHERE id=$id";
  mysqli_query($conn, $sql);

  // Check if an image was uploaded
  if (!empty($_FILES["image"]["name"])) {
    // Get the file name and extension
    $filename = basename($_FILES["image"]["name"]);
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // Generate a unique name for the file
    $new_filename = uniqid() . "." . $extension;

    // Move the uploaded file to the img directory
    move_uploaded_file($_FILES["image"]["tmp_name"], "img/" . $new_filename);

    // Update the image path in the database
    $image = "img/" . $new_filename;
    $sql = "UPDATE competitions SET image='$image' WHERE id=$id";
    mysqli_query($conn, $sql);
  }

  // Redirect to the admin panel
  header("location:content-management.php");
}
?>

<html>
  <head>
    <meta charset="UTF-8">
    <title>Edit Competitions - Music Society</title>
  </head>
  <body>
    <div class="admin-panel">
      <h3>Edit Competition</h3>
      <form method="post">
        <label>Name:</label><br>
        <input type="text" name="name" value="<?php echo $class["name"] ?>"><br><br>
        <label>Description:</label><br>
        <textarea name="description"><?php echo $class["description"] ?></textarea><br><br>
        <label>Image:</label><br>
        <input type="text" name="image" value="<?php echo $class["image"] ?>"><br><br>
        <label>URL:</label><br>
        <input type="text" name="url" value="<?php echo $class["url"] ?>"><br><br>
        <input type="submit" value="Save Changes">
      </form>
    </div>
  </body>
</html>
