<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Posts</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Add styles for the background image */
        body {
            background-image: url('background.png'); /* Adjust the path as necessary */
            background-size: cover;
            background-repeat: no-repeat;
        }

        /* CSS styles for the forum container */
        .forum-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            color: #4e5752;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* CSS styles for the menu bar */
        nav.menu {
            background-color: #4e5752;
            color: #ffffff;
            padding: 10px 0;
            text-align: center;
        }

        nav.menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        nav.menu ul li {
            display: inline;
            margin-right: 20px;
        }

        nav.menu ul li a {
            color: #ffffff;
            text-decoration: none;
        }

        nav.menu ul li a:hover {
            text-decoration: underline;
        }

        /* CSS styles for forum posts */
        .forum-post {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }

        .forum-post h3 {
            margin-top: 0;
        }

        .forum-post p {
            margin-bottom: 5px;
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

    <div class="forum-container">
        <h1>Forum Posts</h1>

        <?php
        session_start();

        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "capstone_db";

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $budget = $_POST['budget'];
            $post = $_POST['post'];

            $stmt = $conn->prepare("INSERT INTO forum (name, budget, post) VALUES (?, ?, ?)");
            $stmt->bind_param("sis", $name, $budget, $post);

            if ($stmt->execute()) {
                header("Location: forum.php");
                exit;
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        }

        $sql = "SELECT forum_id, name, budget, post FROM forum";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='forum-post'>";
                echo "<h3>Post #: " . $row["forum_id"] . "</h3>";
                echo "<p><strong>Name:</strong> " . $row["name"] . "</p>";
                echo "<p><strong>Budget:</strong> $" . $row["budget"] . "</p>";
                echo "<p><strong>Post:</strong> " . $row["post"] . "</p>";
                echo "<a href='post_details.php?forum_id=" . $row["forum_id"] . "'>View Details</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No forum posts yet.</p>";
        }
        ?>

        <hr>

        <h2>Add New Forum Post</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name"><br>
            <label for="budget">Budget:</label><br>
            <input type="number" id="budget" name="budget"><br>
            <label for="post">Post:</label><br>
            <textarea id="post" name="post"></textarea><br>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
