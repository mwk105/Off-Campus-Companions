<?php
session_start();

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

if (isset($_POST['submit_review'])) {
    // Handle review submission
    $reviewer_name = $_POST['reviewer_name'];
    $reviewee_name = $_POST['reviewee_name'];
    $review = $_POST['review'];
    $rating = $_POST['rating'];

    // Prepare SQL statement to insert review into the reviews table
    $stmt = $conn->prepare("INSERT INTO reviews (review_id, reviewer_name, reviewee_name, review, rating) VALUES (?,?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $review_id, $reviewer_name, $reviewee_name, $review, $rating);

    // Execute the prepared statement
    if ($stmt->execute()) {
        // Review submitted successfully, redirect to reviews page
        header("Location: reviews.php");
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
