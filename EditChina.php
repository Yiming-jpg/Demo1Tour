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
    $code = mysqli_real_escape_string($conn, $_POST["code"]);

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
    $sql = "UPDATE concerts SET name='$name', description='$description', url='$url', country='$country', price='$price', code='$code', date='$formattedDatesString' WHERE id=$id";
    mysqli_query($conn, $sql);

    // Check if an image file was uploaded
    if (!empty($_FILES["image"]["name"])) {
    // Get the file name and extension
    $imageFilename = basename($_FILES["image"]["name"]);

    // Delete the previous image file if it exists
    if (!empty($concert["image"])) {
        unlink($concert["image"]);
    }

    // Generate a unique name for the new image file
    $newImageFilename = uniqid() . "." . pathinfo($imageFilename, PATHINFO_EXTENSION);

    // Move the uploaded image file to the img directory
    move_uploaded_file($_FILES["image"]["tmp_name"], "img/" . $newImageFilename);

    // Update the image path in the database
    $image = "img/" . $newImageFilename;
    $sql = "UPDATE concerts SET image='$image' WHERE id=$id";
    mysqli_query($conn, $sql);
}



    // Check if a document file was uploaded
    if (!empty($_FILES["document"]["name"])) {
    // Get the file name
    $documentFilename = basename($_FILES["document"]["name"]);

    // Delete the previous document file if it exists
    if (!empty($concert["document"])) {
        unlink($concert["document"]);
    }

    // Move the uploaded document file to the document directory
    move_uploaded_file($_FILES["document"]["tmp_name"], "document/" . $documentFilename);

    // Update the document path in the database
    $document = "document/" . $documentFilename;
    $sql = "UPDATE concerts SET document='$document' WHERE id=$id";
    mysqli_query($conn, $sql);
}

    
    // Redirect to the admin panel
    header("location:PackageManagement.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit China Tour</title>
    <link rel="stylesheet" href="edit.css">
</head>
<style>
    body {
        background-color: #ff7c7c
    }

    /* Form styles */
    form {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: orange;
        color: white;
        font-family: helvetica, sans-serif;
        font-weight: bold;
    }

    label {
        display: block;
        font-size: 16px;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    select {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border-radius: 5px;
        border: 1px solid #ccc;
        margin-bottom: 10px;
        box-sizing: border-box;
    }

    select {
        height: 40px;
    }

    input[type="submit"] {
        background-color: orange;
        color: white;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #3e8e41;
    }

    .cancel {
        text-decoration: none;  /* Remove underline */
        background-color: #ff9999;
        color: orange;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    
    .cancel {
                text-decoration: none;  /* Remove underline */
                background-color: #ff9999;
                color: red;
                font-size: 16px;
                border: none;
                border-radius: 5px;
                padding: 10px 20px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }
    /* Error message styles */
    .error {
        color: orange;
        font-size: 14px;
        margin-top: 5px;
    }

    /* Heading styles */
    h1 {
        text-align: center;
        font-size: 32px;
        margin-top: 50px;
        margin-bottom: 20px;
        background-color: orange;
        color: white;
        font-family: helvetica, sans-serif;
        font-weight: bold;
        font-size: 48px;
    }
    
</style>
<body>
        <div class="admin-panel">
            <h1>Edit China Tour</h1>
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

                <label>Code:</label><br> <!-- Add this line -->
                <input type="text" name="code" value="<?php echo $concert["code"] ?>"><br><br> <!-- Add this line -->

                <div id="dateFields">
                    <label for="date">Date:</label>
                    <input type="date" name="date[]" value="<?php echo $concert["date"] ?>">
                    <input type="button" value="Add More Dates" onclick="addDateField()">
                    <br>  </div> <br>

                <label>Price:</label><br>
                <input type="text" name="price" value="<?php echo $concert["price"] ?>"><br><br>

                <label>Image:</label>
                <?php if (!empty($concert["image"])) { ?>
                    <img src="<?php echo $concert["image"] ?>" width="100px">
                    <?php echo basename($concert["image"]); ?><br>
                <?php } ?><br>
                <input type="file" name="image"><br><br>
                
                
               <label>Document:</label>
                <?php
                if (!empty($concert["document"])) {
                    $documentFileName = basename($concert["document"]);
                    echo "$documentFileName";
                }
                ?><br><br>
                <?php
                echo "────➣ upload new document : ";
                ?>
               <input type="file" name="document" accept=".pdf"><br><br>
                
                <label>URL:</label><br>
                <input type="text" name="url" value="<?php echo $concert["url"] ?>" readonly><br><br>
                <input type="submit" value="Save Changes">
                <a href="PackageManagement.php" class="cancel">Cancel</a>
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
