<?php
session_start();

if(!isset($_SESSION["username"]))
{
	header("location:login.php");
}
include 'header.php';

$host = "localhost";
$user = "root";
$password = "";
$db = "user";

// Create connection
$data = mysqli_connect($host, $user, $password, $db);

if ($data === false) {
    die("connection error");
}

if (isset($_POST['cancel_registration'])) {
  $id = $_POST['registration_id'];
  $sql = "DELETE FROM registrations WHERE id = '$id'";
  mysqli_query($data, $sql);
}

// Retrieve data from database
$username = $_SESSION['username'];
$sql = "SELECT * FROM registrations WHERE username = '$username'";
$result = mysqli_query($data, $sql);
$registrations = array();
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $registration = array(
      "id" => $row["id"],
      "event" => $row["event"],
      "faculty" => $row["faculty"],
      "registration_date" => $row["registration_date"]
    );
    $registrations[] = $registration;
  }
}

?>

<html>
  <head>
    <meta charset="UTF-8">
    <title>Your Events</title>
    <link rel="stylesheet" href="userpanel.css"/>
    <script>
      function confirmCancellation() {
        return confirm('Are you sure you want to cancel this registration?');
      }
    </script>
  </head>
  <body>
    <!-- ... (previous code) -->

    <div class="events">
      <h3>Your Events</h3>
      <div class="event-container">
        <?php
          foreach ($registrations as $registration) {
            echo "<div class='event'>";
            echo "<h4>" . $registration['event'] . "</h4>";
            echo "<p>Faculty: " . $registration['faculty'] . "</p>";
            echo "<p>Registration Date: " . $registration['registration_date'] . "</p>";
            echo "<form method='POST' onsubmit='return confirmCancellation();'>";
            echo "<input type='hidden' name='registration_id' value='" . $registration['id'] . "'>";
            echo "<input type='submit' name='cancel_registration' value='Cancel Registration'>";
            echo "</form>";
            echo "</div>";
          }
        ?>
      </div>
    </div>
        
  </body>
</html>
