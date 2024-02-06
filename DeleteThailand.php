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

    // Delete the competition with the given ID from the competitions table
    $sql = "DELETE FROM competitions WHERE id=$id";
    mysqli_query($data, $sql);

    // Redirect to content-management.php after deleting competition
    header("location: PackageManagement.php");
}

?>
