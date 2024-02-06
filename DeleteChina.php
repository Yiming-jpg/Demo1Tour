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

// Check if ID parameter is present in URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the concert with the given ID from the concerts table
    $sql = "DELETE FROM concerts WHERE id=$id";
    mysqli_query($data, $sql);

    // Redirect to content-management.php after deleting concert
    header("location: PackageManagement.php");
}

?>
