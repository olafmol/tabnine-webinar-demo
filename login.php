<?php
// Connect to the database
$db = mysqli_connect('localhost', 'username', 'password', 'database');

// Check if the form has been submitted
if (isset($_POST['username']) && isset($_POST['password'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Escape the username and password before using them in the query
  $username = mysqli_real_escape_string($db, $username);
  $password = mysqli_real_escape_string($db, $password);

  // Query the database to see if the username and password are valid
  $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
  $result = mysqli_query($db, $query);

  // Check if the username and password are correct
  if (mysqli_num_rows($result) == 1) {
    // Login successful
    session_start();
    $_SESSION['username'] = $username;
    header('Location: index.php');
  } else {
    // Login failed
    echo 'Invalid username or password.';
  }
}
?>