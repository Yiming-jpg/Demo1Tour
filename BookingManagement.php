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
        padding: 5px 10px; /* Add padding to make buttons more clickable */
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
    </style>
  </head>

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
    echo "<tr>
        <td colspan='11' style='text-align: center; background-color: #e6f7ff;'><strong>Booking</strong></td>
        <td style='text-align: center; background-color: #e6f7ff;'><a href=' '>+</a></td>
    </tr>
    <tr><th>Username</th><th>First Name</th><th>Last Name</th><th>Faculty</th><th>Package</th><th>Gender</th><th>Phone</th><th>Address</th><th>Email</th><th>Registration Date</th><th>Edit</th><th>Delete</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        
    echo "
        <tr>
            <td>" . $row['username'] . "</td>
            <td>" . $row['firstname'] . "</td>
            <td>" . $row['lastname'] . "</td>
            <td>" . $row['faculty'] . "</td>
            <td>" . $row['event'] . "</td>
            <td>" . $row['gender'] . "</td>
            <td>" . $row['phone'] . "</td>
            <td>" . $row['address'] . "</td>
            <td style='max-width: 150px; overflow: hidden; text-overflow: ellipsis;' title='" . htmlspecialchars($row['email']) . "'>" . $row['email'] . "</td>
            <td>" . $row['registration_date'] . "</td>
                
            <td><a class='edit-btn' href='Edit_Booking.php?id=" . $row['id'] . "'>Edit</a></td>
            <td><a class='delete-btn' href='Delete_Booking.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this booking?\")'>Delete</a></td>
        </tr>";
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