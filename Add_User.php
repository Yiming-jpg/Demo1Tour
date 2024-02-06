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
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $usertype = $_POST['usertype'];

    // Insert the new user into the login table
    $sql = "INSERT INTO login (username, password, email, usertype) VALUES ('$username', '$password', '$email', '$usertype')";
    mysqli_query($data, $sql);

    // Redirect to adminhome.php after adding user
    header("location: UserManagement.php");
}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>AM TOUR Admin Panel - Add User</title>
  </head>
  <body>
    <h1>Add User</h1>
    <form method="post" action="">
      <label for="username">Username:</label><br>
      <input type="text" id="username" name="username"><br><br>

      <label for="password">Password:</label><br>
      <input type="password" id="password" name="password"><br><br>

      <label for="email">Email:</label><br>
      <input type="email" id="email" name="email"><br><br>

      <label for="usertype">User Type:</label><br>
      <select id="usertype" name="usertype">
        <option value="admin">Admin</option>
        <option value="user">user</option>
      </select><br><br>

      <input type="submit" name="submit" value="Add User">
    </form>
  </body>
</html>
