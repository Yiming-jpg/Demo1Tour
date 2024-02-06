<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<style>
    /* Scroll Bar Design for USER */
        /* For WebKit browsers (Chrome, Safari) */
            ::-webkit-scrollbar {
                width: 12px;
            }

            ::-webkit-scrollbar-thumb {
                background-color: #87CEFA; /* Light blue color for the thumb */
                border-radius: 0px;
            }

            ::-webkit-scrollbar-track {
                background-color: #f0f0f0; /* Light gray color for the track */
            }


        /* CSS Styles */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #333;
            color: #fff;
            padding: 10px;
            display: flex;
            align-items: center;
        }
        
        .logo {
            flex: 1;
            font-size: 20px;
            font-weight: bold;
            padding-left: 20px;
            text-decoration: none; /* Add this line to remove underline */
            color: #fff; /* Set the text color */
        }
        
        .nav-links {
            display: flex;
            justify-content: flex-end;
            list-style: none;
            margin: 0;
            padding: 0;
        }

.nav-links li {
    margin-right: 20px;
}

.nav-links li a {
    color: #fff;
    text-decoration: none;
}
    </style>
</head>
<body>
    <header>
        
        <a href="index.php" class="logo">AM TOUR</a>
        <nav>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="https://www.example.com/destinations">Destinations</a></li>
                <li><a href="https://www.example.com/contact">Contact</a></li>
                <li><a href="login.php">Member</a></li>
            </ul>
        </nav>
    </header>
    <!-- Rest of your HTML content goes here -->
</body>
</html>
