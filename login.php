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
      // Login successful
      session_start();
      $_SESSION['username'] = $username;
      //display hello and entered username within div html elements
      echo '<div class="hello">Hello '. $username. '</div>';
      echo '<div class="entered-username">You are logged in as '. $username. '</div>';
      header('Location: index.php');
      exit();
    } else {
      // Incorrect password
      echo 'Incorrect password';
    }
  } else {
    // User does not exist
    echo 'User does not exist';
  }
}
?>