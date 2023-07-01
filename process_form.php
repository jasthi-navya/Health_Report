<?php
$servername = "localhost";
$username = "";//username
$password = "";//password
$dbname = "";//database_name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$name = $_POST['name'];
$age = $_POST['age'];
$weight = $_POST['weight'];
$email = $_POST['email'];

// Insert user details into the database
$sql = "INSERT INTO users (name, age, weight, email) VALUES ('$name', $age, $weight, '$email')";
if ($conn->query($sql) === false) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Move the uploaded file to a desired location
$targetDir = "uploads/";
$targetFile = $targetDir . basename($_FILES["healthReport"]["name"]);
move_uploaded_file($_FILES["healthReport"]["tmp_name"], $targetFile);

// Insert file details into the database
$sql = "INSERT INTO health_reports (user_email, file_path) VALUES ('$email', '$targetFile')";
if ($conn->query($sql) === false) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
