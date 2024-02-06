<?php
session_start();


if(!isset($_SESSION["username"]))
{
	header("location:login.php");
}

include 'headeradmin.php';
include 'Admin_Sidebar.php';
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
    <script>
  function confirmDelete() {
    return confirm("Are you sure you want to delete this user?");
  }
</script>

  </head>
  <body>
    <header>

    </header>

      <div>
    
          
          <main>
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

// Check if delete button was clicked
if (isset($_POST['delete'])) {
    $id = $_POST['delete_id'];

    // Delete the row with the given ID from the login table
    $sql = "DELETE FROM login WHERE id = $id";
    mysqli_query($data, $sql);
}

// Select all data from login table
$sql = "SELECT * FROM login";
$result = mysqli_query($data, $sql);

// Display the data in a table format
echo "<table>";
echo "<tr><th>ID</th><th>Username</th><th>Password</th><th>Email</th><th>User Type</th><th>Edit</th><th>Delete</th></tr>";

while ($row = mysqli_fetch_array($result)) {
    echo "<tr><td>".$row['id']."</td><td>".$row['username']."</td><td>".$row['password']."</td><td>".$row['email']."</td><td>".$row['usertype']."</td>";

    // Add edit and delete links for each row
    echo "<td><a href='editadmin.php?id=".$row['id']."'>Edit</a></td>";
    echo "<td><form method='post' action='adminhome.php'><input type='hidden' name='delete_id' value='".$row['id']."'><input type='submit' name='delete' value='Delete' onclick='return confirmDelete()'></form></td></tr>";

}

echo "</table>";



?>
              <a href="addadmin.php">Add</a>

          </main>

      </div>
  </body>
</html>