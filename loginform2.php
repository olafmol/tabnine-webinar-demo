<?php

// Start session 
session_start();

// MySQL database connection
 = "localhost";
 = "username"; 
 = "password";
 = "myDB";

// Create connection
 = mysqli_connect(, , , );

// Check connection
if (!) {
  die("Connection failed: " . mysqli_connect_error());
}

// If form submitted
if(["REQUEST_METHOD"] == "POST") {

  // Get form data
   = ['username'];
   = ['password'];

  // Prepare and bind statement
   = mysqli_prepare(, "SELECT id, username, password FROM users WHERE username=?");
  mysqli_stmt_bind_param(, "s", );

  // Execute statement
  mysqli_stmt_execute();

  // Get result
   = mysqli_stmt_get_result();

  // If matching record found
  if(mysqli_num_rows() == 1) {
    // Fetch data
     = mysqli_fetch_assoc();

    // Verify password
    if(password_verify(, ['password'])) {
      // Start session
      session_start();

      // Store data in session variables
      ['loggedin'] = true;
      ['username'] = ;

      // Redirect to welcome page
      header("location: welcome.php");
    }
    else {
       = "Invalid password";
    }
  }
  else {
     = "Invalid username or password";
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
if(isset()) {
  echo ; 
}
?>