<?php

// Start session 
session_start();

// MySQL database connection
$servername = "localhost";
$username = "username"; 
$password = "password";
$dbname = "myDB";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// If form submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
  
  // Get form data
  $username = $_POST['username'];
  $password = $_POST['password'];
  
  // SQL query
  $sql = "SELECT id FROM users WHERE username='$username' AND password='$password'";
  
  // Get result
  $result = mysqli_query($conn, $sql);
  
  // If matching record found
  if(mysqli_num_rows($result) == 1) {
    // Start session
    session_start();
    
    // Store data in session variables
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    
    // Redirect to welcome page
    header("location: welcome.php");
  }
  else {
    $error = "Invalid username or password";
  }
}
?>

// HTML form
<form action="" method="post">
  <label>Username:</label>
  <input type="text" name="username" required>
  
  <label>Password:</label>
  <input type="password" name="password" required>
  
  <input type="submit" value="Login">
</form>

<?php
if(isset($error)) {
  echo $error; 
}
?>
