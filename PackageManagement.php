<?php
    session_start();
        if(!isset($_SESSION["username"]))
        {
            header("location:login.php");
        }
        include 'Admin_Header.php';
        include 'Admin_Sidebar.php';
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Music Society Admin Panel</title>
    <style>
      body {
        background-color: #e6f7ff;
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

      /* Style the main content section */
      main {
        margin-left: 220px; /* Set the left margin to push the main content section to the right of the navigation section */
        padding: 20px;
        box-sizing: border-box;
      }

      
       /* Design table */
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        text-align: left;
        padding: 8px;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: green;
        color: white;
    }

    td a {
        text-decoration: none;
        color: blue;
    }

    td a:hover {
        color: black;
    }

    td form {
        display: inline-block;
    }

      td input[type='submit'] {
        background-color: green;
        color: white;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
    }

    a.add-link {
      display: inline-block;
      background-color: green;
      color: white;
      padding: 10px;
      border-radius: 5px;
      text-decoration: none;
    }

    a.add-link:hover {
      background-color: #c00;
      color: white;
    }
    
    /* Add styles for Edit and Delete buttons */
    td a.edit-btn {
        text-decoration: none;
        background-color: #ffb739;
        color: black;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
    }

    td a.delete-btn {
        background-color: red;
        color: white;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
    }

    /* Hover styles for Edit and Delete buttons */
    td a.edit-btn:hover {
        background-color: #e5a300;
    }

    td a.delete-btn:hover {
        background-color: #c00;
    }
    
     /* Add a new class for the container of edit and delete buttons */
    .action-buttons {
        display: flex;
        gap: 5px; /* Adjust the spacing between buttons */
    }

    /* Style for the edit and delete buttons */
    .action-buttons a {
        text-decoration: none;
        padding: 5px 10px;
        cursor: pointer;
    }

    .action-buttons a.edit-btn {
        background-color: #ffb739;
        color: black;
    }

    .action-buttons a.delete-btn {
        background-color: red;
        color: white;
    }

    /* Hover styles for Edit and Delete buttons */
    .action-buttons a.edit-btn:hover {
        background-color: #e5a300;
    }

    .action-buttons a.delete-btn:hover {
        background-color: #c00;
    }
    </style>
  </head>
      
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

// CHINA MODULE
$sql = "SELECT * FROM concerts";
$result = mysqli_query($data, $sql);

// Display data in a table
echo "<table border='1'>
    <tr>
        <td colspan='9' style='text-align: center; background-color: #e6f7ff;'><strong>CHINA</strong></td>
        <td style='text-align: center; background-color: #e6f7ff;'><a href='AddChina.php'>+</a></td>
    </tr>
    <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Image</th>
        <th>Date</th>
        <th>Code</th>
        <th>Price</th>
        <th>Country</th>
        <th>Document</th>

        <th>Edit</th>
        <th>Delete</th>
    </tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['name'] . "</td>";
echo "<td>" . $row['description'] . "</td>";
echo "<td>" . $row['image'] . "</td>";
echo "<td>" . $row['date'] . "</td>";
echo "<td>" . $row['code'] . "</td>";
echo "<td>" . $row['price'] . "</td>";
echo "<td>" . $row['country'] . "</td>";
echo "<td>" . $row['document'] . "</td>";

echo "<td><a class='edit-btn' href='EditChina.php?id=" . $row['id'] . "'>Edit</a></td>";
    echo "<td><a class='delete-btn' href='DeleteChina.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this CHINA package?\")'>Delete</a></td>";
    echo "</tr>";
}
echo "</table>";
echo"<a href='AddChina.php'>Add</a>";



echo"<br><br><br>";

// THAILAND MODULE
// Retrieve data from database
$sql = "SELECT * FROM classes";
$result = mysqli_query($data, $sql);

// Display data in a table
echo "<table border='1'>
    <tr>
        <td colspan='8' style='text-align: center; background-color: #e6f7ff;'><strong>KOREA</strong></td>
        <td style='text-align: center; background-color: #e6f7ff;'><a href='AddChina.php'>+</a></td>
    </tr>
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
echo "<td><a href='editclass.php?id=" . $row['id'] . "'>Edit</a> | <a href='DeleteKorea.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this class?\")'>Delete</a></td>";
echo "</tr>";
}
echo "</table>";
echo"<a href='addclass.php'>Add</a>";

echo"<br><br><br>";

// THAILAND MODULE
$sql = "SELECT * FROM competitions";
$result = mysqli_query($data, $sql);

// Display data in a table
echo "<table border='1'>
    <tr>
        <td colspan='8' style='text-align: center; background-color: #e6f7ff;'><strong>THAILAND</strong></td>
        <td style='text-align: center; background-color: #e6f7ff;'><a href='AddChina.php'>+</a></td>
    </tr>
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
echo "<td><a href='editcompetition.php?id=" . $row['id'] . "'>Edit</a> | <a href='DeleteThailand.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this competition?\")'>Delete</a></td>";
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