<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
    <link rel="stylesheet" href="style.css"> <!-- Include the style.css file -->
    <style>
        /* Add styles for the background image */
        body {
            background-image: url('background.png'); /* Adjust the path as necessary */
            background-size: cover;
            background-repeat: no-repeat;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
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

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h1, h2 {
            color: rgb(255, 255, 255)(252, 252, 252);
            font-weight: bold;
            text-align: center;
        }

        p {
            color: rgb(0, 0, 0);
            line-height: 1.6;
        }

        .tips {
            margin-bottom: 40px;
        }

        .tips h2 {
            color: #000000ce;
            text-align: center;
            margin-bottom: 20px;
        }

        .tips ul {
            list-style-type: none;
            padding: 0;
        }

        .tips ul li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        
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

        <div class="container">
            <div class="content">
                <?php
                session_start();

                // Database configuration
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "capstone_db";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $database);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch all users from the database
                $sql = "SELECT * FROM users";
                $result = $conn->query($sql);

                // Check if there are users
                if ($result->num_rows > 0) {
                    ?>
                    <table class="user-table"> <!-- Add class for styling -->
                        <tr>
                            <th>Full Name</th>    
                            <th>Gender</th>
                            <th>Year of School</th>
                            <th>College Major</th>
                            <th>Email</th>
                        </tr>
                        <?php
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $row["fullname"]; ?></td>
                                <td><?php echo $row["gender"]; ?></td>
                                <td><?php echo $row["year_of_school"]; ?></td>
                                <td><?php echo $row["college_major"]; ?></td>
                                <td><a href="mailto:<?php echo $row["email"]; ?>"><?php echo $row["email"]; ?></a></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                    <?php
                } else {
                    echo "No users found";
                }

                // Close connection
                $conn->close();
                ?>
            </div>
        </div>

    </div>
</body>
</html>
