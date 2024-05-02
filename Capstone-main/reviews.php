<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Off Campus Companions</title>
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
    </style>
</head>
<body>
    <nav class="menu">
        <ul>
            <li><a href="landing_page.html">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="reviews.html">Reviews + Ratings</a></li>
            <li><a href="faq.php">FAQ</a></li>
            <li><a href="user_search.php">User Search</a></li>
            <li><a href="forum.php">User Forum</a></li>
            <li><a href="index.html">Logout</a></li>
        </ul>
    </nav>
    <div class="container">
        
        <section class="content">
            <h2>Leave a Review</h2>
            <form action="submit_review.php" method="POST">
                <label for="reviewer_name">Your Name:</label><br>
                <input type="text" id="reviewer_name" name="reviewer_name"><br>
                <label for="reviewee_name">Name of Person Reviewed:</label><br>
                <input type="text" id="reviewee_name" name="reviewee_name"><br>
                <label for="review">Your Review:</label><br>
                <textarea id="review" name="review" rows="4" cols="50"></textarea><br>
                <label for="rating">Rating (1-10):</label><br>
                <input type="number" id="rating" name="rating" min="1" max="10"><br><br>
                <input type="submit" name="submit_review" value="Submit"> <!-- Changed the input name to 'submit_review' -->
            </form>
            
            <h2>Reviews</h2>
<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = ""; // Assuming your MySQL password is empty
$dbname = "capstone_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch reviews from the database and display them
$sql = "SELECT review_id, reviewer_name, reviewee_name, review, rating FROM reviews";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<p><strong>Reviewer:</strong> " . $row["reviewer_name"]. "<br>";
        echo "<strong>Reviewee:</strong> " . $row["reviewee_name"]. "<br>";
        echo "<strong>Review:</strong> " . $row["review"]. "<br>";
        echo "<strong>Rating:</strong> " . $row["rating"]. "</p>";
    }
} else {
    echo "No reviews found.";
}

// Close the database connection
$conn->close();
?>

        </section>
        <footer>
            <p>&copy; 2024 OffCampusCompanions.Com. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>