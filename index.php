<?php
session_start();

include 'User_Header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Webpage</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #b3e0ff;
        }  

        .main-section img {
            max-width: 100%;
            height: auto;
        }

        .text-container {
            margin-top: 20px;
        }

        .text-container h2 {
            color: #fff;
            text-transform: uppercase;
            font-size: 50px;
            margin-bottom: 30px;
            font-weight: 300 !important;
        }

        .text-container p {
            color: #666;
            font-size: 16px;
        }

        .button-container {
            margin-top: 20px;
        }

        .button-container a {
            display: inline-block;
            padding: 12px 30px;
            opacity: 0.9;
            background: #8eec63 !important;
            color: #fff;
            text-decoration: none;
            font-size: 35px;
            border-radius: 5px;
        }

        .grid-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
            margin-top: 50px;
            grid-template-columns: repeat(3, 1fr); /* 3 boxes per row */
        }


        .grid-item {
            background-size: cover;
            background-position: center;
            position: relative;
            overflow: hidden;
            min-height: 200px; /* Set a minimum height for each grid item */
            width: 320px; /* Set the width for each grid item */
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #fff;
            font-size: 40px;
            -webkit-transition: 0.2s;
            -o-transition: 0.2s;
            transition: 0.2s;
            text-decoration: none;
        }

        .grid-item h3 {
            margin: 0;
        }

        /* Example styles for grid items */
        .grid-item:nth-child(1) {
            background-image: url('img/HomeChina.jpg'); /* Replace with your image path */
        }

        .grid-item:nth-child(2) {
            background-image: url('img/HomeKorea.jpg'); /* Replace with your image path */
        }

        .grid-item:nth-child(3) {
            background-image: url('img/HomeThailand.jpg'); /* Replace with your image path */
        }
        
        .grid-item:nth-child(4) {
            background-image: url('img/HomeTaiwan.jpg'); /* Replace with your image path */
        }

        .grid-item:nth-child(5) {
            background-image: url('img/HomeVietnam.jpg'); /* Replace with your image path */
        }

        .grid-item:nth-child(6) {
            background-image: url('img/HomeIndonesia.jpg'); /* Replace with your image path */
        }
        
        body, html {
            margin: 0;
            padding: 0;
        }

        .main-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            max-width: 2000px; /* Set the maximum width for better readability */
            margin: 0 auto; /* Center the container */
            padding: 50px;
             background-image: url('img/indexBackground.jpg'); /* Modify this line with the correct path */
            background-size: cover;
            background-position: center;
        }

    .main-section img {
        max-width: 100%;
        max-height: 100%;
    }

    .text-container {
        text-align: center;
    }

    .button-container {
        margin-top: 10px;
    }
    </style>
</head>
<body>

<div class="main-section">
    
    <div class="text-container">
        <h2>Go Go Let's Go ! 我要去旅行 !</h2>
    </div>
    <div class="button-container">
        <a href="#">Start 出发！</a>
    </div>
</div>


<div class="grid-container">
    
        <a href="China.php" class="grid-item">
        <h3>CHINA</h3>
        </a>
    <a href="Korea.php" class="grid-item">
        <h3>KOREA</h3>
        </a>
    <a href="Thailand.php" class="grid-item">
        <h3>THAILAND</h3>
        </a>
    <a href="Taiwan.php" class="grid-item">
        <h3>TAIWAN</h3>
        </a>
    <a href="Vietnam.php" class="grid-item">
        <h3>VIETNAM</h3>
        </a>
    <a href="Indonesia.php" class="grid-item">
        <h3>INDONESIA</h3>
        </a>
    
</div>



</body>
</html>
