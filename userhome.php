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

// Retrieve data from database
$sql = "SELECT * FROM classes";
$result = mysqli_query($data, $sql);
$classes = array();
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $class = array(
      "name" => $row["name"],
      "description" => $row["description"],
      "image" => $row["image"],
      "url" => $row["url"]
    );
    $classes[] = $class;
  }
}

?>

<html>
  <head>
    <meta charset="UTF-8">
    <title>Music Society Classes</title>
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

    <div class="classes">
      <h3>Classes</h3>
      <div class="class-container">
        <?php
          foreach ($classes as $class) {
            echo "<div class='class'>";
            echo "<a href='" . $class['url'] . "'><img src='" . $class['image'] . "' alt='" . $class['name'] . "'></a>";
            echo "<a href='" . $class['url'] . "'><h4>" . $class['name'] . "</h4></a>";
            echo "<a href='" . $class['url'] . "'><p>" . $class['description'] . "</p></a>";
            echo "</div>";
          }
        ?>
      </div>
    </div>
        
  </body>
</html>
