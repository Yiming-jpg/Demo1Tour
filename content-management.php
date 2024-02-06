<?php
session_start();


if(!isset($_SESSION["username"]))
{
	header("location:login.php");
}
include 'headeradmin.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Music Society Admin Panel</title>
    <style>
      body {
        background-color: white;
        margin: 0;
        padding: 0;
        color: black;
        font-family: Arial, sans-serif;
      }

      /* Style the header section */
      header {
        background-color: red;
        color: white;
        text-align: center;
        padding: 20px;
        margin-bottom: 0px;
      }

      /* Style the navigation section */
      nav {
        float: left;
        width: 200px;
        background-color: red;
        height: calc(100vh - 100px); /* Set the height of the navigation section to fill the remaining height of the viewport */
        padding: 20px;
        box-sizing: border-box;
      }

      nav ul {
        list-style: none;
        margin: 0;
        padding: 0;
      }

      nav li {
        margin: 0;
        padding: 0;
      }

      nav a {
        display: block;
        padding: 30px;
        color: white;
        text-decoration: none;
      }

      nav a:hover {
        background-color: #c00;
      }

      /* Style the main content section */
      main {
        margin-left: 220px; /* Set the left margin to push the main content section to the right of the navigation section */
        padding: 20px;
        box-sizing: border-box;
      }

    </style>
  </head>
      <nav>
        <ul>
        <li><a href="adminhome.php">User Management</a></li>
        <li><a href="content-management.php">Content Management</a></li>
        <li><a href="registered-event.php">Registered Event User</a></li>
        </ul>
      </nav>
    </header>
    <main>
<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "user";

// Create connection
$data = mysqli_connect($host, $user, $password, $db);

if ($data === false) {
    die("connection error");
}

// Retrieve data from database
$sql = "SELECT * FROM classes";
$result = mysqli_query($data, $sql);

// Display data in a table
echo "<table border='1'>
<tr>
<th>ID</th>
<th>Name</th>
<th>Description</th>
<th>Image</th>
<th>Actions</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['id'] . "</td>";
echo "<td>" . $row['name'] . "</td>";
echo "<td>" . $row['description'] . "</td>";
echo "<td>" . $row['image'] . "</td>";
echo "<td><a href='editclass.php?id=" . $row['id'] . "'>Edit</a> | <a href='deleteclass.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this class?\")'>Delete</a></td>";
echo "</tr>";
}
echo "</table>";
echo"<a href='addclass.php'>Add</a>";

echo"<br><br><br>";


$sql = "SELECT * FROM concerts";
$result = mysqli_query($data, $sql);

// Display data in a table
echo "<table border='1'>
<tr>
<th>ID</th>
<th>Name</th>
<th>Description</th>
<th>Image</th>
<th>Actions</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['id'] . "</td>";
echo "<td>" . $row['name'] . "</td>";
echo "<td>" . $row['description'] . "</td>";
echo "<td>" . $row['image'] . "</td>";
echo "<td><a href='editconcert.php?id=" . $row['id'] . "'>Edit</a> | <a href='deleteconcert.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this concert?\")'>Delete</a></td>";
echo "</tr>";
}
echo "</table>";
echo"<a href='addconcert.php'>Add</a>";



echo"<br><br><br>";


$sql = "SELECT * FROM competitions";
$result = mysqli_query($data, $sql);

// Display data in a table
echo "<table border='1'>
<tr>
<th>ID</th>
<th>Name</th>
<th>Description</th>
<th>Image</th>
<th>Actions</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['id'] . "</td>";
echo "<td>" . $row['name'] . "</td>";
echo "<td>" . $row['description'] . "</td>";
echo "<td>" . $row['image'] . "</td>";
echo "<td><a href='editcompetition.php?id=" . $row['id'] . "'>Edit</a> | <a href='deletecompetition.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this competition?\")'>Delete</a></td>";
echo "</tr>";
}
echo "</table>";
echo"<a href='addcompetition.php'>Add</a>";

// Close connection
mysqli_close($data);
?>

    </main>
   
  </body>
</html>