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
   = ['file'];

  // Check if file was uploaded successfully
  if(['error'] == 0){

    // Get file details
     = ['name'];
     = ['tmp_name'];
     = ['size'];
     = ['type'];

    // Allow only specific file types
     = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');

    // Check if file type is allowed
    if(in_array(, )){

      // Check if file size is less than 10MB
      if( < 1048576){

        // Get the current date and time
         = date('Y-m-d H:i:s');

        // Generate a unique filename
         = uniqid() . "_" . ;

        // Move the uploaded file to the desired location
        if(move_uploaded_file(, "uploads/" . )){

          // Insert the file details into the database
           = "INSERT INTO files (filename, filetype, filesize, uploaded_at) VALUES (?, ?, ?, ?)";
           = ->prepare();
          ->bind_param("sss", , , , );

          // Execute statement
          if(->execute()){
            // Display success message
            echo "File uploaded successfully!";
          } else {
            // Display error message
            echo "Error: " .  . "<br>" . ->error;
          }

        } else {
          // Display error message
          echo "Error: Unable to move the uploaded file to the desired location.";
        }

      } else {
        // Display error message
        echo "Error: The file size must be less than 10MB.";
      }

    } else {
      // Display error message
      echo "Error: The file type is not allowed.";
    }

  } else {
    // Display error message
    echo "Error: " . ['error'];
  }

} else {

  // Display file