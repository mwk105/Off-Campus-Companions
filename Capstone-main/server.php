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
    // Destroy session and redirect to login page
    session_destroy();
    header("Location: login.php");
    exit;
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
    $stmt = $conn->prepare("INSERT INTO users (fullname, dob, gender, year_of_school, college_major, username, password,email) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
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
} elseif (isset($_POST['login'])) {
    // Handle login form submission
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username exists in the database
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Username exists, verify the password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password is correct, create session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $username;

            // Insert or update session record into the database
            $session_id = session_id(); // Get the session ID
            $login_time = date('Y-m-d H:i:s'); // Get current time
            $user_id = $row['id'];

            // Check if session already exists for this user
            $check_session_sql = "SELECT id FROM sessions WHERE user_id = ? LIMIT 1";
            $stmt = $conn->prepare($check_session_sql);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $existing_session = $stmt->get_result()->fetch_assoc();

            if ($existing_session) {
                // Session already exists, update it
                $update_session_sql = "UPDATE sessions SET session_id = ?, login_time = ? WHERE id = ?";
                $stmt = $conn->prepare($update_session_sql);
                $stmt->bind_param("ssi", $session_id, $login_time, $existing_session['id']);
            } else {
                // Session does not exist, insert new session
                $insert_session_sql = "INSERT INTO sessions (user_id, session_id, login_time) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($insert_session_sql);
                $stmt->bind_param("iss", $user_id, $session_id, $login_time);
            }

            if ($stmt->execute()) {
                // Session record inserted or updated successfully
                header("Location: landing_page.html");
                exit;
            } else {
                echo "Error: " . $stmt->error;
            }
        } else {
            echo "Incorrect username or password";
        }
    } else {
        echo "Incorrect username or password";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>