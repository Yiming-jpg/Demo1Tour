<?php
session_start();
include 'User_Header.php';

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
            "url" => $row["url"],
            "country" => $row["country"],
            "code" => $row["code"],
            "date" => $row["date"],
            "price" => $row["price"],
            "document" => $row["document"] // Fetch the "document" column
        );
        $concerts[] = $concert;
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AMTOUR CHINA TOUR</title>
        <link rel="stylesheet" href="userpanel.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">  
        
        <style>
            body {
                background-color: #6ab7ff;
                font-family: 'Arial', sans-serif;
            }
            
            h3 {
            width: 100%; /* 让标题宽度与父元素相同 */
            border-radius: 15px; /* 适当调整border-radius的值 */
            text-align: center; /* 文本居中 */
            padding: 10px 0; 
            color: #1890ff; /* 设置文字颜色 */
            background: #e6f7ff; /* Bluish background color */
            border: 1px solid #91d5ff; /* Light blue border color */
}

            .china {
            margin: 0 auto; /* Center the container */
            max-width: 800px; /* Set the maximum width for better readability */
            padding: 20px; /* Add padding for better appearance */
        }
        
            .concert-item {
                display: flex;
                align-items: center;
                background-color: white;
                margin-bottom: 20px;
                border-radius: 20px;
                max-width: 800px; /* Set the maximum width as needed */
                width: 100%; /* Make it responsive */
            }

            .item-left {
                flex: 0 0 auto;
                margin-right: 20px;
                display: flex;
                align-items: stretch;
            }

            .item-left img {
                max-width: 100%;
                max-height: 100%;
                object-fit: cover;
            }

            .item-middle {
                flex: 1 1 auto;
                border-right: 1px solid lightgray;
                padding-right: 10px;
            }

            .item-right {
                flex: 0 0 auto;
                margin-left: 20px;
                margin-right: 20px;
            }

            .location-icon {
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 10px;
            }

            .location-icon i {
                color: red; /* Set the color of the location icon */
            }

            .concert-item .item-left {
                width: 150px; /* Adjust the desired size of the square image */
            }

            .concert-item .item-left img {
                max-width: 100%;
                max-height: 100%;
                object-fit: contain;
            }

            .select {
                background-color: lightgray;
                padding: 10px;
                border-radius: 5px;
                margin-top: 10px;
            }

            /* Add any additional CSS styles as needed */

            .user-panel {
                /* Your user panel styles */
            }

            .concert {
                /* Your concert container styles */
            }

            /* Style the hyperlink to remove underline */
            .concert-item a {
                text-decoration: none;
            }

            .concert-details .concert-date {
            border: 1px solid black; /* Border style */
            border-radius: 10px;
            padding: 5px; /* Padding for better appearance */
            margin: 2px 2px; /* Margin to separate from other details */
        color: #1890ff; /* Blue text color */
        background: #e6f7ff; /* Bluish background color */
        border: 1px solid #91d5ff; /* Light blue border color */
            display: inline-block;
        }
        
            .concert-details p {
                display: inline-block;
                margin-right: 10px;
            }

        </style>
    </head>
   <body>
        <!--  <div class="user-panel">
            <h3>Welcome to AM TOUR </h3>
            <ul>
                <li><a href="userhome.php">Classes</a></li>
                <li><a href="concert-talks.php">Concert/Talks</a></li>
                <li><a href="competitions.php">Competitions</a></li>
                <li><a href="userevents.php">Your events</a></li>
            </ul>
        </div>
        -->
        <br><br>
        <div class="china">
            <h3>CHINA TOURS</h3>
            <?php
        foreach ($concerts as $concert) {
            echo "<div class='concert-item'>";
            echo "<div class='item-left'>";
            echo "<a href='" . $concert['url'] . "'><img src='" . $concert['image'] . "' alt='" . $concert['name'] . "'></a>";
            echo "</div>";

            echo "<div class='item-middle'>";
            echo "<a href='" . $concert['url'] . "'><h4>" . $concert['name'] . "</h4></a>";
            echo "<div class='concert-details'>";
            echo "<p class='concert-country'><i class='fas fa-map-marker-alt'></i> " . $concert['country'] . "</p>";

            // Add the link for the document
            if (!empty($concert['document'])) {
                $documentFileName = basename($concert['document']);
                $documentFilePath = "document/" . $documentFileName; // Adjust the path as needed
                echo "<p class='concert-tourcode'><i class='far fa-file-alt'></i> <a href='" . $documentFilePath . "' download>" . $concert['code'] . "  Click here for more details.</a></p>";
            }
                echo "<br>";
            // Display each date with a border
            $dates = explode(',', $concert['date']);
            foreach ($dates as $date) {
                echo "<p class='concert-date'><i class='far fa-calendar-alt'></i> " . trim($date) . "</p>";
            }

            echo "</div>";

            echo "<a href='" . $concert['url'] . "'><p>" . $concert['description'] . "</p></a>";
            echo "</div>";

            echo "<div class='item-right'>";
            echo "<div class='price'>From". "<br>" . $concert['price'] . "</div>";
            echo "<div class='select'><a href='" . $concert['url'] . "'>SELECT</a></div>";
            echo "</div>";
            echo "</div>";
        }
        ?>

        </div>
    </body>
</html>
