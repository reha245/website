<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// InfinityFree database details:
$servername = "sql310.infinityfree.com"; // Your server name
$username = "if0_38580117";               // Your DB username
$password = "Ec5Tna1vGoTo75q";            // Your vPanel password
$dbname = "if0_38580117_message";         // Your DB name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        // Redirect to home page
        echo "<script>alert('Message sent successfully!'); window.location.href='index.html';</script>";
    } else {
        // Redirect to home page on error too
        echo "<script>alert('Error sending message.'); window.location.href='index.html';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
