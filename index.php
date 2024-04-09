<?php

// Start session 
session_start();

// Check if user is logged in
if(isset(['loggedin']) && ['loggedin'] == true){

  // Get the username from the session variables
  $username = $_SESSION['username'];

  // Display welcome message
  echo "Hello, " . $username . "!";

} else {
  // If user is not logged in, redirect to login page
  header("location: login.php");
}

?>