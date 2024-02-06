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

// Check if an ID parameter was passed
if (isset($_GET['id'])) {
    // Retrieve the record with the given ID
    $id = $_GET['id'];
    $sql = "DELETE FROM registrations WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        header("location:BookingManagement.php");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
