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
// Establish a database connection
$host = "localhost";
$user = "root";
$password = "";
$db = "user";

// Create a database connection
$conn = mysqli_connect($host, $user, $password, $db);

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve data from the 'registrations' table
$sql = "SELECT * FROM registrations";
$result = mysqli_query($conn, $sql);

// Check if any rows were returned
// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
    // Display the data in a table format
    echo "<table>";
    echo "<tr><th>ID</th><th>Username</th><th>First Name</th><th>Last Name</th><th>Faculty</th><th>Event</th><th>Gender</th><th>Phone</th><th>Address</th><th>Email</th><th>Registration Date</th><th>Edit</th><th>Delete</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row['id'] . "</td><td>" . $row['username'] . "</td><td>" . $row['firstname'] . "</td><td>" . $row['lastname'] . "</td><td>" . $row['faculty'] . "</td><td>" . $row['event'] . "</td><td>" . $row['gender'] . "</td><td>" . $row['phone'] . "</td><td>" . $row['address'] . "</td><td>" . $row['email'] . "</td><td>" . $row['registration_date'] . "</td><td><a href='edit-registration.php?id=" . $row['id'] . "'>Edit</a></td><td><a href='delete-registration.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this registration?\")'>Delete</a></td></tr>";
    }
    echo "</table>";
} else {
    echo "No registrations found.";
}


// Close the database connection
mysqli_close($conn);
?>



    </main>
   
  </body>
</html>