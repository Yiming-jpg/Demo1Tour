<?php
session_start();

if(!isset($_SESSION["username"])) {
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

// Retrieve data from database
$sql = "SELECT * FROM concerts";
$result = mysqli_query($data, $sql);
$concerts = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $concert = array(
            "name" => $row["name"],
            "description" => $row["description"],
            "image" => $row["image"],
            "url" => $row["url"]
        );
        $concerts[] = $concert;
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Music Society Concert / Talk</title>
        <link rel="stylesheet" href="userpanel.css"/>
    </head>
    <body>
<div class="user-panel">
  <h3>Welcome to Music Society, <?php echo $_SESSION["username"] ?></h3>
  <ul>
      <li><a href="userhome.php">Classes</a></li>
    <li><a href="concert-talks.php">Concert/Talks</a></li>
    <li><a href="competitions.php">Competitions</a></li>
    <li><a href ="userevents.php"><span style="color: red; text-decoration: underline;">Your events</span></a></li>
  </ul>
</div>

<div class="concert">
  <h3>Concert Talks</h3>
  <div class="class-container">
    <?php
      // Loop through the concerts array to display the content
     foreach ($concerts as $concert) {
        echo "<div class='class'>";
        echo "<a href='" . $concert['url'] . "'><img src='" . $concert['image'] . "' alt='" . $concert['name'] . "'></a>";
        echo "<a href='" . $concert['url'] . "'><h4>" . $concert['name'] . "</h4></a>";
        echo "<a href='" . $concert['url'] . "'><p>" . $concert['description'] . "</p></a>";
        echo "</div>";
      }
    ?>
  </div>
</div>


    </body>
</html>