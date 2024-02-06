<?php
// Connect to the database
$host = "localhost";
$user = "root";
$password = "";
$db = "user";

$data = mysqli_connect($host, $user, $password, $db);

if ($data === false) {
    die("Connection error");
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $country = $_POST['country'];
    $code = $_POST['code'];
    $price = $_POST['price'];
    
    // Get the dates submitted by the admin
    $date = $_POST['date'];

    // Format and combine the dates
    $formattedDates = array();
    foreach ($date as $date) {
        if (!empty($date) && $date != '00-00-0000') {
            $formattedDates[] = date('d-m-Y', strtotime($date));
        }
    }
    $formattedDatesString = implode(', ', $formattedDates);
    
    // Move the uploaded file to the img directory and get the path
    $image_path = '';
    if (isset($_FILES['image'])) {
        $target_dir = "img/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image_path = $target_file;
        } else {
            // Handle error if file upload failed
            echo "Sorry, there was an error uploading your image file.";
            exit();
        }
    }

    $document_path = ''; // Initialize document path
    if (isset($_FILES['document'])) {
        $target_dir = "document/"; // Specify the directory for storing documents
        $target_file = $target_dir . basename($_FILES["document"]["name"]);
        
        $uploadOk = 1;
        $documentFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is a PDF
        if ($documentFileType != "pdf") {
            echo "Sorry, only PDF files are allowed.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, the document file already exists.";
            $uploadOk = 0;
        }

        // Check file size (adjust as needed)
        if ($_FILES["document"]["size"] > 5000000) {
            echo "Sorry, your document file is too large.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your document file was not uploaded.";
            exit();
        } else {
            // Move the uploaded document file to the specified directory
            if (move_uploaded_file($_FILES["document"]["tmp_name"], $target_file)) {
                $document_path = $target_file;
            } else {
                echo "Sorry, there was an error uploading your document file.";
                exit();
            }
        }
    }

    // Generate the URL based on the concert name
    $url = "Booking_Registration.php?eventName=" . urlencode($name);

    // Insert the new concert into the concerts table
    $sql = "INSERT INTO concerts (name, description, country, code, date, price, image, url, document) VALUES ('$name', '$description', '$country', '$code','$formattedDatesString', '$price', '$image_path', '$url', '$document_path')";
    mysqli_query($data, $sql);

    // Get the ID of the newly inserted concert
    $concertId = mysqli_insert_id($data);

    // Redirect to PackageManagement.php after adding the concert
    header("location: PackageManagement.php");
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Admin Add_Tour China</title>

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
                background-color: red;
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
                color: red;
                font-size: 14px;
                margin-top: 5px;
            }

            /* Heading styles */
            h1 {
                text-align: center;
                font-size: 32px;
                margin-top: 50px;
                margin-bottom: 20px;
                background-color: red;
                color: white;
                font-family: helvetica, sans-serif;
                font-weight: bold;
                font-size: 48px;
            }
        </style>
    </head>
    <body>
        <h1>Add China Tour</h1>
        <form method="post" action="" enctype="multipart/form-data">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name"><br><br>

            <label for="description">Description:</label><br>
            <input type="text" id="description" name="description"><br><br>

            <label for="country">Country:</label><br>
            <select id="country" name="country">
                <option value="China">China</option>
                <option value="Korea">Korea</option>
                <option value="Thailand">Thailand</option>
                <option value="Taiwan">Taiwan</option>
                <option value="Vietnam">Vietnam</option>
                <option value="Others">Others</option>
            </select><br><br>

            <label for="code">Code:</label><br>
            <input type="text" id="code" name="code"><br><br>

    

<div id="dateFields">
    <label for="date">Date:</label>
    <input type="date" name="date[]">
    <input type="button" value="Add More Dates" onclick="addDateField()">
    <br>
</div> <br>
 


            <label for="price">Price:</label><br>
            <input type="text" id="price" name="price"><br><br>

            <label for="image">Image:</label><br>
            <input type="file" id="image" name="image"><br><br>
            
            <label for="document">Document:</label><br>
            <input type="file" id="document" name="document" accept=".pdf"><br><br>

            <!-- The URL input is disabled and its value is generated automatically based on the concert name -->
            <label for="url">URL:</label><br>
            <input type="text" id="url" name="url" disabled><br><br>

            <input type="submit" name="submit" value="Add China Tour">
            <a href="PackageManagement.php" class="cancel">Cancel</a>
        </form>
        <script>
            // Generate the URL based on the concert name when the name input is changed
            document.getElementById('name').addEventListener('input', function () {
                var name = this.value;
                var url = "Booking_Registration.php?eventName=" + encodeURIComponent(name);
                document.getElementById('url').value = url;
            });

        function addDateField() {
            var dateFieldsContainer = document.getElementById("dateFields");
            var dateField = document.createElement("input");
            dateField.type = "date";
            dateField.name = "date[]"; // Use the same name as the original date input fields
            dateField.required = true;

            var lineBreak = document.createElement("br");

            dateFieldsContainer.appendChild(dateField);
            dateFieldsContainer.appendChild(lineBreak);
        }

        </script>
    </body>
</html>
