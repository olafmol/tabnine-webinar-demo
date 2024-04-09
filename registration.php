<?php

// Start session 
session_start();

// MySQL database connection
 = "localhost";
 = "username"; 
 = "password";
 = "myDB";

// Create connection
 = new mysqli(, , , );

// Check connection
if (!) {
  die("Connection failed: " . mysqli_connect_error());
}

// If form submitted
if(isset(['submit'])){

  // Get form data
   = ['username'];
   = ['email'];
   = ['password'];

  // SQL query
   = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
   = ->prepare();
  ->bind_param("sss", , , );

  // Execute statement
  if(->execute()){
    // Redirect to login page
    header("location: login.php");
  } else {
    // Display error message
    echo "Error: " .  . "<br>" . ->error;
  }

} else {

  // Display registration form
  echo "<form action='' method='post'>
  <label>Username:</label>
  <input type='text' name='username' required><br>
  <label>Email:</label>
  <input type='email' name='email' required><br>
  <label>Password:</label>
  <input type='password' name='password' required><br>
  <input type='submit' name='submit' value='Register'>
  </form>";

}

?>