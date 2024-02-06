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

// Check if the form was submitted
if (isset($_POST['submit'])) {
    // Get the values from the form
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $faculty = $_POST['faculty'];
    $event = $_POST['event'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];

    // Update the record with the given ID
    $sql = "UPDATE registrations SET firstname='$firstname', lastname='$lastname', faculty='$faculty', event='$event', gender='$gender', phone='$phone', address='$address', email='$email' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        header("location:BookingManagement.php");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Check if an ID parameter was passed
if (isset($_GET['id'])) {
    // Retrieve the record with the given ID
    $id = $_GET['id'];
    $sql = "SELECT * FROM registrations WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    // Check if a record was found
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Display the edit form
        ?>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="firstname">First Name:</label>
            <input type="text" name="firstname" value="<?php echo $row['firstname']; ?>"><br>
            <label for="lastname">Last Name:</label>
            <input type="text" name="lastname" value="<?php echo $row['lastname']; ?>"><br>
            <label for="faculty">Faculty:</label>
            <input type="text" name="faculty" value="<?php echo $row['faculty']; ?>"><br>
            <label for="event">Event:</label>
            <input type="text" name="event" value="<?php echo $row['event']; ?>"><br>
            <label for="gender">Gender:</label>
            <input type="text" name="gender" value="<?php echo $row['gender']; ?>"><br>
            <label for="phone">Phone:</label>
            <input type="text" name="phone" value="<?php echo $row['phone']; ?>"><br>
            <label for="address">Address:</label>
            <textarea name="address"><?php echo $row['address']; ?></textarea><br>
            <label for="email">Email:</label>
            <input type="text" name="email" value="<?php echo $row['email']; ?>"><br>
            <input type="submit" name="submit" value="Submit">
        </form>
        <?php
    } else {
        echo "No registration found with ID = $id";
    }
}

// Close the database connection
mysqli_close($conn);

?>