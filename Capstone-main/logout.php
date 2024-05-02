<?php
session_start(); // Place session_start() at the very beginning

// Database configuration
$servername = "localhost";
$username = "root"; // MySQL username
$password = ""; // MySQL password
$database = "capstone_db"; // MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle logout
if (isset($_GET['logout'])) {
    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Delete session from the database
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    if ($user_id) {
        $delete_session_sql = "DELETE FROM sessions WHERE user_id = ?";
        $stmt = $conn->prepare($delete_session_sql);
        $stmt->bind_param("i", $user_id);
        if ($stmt->execute()) {
            // Session deleted successfully
        } else {
            echo "Error deleting session: " . $stmt->error;
        }
        $stmt->close();
    }

    // Redirect to the login page or any other page after logout
    header("Location: index.html");
    exit;
}

if (isset($_POST['register'])) {
    // Handle registration form submission
    // Your registration code here
} elseif (isset($_POST['login'])) {
    // Handle login form submission
    // Your login code here
}

// Close connection
$conn->close();
?>
