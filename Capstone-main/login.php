<?php
// Start the session
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "capstone_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['login'])) {
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

            // Insert session record into the database
            $session_id = session_id(); // Get the session ID
            $login_time = date('Y-m-d H:i:s'); // Get current time
            $user_id = $row['id'];
            
            $insert_session_sql = "INSERT INTO sessions (user_id, session_id, login_time) VALUES ('$user_id', '$session_id', '$login_time')";
            if ($conn->query($insert_session_sql) === TRUE) {
                // Session record inserted successfully
                header("Location: landing_page.html");
                exit;
            } else {
                echo "Error: " . $insert_session_sql . "<br>" . $conn->error;
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