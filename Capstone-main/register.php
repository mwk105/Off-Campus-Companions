<?php
session_start(); // Place session_start() at the very beginning

// Database configuration
$servername = "localhost";
$username = "root"; // MySQL username
$password = ""; // MySQL password
$database = "users"; // MySQL database name for user registration

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['register'])) {
    // Handle registration form submission
    $fullName = $_POST['fullname'];
    $dateOfBirth = $_POST['dob'];
    $gender = $_POST['gender'];
    $yearOfSchool = $_POST['year_of_school'];
    $collegeMajor = $_POST['college_major'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security
    $email = $_POST['email'];
    
    // Prepare SQL statement to insert data into the users table
    $stmt = $conn->prepare("INSERT INTO users (fullname, dob, gender, year_of_school, college_major, username, password,email) VALUES (?, ?, ?, ?, ?, ?, ?,?)");
    $stmt->bind_param("ssssssss", $fullName, $dateOfBirth, $gender, $yearOfSchool, $collegeMajor, $username, $password,$email);
    
    // Execute the prepared statement
    if ($stmt->execute()) {
        // Registration successful, redirect to landing page
        header("Location: landing_page.html");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
    
    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
