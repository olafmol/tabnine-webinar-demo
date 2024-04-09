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

  // Prepare and bind statement
  $stmt = mysqli_prepare($conn, "SELECT id, username, password FROM users WHERE username=?");
  mysqli_stmt_bind_param($stmt, "s", $username);

  // Execute statement
  mysqli_stmt_execute($stmt);

  // Get result
  $result = mysqli_stmt_get_result($stmt);

  // If matching record found
  if(mysqli_num_rows($result) == 1) {
    // Fetch data
    $row = mysqli_fetch_assoc($result);

    // Verify password
    if(password_verify($password, $row['password'])) {
      // Start session
      session_start();

      // Store data in session variables
      $_SESSION['loggedin'] = true;
      $_SESSION['username'] = $username;

      // Redirect to welcome page
      header("location: welcome.php");
    }
    else {
      $error = "Invalid password";
    }
  }
  else {
    $error = "Invalid username or password";
  }
}
?>

<!-- HTML form -->
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