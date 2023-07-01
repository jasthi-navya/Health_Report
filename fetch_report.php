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

$email = $_GET['email'];

// Fetch user health report from the database
$sql = "SELECT file_path FROM health_reports WHERE user_email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $filePath = $row['file_path'];

    // Send the file to the user for download
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
    readfile($filePath);
} else {
    echo "No health report found for the specified email.";
}

$conn->close();
?>
