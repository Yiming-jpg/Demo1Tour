<?php
$host="localhost";
$user="root";
$password="";
$db="user";

session_start();

$error_message = ""; // Initialize the error message variable

$data=mysqli_connect($host,$user,$password,$db);

if($data===false)
{
    die("connection error");
}

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if ($password !== $confirm_password) {
        $error_message = 'Passwords do not match.';
    } else {
        // Check if the email already exists in the database
        $sql = "SELECT * FROM login WHERE email = '$email'";
        $result = mysqli_query($data, $sql);

        if (mysqli_num_rows($result) > 0) {
            $error_message = 'Email already exists.';
        } else {
            // Add the new user to the database
            $sql = "INSERT INTO login (username, email, password, usertype) VALUES ('$name', '$email', '$password', 'user')";
            if (mysqli_query($data, $sql)) {
                // Redirect to the login page after successful registration
                header("location: login.php");
                exit();
            } else {
                $error_message = "Error: " . mysqli_error($data);
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register </title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="on.css">
</head>
<body>
    <a href="logout.php" class="login">Back to home page</a>

    <div class="container" id="container">
        <div class="form-container sign-in-container">
            <form action="#" method="POST">
                <h1 style="text-align: center">AM TOUR Registration</h1>
                <?php if (!empty($error_message)) { echo "<p style='color: red;'>$error_message</p>"; } // Display the error message ?>
                <div class="infield">
                                       <input type="text" placeholder="username" name="name" required/>
                    <label></label>
                </div>
                <div class="infield">
                    <input type="email" placeholder="email" name="email" required />
                    <label></label>
                </div>
                <div class="infield">
                    <input type="password" placeholder="password" name="password" required />
                    <label></label>
                </div>
                <div class="infield">
                    <input type="password" placeholder="confirm_password" name="confirm_password" required />
                    <label></label>
                </div>
                <input type="submit" value="Register"/>
            </form>
        </div>
        <div class="overlay-container" id="overlayCon">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <h1>Welcome!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <a href="login.php" style="color: white; text-decoration: underline">Sign In</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

