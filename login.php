<?php
$host="localhost";
$user="root";
$password="";
$db="user";

session_start();


$data=mysqli_connect($host,$user,$password,$db);

if($data===false)
{
	die("connection error");
}


if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$username=$_POST["username"];
	$password=$_POST["password"];


	$sql="select * from login where username='".$username."' AND password='".$password."' ";

	$result=mysqli_query($data,$sql);

	if(mysqli_num_rows($result) > 0)
	{
		$row=mysqli_fetch_array($result);
		
		if($row["usertype"]=="user")
		{	
			$_SESSION["username"]=$username;

			header("location:index.php");
		}

		elseif($row["usertype"]=="admin")
		{

			$_SESSION["username"]=$username;
		
			header("location:UserManagement.php");
		}
	}
	else
	{
		echo "username or password incorrect";
	}

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in </title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="on.css">
</head>
<body>
<a href="logout.php" class="login">Back to home page</a>
    <div class="container" id="container">
        <div class="form-container sign-in-container">
            <form action="#" method="POST">
                <h1>AM TOUR TEST</h1><br><br>
                <div class="infield">
                    <input type="text" placeholder="username" name="username" autocomplete="off" required/>
                    <label></label>
                </div>
                <div class="infield">
                    <input type="password" placeholder="password" name="password" autocomplete="off" required />
                    <label></label>
                </div>
    <input type="submit" name="login" value="Login"/>
            </form>
        </div>
        <div class="overlay-container" id="overlayCon">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <a href="register.php" style="color: white; text-decoration: underline">Register</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>