<!DOCTYPE html>
<html>
<head>
    <title>Demo Admin Panel</title>
<style>
    /* Scroll Bar Design for ADMIN */
        /* For WebKit browsers (Chrome, Safari) */
            ::-webkit-scrollbar {
                width: 12px;
            }

            ::-webkit-scrollbar-thumb {
                background-color: green; /* Replace with your desired green color */
                border-radius: 0px;
            }

            ::-webkit-scrollbar-track {
                background-color: #f0f0f0; /* Light gray color for the track */
            }

 /* header.css */

#header {
    background-color: #44c1ff;
    color: #fff;
    padding: 12px;
    position: fixed;
    width: 100%;
    top: 0;
    left: 0;
    z-index: 1000;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.title {
    font-size: 23px;
    font-weight: bold;
        margin-left: 10px;
}

.nav {
    display: flex;
    flex-grow: 1; /* This property allows the navigation to grow and take available space */
    justify-content: flex-end; /* Align the navigation to the right */
margin-right: 45px; /* Adjust this value to manually move the entire navigation to the left */ 
}

.nav a {
    text-decoration: none;
    color: #fff;
    margin-left: 20px;
}

.D_logout {
    text-decoration: none;
    margin-right: 45px;
    display: inline-block;
    color: white;
    text-align: center;
    padding: 14px;

    font-size: 17px;
    background-color: orange;
    }
   
  </style>
</head>
<body>
  <?php
  
  echo '
 <div id="header">
    <div class="title">Demo Admin Panel</div>
    <div class="nav">
        <a href="index.php">Home</a>
        <a href="contact.php">Contact</a>
    
    </div>
    <div class="">
    <a href="logout.php" class=" D_logout">Logout</a>
  </div>
</div>   
';
  
  ?>
  <!-- rest of the HTML code for your website -->
</body>
</html>
