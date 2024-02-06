<?php
session_start();


if(!isset($_SESSION["username"]))
{
	header("location:login.php");
}

/* include 'Admin_Header.php'; */

?>

<!DOCTYPE html>
<html>
<head>
<style>
   /* sidebar.css */

#sidebar {
    width: 200px;
    height: 100%;
    background-color: #333;
    color: #fff;
    padding: 15px;
    position: fixed;
    left: 0px; /* Adjust the left property to align with the header bar */
    top: 50px; /* Adjust the top position based on your header height */
    bottom: 0;
    overflow-y: auto;
}

#sidebar h2 {
    color: #fff;
}

#sidebar ul {
    list-style-type: none;
    padding: 0;
}

#sidebar ul li {
    margin-bottom: 10px;
}

#sidebar a {
    display: block;
    padding: 10px;
    background-color: #555;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
}

#sidebar a:hover {
    background-color: #777;
}

#content {
    margin-left: 220px;
    padding: 20px;
   
}

.nav-item {
    margin-bottom: 10px; /* Adjust the margin between items */
    color: #fff;
    font-weight: bold;
}
      
 main {
        margin-left: 220px; /* Set the left margin to push the main content section to the right of the navigation section */
        padding: 20px;
        box-sizing: border-box;
        margin-top: 20px;
        
      }

      body {
      font-family: 'Roboto', sans-serif;
      background-color: #white;
     
    }

   
  </style>
</head>
<body>
<?php
  
echo '
    <div id="sidebar">
       <h2>General</h2>
       <div class="nav-item">
       <ul>
           <li><a href="UserManagement.php">User Management</a></li>          
           <li><a href="BookingManagement.php">Booking Management</a></li> ';/* For who register want to buy package demo (have user and info) */
echo '<li><a href="  ">Product Management</a></li>
           
           <li><a href="PackageManagement.php">Package Management</a></li>
       </ul>
       </div> 
    </div>     
';
  
?>
<!-- rest of the HTML code for your website -->
</body>
</html>
