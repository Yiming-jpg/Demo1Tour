<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("location:login.php");
}

include 'User_Header.php';

$eventName = $_GET['eventName'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $faculty = $_POST['faculty'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];

    // Connect to database
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "user";

    $data = mysqli_connect($host, $user, $password, $db);

    if ($data === false) {
        die("connection error");
    }

    // Insert the new user into the registration table
    $sql = "INSERT INTO registrations (username,firstname, lastname, faculty, gender, phone, address, email, event) VALUES ('$username','$firstname', '$lastname', '$faculty', '$gender', '$phone', '$address', '$email', '$eventName')";
    mysqli_query($data, $sql);

    // Close connection
    mysqli_close($data);

    // Redirect to userhome.php after registration
    header("location: index.php");
}
?>
<!DOCTYPE html>  
<html>  
<head>  
<meta name="viewport" content="width=device-width, initial-scale=1">  
<style>  
body{  
     background-image: url('img/music-background.jpeg');
}  
.container {  
    padding: 50px;  
    background-color: white;
    margin: 0 auto;
    max-width: 600px;
    margin-top: 50px;
}  
  
input[type=text], input[type=password], textarea {  
  width: 100%;  
  padding: 15px;  
  margin: 5px 0 22px 0;  
  display: inline-block;  
  border: none;  
  background: #f1f1f1;  
}  
input[type=text]:focus, input[type=password]:focus {  
  background-color: orange;  
  outline: none;  
}  
 div {  
            padding: 10px 0;  
         }  
hr {  
  border: 1px solid #f1f1f1;  
  margin-bottom: 25px;  
}  
.registerbtn {  
  background-color: #4CAF50;  
  color: white;  
  padding: 16px 20px;  
  margin: 8px 0;  
  border: none;  
  cursor: pointer;  
  width: 100%;  
  opacity: 0.9;  
}  
.registerbtn:hover {  
  opacity: 1;  
}  
</style>  
</head>  
<body>  
<form action="#" method="POST">
  <div class="container">  
    <center>  
      <h1><?php echo $eventName ?> <br>Registration Form</h1>  
    </center>  
    <hr>  
    <label> Username : </label>   
    <input type="text" name="username" id="username" value="<?php echo $_SESSION['username']; ?>" readonly />
    <label> Firstname : </label>   
    <input type="text" name="firstname" id="firstname" placeholder= "Firstname" size="15" required />    
    <label> Lastname: </label>    
    <input type="text" name="lastname" id="lastname" placeholder="Lastname" size="15"required />   
    <div>  
      <label>   
        Faculty :  
      </label>   
    <select name="faculty">  
      <option value="Faculty">Country</option>  
      <option value="FAFB">CHINA</option>  
      <option value="FOCS">KOREA</option>  
      <option value="FOAS">THAILAND</option>  
      <option value="FOBE">TAIWAN</option>  
      <option value="FOET">VIETNAM</option>  
      <option value="FCCI">INDONESIA</option>  
      <option value="FSSH">OTHERS</option>  
    </select>


    </div>  
    <div>
      <label>
        Tour Package Registered :
      </label>
      <input type="text" name="event-registration" id="event" value="<?php echo $eventName ?>" required readonly />
    </div>
    <div>  
      <label>   
        Gender :  
          </label><br>  
  <input type="radio" value="Male" name="gender"  id="gender"checked > Male   
  <input type="radio" value="Female" name="gender"id="gender"> Female     
    </div>  
    <label>   
      Phone :  
    </label>  
    <input type="text" name="phone"id="phone" placeholder="phone no." size="11"/ required>   
    Current Address :  
    <textarea cols="80" rows="5" placeholder="Current Address" name="address" required></textarea>
    <label for="email"><b>Email</b></label>  
    <input type="text" placeholder="Enter Email" name="email" id="email" required>  

    <button type="submit" class="registerbtn">Register</button> 
    </form>
  </div>
</form>

</body>
</html>
