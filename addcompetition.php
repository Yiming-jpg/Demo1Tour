<?php
// Connect to database
$host = "localhost";
$user = "root";
$password = "";
$db = "user";

$data = mysqli_connect($host, $user, $password, $db);

if ($data === false) {
    die("connection error");
}

// Check if form is submitted
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    
    // Move the uploaded file to the img directory and get the path
    $image_path = '';
    if (isset($_FILES['image'])) {
        $target_dir = "img/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_path = $target_file;
        } else {
            // Handle error if file upload failed
            echo "Sorry, there was an error uploading your file.";
        }
    }
    
    // Generate the URL based on the class name
    $url = "event-registration.php?eventName=" . urlencode($name);

    // Insert the new class into the classes table
    $sql = "INSERT INTO competitions (name, description, image, url) VALUES ('$name', '$description', '$image_path', '$url')";
    mysqli_query($data, $sql);

    // Redirect to content-management.php after adding class
    header("location: content-management.php");
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Music Society Admin Panel - Add Competitions</title>
  </head>
  <body>
    <h1>Add Competitions</h1>
    <form method="post" action="" enctype="multipart/form-data">
      <label for="name">Name:</label><br>
      <input type="text" id="name" name="name"><br><br>

      <label for="description">Description:</label><br>
      <input type="text" id="description" name="description"><br><br>

      <label for="image">Image:</label><br>
      <input type="file" id="image" name="image"><br><br>

      <!-- The URL input is disabled and its value is generated automatically based on the class name -->
      <label for="url">URL:</label><br>
      <input type="text" id="url" name="url" disabled><br><br>

      <input type="submit" name="submit" value="Add Competition">
    </form>
    <script>
      // Generate the URL based on the class name when the name input is changed
      document.getElementById('name').addEventListener('input', function() {
        var name = this.value;
        var url = "event-registration.php?eventName=" + encodeURIComponent(name);
        document.getElementById('url').value = url;
      });
    </script>
  </body>
</html>
