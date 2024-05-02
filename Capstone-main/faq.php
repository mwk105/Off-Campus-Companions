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

        /* Style for FAQ items */
        .faq-list {
            list-style: none;
            padding: 0;
            margin-top: 20px;
        }

        .faq-item {
            margin-bottom: 10px;
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 5px;
        }

        .question {
            cursor: pointer;
        }

        .answer {
            display: none;
        }

        .arrow {
            float: right;
        }
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
    <div class="container">
    
        <section class="content">
            <h2>Frequently Asked Questions</h2>
            <ul class="faq-list">
                <li class="faq-item">
                    <div class="question" onclick="toggleAnswer(this)">Who Can Use Off Campus Companions?<span class="arrow">▼</span></div>
                    <div class="answer">As of now, Off Campus Companions is for current Adelphi students with provisions to expand to other universities in the future!</div>
                </li>
                <li class="faq-item">
                    <div class="question" onclick="toggleAnswer(this)">How can I verify my profile?<span class="arrow">▼</span></div>
                    <div class="answer">When you sign up, use your Adelphi Email and your profile can become verified.</div>
                </li>
                <li class="faq-item">
                    <div class="question" onclick="toggleAnswer(this)"> Can I change any of my information if anything changes in the future?<span class="arrow">▼</span></div>
                    <div class="answer">Yes! You can do so by visiting your profile page and editing your information!</div>
                </li>
                <li class="faq-item">
                    <div class="question" onclick="toggleAnswer(this)">How can I leave a review for my roommate?<span class="arrow">▼</span></div>
                    <div class="answer">You can leave a review on the Reviews page and including their name in the text box.</div>
                </li>
                <li class="faq-item">
                    <div class="question" onclick="toggleAnswer(this)">How can I find other people?<span class="arrow">▼</span></div>
                    <div class="answer">You can find other users on the User Search page!</div>
                </li>
                <li class="faq-item">
                    <div class="question" onclick="toggleAnswer(this)">How can I connect with others?<span class="arrow">▼</span></div>
                    <div class="answer">You can connect with other users using our User Forum. There you can make your own post and respond to others!</div>
                </li>
                <!-- Add more FAQ items as needed -->
            </ul>
        </section>
        <footer>
            <p>&copy; 2024 OffCampusCompanions.Com. All rights reserved.</p>
        </footer>
    </div>

    <script>
        function toggleAnswer(question) {
            var answer = question.nextElementSibling;
            answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
        }
    </script>
</body>
</html>
