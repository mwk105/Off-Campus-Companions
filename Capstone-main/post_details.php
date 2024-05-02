<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Post Details</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Add your custom styles here */
    </style>
</head>
<body>
    <nav class="menu">
        <ul>
            <li><a href="landing_page.html">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="reviews.php">Reviews + Ratings</a></li>
            <li><a href="faq.php">FAQ</a></li>
            <li><a href="user_search.php">User Search</a></li>
            <li><a href="forum.php">User Forum</a></li>
            <li><a href="index.html">Logout</a></li>
        </ul>
    </nav>

    <div class="post-container">
        <h1>Forum Post Details</h1>

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

        if (isset($_GET['forum_id'])) {
            $forum_id = $_GET['forum_id'];

            // Fetch forum post details
            $stmt = $conn->prepare("SELECT forum_id, name, budget, post FROM forum WHERE forum_id = ?");
            $stmt->bind_param("i", $forum_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div>";
                    echo "<h3>Post #: " . $row["forum_id"] . "</h3>";
                    echo "<p><strong>Name:</strong> " . $row["name"] . "</p>";
                    echo "<p><strong>Budget:</strong> $" . $row["budget"] . "</p>";
                    echo "<p><strong>Post:</strong> " . $row["post"] . "</p>";
                    echo "</div>";
                }

                // Display reply form
                echo "<div>";
                echo "<h2>Reply to Post</h2>";
                echo "<form method='post' action='post_details.php?forum_id=$forum_id'>";
                echo "<label for='name'>Name:</label><br>";
                echo "<input type='text' id='name' name='name'><br>";
                echo "<label for='budget'>Budget:</label><br>";
                echo "<input type='number' id='budget' name='budget'><br>";
                echo "<label for='post'>Reply:</label><br>";
                echo "<textarea id='post' name='post'></textarea><br>";
                echo "<input type='submit' value='Submit'>";
                echo "</form>";
                echo "</div>";

                // Fetch and display replies
                $stmt_replies = $conn->prepare("SELECT name, budget, post FROM forum_replies WHERE forum_id = ?");
                $stmt_replies->bind_param("i", $forum_id);
                $stmt_replies->execute();
                $result_replies = $stmt_replies->get_result();

                if ($result_replies->num_rows > 0) {
                    echo "<h2>Replies</h2>";
                    while ($row = $result_replies->fetch_assoc()) {
                        echo "<div>";
                        echo "<p><strong>Name:</strong> " . $row["name"] . "</p>";
                        echo "<p><strong>Budget:</strong> $" . $row["budget"] . "</p>";
                        echo "<p><strong>Reply:</strong> " . $row["post"] . "</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No replies yet.</p>";
                }

            } else {
                echo "<p>Post not found.</p>";
            }
            $stmt->close();
        } else {
            echo "<p>No post selected.</p>";
        }

        // Handle reply submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Handle form submission to add a new reply to the forum post
            $name = $_POST['name'];
            $budget = $_POST['budget'];
            $reply = $_POST['post'];

            $stmt_reply = $conn->prepare("INSERT INTO forum_replies (forum_id, name, budget, post) VALUES (?, ?, ?, ?)");
            $stmt_reply->bind_param("isds", $forum_id, $name, $budget, $reply);

            if ($stmt_reply->execute()) {
                // Refresh the page to display the new reply
                echo "<meta http-equiv='refresh' content='0'>";
            } else {
                echo "Error: " . $stmt_reply->error;
            }

            $stmt_reply->close();
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
