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

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $usertype = $_POST['usertype'];

    // Update the row with the given ID in the login table
    $sql = "UPDATE login SET username='$username', password='$password', email='$email', usertype='$usertype' WHERE id=$id";
    mysqli_query($data, $sql);

    // Redirect back to the admin page
    header("location: UserManagement.php");
    exit();
}

// Get the ID of the row to edit from the URL parameter
$id = $_GET['id'];

// Retrieve the data for the row with the given ID from the login table
$sql = "SELECT * FROM login WHERE id=$id";
$result = mysqli_query($data, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="hidden" name="id" value="<?php echo $row['id'];?>">
        <label>Username:</label>
        <input type="text" name="username" value="<?php echo $row['username'];?>" required><br><br>
        <label>Password:</label>
        <input type="password" name="password" value="<?php echo $row['password'];?>" required><br><br>
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $row['email'];?>" required><br><br>
        <label>User Type:</label>
        <select name="usertype">
            <option value="admin" <?php if ($row['usertype'] == 'admin') echo 'selected';?>>Admin</option>
            <option value="user" <?php if ($row['usertype'] == 'user') echo 'selected';?>>User</option>
        </select><br><br>
        <input type="submit" value="Save Changes">
    </form>
</body>
</html>
