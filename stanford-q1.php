<?php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO STUDENTS (NAME, AGE) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $name, $age);

$name = "John Doe";
$age = 25;

$stmt->execute();

echo "1 record inserted";

$stmt->close();
$conn->close();
?>