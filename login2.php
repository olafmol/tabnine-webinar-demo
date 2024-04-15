<?php
// Database connection
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get username and password from form
$username = $_POST['username'];
$password = $_POST['password'];

// Prepare and bind statement
$stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);

// Execute statement
$stmt->execute();

// Get result
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows > 0) {
    // Fetch user data
    $row = $result->fetch_assoc();

    // Verify password
    if (password_verify($password, $row['password'])) {
        // User is authenticated, set session variables
        session_start();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $username;
        header("Location: welcome.php");
        exit;
    } else {
        // Invalid password
        echo "Invalid password";
    }
} else {
    // User not found
    echo "User not found";
}

// Close statement and connection
$stmt->close();
$conn->close();
?>