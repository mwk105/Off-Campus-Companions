<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Add styles for the background image */
        body {
            background-image: url('background.png'); /* Adjust the path as necessary */
            background-size: cover;
            background-repeat: no-repeat;
        }

        /* Style for the menu bar */
        nav {
            background-color: #4e5752;
            color: #ffffff;
            padding: 10px 0;
            text-align: center;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            color: #ffffff;
            text-decoration: none;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }

        .verification-image {
            width: 20px; /* Adjust as needed */
            vertical-align: middle;
        }

        .profile-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            color: #4e5752;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <nav class="menu">
        <ul>
        <li><a href="landing_page.html">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="user_search.php">User Search</a></li>
            <li><a href="forum.html">User Forum</a></li>
            <li><a href="reviews.php">Reviews + Ratings</a></li>
            <li><a href="faq.php">FAQ</a></li>   
            <li><a href="index.html">Logout</a></li>
        </ul>
    </nav>
    <div class="container">
        <div class="profile-container">
            <h2>User Profile</h2>
            <?php
            // Start the session
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

            // Check if user is logged in
            if(isset($_SESSION['user_id'])) {
                // Fetch user data from the database
                $user_id = $_SESSION['user_id'];
                $sql = "SELECT * FROM users WHERE id = $user_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Display user information
                    $row = $result->fetch_assoc();
                    echo "<p><strong>Full Name: </strong> " . $row['fullname'] . "</p>";
                    echo "<p><strong>Date of Birth: </strong> " . $row['dob'] . "</p>";
                    echo "<p><strong>Gender: </strong> " . $row['gender'] . "</p>";
                    echo "<p><strong>Year of School: </strong> " . $row['year_of_school'] . "</p>";
                    echo "<p><strong>College Major: </strong> " . $row['college_major'];
                    echo "<p><strong>Email: </strong>". $row['email'];
                    
                    // Check if email ends with "@mail.adelphi.edu"
                    if (strpos($row['email'], '@mail.adelphi.edu') !== false) {
                        echo " <img src='blue_check.png' alt='Verification' class='verification-image'>";
                    }
                    echo "</p>";
                }
            }

            // Close connection
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
