<!DOCTYPE html>
<html>
<head>
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #d1341f;
    }

    .menu {
      background-color: white;
    }

    .menu a {
      display: inline-block;
      color: black;
      text-align: center;
      padding: 14px;
      text-decoration: none;
      font-size: 17px;
      background-color: white;
    }

    .menu a:hover {
      background-color: #ddd;
      color: black;
    }

    .menu a.active {
      background-color: red;
      color: white;
    }

    .login {
      display: inline-block;
      color: white;
      text-align: center;
      padding: 14px;
      text-decoration: none;
      font-size: 17px;
      background-color: orange;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: white;
      color_code: #d1341f；
    }

    .header-left {
      flex-grow: 1;
      text-align: left;
    }

    .header-right {
      margin-left: 10px;
    }

    .header-up {
      display: flex;
      justify-content: space-between;
      align-items: center;
      color: #fff;
      font-size: 14px;
      font-weight: 400;
      text-decoration: none;
      font-family: 'Roboto', sans-serif;
    }

    .header-title {
      color: #d1341f;
      text-align: left;
    }
  </style>
</head>
<body>
  <?php
    // PHP code to output the header
    echo '<header class="header-up">';
    echo '<div class="header-left">';
    echo '<h4>&nbsp Phone: 011-232 7749 &nbsp &nbsp &nbsp Email: music-society@gmail.com</h4>';
    echo '</div>';
    echo '<div class="header-right">';
    echo '<a href="logout.php" class="login">Logout</a>';
    echo '</div>';
    echo '</header>';
  
    echo '<header class="header">';
    echo '<div class="header-left">';
    echo '<h1 class="header-title">&nbsp &nbsp MUSIC SOCIETY</h1>';
    echo '</header>';
  ?>
  <!-- rest of the HTML code for your website -->
</body>
</html>
