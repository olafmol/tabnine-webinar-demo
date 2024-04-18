<?php
// Connect to the database
$db = mysqli_connect('localhost', 'username', 'password', 'database');

// Check if the form has been submitted
if (isset($_POST['username']) && isset($_POST['password'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Query the database for the user
  $query = "SELECT * FROM users WHERE username = '$username'";
  $result = mysqli_query($db, $query);

  // Check if the user exists
  if (mysqli_num_rows($result) == 1) {
    // Fetch the user details
    $user = mysqli_fetch_array($result);

    // Check if the password is correct
    if (password_verify($password, $user['password'])) {
      // Login the user
      session_start();
      $_SESSION['username'] = $username;
      $_SESSION['logged_in'] = true;

      // Redirect to the homepage
      header('Location: index.php');
      exit();
    } else {
      echo 'Invalid password';
    }
  } else {
    echo 'Invalid username';
  }
}
?>