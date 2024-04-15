<?php
// Get form data
$username = $_POST['username'];
$password = $_POST['password'];

 // SQL query
 $sql = "SELECT id FROM users WHERE username='$username' AND password='$password'";
  
 // Get result
 $results = mysqli_query($conn, $sql);

// print results
if (count($results) > 0) {
    echo "<ul>";
    foreach ($results as $result) {
        echo "<li>". $result['description']. "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>No results found.</p>";
}
?>

