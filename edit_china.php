<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("location:login.php");
}

$host = "localhost";
$user = "root";
$password = "";
$db = "user";

// Create connection
$conn = mysqli_connect($host, $user, $password, $db);

if ($conn === false) {
    die("connection error");
}

// Get the id of the concert to be edited from the query string
$id = $_GET["id"];

// Get the details of the concert from the database
$sql = "SELECT * FROM concerts WHERE id=$id";
$result = mysqli_query($conn, $sql);
$concert = mysqli_fetch_assoc($result);

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the updated details of the concert from the form
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $url = mysqli_real_escape_string($conn, $_POST["url"]);
    $country = mysqli_real_escape_string($conn, $_POST["country"]);
    $price = mysqli_real_escape_string($conn, $_POST["price"]);
    $tourcode = mysqli_real_escape_string($conn, $_POST["tourcode"]);

    // Get the dates submitted by the admin
    $dates = $_POST['date'];

    // Format and combine the dates
    $formattedDates = array();
    foreach ($dates as $date) {
        if (!empty($date) && $date != '0000-00-00') {
            $formattedDates[] = date('d-m-Y', strtotime($date));
        }
    }
    $formattedDatesString = implode(', ', $formattedDates);

    // Update the details of the concert in the database, including the dates
    $sql = "UPDATE concerts SET name='$name', description='$description', url='$url', country='$country', price='$price', tourcode='$tourcode', date='$formattedDatesString' WHERE id=$id";
    mysqli_query($conn, $sql);

    // Check if an image was uploaded
    if (!empty($_FILES["image"]["name"])) {
        // Get the file name and extension
        $filename = basename($_FILES["image"]["name"]);
        $extension = pathinfo($filename, PATHINFO_EXTENSION);

        // Generate a unique name for the file
        $new_filename = uniqid() . "." . $extension;

        // Move the uploaded file to the img directory
        move_uploaded_file($_FILES["image"]["tmp_name"], "img/" . $new_filename);

        // Update the image path in the database
        $image = "img/" . $new_filename;
        $sql = "UPDATE concerts SET image='$image' WHERE id=$id";
        mysqli_query($conn, $sql);
    }

    // Redirect to the admin panel
    header("location:admin_country.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit China Tour</title>
        <link rel="stylesheet" href="edit.css">
    </head>
    <body>
        <div class="admin-panel">
            <h3>Edit China Tour</h3>
            <form method="post" enctype="multipart/form-data">
                <label>Name:</label><br>
                <input type="text" name="name" value="<?php echo $concert["name"] ?>"><br><br>
                <label>Description:</label><br>
                <textarea name="description"><?php echo $concert["description"] ?></textarea><br><br>
                <label>Country:</label><br>
                <select name="country">
                    <option value="China" <?php if ($concert["country"] === "China") echo "selected"; ?>>China</option>
                    <option value="Korea" <?php if ($concert["country"] === "Korea") echo "selected"; ?>>Korea</option>
                    <option value="Thailand" <?php if ($concert["country"] === "Thailand") echo "selected"; ?>>Thailand</option>
                    <option value="Taiwan" <?php if ($concert["country"] === "Taiwan") echo "selected"; ?>>Taiwan</option>
                    <option value="Vietnam" <?php if ($concert["country"] === "Vietnam") echo "selected"; ?>>Vietnam</option>
                    <option value="Others" <?php if ($concert["country"] === "Others") echo "selected"; ?>>Others</option>
                </select><br><br>

                <label>Price:</label><br>
                <input type="text" name="price" value="<?php echo $concert["price"] ?>"><br><br>

                <label>Tour Code:</label><br> <!-- Add this line -->
                <input type="text" name="tourcode" value="<?php echo $concert["tourcode"] ?>"><br><br> <!-- Add this line -->

                <div id="dateFields">
                    <label for="date">Date:</label>
                    <input type="date" name="date[]" value="<?php echo $concert["date"] ?>">
                    <input type="button" value="Add More Dates" onclick="addDateField()">
                    <br>  </div> <br>

                <label>Image:</label><br>
                <?php if (!empty($concert["image"])) { ?>
                    <img src="<?php echo $concert["image"] ?>" width="100px"><br>
                <?php } ?>
                <input type="file" name="image"><br><br>
                <label>URL:</label><br>
                <input type="text" name="url" value="<?php echo $concert["url"] ?>" readonly><br><br>
                <input type="submit" value="Save Changes">
                <a href="admin_country.php" class="cancel-button">Cancel</a> <!-- Modify this line -->
            </form>
            <script>


                function addDateField() {
                    var dateFieldsContainer = document.getElementById("dateFields");
                    var dateField = document.createElement("input");
                    dateField.type = "date";
                    dateField.name = "date[]";
                    dateField.required = true;

                    var lineBreak = document.createElement("br");

                    dateFieldsContainer.appendChild(dateField);
                    dateFieldsContainer.appendChild(lineBreak);
                }
            </script>
        </div>
    </body>
</html>
